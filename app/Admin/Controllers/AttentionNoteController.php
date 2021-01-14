<?php

namespace App\Admin\Controllers;

use App\Lionnote;
use App\Topfifteen;
use App\Extrastock;
use App\Admin\Actions\Post\TopReplicate;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;


class AttentionNoteController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header(trans('注目銘柄ノート一覧'))
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header(trans('admin.detail'))
            ->description(trans('admin.description'))
            ->body($this->detail($id));
    }


    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header(trans('admin.edit'))
            ->description(trans('admin.description'))
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header(trans('admin.create'))
            ->description(trans('admin.description'))
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Topfifteen);

        $grid->id('ID')->modal('情報', function () {

            $data = [
                [
                    $this->id,
                    $this->cover,
                ]
            ];

            return new Table(['ID', '表紙'], $data);
        })->sortable();

        $grid->column('cover', '表紙')->image('https://stock-database.s3.ap-northeast-1.amazonaws.com/', 100, 100);

        $grid->created_at('Created at')->label('danger');
        $grid->updated_at('Updated at')->badge();
        $grid->actions(function ($actions) {
            $actions->add(new TopReplicate);
        });

        $grid->filter(function ($filter) {
            $filter->column(1/2, function ($filter) {
                $filter->disableIdFilter();
                $filter->between('created_at', '登録日時')->datetime();
            });
            // $filter->column(1/2, function ($filter) {
            //     $filter->contains('description','紹介文');          // Like検索
            // });
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
     public function detail($id)
     {
       $show = new Show(Reviewnote::findOrFail($id));

       $show->id('ID');

       return $show;
     }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Topfifteen);

        $form->tab('表紙と銘柄リスト',function($form) {
            $form->hidden('id');
            $form->image('cover', '表紙');
         
        })->tab('個別銘柄情報',function($form) {
            $form->hasMany('stocks','銘柄解説',function(Form\NestedForm $nestedForm) {
                $nestedForm->hidden('id');
                $nestedForm->number('stock_ranking','銘柄順位');
                $nestedForm->number('stock_number','銘柄コード');
                $nestedForm->text('stock_name','銘柄名');
                $nestedForm->text('dekidaka', '出来高');
                $nestedForm->text('overunder', 'Over/Under比');
                $nestedForm->image('chart_picture','日足チャート');
                $nestedForm->textarea('description','説明');
            });
        })->tab('EXTRA銘柄', function($form) {
            $form->hasMany('extras','追加銘柄',function(Form\NestedForm $nestedForm) {
                $nestedForm->hidden('id');
                $nestedForm->number('stock_number', '銘柄コード');
                $nestedForm->text('stock_name', '銘柄名');
            });
        });

        return $form;
    }

    public function store()
    {
        request()->merge(['user_id' => auth('admin')->user()->id]);

        return $this->form()->store();
    }

    public function update($id)
    {
        request()->merge(['user_id' => auth('admin')->user()->id]);

        return $this->form()->update($id);
    }
}

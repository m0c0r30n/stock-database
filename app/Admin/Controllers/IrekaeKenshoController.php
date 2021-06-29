<?php

namespace App\Admin\Controllers;

use App\Irekaekensho;
use App\Irekaestock;
use App\Admin\Actions\Post\IrekaeReplicate;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;

class IrekaeKenshoController extends Controller
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
            ->header(trans('入れ替え検証一覧'))
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
        $grid = new Grid(new Irekaekensho);

        $grid->id('ID')->modal('情報', function () {

            $data = [
                [
                    $this->id,
                    $this->date,
                ]
            ];

            return new Table(['ID', '日付'], $data);
        })->sortable();

        $grid->date('日付')->setAttributes(['style' => 'min-width:150px;'])->editable();

        $grid->created_at('Created at')->label('danger');
        $grid->updated_at('Updated at')->badge();
        $grid->actions(function ($actions) {
            $actions->add(new IrekaeReplicate);
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
       $show = new Show(Irekaekensho::findOrFail($id));

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
        $form = new Form(new Irekaekensho);

        $form->tab('入れ替え検証',function($form) {
            $form->hidden('id');
            $form->date('date', '日付');
         
        })->tab('個別銘柄情報',function($form) {
            $form->hasMany('stocks','銘柄解説',function(Form\NestedForm $nestedForm) {
                $nestedForm->hidden('id');
                $nestedForm->number('stock_number','銘柄コード');
                $nestedForm->image('irekae_before','入れ替え銘柄チャート前');
                $nestedForm->image('irekae_after','入れ替え銘柄チャート後');
                $nestedForm->textarea('info','企業情報');
                $nestedForm->textarea('result', '結果とまとめ');
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

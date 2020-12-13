<?php

namespace App\Admin\Controllers;

use App\Sikihodata;
use App\Stockdatabase;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;


class StockDatabaseController extends Controller
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
            ->header(trans('株データベース一覧'))
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
        $grid = new Grid(new Stockdatabase);

        $grid->id('ID')->modal('情報', function () {

            $data = [
                [
                    $this->id,
                    $this->stock_number,
                    $this->stock_name,
                ]
            ];

            return new Table(['ID', '銘柄コード', '銘柄名'], $data);
        })->sortable();

        // $grid->column('stock_number', '銘柄コード')->image('https://circle-thumbnail.s3.ap-northeast-1.amazonaws.com/', 100, 100);

        $grid->stock_number('銘柄コード')->setAttributes(['style' => 'min-width:150px;'])->editable();
        $grid->stock_name('銘柄名')->setAttributes(['style' => 'min-width:150px;'])->editable();
        
        $grid->created_at('Created at')->label('danger');
        $grid->updated_at('Updated at')->badge();

        $grid->filter(function ($filter) {
            $filter->column(1/2, function ($filter) {
                $filter->disableIdFilter();
                $filter->startsWith('stock_number','銘柄コード');      // 前方一致
                $filter->startsWith('stock_name','銘柄名');      // 前方一致
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
       $show = new Show(Stockdatabase::findOrFail($id));

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
        $form = new Form(new Stockdatabase);

        $form->tab('銘柄名と銘柄コード',function($form) {
            $form->hidden('id');
            $form->text('stock_number', '銘柄コード');
            $form->text('stock_name', '銘柄名');
         
        })->tab('四季報情報',function($form) {
            $form->hasMany('sikiho','銘柄解説',function(Form\NestedForm $nestedForm) {
                $nestedForm->hidden('id');
                $nestedForm->number('sikiho_year_season','年号と季節');
                $nestedForm->text('sikiho_title', 'タイトル');
                $nestedForm->textarea('characteristic','銘柄特性');
                $nestedForm->textarea('perspective','銘柄見通し');
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

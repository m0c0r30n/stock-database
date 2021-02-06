<?php

namespace App\Admin\Controllers;

use App\Indivilionpdf;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;


class IndiviLionpdfController extends Controller
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
            ->header(trans('過去の注目銘柄PDF一覧'))
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
        $grid = new Grid(new Indivilionpdf);

        $grid->id('ID')->modal('情報', function () {

            $data = [
                [
                    $this->id,
                    $this->date,
                    $this->stock_number,
                    $this->ranking,
                ]
            ];

            return new Table(['ID', '日にち', '銘柄コード', 'ランキング'], $data);
        })->sortable();

        $grid->date('日にち')->setAttributes(['style' => 'min-width:100px;'])->editable();
        $grid->stock_number('銘柄コード')->setAttributes(['style' => 'min-width:100px;'])->editable();
        $grid->ranking('ランキング')->setAttributes(['style' => 'min-width:100px;'])->editable();
        
        $grid->created_at('Created at')->label('danger');
        $grid->updated_at('Updated at')->badge();

        $grid->filter(function ($filter) {
            $filter->column(1/2, function ($filter) {
                $filter->disableIdFilter();
                $filter->startsWith('stock_number','銘柄コード');      // 前方一致
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
       $show = new Show(Indivilionpdf::findOrFail($id));

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
        $form = new Form(new Indivilionpdf);

        $form->display('id', 'ID');
        $form->date('date', '日付');
        $form->number('stock_number', '銘柄コード');
        $form->number('ranking', '銘柄順位');
        $form->file('pdf', 'pdfファイル');
        $form->display('created_at', 'Created At');
        $form->display('updated_at', 'Updated At');

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

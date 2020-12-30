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
                    $this->stockname1,
                    $this->stockname2,
                    $this->stockname3,
                    $this->stockname4,
                    $this->stockname5,
                ]
            ];

            return new Table(['ID', '表紙', '銘柄1位', '銘柄2位', '銘柄3位', '銘柄4位', '銘柄5位'], $data);
        })->sortable();

        $grid->column('cover', '表紙')->image('https://circle-thumbnail.s3.ap-northeast-1.amazonaws.com/', 100, 100);

        $grid->stockname1('銘柄1位')->setAttributes(['style' => 'min-width:150px;'])->editable();
        $grid->stockname2('銘柄2位')->setAttributes(['style' => 'min-width:150px;'])->editable();
        $grid->stockname3('銘柄3位')->setAttributes(['style' => 'min-width:150px;'])->editable();
        $grid->stockname4('銘柄4位')->setAttributes(['style' => 'min-width:150px;'])->editable();
        $grid->stockname5('銘柄5位')->setAttributes(['style' => 'min-width:150px;'])->editable();
        $grid->stockname6('銘柄6位')->setAttributes(['style' => 'min-width:150px;'])->editable();
        $grid->stockname7('銘柄7位')->setAttributes(['style' => 'min-width:150px;'])->editable();
        $grid->stockname8('銘柄8位')->setAttributes(['style' => 'min-width:150px;'])->editable();
        $grid->stockname9('銘柄9位')->setAttributes(['style' => 'min-width:150px;'])->editable();
        $grid->stockname10('銘柄10位')->setAttributes(['style' => 'min-width:150px;'])->editable();
        $grid->stockname11('銘柄11位')->setAttributes(['style' => 'min-width:150px;'])->editable();
        $grid->stockname12('銘柄12位')->setAttributes(['style' => 'min-width:150px;'])->editable();
        $grid->stockname13('銘柄13位')->setAttributes(['style' => 'min-width:150px;'])->editable();
        $grid->stockname14('銘柄14位')->setAttributes(['style' => 'min-width:150px;'])->editable();
        $grid->stockname15('銘柄15位')->setAttributes(['style' => 'min-width:150px;'])->editable();
        $grid->created_at('Created at')->label('danger');
        $grid->updated_at('Updated at')->badge();
        $grid->actions(function ($actions) {
            $actions->add(new TopReplicate);
        });

        $grid->filter(function ($filter) {
            $filter->column(1/2, function ($filter) {
                $filter->disableIdFilter();
                $filter->startsWith('stock1','銘柄1位');      // 前方一致
                $filter->startsWith('stock2','銘柄2位');      // 前方一致
                $filter->startsWith('stock3','銘柄3位');      // 前方一致
                $filter->startsWith('stock4','銘柄4位');      // 前方一致
                $filter->startsWith('stock5','銘柄5位');      // 前方一致
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
            $form->text('stockname1', '1位');
            $form->text('stockname2', '2位');
            $form->text('stockname3', '3位');
            $form->text('stockname4', '4位');
            $form->text('stockname5', '5位');
            $form->text('stockname6', '6位');
            $form->text('stockname7', '7位');
            $form->text('stockname8', '8位');
            $form->text('stockname9', '9位');
            $form->text('stockname10', '10位');
            $form->text('stockname11', '11位');
            $form->text('stockname12', '12位');
            $form->text('stockname13', '13位');
            $form->text('stockname14', '14位');
            $form->text('stockname15', '15位');
            $form->text('stockname16', '16位 (別枠)');
            $form->text('stockname17', '17位 (別枠)');
            $form->text('stockname18', '18位 (別枠)');
            $form->text('stockname19', '19位 (別枠)');
            $form->text('stockname20', '20位 (別枠)');
         
        })->tab('個別銘柄情報',function($form) {
            $form->hasMany('stocks','銘柄解説',function(Form\NestedForm $nestedForm) {
                $nestedForm->hidden('id');
                $nestedForm->number('stock_ranking','銘柄順位');
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

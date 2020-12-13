<?php

namespace App\Admin\Controllers;

use App\Reviewnote;
use App\Admin\Actions\Post\Replicate;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;


class TopNoteAdminCoontroller extends Controller
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
            ->header(trans('振り返りノート一覧'))
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
        $grid = new Grid(new Reviewnote);

        $grid->id('ID')->modal('情報', function () {

            $data = [
                [
                    $this->id,
                    $this->date,
                    $this->stock1_name,
                    $this->stock1_daylychart,
                    $this->stock1_daychart,
                    $this->stock2_name,
                    $this->stock2_daylychart,
                    $this->stock2_daychart,
                ]
            ];

            return new Table(['ID', '日付', '銘柄1名前', '銘柄1日足チャート', '銘柄1日中足チャート', '銘柄2名前', '銘柄2日足チャート', '銘柄2日中足チャート'], $data);
        })->sortable();

        $grid->date('日付')->setAttributes(['style' => 'min-width:150px;'])->editable();
        $grid->stock1_name('銘柄1名前')->setAttributes(['style' => 'min-width:150px;'])->editable();
        $grid->stock1_daylychart('銘柄1日足チャート')->setAttributes(['style' => 'min-width:150px;'])->editable();
        $grid->stock1_daychart('銘柄1日中足チャート')->setAttributes(['style' => 'min-width:150px;'])->editable();
        $grid->stock2_name('銘柄2名前')->setAttributes(['style' => 'min-width:150px;'])->editable();
        $grid->stock2_daylychart('銘柄2日足チャート')->setAttributes(['style' => 'min-width:150px;'])->editable();
        $grid->stock2_daychart('銘柄2日中足チャート')->setAttributes(['style' => 'min-width:150px;'])->editable();
        
        $grid->actions(function ($actions) {
            $actions->add(new Replicate);
        });

        $grid->filter(function ($filter) {
            $filter->column(1/2, function ($filter) {
                $filter->disableIdFilter();
                $filter->startsWith('stock1_name','銘柄1名前');      // 前方一致
                $filter->startsWith('stock1_daylychart','銘柄1日足チャート');      // 前方一致
                $filter->startsWith('stock1_daychart','銘柄1日中足チャート');      // 前方一致
                $filter->startsWith('stock2_name','銘柄2名前');      // 前方一致
                $filter->startsWith('stock2_daylychart','銘柄2日足チャート');      // 前方一致
                $filter->startsWith('stock2_daychart','銘柄2日中足チャート');      // 前方一致
                $filter->between('created_at', '登録日時')->datetime();
            });
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
        $form = new Form(new Reviewnote);

        $form->tab('振り返りノート',function($form) {
            $form->hidden('id');
            $form->date('date', '入れ替え前の日付');
            $form->image('heatmap_before', 'ヒートマップ入れ替え前');
            $form->image('heatmap_after1', 'ヒートマップ入れ替え後寄り付き前');
            $form->text('stock1_name','銘柄1名前');
            $form->image('stock1_daylychart', '銘柄1日足チャート');
            $form->image('stock1_daychart', '銘柄1日中足チャート');
            $form->textarea('stock1_extension', '銘柄1選定理由');
            $form->textarea('stock1_review', '銘柄1振り返り');
            $form->text('stock2_name','銘柄2名前');
            $form->image('stock2_daylychart', '銘柄2日足チャート');
            $form->image('stock2_daychart', '銘柄2日中足チャート');
            $form->textarea('stock2_extension', '銘柄2選定理由');
            $form->textarea('stock2_review', '銘柄2振り返り');

        })->tab('入れ替え銘柄リスト',function($form) {
            $form->hasMany('stockchange','銘柄リスト',function(Form\NestedForm $nestedForm) {
                $nestedForm->hidden('id');
                $nestedForm->text('stock1','入れ替え銘柄1');
                $nestedForm->text('stock1_description','入れ替え銘柄1説明');
                $nestedForm->text('stock2','入れ替え銘柄2');
                $nestedForm->text('stock2_description','入れ替え銘柄2説明');
                $nestedForm->text('stock3','入れ替え銘柄3');
                $nestedForm->text('stock3_description','入れ替え銘柄3説明');
                $nestedForm->text('stock4','入れ替え銘柄4');
                $nestedForm->text('stock4_description','入れ替え銘柄4説明');
                $nestedForm->text('stock5','入れ替え銘柄5');
                $nestedForm->text('stock5_description','入れ替え銘柄5説明');
                $nestedForm->text('stock6','入れ替え銘柄6');
                $nestedForm->text('stock6_description','入れ替え銘柄6説明');
                $nestedForm->text('stock7','入れ替え銘柄7');
                $nestedForm->text('stock7_description','入れ替え銘柄7説明');
                $nestedForm->text('stock8','入れ替え銘柄8');
                $nestedForm->text('stock8_description','入れ替え銘柄8説明');
                $nestedForm->text('stock9','入れ替え銘柄9');
                $nestedForm->text('stock9_description','入れ替え銘柄9説明');
                $nestedForm->text('stock10','入れ替え銘柄10');
                $nestedForm->text('stock10_description','入れ替え銘柄10説明');
                $nestedForm->text('stock11','入れ替え銘柄11');
                $nestedForm->text('stock11_description','入れ替え銘柄11説明');
                $nestedForm->text('stock12','入れ替え銘柄12');
                $nestedForm->text('stock12_description','入れ替え銘柄12説明');
                $nestedForm->text('stock13','入れ替え銘柄13');
                $nestedForm->text('stock13_description','入れ替え銘柄13説明');
                $nestedForm->text('stock14','入れ替え銘柄14');
                $nestedForm->text('stock14_description','入れ替え銘柄14説明');
                $nestedForm->text('stock15','入れ替え銘柄15');
                $nestedForm->text('stock15_description','入れ替え銘柄15説明');
                $nestedForm->text('stock16','入れ替え銘柄16');
                $nestedForm->text('stock16_description','入れ替え銘柄16説明');
                $nestedForm->text('stock17','入れ替え銘柄17');
                $nestedForm->text('stock17_description','入れ替え銘柄17説明');
                $nestedForm->text('stock18','入れ替え銘柄18');
                $nestedForm->text('stock18_description','入れ替え銘柄18説明');
                $nestedForm->text('stock19','入れ替え銘柄19');
                $nestedForm->text('stock19_description','入れ替え銘柄19説明');
                $nestedForm->text('stock20','入れ替え銘柄20');
                $nestedForm->text('stock20_description','入れ替え銘柄20説明');
                $nestedForm->text('stock21','入れ替え銘柄21');
                $nestedForm->text('stock21_description','入れ替え銘柄21説明');
                $nestedForm->text('stock22','入れ替え銘柄22');
                $nestedForm->text('stock22_description','入れ替え銘柄22説明');
                $nestedForm->text('stock23','入れ替え銘柄23');
                $nestedForm->text('stock23_description','入れ替え銘柄23説明');
                $nestedForm->text('stock24','入れ替え銘柄24');
                $nestedForm->text('stock24_description','入れ替え銘柄24説明');
                $nestedForm->text('stock25','入れ替え銘柄25');
                $nestedForm->text('stock25_description','入れ替え銘柄25説明');
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

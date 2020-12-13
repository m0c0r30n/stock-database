<?php

namespace App\Admin\Controllers;

use App\Circle;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;


class CircleAdminController extends Controller
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
            ->header(trans('サークル情報一覧'))
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
        $grid = new Grid(new Circle);

        $grid->id('ID')->modal('情報', function () {

            $data = [
                [
                    $this->id,
                    $this->name,
                    $this->category,
                    $this->twitter_id,
                    $this->description,
                    $this->thumbnail,
                    $this->canpas_name,
                    $this->group_type,
                    $this->area,
                    $this->web_url,
                    $this->activity_day,
                    $this->activity_place,
                    $this->account_people,
                ]
            ];

            return new Table(['ID', 'サークル名', 'カテゴリー', 'ツイッターID', '紹介文', 'サムネイル', '大学名', 'グループタイプ', 'ウェブURL', '活動日', '活動場所', '人数'], $data);
        })->sortable();

        $grid->name('サークル名')->setAttributes(['style' => 'min-width:300px;'])->editable();
        $grid->category('カテゴリー')->setAttributes(['style' => 'min-width:120px;'])->editable();
        $grid->twitter_id('ツイッターID')->setAttributes(['style' => 'min-width:150px;'])->editable();
        $grid->description('紹介文')->setAttributes(['style' => 'min-width:350px;'])->limit(40)->expand(function () {
            return $this->detail;
        });
        $grid->column('thumbnail', 'サムネイル')->image('https://circle-thumbnail.s3.ap-northeast-1.amazonaws.com/', 100, 100);

        $grid->canpas_name('大学名')->setAttributes(['style' => 'min-width:150px;'])->editable();
        $grid->group_type('グループタイプ')->setAttributes(['style' => 'min-width:150px;']);
        $grid->area('エリア')->setAttributes(['style' => 'min-width:150px;']);
        $grid->web_url('ウェブURL')->setAttributes(['style' => 'min-width:150px;']);
        $grid->activity_day('活動日')->setAttributes(['style' => 'min-width:150px;']);
        $grid->activity_place('活動場所')->setAttributes(['style' => 'min-width:150px;']);
        $grid->account_people('人数')->setAttributes(['style' => 'min-width:150px;']);

        $grid->created_at('Created at')->label('danger');
        $grid->updated_at('Updated at')->badge();


        $grid->filter(function ($filter) {
            $filter->column(1/2, function ($filter) {
                $filter->disableIdFilter();
                $filter->startsWith('name','サークル名');      // 前方一致
                $filter->startsWith('canpas_name','大学名');      // 前方一致
                $filter->between('created_at', '登録日時')->datetime();
            });
            $filter->column(1/2, function ($filter) {
                $filter->contains('description','紹介文');          // Like検索
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
       $show = new Show(Circle::findOrFail($id));

       $show->id('ID');
       $show->name('サークル名');
       $show->category('カテゴリー');
       $show->twitter_id('ツイッターID');
       $show->description('紹介文');
       $show->thumbnail('サムネイル');
       $show->canpas_name('大学名');
       $show->group_type('グループタイプ');
       $show->area('エリア');
       $show->web_url('ウェブURL');
       $show->activity_day('活動日');
       $show->activity_place('活動場所');
       $show->account_people('人数');

       return $show;
     }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Circle);

        $form->display('id', 'ID');

        $form->text('name', 'サークル名');
        $category = [
          '野球'=> '野球', 'サッカー' => 'サッカー',
          'テニス' => 'テニス', 'バスケ' => 'バスケ',
          'バレー' => 'バレー', 'バドミントン' => 'バドミントン',
          '武道格闘技' => '武道格闘技',
          'スキー・スノボ' => 'スキー・スノボ',
          'マリン' => 'マリン', 'アウトドア' => 'アウトドア',
          'パフォーマンス' => 'パフォーマンス', '映像演劇' => '映像演劇',
          '出版企画' => '出版企画', '音楽' => '音楽',
          '法律経済' => '法律経済','語学国際' => '語学国際',
          'ボランティア' => 'ボランティア', 'その他スポーツ' => 'その他スポーツ',
          'その他文化系' => 'その他文化系'
        ];

        $form->select('category', 'カテゴリー')->options($category);
        $form->text('twitter_id', 'ツイッターID');

        $canpas_name = [
          '青山学院大学' => '青山学院大学', '慶應義塾大学' => '慶應義塾大学','上智大学' => '上智大学', '大東文化大学' => '大東文化大学', '中央大学' => '中央大学', '東京大学' => '東京大学',
          '法政大学' => '法政大学', '明治大学' => '明治大学','立教大学' => '立教大学', '早稲田大学' => '早稲田大学'
        ];

        $form->select('canpas_name', '大学名')->options($canpas_name);

        $group_type = [
          'オール学内' => 'オール学内', 'インカレ' => 'インカレ', '部活' => '部活'
        ];
        $form->select('group_type', 'グループタイプ')->options($group_type);

        $area = [
          '高田馬場' => '高田馬場', '池袋' => '池袋', '渋谷' => '渋谷', '八王子' => '八王子',
          '市ヶ谷' => '市ヶ谷', '田町' => '田町','新宿' => '新宿','横浜' => '横浜', '国分寺' => '国分寺', '埼玉' => '埼玉', 'その他' => 'その他'
        ];
        $form->select('area', 'エリア')->options($area);

        $form->textarea('description', '紹介文');
        $form->image('thumbnail', 'サムネイル');
        $form->text('web_url', 'ウェブURL');
        $form->text('activity_day', '活動日');
        $form->text('activity_place', '活動場所');
        $form->text('account_people', '人数');
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

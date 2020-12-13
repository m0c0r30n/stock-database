<?php

namespace App\Admin\Controllers;

use App\Todo;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;


class TodoController extends Controller
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
            ->header(trans('TODO一覧'))
            ->description(trans('一覧を表示してます'))
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
        $grid = new Grid(new Todo);

        // $grid->id('ID');
        // $grid->user()->name('ユーザー名');
        // $grid->title('タイトル');
        // $grid->detail('詳細');
        // $grid->created_at('Created at');
        // $grid->updated_at('Updated at');

        $grid->id('ID')->modal('情報', function () {

            $data = [
                [
                    $this->id,
                    $this->user->name,
                    $this->title,
                    $this->detail,
                ]
            ];

            return new Table(['ID', 'ユーザー名', 'タイトル', '詳細'], $data);
        })->sortable();

        $grid->user()->name('ユーザー名')->style('min-width:100px;');
        $grid->title('タイトル')->setAttributes(['style' => 'background-color:#ffdbdb;'])->editable();
        $grid->detail('詳細')->limit(20)->expand(function () {
            return $this->detail;
        });
        $grid->created_at('Created at')->label('danger');
        $grid->updated_at('Updated at')->badge();


        $grid->filter(function ($filter) {
            $filter->column(1/2, function ($filter) {
                $filter->disableIdFilter();
                $filter->startsWith('title','タイトル');      // 前方一致
                $filter->between('created_at', '登録日時')->datetime();
            });
            $filter->column(1/2, function ($filter) {
                $filter->contains('detail','詳細');          // Like検索
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
       $show = new Show(Todo::findOrFail($id));

       $show->id('ID');
       $show->title('タイトル');
       $show->detail('詳細');
       $show->created_at('Created at');
       $show->updated_at('Updated at');

       $show->user('ユーザー情報', function ($user) {
           $user->setResource('/admin/auth/users');
           $user->id('ユーザーID');
           $user->name('ユーザー名');
       });

       return $show;
     }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        // $form = new Form(new Todo);
        //
        // $form->display('ID');
        // $form->text('user_id', 'user_id');
        // $form->text('title', 'title');
        // $form->text('detail', 'detail');
        // $form->display(trans('admin.created_at'));
        // $form->display(trans('admin.updated_at'));
        //
        // return $form;

        $form = new Form(new Todo);

        $form->text('title', 'タイトル')->rules(function ($form) {
            return [
                'required',
                Rule::unique('todos')->where(function($query) {
                    // ログインID単位で一意
                    $query->where('user_id', auth('admin')->user()->id);
                }),
            ];
        })->required(true);
        $form->textarea('detail', '詳細')->rules('required');
        $form->hidden('user_id');

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

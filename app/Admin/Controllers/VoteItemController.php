<?php

namespace App\Admin\Controllers;

use App\Entities\Common\VoteItem;

use App\Entities\Common\VoteProject;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class VoteItemController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('报名记录');
            $content->description('报名记录描述');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('修改报名记录');
            $content->description('描述');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('添加报名记录');
            $content->description('描述');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(VoteItem::class, function (Grid $grid) {

            $grid->id('编号')->sortable();
            $grid->voteProject()->name('投票主题');
            $grid->main_image('主图')->image('', 50, 50);
            $grid->name('图片标题')->limit(10);
            $grid->openid('参与者微信');
            $grid->voted('投票数量');
            $grid->created_at('报名时间');
            $grid->status('审核状态')->select(VoteItem::$_status);

            $grid->filter(function($filter){
                $filter->disableIdFilter();
                $filter->like('openid', '参与者微信');

            });

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(VoteItem::class, function (Form $form) {

            $form->display('id', '编号');
            $form->select('vote_projects_id', '投票主题')->options(VoteProject::all()->pluck('name', 'id'))->rules('required');
            $form->text('openid', '参与者微信openid')->rules('required');
            $form->text('name', '图片标题');
            $form->text('desc', '图片描述');
            $form->multipleImage('images','投票图片')->removable();
            $form->select('status','审核状态')->options(VoteItem::$_status);;
        });
    }
}

<?php

namespace App\Admin\Controllers;

use App\Entities\Common\VoteProject;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class VoteProjectController extends Controller
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

            $content->header('投票主题');
            $content->description('投票描述');


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

            $content->header('编辑投票主题');
            $content->description('投票描述');

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

            $content->header('创建投票主题');
            $content->description('投票描述');

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
        return Admin::grid(VoteProject::class, function (Grid $grid) {

            $grid->id('编号')->sortable();
            $grid->name('投票主题');
            $grid->visitd('访问量');
            $grid->involved('参与者数量');
            $grid->voted('投票数量');
            $grid->start('开始时间');
            $grid->end('结束时间');
            $states = [
                'on' => ['text' => '启用'],
                'off' => ['text' => '关闭'],
            ];
            $grid->status('活动状态')->switch($states);
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(VoteProject::class, function (Form $form) {

            $form->display('id', '编号');
            $form->text('name', '投票主题')->rules('required');
            $form->editor('desc', '投票说明');
            $form->dateRange('start', 'end', '活动有效日期')->rules('required');
            $form->multipleImage('slide','投票主题幻灯片')->removable();
            $states = [
                'on'  => ['value' => VoteProject::OPEND, 'text' => '打开', 'color' => 'success'],
                'off' => ['value' => VoteProject::CLOSED, 'text' => '关闭', 'color' => 'danger'],
            ];
            $form->switch('status','活动状态')->states($states);
        });
    }
}


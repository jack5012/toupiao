<?php

namespace App\Admin\Controllers;

use App\Entities\Common\VoteRecord;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class VoteRecordController extends Controller
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

            $content->header('投票记录');
            $content->description('投票记录');

            $content->body($this->grid());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(VoteRecord::class, function (Grid $grid) {
            $grid->disableActions()->disableCreation()->disableRowSelector();
            $grid->id('编号')->sortable();
            $grid->voteItem()->main_image('投票对象')->image('',50,50);
            $grid->openid('投票者微信');
            $grid->update_at('投票时间');
        });
    }
}

<?php

namespace Touge\AdminSundry\Http\Controllers\Admin;

use Encore\Admin\Controllers\HasResourceActions;
use Touge\AdminOverwrite\Grid\Grid;
use Encore\Admin\Layout\Content;
use Touge\AdminSundry\Http\Controllers\BaseAdminController;
use Touge\AdminSundry\Models\CustomerMemberLog;

/**
 * 院校用户登录日志
 * Class CustomerMemberLogin
 * @package App\Admin\Controllers\Logs
 */
class CustomerMemberLogin extends BaseAdminController
{

    public function __construct()
    {
        $this->push_breadcrumb(["text"=> __('touge::touge-sundry.log.login'), 'url'=> admin_url('login')]);
    }

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        $this->set_breadcrumb($content);
        return $content
            ->header(__('touge::touge-sundry.log.login'))
            ->description(__('admin.list'))
            ->body($this->grid());
    }


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $self= $this;
        $grid = new Grid(new CustomerMemberLog());
        $grid->model()
            ->where(['customer_id'=> $this->customer_school_id()])
            ->orderBy("id", "DESC");
        $grid->id('Id');


        /**
         * 用户含身份信息
         */
        $grid->column("full_user" ,__('touge::touge-sundry.member_info'))->display(function(){

            $display_string= $this->user_name;

            $display_string.= "&nbsp;";
            if($this->identity==1){
                $display_string.= "<label class='label label-warning'>教师</label>";
            }else{
                $display_string.= "<label class='label label-danger'>学生</label>";
            }

            //如果有职务，加入
            if($this->job){
                $display_string.= "&nbsp;<label class='label label-info'>J:{$this->job}</label>";
            }

            if($this->mark){
                $display_string.= "&nbsp;<label class='label label-primary'>M:{$this->mark}</label>";
            }

            return $display_string;
        });

        $grid->ip('Ip')->display(function($ip){
            return $ip . "&nbsp;<a href='http://www.ip138.com/ips138.asp?action=2&ip={$ip}' target='_blank' title='查看IP来源'><i class='fa fa-external-link'></i></a>";
        });

        $grid->created_at(trans('admin.created_at'));


        $grid->disableActions();
        $grid->disableCreateButton()
            ->disableRowSelector()
            ->disableColumnSelector()
            ->disableExport()
            ;

        $grid->filter(function($filter){
            $filter->disableIdFilter();
            $filter->like('user_name', trans('admin.username'));
            $filter->between('created_at', trans('admin.created_at'))->datetime();

        });
        return $grid;
    }

}

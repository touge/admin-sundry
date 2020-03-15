<?php

namespace Touge\AdminSundry\Http\Controllers\Admin;

use Touge\AdminOverwrite\Grid\Grid;
use Encore\Admin\Layout\Content;
use Touge\AdminSundry\Http\Controllers\BaseAdminController;
use Touge\AdminSundry\Models\CustomerRecordLog;

/**
 * 院校用户登录日志
 * Class CustomerMemberLogin
 * @package App\Admin\Controllers\Logs
 */
class CustomerMemberRecord extends BaseAdminController
{
    protected $header= '院校客户-下载日志';

    public function __construct()
    {
        $this->push_breadcrumb(["text"=> __('touge::touge-sundry.log.record'), 'url'=> admin_url('record')]);
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
            ->header(__('touge::touge-sundry.log.record'))
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
        $grid = new Grid(new CustomerRecordLog());
        $grid->model()
            ->where(['customer_id'=> $this->customer_school_id()])
            ->orderBy("id", "DESC");

        $grid->id('Id')->style("width: 3%");
        $grid->column("customer_info",__('touge::touge-sundry.member_info'))->display(function(){
            $display_string= $this->user_name;

            $display_string.= "&nbsp;";
            if($this->identity==1){
                $display_string.= "<label class='label label-warning'>教</label>";
            }else{
                $display_string.= "<label class='label label-danger'>生</label>";
            }

            //如果有职务，加入
            if($this->job){
                $display_string.= "&nbsp;<label class='label label-info'>{$this->job}</label>";
            }

            if($this->mark){
                $display_string.= "&nbsp;<label class='label label-primary'>{$this->mark}</label>";
            }

            return $display_string;
        });

        $grid->column("flag_info" ,"项目/名称")->display(function(){
            $display_string= null;


            $res_flag_type=  "<label class='label label-warning'>项</label>";
            if($this->res_flag=='course'){
                $res_flag_type= "<label class='label label-success'>课</label>";
            }
            $display_string.= $res_flag_type;
            $display_string.= "&nbsp;".$this->res_flag_name;
            return $display_string;
        });

        $grid->column("download_info" ,"属性/内容")->display(function(){
            $display_string= null;

            switch ($this->res_type){
                case "zip":
                    $type_icon= "fa-download";
                    $type_class= "label-danger";
                    break;
                case "pdf":
                    $type_icon= "fa-eye";
                    $type_class= "label-info";
                    break;
                case "mp4":
                    $type_icon= "fa-play-circle";
                    $type_class= "label-warning";
                    break;
                default:
                    $type_icon= "fa-file-pdf-o";
                    $type_class= "label-primary";
            }
            $display_string.= "<label class='label {$type_class}'><i class='fa {$type_icon}'></i></label>";

            $display_string.= "&nbsp;<label class='label label-default'>$this->res_attribute_name</label>";
            $display_string.= "&nbsp;{$this->res_name}";

            return $display_string;
        });

        $grid->ip('Ip')->display(function($ip){
            return $ip . "&nbsp;<a href='http://www.ip138.com/ips138.asp?action=2&ip={$ip}' target='_blank' title='查看IP来源'><i class='fa fa-external-link'></i></a>";
        });

        $grid->created_at("时间");

        $grid->disableActions();

        $grid->disableExport()
            ->disableColumnSelector()
            ->disableRowSelector()
            ->disableCreateButton()
            ;

        $grid->filter(function($filter){
            // 去掉默认的id过滤器
            $filter->disableIdFilter();
            // 在这里添加字段过滤器
            $filter->like('user_name', trans('admin.username'));

            $filter->between('created_at', trans('admin.created_at'))->datetime();

        });
        return $grid;
    }
}

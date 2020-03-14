<?php

namespace Touge\AdminSundry\Http\Controllers\Admin;

use Encore\Admin\Form;
use Encore\Admin\Show;
use Touge\AdminOverwrite\Grid\Displayers\Actions;
use Touge\AdminSundry\Http\Controllers\BaseAdminController;
use Touge\AdminSundry\Models\Calendar;

use Touge\AdminOverwrite\Grid\Grid;

class CalendarController extends BaseAdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '签到记录';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Calendar());

        $model = $grid->model();
        $model->where(['customer_school_id'=> $this->customer_school_id()])->orderBy('id', 'desc');

        $grid->column('id', __('Id'));
//        $grid->customer_school_id('example');
        $grid->column('user.name', __('admin.name'));
//        $grid->column('type', __('Type'));
        $grid->column('title', __('admin.title'));
//        $grid->column('content', __('Content'));
        $grid->column('created_at', __('admin.created_at'));
//        $grid->column('updated_at', __('Updated at'));

        $grid->disableExport()
            ->disableColumnSelector()
            ->disableFilter()
            ->disableCreateButton()
            ->disableRowSelector();

        $grid->actions(function(Actions $actions){
            $actions->disableDelete()->disableEdit();
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Calendar::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('type', __('Type'));
        $show->field('title', __('Title'));
        $show->field('content', __('Content'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Calendar());

        $form->number('user_id', __('User id'));
        $form->text('type', __('Type'));
        $form->text('title', __('Title'));
        $form->textarea('content', __('Content'));

        return $form;
    }
}

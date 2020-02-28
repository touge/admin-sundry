<?php

namespace Touge\AdminSundry\Http\Controllers\Admin;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Touge\AdminSundry\Http\Controllers\BaseAdminController;
use Touge\AdminSundry\Models\Calendar;

class CalendarController extends BaseAdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Touge\AdminSundry\Models\Calendar';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Calendar());

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'));
        $grid->column('type', __('Type'));
        $grid->column('title', __('Title'));
        $grid->column('content', __('Content'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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

<?php

namespace Touge\AdminSundry\Http\Controllers\Admin;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Touge\AdminSundry\Http\Controllers\BaseAdminController;
use Touge\AdminSundry\Models\LearnDuration;

class LearnDurationController extends BaseAdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Touge\AdminSundry\Models\LearnDuration';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new LearnDuration());

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'));
        $grid->column('online_time', __('Online time'));
        $grid->column('day', __('Day'));
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
        $show = new Show(LearnDuration::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('online_time', __('Online time'));
        $show->field('day', __('Day'));
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
        $form = new Form(new LearnDuration());

        $form->number('user_id', __('User id'));
        $form->number('online_time', __('Online time'));
        $form->number('day', __('Day'));

        return $form;
    }
}

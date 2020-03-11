<?php

namespace Touge\AdminSundry\Http\Controllers\Admin;

use Encore\Admin\Form;
use Touge\AdminOverwrite\Grid\Displayers\Actions;
use Touge\AdminOverwrite\Grid\Grid;
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
    protected $title = '学习时长';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new LearnDuration());

        $grid->model()->orderBy('id','desc');

        $grid->column('id', __('Id'));
        $grid->column('user.name', __('User id'));
        $grid->column('online_time', __('Online time'));
        $grid->column('day', __('Day'))->display(function($value){
            return date('Y-m-d', $value);
        });

        $grid->disableExport()
            ->disableColumnSelector()
            ->disableCreateButton()
            ->disableFilter()
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

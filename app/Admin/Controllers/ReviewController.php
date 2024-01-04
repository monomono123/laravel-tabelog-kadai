<?php

namespace App\Admin\Controllers;

use App\Models\Review;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ReviewController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Review';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Review());

        $grid->column('id', __('Id'));
        $grid->column('content', __('Content'));
        $grid->column('user_id', __('User id'));
        $grid->column('star', __('Star'));
        $grid->column('restaurant_id', __('Restaurant id'));
        $grid->column('created_at', __('Created at'))->sortable();
        $grid->column('updated_at', __('Updated at'))->sortable();

        $grid->filter(function($filter) {
            $filter->between('created_at', '登録日')->datetime();
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
        $show = new Show(Review::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('content', __('Content'));
        $show->field('user_id', __('User id'));
        $show->field('star', __('Star'));
        $show->field('restaurant_id', __('Restaurant id'));
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
        $form = new Form(new Review());

        $form->textarea('content', __('Content'));
        $form->number('user_id', __('User id'));
        $form->number('star', __('Star'));
        $form->number('restaurant_id', __('Restaurant id'));

        return $form;
    }
}

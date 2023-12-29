<?php

namespace App\Admin\Controllers;

use App\Models\Reservation;
use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ReservationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Reservation';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Reservation());

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'));
        $grid->column('restaurant_id', __('Restaurant id'));
        $grid->column('reservationday', __('Reservationday'));
        $grid->column('reservationnumber', __('Reservationnumber'));
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
        $show = new Show(Reservation::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('restaurant_id', __('Restaurant id'));
        $show->field('reservationday', __('Reservationday'));
        $show->field('reservationnumber', __('Reservationnumber'));
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
        $form = new Form(new Reservation());

        $form->number('user_id', __('User id'));
        $form->number('restaurant_id', __('Restaurant id'));
        $form->text('reservationday', __('Reservationday'));
        $form->text('reservationnumber', __('Reservationnumber'));

        return $form;
    }
}

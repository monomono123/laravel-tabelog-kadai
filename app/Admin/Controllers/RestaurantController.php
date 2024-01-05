<?php

namespace App\Admin\Controllers;

use App\Models\Restaurant;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Category;

class RestaurantController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Restaurant';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Restaurant());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('category_id', __('Category id'));
        $grid->column('image', __('Image'));
        $grid->column('discription', __('Discription'));
        $grid->column('priceupper', __('Priceupper'));
        $grid->column('pricelower', __('Pricelower'));
        $grid->column('time', __('Time'));
        $grid->column('holiday', __('Holiday'));
        $grid->column('postcode', __('Postcode'));
        $grid->column('address', __('Address'));
        $grid->column('telephone', __('Telephone'));
        $grid->column('payment', __('Payment'));
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
        $show = new Show(Restaurant::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('category_id', __('Category id'));
        $show->field('image', __('Image'));
        $show->field('discription', __('Discription'));
        $show->field('priceupper', __('Priceupper'));
        $show->field('pricelower', __('Pricelower'));
        $show->field('time', __('Time'));
        $show->field('holiday', __('Holiday'));
        $show->field('postcode', __('Postcode'));
        $show->field('address', __('Address'));
        $show->field('telephone', __('Telephone'));
        $show->field('payment', __('Payment'));
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
        $form = new Form(new Restaurant());

        $form->text('name', __('Name'));
        $form->select('category_id', __('Category id'))->options(Category::all()->pluck('name', 'id'));
        $form->image('image', __('Image'));
        $form->text('discription', __('Discription'));
        $form->number('priceupper', __('Priceupper'));
        $form->number('pricelower', __('Pricelower'));
        $form->text('time', __('Time'))->placeholder('10:00～20:00');
        $form->text('holiday', __('Holiday'))->placeholder('土,日');
        $form->text('postcode', __('Postcode'));
        $form->text('address', __('Address'));
        $form->text('telephone', __('Telephone'));
        $form->text('payment', __('Payment'));

        return $form;
    }
}

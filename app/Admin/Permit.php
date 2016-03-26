<?php

Admin::model('App\Permit')->title('Права пользователей')->display(function ()
{
	$display = AdminDisplay::datatables();
	$display->with();
	$display->filters([

	]);
	$display->columns([
		Column::string('name')->label('Наименование'),
		Column::string('slug')->label('Ярлык'),
	]);
	return $display;
})->createAndEdit(function ()
{
	$form = AdminForm::form();
	$form->items([
		FormItem::text('name', 'Name'),
		FormItem::text('slug', 'Slug'),
	]);
	return $form;
});
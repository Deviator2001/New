<?php

Admin::model('App\User')->title('Пользователи')->display(function ()
{
	$display = AdminDisplay::datatables();
	$display->with();
	$display->filters([

	]);
	$display->columns([
		Column::string('first_name')->label('first_name'),
		Column::string('email')->label('Email'),
	]);
	return $display;
})->createAndEdit(function ()
{
	$form = AdminForm::form();
	$form->items([
		FormItem::text('email', 'Email'),
		FormItem::password('password', 'Password'),
		FormItem::timestamp('last_login', 'Last Login')->format('d.m.Y'),//->seconds(true),
		FormItem::text('first_name', 'First Name'),
		FormItem::text('last_name', 'Last Name'),
		FormItem::multiselect('theroles', 'Роли')->model('App\Role')->display('name'),
	]);
	return $form;
});
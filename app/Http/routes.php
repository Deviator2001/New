<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
// ����� �������� ����������� ������������
    Route::get('register', 'AuthController@register');
// ������������ �������� ����� ����������� � ��������
    Route::post('register', 'AuthController@registerProcess');
// ������������ ������� ������ ��� ��������� �������� �� ������� ����
    Route::get('activate/{id}/{code}', 'AuthController@activate');
// ����� �������� �����������
    Route::get('login', 'AuthController@login');
// ������������ �������� ����� ����������� � ��������
    Route::post('login', 'AuthController@loginProcess');
// ����� ������������ �� �������
    Route::get('logout', 'AuthController@logoutuser');
// ������������ ����� ������ � �������� ����� ������. ��� ������ �������� -
// �������� � �������� E-Mail ������������
    Route::get('reset', 'AuthController@resetOrder');
// ������������ �������� � �������� ����� � E-Mail � ������� �� ����� ������
    Route::post('reset', 'AuthController@resetOrderProcess');
// ������������ ������ ������ �� ������� �� ��� �������� ��� ����� ������ ������
    Route::get('reset/{id}/{code}', 'AuthController@resetComplete');
// ������������ ���� ����� ������ � ��������.
    Route::post('reset/{id}/{code}', 'AuthController@resetCompleteProcess');
// ��������� ���������, ���������� ����� ���������� ��� �����, ����� ������ � �.
// � ���, ��� ������ ���������� � ���� ��������� � �������� ����.
    Route::get('wait', 'AuthController@wait');
});

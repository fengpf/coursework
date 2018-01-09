<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'HomeController@index');
Route::post('login', 'HomeController@login');
Route::get('logout', 'HomeController@logout');
Route::get('access_denied', 'HomeController@access_denied');
Route::get('/index', 'HomeController@index');
Route::get('home', 'HomeController@home');

//data entry
Route::get('dataentry', 'ContactController@Index');
Route::post('add_contact', 'ContactController@add_contact');
//Route::get('search_contact','ContactController@search_contact');
Route::get('datasearch', 'ContactController@data_search');
Route::get('edit_contact', 'ContactController@edit_contact');
Route::get('delete_contact', 'ContactController@delete_contact');
Route::post('update_contact', 'ContactController@update_contact');
Route::post('batchadd_contact', 'ContactController@batchadd_contact');


Route::get('organisation', 'OrganisationController@index');
Route::post('add_organisation', 'OrganisationController@add_organisation');
Route::get('search_organisation', 'OrganisationController@search_organisation');
Route::get('organisation_form', 'OrganisationController@organisation_form');
Route::get('edit_organisation', 'OrganisationController@edit_organisation');
Route::get('delete_organisation', 'OrganisationController@delete_organisation');
Route::post('update_organisation', 'OrganisationController@update_organisation');
Route::get('match_org_name', 'OrganisationController@match_org_name');
Route::post('batchadd_organisation', 'OrganisationController@batchadd_organisation');



//search
Route::get('search', 'SearchController@search');
Route::get('searchreturn', 'SearchController@search');
Route::get('search_flush', 'SearchController@search_flush');
Route::get('search_admin', 'SearchController@search_admin');
Route::get('search_admin_return', 'SearchController@search_admin_return');
Route::get('search_contact_flush', 'SearchController@search_contact_flush');


//user
Route::get('adduser', 'UserController@pre_add_user');
Route::post('add_user', 'UserController@add_user');
Route::get('edit_user', 'UserController@edit_user');
Route::get('delete_user', 'UserController@delete_user');
Route::post('update_user', 'UserController@update_user');
Route::get('adminuser', 'UserController@admin_user');
Route::get('user_form', 'UserController@user_form');
Route::get('admin_search', 'UserController@admin_search');


Route::get('dataupload','DatauploadController@Index');
Route::get('dailyreport','DatauploadController@DailyReport');
Route::get('dailyreportlist','DatauploadController@DailyReportList');
Route::get('targetreport','DatauploadController@TargetReport');
Route::post('targetreportreturn','DatauploadController@Targetreportreturn');
Route::post('csv','DatauploadController@csv');

// postcode
Route::get('postcode','Controller@PostCodeLookup');

// permission role
Route::get('pre_add_role', 'RolePermissionController@pre_add_role');
Route::post('add_role', 'RolePermissionController@add_role');
Route::get('edit_role', 'RolePermissionController@edit_role');
Route::post('update_role', 'RolePermissionController@update_role');
Route::post('delete_role', 'RolePermissionController@delete_role');
Route::get('list_role', 'RolePermissionController@list_role');

    

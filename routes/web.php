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

/*Route::get('/', function () {
    return view('welcome');
});*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/webspot', 'HomeController@webspot');
Route::get('/home/advanced_markets', 'HomeController@advanced_markets');
Route::get('/home/advanced_resources', 'HomeController@advanced_resources');
Route::post('home/ajax_return_view', 'HomeController@ajax_return_view');

Route::get('/email/process_queue', 'EmailController@process_queue')->name('process_queue');


Route::get('/', function () {
    return redirect('/home');
});
Route::get('/test', 'HomeController@test');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');


Route::middleware(['estateKid'])->group(function () {
    Route::post('/check_session', 'DashboardController@check_session')->name('check_session');


    Route::post('/message/message_box_display', 'MessageController@message_box_display')->name('message_box_display');
    Route::post('/message/message_group_box_display', 'MessageController@message_group_box_display')->name('message_group_box_display');
    Route::post('/message/message_create_group_message', 'MessageController@message_create_group_message')->name('message_create_group_message');
    Route::post('/message/message_create', 'MessageController@message_create')->name('message_create');
    Route::post('/message/message_groups_select', 'MessageController@message_groups_select')->name('message_groups_select');
    Route::post('/message/message_group_create', 'MessageController@message_group_create')->name('message_group_create');
    Route::post('/message/delete_message_group', 'MessageController@delete_message_group')->name('delete_message_group');
    Route::post('/message/message_image', 'MessageController@message_image')->name('message_image');
    Route::post('/message/message_attachment', 'MessageController@message_attachment')->name('message_attachment');


    Route::post('/estate/ajax_profile_edit', 'EstateController@ajax_profile_edit')->name('ajax_profile_edit');
    Route::post('/estate_image/ajax_profile_image', 'EstateImageController@ajax_profile_image')->name('ajax_profile_image');

    Route::post('/estate/ajax_member_edit', 'EstateController@ajax_member_edit')->name('ajax_member_edit');
    Route::post('/estate_image/ajax_member_image', 'EstateImageController@ajax_member_image')->name('ajax_member_image');

    Route::post('/estate/ajax_member_popup', 'EstateController@ajax_member_popup')->name('ajax_member_popup');
    Route::post('/estate/ajax_return_view', 'EstateController@ajax_return_view')->name('ajax_return_view');
    Route::post('/estate/member_delete', 'EstateController@member_delete')->name('member_delete');
    Route::post('/estate/pet_delete', 'EstateController@pet_delete')->name('pet_delete');


    Route::post('/dashboard/ajax_activity_log', 'DashboardController@ajax_activity_log')->name('ajax_activity_log');
    Route::post('/dashboard/ajax_calendar_events', 'DashboardController@ajax_calendar_events')->name('ajax_calendar_events');
    Route::post('/dashboard/ajax_add_tasks', 'DashboardController@ajax_add_tasks')->name('ajax_add_tasks');
    Route::post('/dashboard/ajax_skip_task', 'DashboardController@ajax_skip_task')->name('ajax_skip_task');
    Route::post('/dashboard/ajax_delete_task', 'DashboardController@ajax_delete_task')->name('ajax_delete_task');
    Route::post('/dashboard/dashboard_counts', 'DashboardController@dashboard_counts')->name('dashboard_counts');


});

Route::middleware(['kid'])->group(function () {
    Route::get('/kid', 'DashboardKidController@index')->name('kid_index');
    Route::get('/kid_profile', 'DashboardKidController@profile')->name('kid_profile');

    Route::get('/kid_shared_info', 'DashboardKidController@shared_info')->name('kid_shared_info');
    Route::get('/kid_game_center', 'DashboardKidController@game_center')->name('kid_game_center');

    Route::post('/kid/ajax_site_edit', 'DashboardKidController@ajax_site_edit')->name('ajax_site_edit');
    Route::post('/kid/ajax_site_image', 'DashboardKidController@ajax_site_image')->name('ajax_site_image');

    Route::get('/kid/messages', 'MessageController@index')->name('kid_messages');

    Route::get('/kid/members', 'DashboardKidController@members')->name('kid_members');

});

Route::middleware(['estate'])->group(function () {


   Route::get('/estate', 'DashboardController@index')->name('estate_index');

    Route::get('/switch_from_husband_to_spouse', 'DashboardController@switch_from_husband_to_spouse')->name('switch_from_husband_to_spouse');
    Route::get('/log_spouse_to_husband', 'DashboardController@log_spouse_to_husband')->name('log_spouse_to_husband');
    Route::get('/print_snapshot', 'DashboardController@print_snapshot')->name('print_snapshot');


    Route::get('/estate/profile', 'EstateController@profile')->name('estate_profile');
    Route::get('/estate/estate', 'EstateController@estate')->name('estate_estate');

    Route::get('/estate/messages', 'MessageController@index')->name('estate_messages');

    Route::get('/estate/members', 'EstateController@members')->name('estate_members');
    Route::get('/estate/documents', 'EstateController@documents')->name('estate_documents');
    Route::get('/estate/webspot', 'EstateController@webspot')->name('estate_webspot');
    Route::get('/estate/other_estates', 'OtherEstateController@index')->name('estate_other_estates');
    Route::get('/estate/grow_estate', 'EstateController@grow_estate')->name('estate_grow_estate');


    Route::post('/estate/ajax_estate_edit', 'EstateController@ajax_estate_edit')->name('ajax_estate_edit');
    Route::post('/estate/ajax_pet_edit', 'EstateController@ajax_pet_edit')->name('ajax_pet_edit');

    Route::post('/estate/ajax_pet_guardian_suggest', 'EstateController@ajax_pet_guardian_suggest')->name('ajax_pet_guardian_suggest');
    Route::post('/estate/ajax_member_guardian_suggest', 'EstateController@ajax_member_guardian_suggest')->name('ajax_member_guardian_suggest');

    Route::post('/estate/ajax_get_member', 'EstateController@ajax_get_member')->name('ajax_get_member');

    Route::post('/estate/ajax_edit_dependent_medical', 'EstateController@ajax_edit_dependent_medical')->name('ajax_edit_dependent_medical');

    Route::post('/estate/ajax_edit_dependent_school', 'EstateController@ajax_edit_dependent_school')->name('ajax_edit_dependent_school');


    Route::post('/estate/ajax_dependent_popup', 'EstateController@ajax_dependent_popup')->name('ajax_dependent_popup');


    Route::post('/estate/ajax_share_unshare_member', 'EstateController@ajax_share_unshare_member')->name('ajax_share_unshare_member');
    Route::post('/estate/ajax_member_share', 'EstateController@ajax_member_share')->name('ajax_member_share');


    Route::post('/estate_image/ajax_estate_image', 'EstateImageController@ajax_estate_image')->name('ajax_estate_image');
    Route::post('/estate_image/ajax_pet_image', 'EstateImageController@ajax_pet_image')->name('ajax_pet_image');
    Route::post('/estate_image/ajax_dependent_medical_image', 'EstateImageController@ajax_dependent_medical_image')->name('ajax_dependent_medical_image');
    Route::post('/estate_image/ajax_dependent_school_image', 'EstateImageController@ajax_dependent_school_image')->name('ajax_dependent_school_image');


    Route::post('/email/ajax_validate_member_email', 'EmailController@ajax_validate_member_email')->name('ajax_validate_member_email');
    Route::post('/email/ajax_get_invitation_email', 'EmailController@ajax_get_invitation_email')->name('ajax_get_invitation_email');
    Route::post('/email/ajax_send_invitation_email', 'EmailController@ajax_send_invitation_email')->name('ajax_send_invitation_email');


    Route::post('/document/add_document', 'DocumentController@add_document')->name('add_document');
    Route::post('/document/ajax_return_view', 'DocumentController@ajax_return_view')->name('document_ajax_return_view');
    Route::post('/document/ajax_set_not_applicable', 'DocumentController@ajax_set_not_applicable')->name('ajax_set_not_applicable');
    Route::post('/document/ajax_document_delete', 'DocumentController@ajax_document_delete')->name('ajax_document_delete');
    Route::post('/document/ajax_search_document', 'DocumentController@ajax_search_document')->name('ajax_search_document');



    Route::post('/other_estate/other_estate_shares', 'OtherEstateController@other_estate_shares')->name('other_estate_shares');
    Route::post('/other_estate/other_estate_document_shares', 'OtherEstateController@other_estate_document_shares')->name('other_estate_document_shares');



});
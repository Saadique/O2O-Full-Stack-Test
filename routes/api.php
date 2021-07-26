<?php

use Illuminate\Support\Facades\Route;


//Login
Route::post('login', 'App\Http\Controllers\AuthController@login');

//Register
Route::post('people', 'App\Http\Controllers\PeopleController@store');

Route::middleware('auth:api')->group(function () {
    //people
    Route::get('people', 'App\Http\Controllers\PeopleController@index');
    Route::get('people/{id}', 'App\Http\Controllers\PeopleController@show');

    //conversations
    Route::post('conversations','App\Http\Controllers\ConversationController@store');
    Route::get('conversations/person/{conversation_id}/{person_id}','App\Http\Controllers\ConversationController@addPerson');
    Route::get('conversations/person/remove/{conversation_id}/{person_id}','App\Http\Controllers\ConversationController@removePerson');
    Route::delete('conversations/{conversation_id}','App\Http\Controllers\ConversationController@removeConversation')
        ->middleware('api.conversationOwner');
    Route::get('conversations/{conversation_id}/messages','App\Http\Controllers\ConversationController@getAllMessagesByConversation')
        ->middleware('api.conversationMember');
    Route::get('conversations/person/{person_id}','App\Http\Controllers\ConversationController@getConversationsByPerson');
    Route::get('conversations/owner/{owner_id}','App\Http\Controllers\ConversationController@getConversationsByOwner');
    Route::get('conversations/members/{conversation_id}','App\Http\Controllers\ConversationController@getConversationMembers');


    //messages
    Route::post('messages','App\Http\Controllers\MessageController@store');
    Route::delete('messages/{message_id}','App\Http\Controllers\MessageController@destroy')
        ->middleware('api.messageOwner');
});












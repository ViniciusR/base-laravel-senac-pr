<?php
/**
 * Unauthenticated routes
 */

Auth::routes();

Route::get('/', 'Auth\LoginController@showLoginForm');

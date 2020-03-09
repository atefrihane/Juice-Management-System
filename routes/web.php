<?php

use App\Modules\User\Models\User;
use App\Notifications\TestNotification;



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

route::get('/test', function () {
    // dd(Auth::user()->notifications()->get());
    // event(new TestEvent('TESTTTT'));
    $groups = [1,2,5];
    $users = User::whereIn('id', $groups)->get();

    Notification::send($users, new TestNotification($groups));
    // Auth::user()->notify(new TestNotification($groups));
    return "Event has been sent!";

});

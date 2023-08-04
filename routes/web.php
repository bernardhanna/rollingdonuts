<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-06-14 16:00:17
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-07-11 13:02:26
 */
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
|
*/

Route::get('/welcome/', function () {
    return view('welcome');
});

//Newsletter Form
Route::post('/newsletter/subscribe', function (Request $request) {
    // Process the form submission
    // ...

    // Set the session variable to indicate a successful subscription
    session()->flash('subscribed', true);

    // Redirect back to the form
    return redirect()->back();
})->name('newsletter.subscribe');


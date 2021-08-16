<?php

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/super-adming', function () {
    $users = User::all();
    return view('back_end.superadmin.dashboard', compact('users'));
})->name('superadmin');

Route::post('assign-domain',function (Request $request){
    $sub_domain = $request->domain;
    User::where('id',$request->user_id)->update(['sub_domain' => $sub_domain]);
    return redirect()->route('superadmin');
})->name('assign.domain');

Route::get('users', [UserController::class, 'index'])->name('users');
Route::post('list-users', [UserController::class, 'listUser'])->name('list-users');

Route::domain('{account}'.".".config('short_url','localhost'))->group(function ($account){
//    dd($account);
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');

});
Route::get('test',function(){

$x = '0.0.0.0';
$y = 'abc.com';
$z = 'websitename.com';
    $process = new Process('echo "${:x}"
     
     "${:y}" >> "${:z}"');

    
   $process->run();

// executes after the command finishes
    if (!$process->isSuccessful()) {
        throw new ProcessFailedException($process);
    }

    echo $process->getOutput();
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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

Route::middleware('guest')->group(function(){
    Route::get('login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
});

Route::middleware(['superadmin', 'web'])->group(function(){
    Route::post('login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);
});

Route::middleware('auth')->group(function(){
    Route::post('logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function(){
    Route::get('register', [\App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
});

Route::get('/super-admin', function () {
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

Route::domain('{account?}.'.config('short_url','localhost.test'))->group(function (){
    Route::post('login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);

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


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

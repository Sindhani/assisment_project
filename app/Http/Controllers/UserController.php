<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('back_end.admin.users.users');
    }

    public function listUser()
    {
        $users = User::select('name', 'email', 'is_admin')->get();
        if(auth()->check() && auth()->user()->is_admin == 2){
            return Datatables::of($users)
            ->addColumn('action', function ($user) {
                return '<input type="checkbox" class="demo">';
            })->make();
        }
        return Datatables::of($users)->make();
    }
}

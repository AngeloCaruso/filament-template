<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function infoUser(int $user_id){
       $user = User::find($user_id);
       return view('users.info_user',compact('user'));
    }
}

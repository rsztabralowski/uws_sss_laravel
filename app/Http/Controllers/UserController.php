<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function delete($id)
    {

        $user = User::where('id', $id)->first();
        $user->delete();

        return redirect('users')->with('status', 'User deleted');
    
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->where('id', $id)->first();
        $user->restore();

        return redirect('users')->with('status', 'User restored');
    }
}

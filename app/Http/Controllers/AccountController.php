<?php

namespace App\Http\Controllers;

use App\Fact;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->isAdmin == 1)
        {
            $user_facts = Fact::orderBy('created_at' , 'desc')->get();
        }
        else
        {
            $user_facts = Fact::where('user_id', Auth::user()->id)->orderBy('created_at' , 'desc')->get();
        }
        
        return view('account')->with('user_facts', $user_facts);
    }

    public function all()
    {
        $all_facts = Fact::all();

        return view('all')->with('all_facts', $all_facts);
    }

    public function users()
    {
        $users = User::all();
        $users_removed = User::onlyTrashed()->get();

        return view('users')->with(['users' =>$users, 'users_removed' => $users_removed]);
    }
}

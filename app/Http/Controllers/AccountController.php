<?php

namespace App\Http\Controllers;

use App\Fact;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

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
}

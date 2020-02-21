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
        $user_facts = Fact::where('user_id', Auth::user()->id)->orderBy('created_at' , 'desc')->get();

        return view('account')->with('user_facts', $user_facts);
    }
}

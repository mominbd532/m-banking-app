<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
        $user_id = Auth::user()->id;
        $type =  Auth::user()->account_type;
        $balance =  Auth::user()->balance;

        $transactions = Transaction::where('user_id', $user_id )
                                ->orderBy('created_at','DESC')
                                ->get();
                                
        return view('home',compact('transactions','balance','type'));

    }
}

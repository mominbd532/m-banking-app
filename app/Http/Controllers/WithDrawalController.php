<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithDrawalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;

        $withdrawals = Transaction::where('user_id', $user_id )
                                ->where('transaction_type','withdrawal')
                                ->orderBy('created_at','DESC')
                                ->get();
                                
        return view('withdrawal',compact('withdrawals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $fees = 0;

        if(Auth::user()->account_type == 'individual'){
           
            $withdrawals = Transaction::where('user_id', $user_id )
                            ->where('transaction_type','withdrawal')
                            ->whereYear('date', Carbon::now()->year)
                            ->whereMonth('date', Carbon::now()->month)
                            ->sum('amount');
            $withdrawals = $withdrawals+$request->amount;

            // Friday

            if($withdrawals  > 5000 && $request->amount > 1000 && Carbon::now()->format('l') != 'Friday'){
                $fees = $request->amount - 1000;
                $fees = $fees*0.015;
                $fees = $fees/100;
            }

        }else{
           
            $withdrawals = Transaction::where('user_id', $user_id )
                            ->where('transaction_type','withdrawal')
                            ->sum('amount');

            if($withdrawals > 50000){
                $fees = $request->amount*0.015;
                $fees = $fees/100;
            }else{
                $fees = $request->amount*0.025;
                $fees = $fees/100;
            }
           
        }

        Transaction::create([
            'user_id' => $user_id,
            'transaction_type' => 'withdrawal',
            'amount' => $request->amount,
            'fee' => $fees,
            'date' => Carbon::now()
            ]);
        
        User::where('id',$user_id)
            ->update([
                    'balance' => Auth::user()->balance - ($request->amount+$fees),
                ]);
        
        return redirect()->back()->with('massage','Your Withdrawal Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

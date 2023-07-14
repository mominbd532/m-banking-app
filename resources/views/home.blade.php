@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('All Transaction') }} <span style="text-transform: capitalize;">({{$type}})</span>


                    <a href="/withdrawal" class="btn btn-primary" style="float: right;">Withdrawal List</a>
                    <a href="/deposit" class="btn btn-success ml-5" style="float: right; margin-right: 10px;">Deposit List</a>

                </div>

                <div class="card-body">
                    
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Type</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Fee</th>
                            <th scope="col">Date</th>
                           
                            </tr>
                        </thead>
                        <tbody>
                            <?php $index = 0; ?>
                            @foreach($transactions as $transaction)
                            <?php $index++; ?>
                            <tr>
                            <th scope="row">{{$index}}</th>
                            <td style="text-transform: capitalize;">{{$transaction->transaction_type}}</td>
                            <td>{{$transaction->amount}}</td>
                            <td>{{$transaction->fee}}</td>
                            <td>{{$transaction->date}}</td>
                            </tr>
                            @endforeach
                           
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Balance</th>
                                <th>{{$balance}}</th>
                                <td></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

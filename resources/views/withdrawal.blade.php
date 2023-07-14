@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Withdrawal Here') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('withdrawal_add') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="amount" class="col-md-4 col-form-label text-md-end">{{ __('Amount') }}</label>

                            <div class="col-md-6">
                                <input id="amount" type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" required>

                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Withdraw') }}
                                </button>
                            </div>
                        </div>

                        @if(Session::has('massage'))
                            <div class="alert alert-success mt-5">
                                {{Session::get('massage')}}
                            </div>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Withdraw List') }}</div>

                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Fee</th>
                            <th scope="col">Date</th>
                           
                            </tr>
                        </thead>
                        <tbody>
                            <?php $index = 0; ?>
                            @foreach($withdrawals as $withdrawal)
                            <?php $index++; ?>
                            <tr>
                            <th scope="row">{{$index}}</th>
                            <td>{{$withdrawal->amount}}</td>
                            <td>{{$withdrawal->fee}}</td>
                            <td>{{$withdrawal->date}}</td>
                            </tr>
                            @endforeach
                           
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

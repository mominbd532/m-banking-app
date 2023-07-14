@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Deposit Here') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('deposit_add') }}">
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
                                    {{ __('Deposit') }}
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
                <div class="card-header">{{ __('Deposit List') }}</div>

                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Date</th>
                           
                            </tr>
                        </thead>
                        <tbody>
                            <?php $index = 0; ?>
                            @foreach($deposits as $deposit)
                            <?php $index++; ?>
                            <tr>
                            <th scope="row">{{$index}}</th>
                            <td>{{$deposit->amount}}</td>
                            <td>{{$deposit->date}}</td>
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

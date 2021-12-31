@extends('layout.app')
@section('content')
    <!-- App Capsule -->
    <div id="appCapsule">
        <div class="section mt-2">
            @foreach ($errors->all() as $error)
                <br>
                <div style="max-width: 90%;margin: auto;" class="alert alert-danger" role="alert">
                    {{ $error }}
                </div><br>
            @endforeach
            @if (session()->has('message'))
                <br>
                <div style="max-width: 90%;margin: auto;" class="alert alert-success" role="alert">
                    {{ session()->get('message') }}
                </div><br>
            @endif
        </div>
        @foreach($data['transactions'] as $key => $transaction)
            <div class="section mt-2">
                <div class="section-title">@if($key == "BB") Bugün @elseif($key == "AA") Dün @else {{$key}} @endif</div>
                <div class="transactions">
                    <!-- item -->
                    @foreach($data['transactions'][$key] as $singleTransaction)
                        <a href="app-transaction-detail.html" class="item">
                            <div class="detail">
                                <img src="@if($singleTransaction->transaction_type == "add") assets/img/gelen.png @else assets/img/giden.png @endif" alt="img" class="image-block imaged w48">
                                <div>
                                    <strong>{{$singleTransaction->transaction_desc}}</strong>
                                    <p>{{$singleTransaction->transaction_date}}</p>
                                </div>
                            </div>
                            <div class="right">
                                <div class="price @if($singleTransaction->transaction_type == "add") text-success @else text-danger @endif"> @if($singleTransaction->transaction_type == "add") + @else - @endif {{$singleTransaction->transaction_amount}} ₺</div>
                            </div>
                        </a>
                    @endforeach
                    <!-- * item -->
                </div>
            </div>
        @endforeach
            </div>
@endsection

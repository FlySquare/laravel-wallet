@extends('layout.app')
@section('content')
    <div id="appCapsule">

        <!-- Wallet Card -->
        <div class="section wallet-card-section pt-1">
            <div class="wallet-card">
                <!-- Balance -->
                <div class="balance">
                    <div class="left">
                        <span class="title">Toplam Bütçe</span>
                        <h1 class="total">{{ request()->get('totalBalance') }} ₺</h1>
                    </div>
                    <div class="right">
                        <a href="#" class="button" data-toggle="modal" data-target="#depositActionSheet">
                            <ion-icon name="add-outline"></ion-icon>
                        </a>
                    </div>
                </div>
                <!-- * Balance -->
                <!-- Wallet Footer -->
                <div class="wallet-footer">
                    <div class="item">
                        <a href="#" data-toggle="modal" data-target="#depositActionSheet">
                            <div class="icon-wrapper bg-danger">
                                <ion-icon name="arrow-down-outline"></ion-icon>
                            </div>
                            <strong>Para Girişi</strong>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#" data-toggle="modal" data-target="#sendActionSheet">
                            <div class="icon-wrapper">
                                <ion-icon name="arrow-forward-outline"></ion-icon>
                            </div>
                            <strong>Para Çıkışı</strong>
                        </a>
                    </div>
                    <div class="item">
                        <a href="{{@route('my-cards')}}">
                            <div class="icon-wrapper bg-success">
                                <ion-icon name="card-outline"></ion-icon>
                            </div>
                            <strong>Kartlarım</strong>
                        </a>
                    </div>

                </div>
                <!-- * Wallet Footer -->
            </div>
        </div>
        <!-- Wallet Card -->

        <!-- Deposit Action Sheet -->
        <div class="modal fade action-sheet" id="depositActionSheet" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Para Girişi Ekle</h5>
                    </div>
                    <div class="modal-body">
                        <div class="action-sheet-content">
                            <form method="post" action="{{@route('addMoney')}}">
                                @csrf
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="account1">Eklenecek Hesap</label>
                                        <select required class="form-control custom-select" name="account" id="account1">
                                            @foreach(request()->get('currentUser')->cards as $card)
                                                <option value="{{ $card->card_id }}">{{ $card->card_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group basic">
                                    <label class="label">Açıklama</label>
                                    <div class="input-group">
                                        <input type="text" name="desc" class="form-control form-control-lg" placeholder="Zorunlu Değil">
                                    </div>
                                </div>
                                <div class="form-group basic">
                                    <label class="label">Miktar Giriniz</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="input1">₺</span>
                                        </div>
                                        <input required type="number" min="0" name="amount" class="form-control form-control-lg" placeholder="100">
                                    </div>
                                </div>
                                <div class="form-group basic">
                                    <button type="submit" class="btn btn-primary btn-block btn-lg">Ekle</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * Deposit Action Sheet -->

        <!-- Send Action Sheet -->
        <div class="modal fade action-sheet" id="sendActionSheet" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Para Çıkışı Ekle</h5>
                    </div>
                    <div class="modal-body">
                        <div class="action-sheet-content">
                            <form method="POST" action="{{@route('sendMoney')}}">
                                @csrf
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="account1">Eksilen Hesap</label>
                                        <select required class="form-control custom-select" name="account" id="account1">
                                            @foreach(request()->get('currentUser')->cards as $card)
                                                <option value="{{ $card->card_id }}">{{ $card->card_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group basic">
                                    <label class="label">Açıklama</label>
                                    <div class="input-group">
                                        <input type="text" name="desc" class="form-control form-control-lg" placeholder="Zorunlu Değil">
                                    </div>
                                </div>
                                <div class="form-group basic">
                                    <label class="label">Miktar Giriniz</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="input1">₺-</span>
                                        </div>
                                        <input required type="number" min="0" name="amount" class="form-control form-control-lg" placeholder="100">
                                    </div>
                                </div>

                                <div class="form-group basic">
                                    <button type="submit" class="btn btn-primary btn-block btn-lg">Para Çıkışı Ekle</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * Send Action Sheet -->
        @foreach ($errors->all() as $error)
            <br>
            <div style="max-width: 90%;margin: auto;" class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
        @if (session()->has('message'))
            <br>
            <div style="max-width: 90%;margin: auto;" class="alert alert-success" role="alert">
                {{ session()->get('message') }}
            </div>
    @endif
        <!-- Stats -->
        <div class="section">
            <div class="row mt-2">
                <div class="col-6">
                    <div class="stat-box">
                        <div class="title">Gelen Para</div>
                        <div class="value text-success">{{$data['incomingMoney']}} ₺</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="stat-box">
                        <div class="title">Giden Para</div>
                        <div class="value text-danger">{{$data['outgoingMoney']}} ₺</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * Stats -->

        <!-- Transactions -->
        <div class="section mt-4">
            <div class="section-heading">
                <h2 class="title">Hesap Hareketleri</h2>
                <a href="{{@route('my-transactions')}}" class="link">Hepsini Gör</a>
            </div>
            <div class="transactions">
                <!-- item -->
               @foreach(request()->get('currentUser')->transactions(5) as $transaction)
                    <a href="app-transaction-detail.html" class="item">
                        <div class="detail">
                            <img src="@if($transaction->transaction_type == "add") assets/img/gelen.png @else assets/img/giden.png @endif" alt="img" class="image-block imaged w48">
                            <div>
                                <strong>{{$transaction->transaction_desc}}</strong>
                                <p>{{$transaction->transaction_date}}</p>
                            </div>
                        </div>
                        <div class="right">
                            <div class="price @if($transaction->transaction_type == "add") text-success @else text-danger @endif"> @if($transaction->transaction_type == "add") + @else - @endif {{$transaction->transaction_amount}} ₺</div>
                        </div>
                    </a>
                @endforeach
                <!-- * item -->

            </div>
        </div>
        <!-- * Transactions -->







    </div>
@endsection

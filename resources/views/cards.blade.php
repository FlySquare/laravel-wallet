@extends('layout.app')
@section('content')
    <!-- App Capsule -->
    <div id="appCapsule">

        <div class="section mt-2">
            <button type="button" data-toggle="modal" data-target="#ModalCardAdd" style="width: 100%;" class="btn btn-primary mr-1 mb-1">Yeni Hesap Ekle</button>
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
        @foreach(request()->get('currentUser')->cards as $card)
            <!-- card block -->
                <div @if($card->card_name == "Nakit") style="max-height: 100px;" @endif() class="card-block  @if($card->card_name == "Nakit") bg-success @else {{$card->card_color}} @endif() mb-2">
                    <div class="card-main">
                        @if($card->card_name != "Nakit")
                        <div class="card-button dropdown">
                            <button type="button" class="btn btn-link btn-icon" data-toggle="dropdown">
                                <ion-icon name="ellipsis-horizontal"></ion-icon>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">

                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#ModalCardChange{{$card->card_id}}">
                                    <ion-icon name="pencil-outline"></ion-icon>
                                    Düzenle
                                </a>
                                    <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#ModalCardDelete{{$card->card_id}}">
                                    <ion-icon name="close-outline"></ion-icon>
                                    Sil
                                </a>
                            </div>
                        </div>
                        @endif()
                        <div class="balance">
                            <span @if($card->card_name == "Nakit") style="color: white;opacity: 1;" @endif() class="label">{{$card->card_name}}</span>
                            <h1 class="title">{{$card->total_balance}} ₺</h1>
                        </div>
                            @if($card->card_name != "Nakit")
                        <div class="in">
                            <div class="card-number">
                                <span class="label">Hesap Numarası</span>
                                {{$card->card_number}}
                            </div>

                            <div class="bottom">
                                <div class="card-expiry">
                                    <span class="label">Son Tarih</span>
                                    {{$card->card_expiry}}
                                </div>
                                <div class="card-ccv">
                                    <span class="label">CCV</span>
                                    {{$card->card_ccv}}
                                </div>
                            </div>
                        </div>
                            @endif()
                    </div>
                </div>
                <div class="modal fade modalbox" id="ModalCardChange{{$card->card_id}}" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{$card->card_name}} Hesabını Güncelle</h5>
                                <a href="javascript:;" data-dismiss="modal">Kapat</a>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{@route('changeCard')}}">
                                    @csrf
                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label class="label" for="card_name">Hesap Adı</label>
                                            <input type="text" required class="form-control" name="card_name" id="card_name" value="{{$card->card_name}}" placeholder="Hesap Adı">
                                            <i class="clear-input">
                                                <ion-icon name="close-circle"></ion-icon>
                                            </i>
                                        </div>
                                    </div>
                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label class="label" for="card_number">Hesap Numarası</label>
                                            <input type="text" required class="form-control" name="card_number" id="card_number" value="{{$card->card_number}}" placeholder="Hesap Numarası">
                                            <i class="clear-input">
                                                <ion-icon name="close-circle"></ion-icon>
                                            </i>
                                        </div>
                                    </div>
                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label class="label" for="card_expiry">Son Tarih</label>
                                            <input type="text" required class="form-control" name="card_expiry" id="card_expiry" value="{{$card->card_expiry}}" placeholder="Son Tarih">
                                            <i class="clear-input">
                                                <ion-icon name="close-circle"></ion-icon>
                                            </i>
                                        </div>
                                    </div>
                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label class="label" for="card_ccv">CCV</label>
                                            <input type="number" required class="form-control" name="card_ccv" id="card_ccv" value="{{$card->card_ccv}}" placeholder="CCV">
                                            <i class="clear-input">
                                                <ion-icon name="close-circle"></ion-icon>
                                            </i>
                                        </div>
                                    </div>
                                    <input type="hidden" name="card_id" value="{{$card->card_id}}">
                                    <br>
                                    <button style="width: 100%" type="submit" class="btn btn-primary mr-1 mb-1">Kaydet</button>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade modalbox" id="ModalCardDelete{{$card->card_id}}" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{$card->card_name}} Hesabını Sil</h5>
                                <a href="javascript:;" data-dismiss="modal">Kapat</a>
                            </div>
                            <div class="modal-body">
                                <p>{{$card->card_name}} hesabınızı silmek istediğinizden emin misiniz?</p>
                                <a style="width: 100%" href="{{@route('deleteCard',['id'=>$card->card_id])}}" class="btn btn-primary mr-1 mb-1">Sil</a>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- * card block -->
            @endforeach
            <div class="modal fade modalbox" id="ModalCardAdd" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Yeni Hesap Ekle</h5>
                            <a href="javascript:;" data-dismiss="modal">Kapat</a>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{@route('addCard')}}">
                                @csrf
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="card_name">Hesap Adı</label>
                                        <input type="text" required class="form-control" name="card_name" id="card_name" placeholder="Hesap Adı">
                                        <i class="clear-input">
                                            <ion-icon name="close-circle"></ion-icon>
                                        </i>
                                    </div>
                                </div>
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="card_number">Hesap Numarası</label>
                                        <input type="text" required class="form-control" name="card_number" id="card_number" placeholder="Hesap Numarası">
                                        <i class="clear-input">
                                            <ion-icon name="close-circle"></ion-icon>
                                        </i>
                                    </div>
                                </div>
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="card_expiry">Son Tarih</label>
                                        <input type="text" required class="form-control" name="card_expiry" id="card_expiry" placeholder="Son Tarih">
                                        <i class="clear-input">
                                            <ion-icon name="close-circle"></ion-icon>
                                        </i>
                                    </div>
                                </div>
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="card_ccv">CCV</label>
                                        <input type="number" required class="form-control" name="card_ccv" id="card_ccv" placeholder="CCV">
                                        <i class="clear-input">
                                            <ion-icon name="close-circle"></ion-icon>
                                        </i>
                                    </div>
                                </div>
                                <br>
                                <button style="width: 100%" type="submit" class="btn btn-primary mr-1 mb-1">Kaydet</button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- * App Capsule -->
@endsection

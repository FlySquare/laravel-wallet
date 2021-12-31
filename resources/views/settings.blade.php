@extends('layout.app')
@section('content')

    <!-- App Capsule -->
    <div id="appCapsule">

        <div class="section mt-3 text-center">
            <div class="avatar-section">
                <a href="#">
                    <img src="assets/img/user-avatar.png" alt="avatar" class="imaged w100 rounded"><br>
                    <b>@</b><b>{{ request()->get('currentUser')->user_username }}</b>
                </a>
            </div>
        </div>


        <div class="listview-title mt-1">Profil Ayarları</div>
        <ul class="listview image-listview text">
            <li>
                <a href="javascript:void(0);" data-toggle="modal" data-target="#ModalUserName" class="item">
                    <div class="in">
                        <div>Kullanıcı Adı Değiştir</div>
                    </div>
                </a>
            </li>

        </ul>

        <div class="listview-title mt-1">Güvenlik</div>
        <ul class="listview image-listview text mb-2">
            <li>
                <a href="javascript:void(0);" data-toggle="modal" data-target="#ModalUserPassword" class="item">
                    <div class="in">
                        <div>Şifre Değiştir</div>
                    </div>
                </a>
            </li>
            <li>
                <a href="{{@route('logout')}}" class="item">
                    <div class="in">
                        <div>Çıkış Yap</div>
                    </div>
                </a>
            </li>
        </ul>


    </div>
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
    <!-- Modal Basic -->
    <div class="modal fade modalbox" id="ModalUserPassword" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Şifre Değiştir</h5>
                    <a href="javascript:;" data-dismiss="modal">Kapat</a>
                </div>
                <div class="modal-body">


                    <form method="post" action="{{@route('changePasswordPost')}}">
                        @csrf
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="old_password">Şuanki Şifrenizi Giriniz</label>
                                <input type="password" required class="form-control" name="old_password" id="old_password" placeholder="Şuanki Şifrenizi Giriniz">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="password">Yeni Şifrenizi Giriniz</label>
                                <input type="password" required class="form-control" name="password" id="password" placeholder="Yeni Şifrenizi Giriniz">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="password_confirmation">Şifrenizi Tekrar Giriniz</label>
                                <input type="password" required class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Şifrenizi Tekrar Giriniz">
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




    <div class="modal fade modalbox" id="ModalUserName" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Kullanıcı Adı Değiştir</h5>
                    <a href="javascript:;" data-dismiss="modal">Kapat</a>
                </div>
                <div class="modal-body">


                    <form method="post" action="{{@route('changeUsernamePost')}}">
                        @csrf
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="username">Kullanıcı Adı</label>
                                <input type="text" required class="form-control" min="3" name="username" id="username" placeholder="{{ request()->get('currentUser')->user_username }}">
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
    <!-- * Modal Basic -->

    <!-- * App Capsule -->
@endsection

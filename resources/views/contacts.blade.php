@extends('layout.app')
@section('content')
    <!-- App Capsule -->
    <div id="appCapsule">
        <div class="section mt-2">
            <button type="button" data-toggle="modal" data-target="#ModalContactAdd" style="width: 100%;" class="btn btn-primary mr-1 mb-1">Yeni Kişi Ekle</button>
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
        <div class="section inset mt-2">
            <ul class="listview image-listview mt-2">
                @foreach(request()->get('currentUser')->contacts as $contact)
                    <li data-toggle="modal" data-target="#ModalContactEdit">
                        <div class="item">
                            <img src="assets/img/iban.png" alt="image" class="image">
                            <div class="in">
                                <div>{{$contact->contact_name}}</div>
                            </div>
                        </div>
                    </li>
                    <div class="modal fade modalbox" id="ModalContactEdit" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{$contact->contact_name}} Kişisi</h5>
                                    <a href="javascript:;" data-dismiss="modal">Kapat</a>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="{{@route('editContact')}}">
                                        @csrf
                                        <div class="form-group basic">
                                            <div class="input-wrapper">
                                                <label class="label" for="contact_name">Kişi Adı</label>
                                                <input type="text" required class="form-control" name="contact_name" id="contact_name" value="{{$contact->contact_name}}" placeholder="Kişi Adı">
                                                <i class="clear-input">
                                                    <ion-icon name="close-circle"></ion-icon>
                                                </i>
                                            </div>
                                        </div>
                                        <div class="form-group basic">
                                            <div class="input-wrapper">
                                                <label class="label" for="contact_iban">İban Numarası</label>
                                                <input type="text" required class="form-control" name="contact_iban" id="contact_iban{{$contact->contact_id}}" value="{{$contact->contact_iban}}" placeholder="İban Numarası">
                                                <i class="clear-input">
                                                    <ion-icon name="close-circle"></ion-icon>
                                                </i>
                                            </div>
                                        </div>
                                        <input type="hidden" required class="form-control" name="contact_id" id="contact_id" value="{{$contact->contact_id}}">

                                        <br>
                                        <button style="width: 100%" onclick="copyToClipboard('{{$contact->contact_id}}')"class="btn btn-success mr-1 mb-1">Iban Kopyala</button>
                                        <button style="width: 100%" type="submit" class="btn btn-primary mr-1 mb-1">Güncelle</button>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </ul>
        </div>
            </div>
    <!-- * App Capsule -->
    <div class="modal fade modalbox" id="ModalContactAdd" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Yeni Kişi Ekle</h5>
                    <a href="javascript:;" data-dismiss="modal">Kapat</a>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{@route('addContact')}}">
                        @csrf
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="contact_name">Kişi Adı</label>
                                <input type="text" required class="form-control" name="contact_name" id="contact_name" placeholder="Kişi Adı">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="contact_iban">İban Numarası</label>
                                <input type="text" required class="form-control" name="contact_iban" id="contact_iban" placeholder="İban Numarası">
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
<script>
    function copyToClipboard(id) {
        var textBox = document.getElementById('contact_iban'+id);
        textBox.select();
        document.execCommand("copy");
        alert("Iban Kopyalandı!");
    }
</script>
@endsection

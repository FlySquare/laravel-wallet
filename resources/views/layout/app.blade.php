
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>E-cüzdan</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Finapp HTML Mobile Template">
    <meta name="keywords" content="bootstrap, mobile template, cordova, phonegap, mobile, html, responsive" />
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png" sizes="32x32">
    <link rel="shortcut icon" href="assets/img/favicon.png">
</head>

<body>

<!-- loader -->
<div id="loader">
    <img src="assets/img/logo-icon.png" alt="icon" class="loading-icon">
</div>
<!-- * loader -->

<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="#" class="headerButton" data-toggle="modal" data-target="#sidebarPanel">
            <ion-icon name="menu-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">
        <a href="{{@route('index')}}"><img src="assets/img/logo.png" alt="logo" class="logo"></a>
    </div>
    <div class="right">
        <a href="{{@route('settings')}}" class="headerButton">
            <img src="assets/img/user-avatar.png" alt="image" class="imaged w32">
        </a>
    </div>
</div>
<!-- * App Header -->


<!-- App Capsule -->
@yield('content')
<!-- * App Capsule -->


<!-- App Bottom Menu -->

<!-- * App Bottom Menu -->

<!-- App Sidebar -->
<div class="modal fade panelbox panelbox-left" id="sidebarPanel" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <!-- profile box -->
                <div class="profileBox pt-2 pb-2">
                    <div class="image-wrapper">
                        <img src="assets/img/user-avatar.png" alt="image" class="imaged  w36">
                    </div>
                    <div class="in">
                        <strong>{{ request()->get('currentUser')->user_username }}</strong>
                        <div class="text-muted">{{ request()->get('currentUser')->user_lastlogin }}</div>
                    </div>
                    <a href="#" class="btn btn-link btn-icon sidebar-close" data-dismiss="modal">
                        <ion-icon name="close-outline"></ion-icon>
                    </a>
                </div>
                <!-- * profile box -->
                <!-- balance -->
                <div class="sidebar-balance">
                    <div class="listview-title">Bütçe</div>
                    <div class="in">
                        <h1 class="amount">{{ request()->get('totalBalance') }} ₺</h1>
                    </div>
                    <br>
                </div>
                <!-- * balance -->



                <!-- menu -->
                <div class="listview-title mt-1">Menü</div>
                <ul class="listview flush transparent no-line image-listview">

                    <li>
                        <a href="{{@route('my-cards')}}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="card-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Hesaplarım
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{@route('my-transactions')}}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="cash-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Hesap Hareketleri
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{@route('my-contacts')}}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="person-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Kayıtlı Kişilerim
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- * menu -->

                <!-- others -->
                <div class="listview-title mt-1">Diğer</div>
                <ul class="listview flush transparent no-line image-listview">
                    <li>
                        <a href="{{@route('settings')}}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="settings-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Ayarlar
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{@route('logout')}}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="log-out-outline"></ion-icon>
                            </div>
                            <div class="in">
                               Çıkış Yap
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- * others -->


            </div>
        </div>
    </div>
</div>
<!-- * App Sidebar -->

<!-- ///////////// Js Files ////////////////////  -->
<!-- Jquery -->
<script src="assets/js/lib/jquery-3.4.1.min.js"></script>
<!-- Bootstrap-->
<script src="assets/js/lib/popper.min.js"></script>
<script src="assets/js/lib/bootstrap.min.js"></script>
<!-- Ionicons -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<!-- Owl Carousel -->
<script src="assets/js/plugins/owl-carousel/owl.carousel.min.js"></script>
<!-- Base Js File -->
<script src="assets/js/base.js"></script>


</body>


</html>

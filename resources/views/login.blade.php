<!doctype html>
<html lang="en">


<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="stylesheet" href="assets/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Finapp HTML Mobile Template">
    <meta name="keywords" content="bootstrap, mobile template, cordova, phonegap, mobile, html, responsive" />
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png" sizes="32x32">
    <link rel="shortcut icon" href="assets/img/favicon.png">
</head>

<body class="bg-light">

<!-- loader -->
<div id="loader">
    <img src="assets/img/logo-icon.png" alt="icon" class="loading-icon">
</div>
<!-- * loader -->

<!-- App Header -->
<div class="appHeader no-border">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle"></div>
    <div class="right">
    </div>
</div>
<!-- * App Header -->

<!-- App Capsule -->
<div id="appCapsule">

    <div class="section mt-2 text-center">
        <h1>Giriş Yap</h1>
        <h4>Hesabınıza giriş yapın</h4>
    </div>

    <div class="section mt-2 mb-5 p-3">
        <form method="POST" action="{{@route('loginPost')}}">
            @csrf
            <div class="form-group basic">
                <div class="input-wrapper">
                    <label class="label" for="email1">Kullanıcı Adı</label>
                    <input required type="text" class="form-control" id="username" name="username" placeholder="Kullanıcı Adınız">
                    <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                </div>
            </div>

            <div class="form-group basic">
                <div class="input-wrapper">
                    <label class="label" for="password1">Şifreniz</label>
                    <input required type="password" class="form-control" id="password1" name="password" placeholder="Şifreniz">
                    <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                </div>
            </div>

            <div class="form-links mt-2">
                <div>
                    <a href="{{ @route('register') }}">Kayıt Ol</a>
                </div>
                <div><a href="{{ @route('forget-password') }}" class="text-muted">Şifremi Unuttum?</a></div>
            </div>

            <div class="form-button-group">
                <button type="submit" class="btn btn-primary btn-block btn-lg">Giriş Yap</button>
            </div>

        </form>
    </div>
    @foreach ($errors->all() as $error)
        <br>
        <div style="max-width: 90%;margin: auto;" class="alert alert-danger" role="alert">
            {{ $error }}
        </div>
    @endforeach
</div>
<!-- * App Capsule -->


<!-- App Sidebar -->

<!-- * App Sidebar -->

<!-- ///////////// Js Files ////////////////////  -->
<!-- Jquery -->
<script src="assets/js/lib/jquery-3.4.1.min.js"></script>
<!-- Bootstrap-->
<script src="assets/js/lib/popper.min.js"></script>
<script src="assets/js/lib/bootstrap.min.js"></script>
<!-- Ionicons -->
<!-- Owl Carousel -->
<script src="assets/js/plugins/owl-carousel/owl.carousel.min.js"></script>
<!-- Base Js File -->
<script src="assets/js/base.js"></script>


</body>

</html>

<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
		<title>中源旅游网</title>
		<meta name="content-type" content="text/html; charset=utf-8">
		<meta name="robots" content="index, follow">
		<meta name="googlebot" content="index, follow">
		<meta name="keyword" content="靖安,中源,必游之地,旅游,江西旅游,must visit,靖安县旅游,观光,中源,旅游,自由行,游客,夜市,美食,本地特产,避暑,天然氧吧,景点">
		<meta name="description" content="在中源您能体验天然氧吧清新的空气。独一无二的娃娃鱼，绝美的九岭尖风景,友好的本地人文风情,营养丰富的土特产">
		<meta name="language" content="zh-cn">
		<meta name="owner" content="中源旅游">
		<meta name="coverage" content="Worldwide">
		<meta name="distribution" content="Global">
		<meta name="rating" content="General">
		<meta property="og:title" content="中源旅游网">
		<meta property="og:type" content="website">
		<meta property="og:site_name" content="中源旅游网">
		<meta property="og:description" content="在中源您能体验天然氧吧清新的空气。独一无二的娃娃鱼，绝美的九岭尖风景,友好的本地人文风情,营养丰富的土特产">
		<meta name="subject">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link id="page_favicon" href="/images/favicon.ico" rel="icon" type="image/x-icon">
        <meta name="apple-mobile-web-app-title" content="万家山庄农家乐">
		<meta name="application-name" content="万家山庄农家乐">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="theme-color" content="#ffffff">
        <!-- Fonts -->
        <!--<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">-->
        <link rel="stylesheet" href="{{mix('css/home.css')}}">
        <style>@-webkit-keyframes spin{0%{transform:rotate(0)}100%{transform:rotate(360deg)}}@-moz-keyframes spin{0%{-moz-transform:rotate(0)}100%{-moz-transform:rotate(360deg)}}@keyframes spin{0%{transform:rotate(0)}100%{transform:rotate(360deg)}}.spinner{position:fixed;top:0;left:0;width:100%;height:100%;z-index:1003;background: #000000;overflow:hidden}  .spinner div:first-child{display:block;position:relative;left:50%;top:50%;width:150px;height:150px;margin:-75px 0 0 -75px;border-radius:50%;box-shadow:0 3px 3px 0 rgba(255,56,106,1);transform:translate3d(0,0,0);animation:spin 2s linear infinite}  .spinner div:first-child:after,.spinner div:first-child:before{content:'';position:absolute;border-radius:50%}  .spinner div:first-child:before{top:5px;left:5px;right:5px;bottom:5px;box-shadow:0 3px 3px 0 rgb(255, 228, 32);-webkit-animation:spin 3s linear infinite;animation:spin 3s linear infinite}  .spinner div:first-child:after{top:15px;left:15px;right:15px;bottom:15px;box-shadow:0 3px 3px 0 rgba(61, 175, 255,1);animation:spin 1.5s linear infinite}</style>
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]);?>;  
        </script>
    </head>
    <body>
        <div id="nb-global-spinner" class="spinner">
            <div class="blob blob-0"></div>
            <div class="blob blob-1"></div>
            <div class="blob blob-2"></div>
            <div class="blob blob-3"></div>
            <div class="blob blob-4"></div>
            <div class="blob blob-5"></div>
        </div>

        <div class="home" id="app">
            
        </div>
        <script src="{{mix('js/manifest.js')}}"></script>
        <script src="{{mix('js/vendor.js')}}"></script>
        <script src="{{mix('js/home.js')}}"></script>
        <script src="{{asset('js/tinymce/tinymce.min.js')}}"></script>
        <!-- <script src="{{asset('js/_scripts.js')}}"></script> -->
    </body>
</html>

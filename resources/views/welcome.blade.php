<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>万家山庄农家乐</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{mix('css/home.css')}}">
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]);?>;
             window.URL = '{{url('/admin')}}';
        </script>
    </head>
    <body>
        <div class="home" id="app">
            
        </div>
        <script src="{{mix('js/home.js')}}"></script>
    </body>
</html>

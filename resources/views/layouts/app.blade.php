  <!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="{{asset('css/app.css')}}">

        <title>{{config('app.name', 'orderX')}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

      
    </head>
    <body>
        @include('inc.navbar')

        <div class="container">
            @include('inc.messages')
            @yield('content')
        </div>


            <script src="/orderx/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
            <script>
                CKEDITOR.replace( 'article-ckeditor' );
            </script>
    </body>
</html>
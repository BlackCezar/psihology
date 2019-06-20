<!doctype html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/index.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Russo+One&display=swap" rel="stylesheet"> 
    </head>
    <body>
        <section>@include('layout.sidebar-admin')</section>
        <main class="admin">
            <div class="background">
            </div>
            <h1 class="main_h1">Официальный  сайт муниципального образования
                поселок Березовка
                Березовского  района  Красноярского края
            </h1> 
            <div class="content">
            @yield('content')
</div>
            <footer>
                <div>
                    <b>Адрес:</b> <span>662520, Красноярский край, Березовский район, п. Березовка, ул. Центральная, 19</span><br>
                    <b>Приемная:</b><a href="telto:83917521315">8 (39175) 2-13-15</a><br>
                    <b>E-mail:</b><a href="mailto:beradm@mail.ru">beradm@mail.ru</a>
                </div>
                <span>Муниципальное образование поселок Березовка <br>Березовского района Красноярского края</span>
            </footer>    
        </main>
        <section>@yield('r_sidebar')</section>
        
    </body>
</html>

<!doctype html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Психолог | ККРИТ</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/index.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Russo+One&display=swap" rel="stylesheet"> 
    </head>
    <body>
        <header>
            <div class="logo"><img src="{{ asset('img/logo.png')}}" alt=""></div>
            <div class="site-title">
                <span>Психолог</span>
                <span>Психотерапевт</span>
            </div>
            <nav>
            <li><a href="/">Главная</a></li>
            <li><a href="/about">Обо мне</a></li>
            <li><a href="/questions">Вопрос-Ответы</a></li>
            <li><a href="/reviews">Отзывы</a></li>
            <li><a href="/contact">Контакты</a></li>
            </nav>
        </header>
        <main>
            <div class="subnav">
                <div class="title">Главная</div>
                <div class="path">Главная</div>
            </div>
            <div class="row">
                <div class="content">@yield('content')</div>
                <section class="">
                    <div class="widgets">
                        <div class="widget card">
                            <div class="widget-header">Свежие записи</div>
                            <div class="widget-bo">уцауцацу</div>
                        </div>
                    </div>
                </section>
            </div>
            
        </main>

    </body>
</html>

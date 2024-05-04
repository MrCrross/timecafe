<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta
        http-equiv="X-UA-Compatible"
        content="IE=edge"
    >
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <title>Time Cafe Alex Stupachenko</title>
    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >
    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >
    <link
        href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;600&family=Oswald:wght@600&display=swap"
        rel="stylesheet"
    >
    <link
        rel="stylesheet"
        href="{{asset('/css/welcome/fontawesome.min.css')}}"
    > <!-- fontawesome -->

    <script src="{{asset('/js/toggleTheme.js')}}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link
        rel="stylesheet"
        href="{{asset('/css/welcome/tooplate-antique-cafe.css')}}"
    >

    <!--

    Tooplate 2126 Antique Cafe

    https://www.tooplate.com/view/2126-antique-cafe

    -->
</head>
<body>
<!-- Intro -->
<div
    id="intro"
    class="parallax-window"
    data-parallax="scroll"
    data-image-src="{{asset('/img/welcome/antique-cafe-bg-01.jpg')}}"
>
    <nav
        id="tm-nav"
        class="fixed w-full"
    >
        <div class="container mx-auto px-2 md:py-6 text-right">
            <button
                class="md:hidden py-2 px-2"
                id="menu-toggle"
            >
                <i class="fas fa-2x fa-bars tm-text-gold"></i>
            </button>
            <ul class="mb-3 md:mb-0 text-xl font-normal flex justify-center flex-col md:flex-row">
                <li class="inline-block mb-4 mx-1">
                    <a
                        href="/#intro"
                        class="tm-text-gold py-1 md:py-3 px-4"
                    >
                        Главная
                    </a>
                </li>
                <li class="inline-block mb-4 mx-1">
                    <button
                            type="button"
                            onclick="event.preventDefault(); location.href='{{ route('rooms.welcome') }}#room';"
                            class="tm-text-gold pb-1 md:pb-3 px-4 @if(request()->routeIs('rooms.welcome')) current @endif"
                    >
                        Комнаты
                    </button>
                </li>
                <li class="inline-block mb-4 mx-1">
                    <button
                            type="button"
                            onclick="event.preventDefault(); location.href='{{ route('products.welcome') }}#menu';"
                            class="tm-text-gold pb-1 md:pb-3 px-4 @if(request()->routeIs('products.welcome')) current @endif"
                    >
                        Меню
                    </button>
{{--                    <a--}}
{{--                        href="#menu"--}}
{{--                        class="tm-text-gold py-1 md:py-3 px-4 @if(request()->routeIs('products.welcome')) current @endif"--}}
{{--                    >--}}
{{--                        Меню--}}
{{--                    </a>--}}
                </li>
                <li class="inline-block mb-4 mx-1">
                    <button
                        type="button"
                        onclick="event.preventDefault(); location.href='{{ route('stocks.welcome') }}#stocks';"
                        class="tm-text-gold pb-1 md:pb-3 px-4 @if(request()->routeIs('stocks.welcome')) current @endif"
                    >
                        Акции
                    </button>
                </li>
                @auth
                    <li class="inline-block mb-4 mx-1">
                        <button
                            type="button"
                            onclick="event.preventDefault(); location.href='{{ route('reservations.welcome') }}#reservations';"
                            class="tm-text-gold pb-1 md:pb-3 px-4 @if(request()->routeIs('reservations.welcome')) current @endif"
                        >
                            Бронь
                        </button>
                    </li>
                    @if(Auth::user()->params()->has('orders_view'))
                    <li class="inline-block mb-4 mx-1">
                        <button
                            type="button"
                            onclick="event.preventDefault(); location.href='{{ route('orders.welcome') }}#orders';"
                            class="tm-text-gold pb-1 md:pb-3 px-4 @if(request()->routeIs('orders.welcome')) current @endif"
                        >
                            Заказы
                        </button>
                    </li>
                    @endif
                @endauth
                <li class="inline-block mb-4 mx-1">
                    <a
                        href="/#about"
                        class="tm-text-gold py-1 md:py-3 px-4"
                    >
                        О нас
                    </a>
                </li>
                <li class="inline-block mb-4 mx-1">
                    <a
                        href="/#contact"
                        class="tm-text-gold py-1 md:py-3 px-4"
                    >
                        Контакты
                    </a>
                </li>
                <li class="inline-block mb-4 mx-1">
                    <button
                        type="button"
                        onclick="event.preventDefault(); location.href='{{ route('reviews.welcome') }}#reviews';"
                        class="tm-text-gold pb-1 md:pb-3 px-4 @if(request()->routeIs('reviews.welcome')) current @endif"
                    >
                        Отзывы
                    </button>
                </li>
                <li class="inline-block mb-4 mx-1">
                    <a
                        href="{{ route('welcome.rules') }}#rules"
                        class="tm-text-gold py-1 md:py-3 px-4"
                    >
                        Правила
                    </a>
                </li>
                <li class="inline-block mb-4 mx-1">
                    <button
                            type="button"
                            onclick="event.preventDefault(); location.href='{{asset('/documents/help.docx')}}';"
                            class="tm-text-gold pb-1 md:pb-3 px-4"
                    >
                        Помощь
                    </button>
                </li>
                @if (Route::has('login'))
                    @guest
                        <li class="inline-block mb-4 mx-1">
                            <button
                                type="button"
                                onclick="event.preventDefault(); location.href='{{ route('login') }}';"
                                class="tm-text-gold pb-1 md:pb-3 px-4"
                            >
                                Вход
                            </button>
                        </li>
                        @if (Route::has('register'))
                            <li class="inline-block mb-4 mx-1">
                                <button
                                    type="button"
                                    onclick="event.preventDefault(); location.href='{{ route('register') }}';"
                                    class="tm-text-gold pb-1 md:pb-3 px-4"
                                >
                                    Регистрация
                                </button>
                            </li>
                        @endif
                    @else
                        <li class="inline-block mb-4 mx-1">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="tm-text-gold pb-1 md:pb-3 px-4 inline-flex items-center border border-transparent rounded-md bg-transparent transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->login }}</div>

                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link class="cursor-pointer" onclick="event.preventDefault(); location.href='{{ route('profile.edit') }}';">
                                        {{ __('Профиль') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')"
                                                         onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                            {{ __('Выйти') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </li>
                    @endguest
                @endif
            </ul>
        </div>
    </nav>
    <div class="container mx-auto px-2 tm-intro-width">
        <div class="sm:pb-60 sm:pt-48 py-20">
            <div class="bg-black bg-opacity-70 p-12 mb-5 text-center">
                <h1 class="text-white text-5xl tm-logo-font mb-5">Time Cafe</h1>
                <p class="tm-text-gold tm-text-2xl">Твоя ежедневная энергия</p>
            </div>
            <div class="bg-black bg-opacity-70 p-10 mb-5">
                <p class="text-white leading-8 text-sm font-light">
                    Time Cafe - Лучшее антикафе города.
                </p>
                <p class="text-white leading-8 text-sm font-light">
                    Есть желание посетить наше антикафе?
                    Оставьте контактные данные для бронирования
                    <a
                        rel="nofollow"
                        href="#contact"
                        target="_parent"
                    >
                        здесь
                    </a>.
                </p>
            </div>
            <div class="text-center">
                <div class="inline-block">
                    <a
                        href="#menu"
                        class="flex justify-center items-center bg-black bg-opacity-70 py-6 px-8 rounded-lg font-semibold tm-text-2xl tm-text-gold hover:text-gray-200 transition"
                    >
                        <i class="fas fa-coffee mr-3"></i>
                        <span>Давайте посмотрим...</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@if (isset($header))
    <header class="bg-gold dark:bg-dark shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{ $header }}
        </div>
    </header>
@endif

<main>
    {{ $slot }}
</main>

<script src="{{asset('/js/welcome/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('/js/welcome/parallax.min.js')}}"></script>
<script src="{{asset('/js/welcome/jquery.singlePageNav.min.js')}}"></script>
<script>
    setTheme();

    function checkAndShowHideMenu() {
        if (window.innerWidth < 768) {
            $('#tm-nav ul').addClass('hidden');
        } else {
            $('#tm-nav ul').removeClass('hidden');
        }
    }

    $(function () {
        var tmNav = $('#tm-nav');
        @if (isset($singlePageNav))
        tmNav.singlePageNav();
        @endif

        checkAndShowHideMenu();
        window.addEventListener('resize', checkAndShowHideMenu);

        $('#menu-toggle').click(function () {
            $('#tm-nav ul').toggleClass('hidden');
        });

        $('#tm-nav ul li').click(function () {
            if (window.innerWidth < 768) {
                $('#tm-nav ul').addClass('hidden');
            }
        });

        $(document).scroll(function () {
            var distanceFromTop = $(document).scrollTop();

            if (distanceFromTop > 100) {
                tmNav.addClass('scroll');
            } else {
                tmNav.removeClass('scroll');
            }
        });
        @if (isset($singlePageNav))
        document.querySelectorAll('a[href^="/#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
        @endif
    });
</script>
</body>
</html>

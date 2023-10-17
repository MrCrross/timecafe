<x-welcome-layout>
    <x-slot name="singlePageNav"></x-slot>
    <!-- Cafe Room -->
    <div
        id="room"
        class="parallax-window"
        data-parallax="scroll"
        data-image-src="{{asset('/img/welcome/antique-cafe-bg-02.jpg')}}"
    >
        <div class="container mx-auto tm-container py-24 sm:py-48">
            <div class="text-center mb-16">
                <h2 class="bg-white tm-text-brown py-6 px-12 text-4xl font-medium inline-block rounded-md">
                    Наши комнаты
                </h2>
            </div>
            <div class="flex flex-col lg:flex-row justify-around items-center">
                <div class="flex-1 m-5 rounded-xl px-4 py-6 sm:px-8 sm:py-10 tm-bg-brown tm-item-container">
                    @foreach($roomsLeft as $room)
                        <div class="flex items-start mb-6 tm-menu-item">
                            <img
                                src="{{$room->image}}"
                                alt="{{$room->name}}"
                                class="rounded-md"
                                width="160"
                                height="120"
                            >
                            <div class="ml-3 sm:ml-6">
                                <h3 class="text-lg sm:text-xl mb-2 sm:mb-3 tm-text-yellow">{{$room->name}}</h3>
                                <div class="text-white text-md sm:text-lg font-light mb-1">{{$room->capacity}} чел.</div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="flex-1 m-5 rounded-xl px-4 py-6 sm:px-8 sm:py-10 tm-bg-brown tm-item-container">
                    @foreach($roomsRight as $product)
                        <div class="flex items-start justify-end mb-6 tm-menu-item-2">
                            <div class="text-right mr-6">
                                <h3 class="text-lg sm:text-xl mb-2 sm:mb-3 tm-text-yellow">{{$room->name}}</h3>
                                <div class="text-white text-md sm:text-lg font-light mb-1">{{$room->capacity}} чел.</div>
                            </div>
                            <img
                                src="{{$room->image}}"
                                alt="{{$room->name}}"
                                width="160"
                                height="120"
                                class="rounded-md"
                            >
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Cafe Menu -->
    <div
        id="menu"
        class="parallax-window"
        data-parallax="scroll"
        data-image-src="{{asset('/img/welcome/antique-cafe-bg-02.jpg')}}"
    >
        <div class="container mx-auto tm-container py-24 sm:py-48">
            <div class="text-center mb-16">
                <h2 class="bg-white tm-text-brown py-6 px-12 text-4xl font-medium inline-block rounded-md">
                    Наше меню
                </h2>
            </div>
            <div class="flex flex-col lg:flex-row justify-around items-center">
                <div class="flex-1 m-5 rounded-xl px-4 py-6 sm:px-8 sm:py-10 tm-bg-brown tm-item-container">
                    @foreach($menuLeft as $product)
                        <div class="flex items-start mb-6 tm-menu-item">
                            <img
                                src="{{$product->image}}"
                                alt="{{$product->name}}"
                                class="rounded-md"
                                width="160"
                                height="120"
                            >
                            <div class="ml-3 sm:ml-6">
                                <h3 class="text-lg sm:text-xl mb-2 sm:mb-3 tm-text-yellow">{{$product->name}}</h3>
                                <div class="text-white text-md sm:text-lg font-light mb-1">{{$product->price}} руб.</div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="flex-1 m-5 rounded-xl px-4 py-6 sm:px-8 sm:py-10 tm-bg-brown tm-item-container">
                    @foreach($menuRight as $product)
                        <div class="flex items-start justify-end mb-6 tm-menu-item-2">
                            <div class="text-right mr-6">
                                <h3 class="text-lg sm:text-xl mb-2 sm:mb-3 tm-text-yellow">{{$product->name}}</h3>
                                <div class="text-white text-md sm:text-lg font-light mb-1">{{$product->price}} руб.</div>
                            </div>
                            <img
                                src="{{$product->image}}"
                                alt="{{$product->name}}"
                                width="160"
                                height="120"
                                class="rounded-md"
                            >
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="text-center mb-16">
                <a
                    href="{{route('products.welcome')}}"
                    class="bg-white tm-text-brown py-6 px-12 text-4xl font-medium inline-block rounded-md"
                >
                    Полное меню
                </a>
            </div>
        </div>
    </div>
    <div
        id="about"
        class="parallax-window"
        data-parallax="scroll"
        data-image-src="{{asset('/img/welcome/antique-cafe-bg-03.jpg')}}"
    >
        <div class="container mx-auto tm-container py-24 sm:py-48">
            <div class="tm-item-container sm:ml-auto sm:mr-12 mx-auto sm:px-0 px-4">
                <div class="bg-white bg-opacity-80 p-12 pb-14 rounded-xl mb-5">
                    <h2 class="mb-6 tm-text-green text-4xl font-medium">О нашем антикафе</h2>
                    <p class="mb-6 text-base leading-8">
                        Только у нас всегда низкие цены и приятная атмосфера!<br>
                        У нас всегда можно провести своё время с компанией, поработать и провести время с друзьями и
                        пользой.
                    </p>
                    <p class="text-base leading-8">
                        Всегда ждём Вас в Time Cafe.
                    </p>
                </div>
                <a
                    href="#contact"
                    class="inline-block tm-bg-green transition text-white text-xl pt-3 pb-4 px-8 rounded-md"
                >
                    <i class="far fa-comments mr-4"></i>
                    Контакты
                </a>
            </div>
        </div>
    </div>
    <div
        id="contact"
        class="parallax-window relative"
        data-parallax="scroll"
        data-image-src="{{asset('/img/welcome/antique-cafe-bg-04.jpg')}}"
    >
        <div class="container mx-auto tm-container pt-24 pb-48 sm:py-48">
            <div class="flex flex-col lg:flex-row justify-around items-center lg:items-stretch">
                <div class="flex-1 rounded-xl px-10 py-12 m-5 bg-white bg-opacity-80 tm-item-container">
                    <h2 class="text-3xl mb-6 tm-text-green">Контакты</h2>
                    <p class="mb-6 text-lg leading-8">
                        Работаем для вас с 8:30 до 21:00 без выходных!
                    </p>
                    <p class="mb-10 text-lg">
                    <span class="block mb-2">Телефон:
                        <a
                            href="tel:89640000000"
                            class="hover:text-yellow-600 transition"
                        >
                            8-964-000-00-00
                        </a>
                    </span>
                        <span class="block">Email:
                        <a
                            href="mailto:admin@timecafe.ru"
                            class="hover:text-yellow-600 transition"
                        >
                            admin@timecafe.ru
                        </a>
                    </span>
                    </p>
                    <div class="text-center">
                        <a
                            href="https://yandex.ru/maps/63/irkutsk/house/ulitsa_lenina_5a/ZUkCaAVoSEYBXUJvYWJzeX9iYAA=/?ll=104.281361%2C52.283148&z=17.64"
                            class="inline-block text-white text-2xl pl-10 pr-12 py-6 rounded-lg transition tm-bg-green"
                        >
                            <i class="fas fa-map-marked-alt mr-8"></i>
                            Открыть карту
                        </a>
                    </div>
                </div>
                <div class="flex-1 rounded-xl p-12 pb-14 m-5 bg-black bg-opacity-50 tm-item-container">
                    <form
                        action="{{route('reservation.store')}}"
                        method="POST"
                        class="text-lg"
                    >
                        @csrf
                        <input
                            type="text"
                            name="fio"
                            class="input w-full bg-black border-b bg-opacity-0 text-white px-1 py-4 mb-4 tm-border-gold"
                            placeholder="ФИО"
                            required
                        />
                        <input
                            type="email"
                            name="email"
                            class="input w-full bg-black border-b bg-opacity-0 text-white px-1 py-4 mb-4 tm-border-gold"
                            placeholder="Почта"
                            required
                        />
                        <select
                            name="room_id"
                            class="select-gold input w-full bg-black border-b bg-opacity-0 text-white px-1 py-4 mb-4 tm-border-gold"
                            required
                        >
                            <option
                                value=""
                                disabled
                                selected
                            >
                                Комната
                            </option>
                            @foreach($rooms as $room)
                                <option
                                    value="{{$room->id}}"
                                >
                                    {{$room->name . ' ' . $room->rate->price . ' руб/час'}}
                                </option>
                            @endforeach
                        </select>
                        <input
                            type="number"
                            name="hours"
                            min="1"
                            class="input w-full bg-black border-b bg-opacity-0 text-white px-1 py-4 mb-4 tm-border-gold"
                            placeholder="Количество часов"
                            required
                        />
                        <input
                            type="number"
                            name="capacity"
                            min="1"
                            class="input w-full bg-black border-b bg-opacity-0 text-white px-1 py-4 mb-4 tm-border-gold"
                            placeholder="Количество человек"
                            required
                        />
                        <input
                            type="datetime-local"
                            name="date_reserve"
                            class="input w-full bg-black border-b bg-opacity-0 text-white px-1 py-4 mb-4 tm-border-gold"
                            placeholder="Дата бронирования"
                            min="{{\Illuminate\Support\Carbon::now()->addHours(2)->format('Y-m-d H:i')}}"
                            value="{{\Illuminate\Support\Carbon::now()->addHours(2)->format('Y-m-d H:i')}}"
                            required
                        >
                        <div class="text-right">
                            <button
                                type="submit"
                                class="text-white hover:text-yellow-500 transition"
                            >Отправить
                            </button>
                        </div>
                        @if (session('status') === 'reservation')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 5000)"
                                class="text-sm text-gray-600 dark:text-gray-400"
                            >{{ __('Форма отправлена.') }}</p>
                        @endif
                    </form>
                </div>
            </div>
            <footer class="absolute bottom-0 left-0 w-full">
                <div class="text-white container mx-auto tm-container p-8 text-lg flex flex-col md:flex-row justify-between">
                    <span>Copyright 2023 Antique Cafe. All rights reserved.</span>
                    <span class="mt-5 md:mt-0">Design: <a
                            href="https://www.tooplate.com"
                            target="_parent"
                        >Tooplate</a></span>
                </div>
            </footer>
        </div>
    </div>
</x-welcome-layout>

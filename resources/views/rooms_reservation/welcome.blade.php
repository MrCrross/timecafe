<x-welcome-layout>
    <x-slot name="header">
        <x-room-reservation-header welcome="true"/>
    </x-slot>
    <div
        id="reservations"
        data-parallax="scroll"
        class="parallax-window py-12"
        data-image-src="{{asset('/img/welcome/antique-cafe-bg-02.jpg')}}"
    >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 bg-transparent">
            <form method="GET" action="{{route('reservations.welcome')}}#reservations"
                  class="rounded-xl shadow bg-gray-100 dark:bg-gray-800 p-4">
                <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Фильтры</h1>
                <div class="grid grid-cols-2 gap-10">
                    <div class="">
                        <x-input-label
                                for="room_id"
                                :value="__('Комната')"
                        />
                        <x-select
                                id="room_id"
                                name="room_id"
                                class="mt-1 block w-full"
                                :data="$rooms_autocomplete"
                                :selected="$filter->room ?? 0"
                        />
                    </div>
                    <div class="">
                        <x-input-label
                                for="date_reserve"
                                :value="__('Дата бронирования')"
                        />
                        <div class="flex flex-row justify-between items-center">
                            <x-input-label
                                    for="min_date"
                                    :value="__('от')"
                            />
                            <x-text-input
                                    id="min_date"
                                    name="min_date"
                                    type="datetime-local"
                                    placeholder="Дата бронирования"
                                    min="1"
                                    :value="$filter->min_date ?? null"
                                    class="mt-1"
                            />
                            <x-input-label
                                    for="max_date"
                                    :value="__('до')"
                            />
                            <x-text-input
                                    id="max_date"
                                    name="max_date"
                                    type="datetime-local"
                                    placeholder="Дата бронирования"
                                    min="1"
                                    :value="$filter->max_date ?? null"
                                    class="mt-1"
                            />
                        </div>
                    </div>
                </div>
                <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight my-2">Сортировка</h1>
                <div class="grid grid-cols-5 gap-10">
                    <div>
                        <x-input-label
                                for="order_room"
                                :value="__('По комнате')"
                        />
                        <x-select
                                id="order_room"
                                name="order_room"
                                class="mt-1"
                                :data="$order->default"
                                :selected="$order->room ?? 0"
                        />
                    </div>
                </div>
                <div
                        class="flex items-center gap-4 mt-4"
                >
                    <x-primary-button>
                        {{ __('Применить') }}
                    </x-primary-button>
                </div>
            </form>
            <div
                class="grid max-w-lg gap-10 lg:grid-cols-3 py-4 lg:max-w-none lg:p-6 bg-transparent shadow-xl sm:rounded-lg">
                @foreach($reservations->items() as $reservation)
                    <div
                        class="p-4 flex flex-col gap-2 justify-center items-start bg-white dark:bg-gray-800 shadow sm:rounded-lg w-full">
                        <h1 class="font-semibold text-xl leading-tight text-gray-800 dark:text-gray-200">
                            Комната: {{$reservation->room->name}}</h1>
                        <x-item-p label="ФИО бронирующего" value="{{$reservation->fio}}"></x-item-p>
                        <x-item-p label="Почта бронирующего" value="{{$reservation->email}}"></x-item-p>
                        <x-item-p label="Дата брони"
                                  value="{{\Illuminate\Support\Carbon::parse($reservation->date_reserve)->format('d.m.Y H:i:s')}}"></x-item-p>
                        <x-item-p label="Количество часов" value="{{$reservation->hours}}"></x-item-p>
                        <x-item-p label="Количество человек" value="{{$reservation->capacity}}"></x-item-p>
                        @if(!empty($reservation->order))
                            <div class="text-gray-800 dark:text-gray-200">
                                <p class="font-bold">Товары/Услуги:</p>
                                @php $orderPrice = 0; @endphp
                                @foreach($reservation->order->products as $product)
                                    <p>
                                        @php $productPrice = $product->product->price * $product->count; @endphp
                                        {{$product->count}} x {{$product->product->name}} = {{$productPrice}}руб.
                                    </p>
                                    @php $orderPrice += $productPrice; @endphp
                                @endforeach
                                <span id="order_price" class="pt-5">Итого товаров/услуг: {{$orderPrice}}</span><span class="pt-5"> руб.</span>
                            </div>
                        @endif
                        <x-danger-button type="button"
                                         x-data=""
                                         x-on:click.prevent="$dispatch('open-modal', 'confirm-reservation-deletion{{$reservation->id}}')"
                        >
                            {{__('Удалить')}}
                        </x-danger-button>
                        <x-modal name="confirm-reservation-deletion{{$reservation->id}}" focusable>
                            <form method="post" action="{{ route('reservation.destroyWelcome', $reservation->id) }}" class="p-6">
                                @csrf
                                @method('delete')

                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Вы уверены, что хотите удалить бронь на ' . \Illuminate\Support\Carbon::parse($reservation->date_reserve)->format('d.m.Y H:i:s') . '?') }}
                                </h2>

                                <div class="mt-6 flex justify-end">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('Отмена') }}
                                    </x-secondary-button>

                                    <x-danger-button class="ml-3" type="submit">
                                        {{ __('Удалить') }}
                                    </x-danger-button>
                                </div>
                            </form>
                        </x-modal>
                    </div>
                @endforeach
            </div>
            @if($reservations->isEmpty())
                <div
                    class="p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg w-full">
                    <h1 class="font-semibold text-xl leading-tight text-gray-800 dark:text-gray-200">Пока не было
                        бронирований</h1>
                </div>
            @endif
            <x-paginate :paginator="$reservations" tag="#reservations"></x-paginate>
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
                                href="tel:89842709031"
                                class="hover:text-yellow-600 transition"
                        >
                            8-984-270-90-31
                        </a>
                    </span>
                        <span class="block">Email:
                        <a
                                href="mailto:alex.jentelmen@gmail.com"
                                class="hover:text-yellow-600 transition"
                        >
                            alex.jentelmen@gmail.com
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
                            @auth
                                value="{{\Illuminate\Support\Facades\Auth::user()->fio}}"
                            hidden
                            @endauth
                            required
                        />
                        @auth
                            <input
                                type="text"
                                name=""
                                class="input w-full bg-black border-b bg-opacity-0 text-white px-1 py-4 mb-4 tm-border-gold"
                                placeholder=""
                                value="{{\Illuminate\Support\Facades\Auth::user()->fio}}"
                                disabled
                            />
                        @endauth
                        <input
                            type="email"
                            name="email"
                            class="input w-full bg-black border-b bg-opacity-0 text-white px-1 py-4 mb-4 tm-border-gold"
                            placeholder="Почта"
                            @auth
                                value="{{\Illuminate\Support\Facades\Auth::user()->email}}"
                            hidden
                            @endauth
                            required
                        />
                        @auth
                            <input
                                type="text"
                                name=""
                                class="input w-full bg-black border-b bg-opacity-0 text-white px-1 py-4 mb-4 tm-border-gold"
                                placeholder=""
                                value="{{\Illuminate\Support\Facades\Auth::user()->email}}"
                                disabled
                            />
                        @endauth
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
        </div>
    </div>
</x-welcome-layout>

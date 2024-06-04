<x-app-layout>
    <x-slot
        name="header"
    >
        @include('rooms_reservation.partials.header')
    </x-slot>
    <div
        class="py-12"
    >
        <p
            class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6"
        >
        @if ($message = Session::get('error'))
            <div class="w-full px-10 py-5 bg-red-500">
                <p>{{ $message }}</p>
            </div>
        @endif
            <x-order-product-card key="0" clone="1" :products="$products"></x-order-product-card>
            <section
                class="max-w-4xl p-6 mx-auto bg-white rounded-md shadow-md dark:bg-gray-800"
            >

                <form method="post" action="{{ route('reservation.storeAdmin') }}" enctype="multipart/form-data">
                    @csrf
                    <p class="text-gray-800 dark:text-gray-200">
                        <span class="font-bold">Пользователь:</span>
                        <x-select
                            id="user_id"
                            name="user_id"
                            class="mt-1 block w-full"
                            :data="$users"
                        />
                    </p>
                    <p class="text-gray-800 dark:text-gray-200">
                        <span class="font-bold">ФИО бронирующего:</span>
                        <x-text-input
                            id="fio"
                            name="fio"
                            type="text"
                            class="mt-1 block w-full"
                        />
                    </p>
                    <p class="text-gray-800 dark:text-gray-200">
                        <span class="font-bold">Почта бронирующего:</span>
                        <x-text-input
                            id="name"
                            name="name"
                            type="email"
                            class="mt-1 block w-full"
                        />
                    </p>
                    <p class="text-gray-800 dark:text-gray-200">
                        <span class="font-bold">Комната:</span>
                        <x-select
                            id="room_id"
                            name="room_id"
                            class="mt-1 block w-full"
                        >
                            <x-slot name="options">
                                <option
                                    value=""
                                    data-price="0"
                                    disabled
                                    selected
                                >
                                    Комната
                                </option>
                                @foreach($rooms as $room)
                                    <option
                                        value="{{$room->id}}"
                                        data-price="{{$room->rate->price}}"
                                    >
                                        {{$room->name . ' ' . $room->rate->price . ' руб/час'}}
                                    </option>
                                @endforeach
                            </x-slot>
                        </x-select>
                    </p>
                    <p class="text-gray-800 dark:text-gray-200">
                        <span class="font-bold">Дата брони:</span>
                        <x-text-input
                            id="date_reserve"
                            name="date_reserve"
                            type="datetime-local"
                            class="mt-1 block w-full"
                            min="{{\Illuminate\Support\Carbon::now()->addHours(2)->format('Y-m-d H:i')}}"
                            required
                        />
                    </p>
                    <p class="text-gray-800 dark:text-gray-200">
                        <span class="font-bold">Количество часов:</span>
                        <x-text-input
                            id="hours"
                            name="hours"
                            type="number"
                            class="mt-1 block w-full"
                            min="1"
                            required
                        />
                    </p>
                    <p class="text-gray-800 dark:text-gray-200">
                        <span class="font-bold">Количество человек:</span>
                        <x-text-input
                            id="capacity"
                            name="capacity"
                            type="number"
                            class="mt-1 block w-full"
                            min="1"
                            required
                        />
                    </p>
                    <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Товары/Услуги</h1>

                    <div class="py-4 flex flex-col justify-items-stretch container-line-Order">
                        <x-order-product-card key="0" :products="$products"></x-order-product-card>
                    </div>
                    <div
                        class="flex items-center mt-4"
                    >
                        <x-primary-button>
                            {{ __('Сохранить') }}
                        </x-primary-button>
                        <span id="order_price" class="pl-5">0</span><span class="pl-5">руб.</span>
                        @if (session('status') === 'reservation-created')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 5000)"
                                class="text-sm text-gray-600 dark:text-gray-400"
                            >{{ __('Сохранено.') }}</p>
                        @endif
                    </div>
                </form>
            </section>
        </div>
    </div>
</x-app-layout>
<script src="{{asset('/js/OrderForm.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        new OrderForm();
    })
</script>

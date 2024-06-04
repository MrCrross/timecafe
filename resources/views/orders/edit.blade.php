<x-app-layout>
    <x-slot
        name="header"
    >
        @include('orders.partials.header')
    </x-slot>
    <div
        class="py-12"
    >
        <div
            class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6"
        >
            <section
                class="max-w-4xl p-6 mx-auto bg-white rounded-md shadow-md dark:bg-gray-800"
            >
                <x-order-product-card key="0" clone="1" :products="$products"></x-order-product-card>
                <form method="post" action="{{ route('orders.update', $order->id) }}">
                    @csrf
                    @method('patch')

                    <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        <p>№{{$order->id}}</p>
                        <p>Дата: {{\Illuminate\Support\Carbon::parse($order->date_order)->format('d.m.Y H:i')}}</p>
                        <p>Комната: {{$order->room->name}}</p>
                    </h1>
                    <div class="py-4">
                        <x-input-label
                            for="room_id"
                            :value="__('Комната')"
                        />
                        <x-select
                            id="room_id"
                            name="room_id"
                            class="mt-1 block w-full"
                            :data="$rooms"
                            :selected="$order->room_id"
                            :additionalFields="['price']"
                            required
                        />
                        <x-input-error
                            class="mt-2"
                            :messages="$errors->get('room_id')"
                        />
                    </div>

                    <div class="py-4">
                        <x-input-label
                            for="hours"
                            :value="__('Количество часов')"
                        />
                        <x-text-input
                            id="hours"
                            name="hours"
                            type="number"
                            class="mt-1 block w-full"
                            min="1"
                            :value="$order->hours"
                            required
                        />
                        <x-input-error
                            class="mt-2"
                            :messages="$errors->get('hours')"
                        />
                    </div>

                    <div class="py-4 flex flex-row gap-2 items-center justify-start">
                        <x-input-label
                            for="status"
                            :value="__('Выполнено')"
                        />
                        <x-text-input
                            id="status"
                            name="status"
                            type="checkbox"
                            class="block p-2 input_checkbox"
                            :checked="$order->status === 2"
                            required
                        />
                    </div>
                    <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Товары/Услуги</h1>

                    <div class="py-4 flex flex-col justify-items-stretch container-line-Order">
                        @if($order->products->isNotEmpty())
                            @foreach($order->products as $key => $product)
                                <x-order-product-card :type="$key" :key="$key" :productID="$product->product_id" :productCount="$product->count" :products="$products"></x-order-product-card>
                            @endforeach
                        @else
                            <x-order-product-card key="0" :products="$products"></x-order-product-card>
                        @endif
                    </div>

                    <div
                        class="flex items-center gap-4"
                    >
                        <x-primary-button>
                            {{ __('Сохранить') }}
                        </x-primary-button>
                        <span id="order_price" class="pl-5">0</span><span class="pl-5">руб.</span>
                        @if (session('status') === 'orders-created')
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

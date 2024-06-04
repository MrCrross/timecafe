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
            <x-order-product-card key="0" clone="1" :products="$products"></x-order-product-card>
            <section
                class="max-w-4xl p-6 mx-auto bg-white rounded-md shadow-md dark:bg-gray-800"
            >
                <form method="post" action="{{ route('orders.store') }}">
                    @csrf

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
                            value="1"
                            required
                        />
                        <x-input-error
                            class="mt-2"
                            :messages="$errors->get('hours')"
                        />
                    </div>

                    <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Товары/Услуги</h1>

                    <div class="py-4 flex flex-col justify-items-stretch container-line-Order">
                        <x-order-product-card key="0" :products="$products"></x-order-product-card>
                    </div>

                    <div
                        class="flex items-center gap-4"
                    >
                        <x-primary-button>
                            {{ __('Сохранить') }}
                        </x-primary-button>
                        <span id="order_price" class="pl-5">0</span><span class="pl-5">руб.</span>
                        @if (session('status') === 'order-created')
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

<x-welcome-layout>
    <x-slot name="header">
        <x-order-header welcome="true"/>
    </x-slot>
    <div
        id="orders"
        data-parallax="scroll"
        class="parallax-window py-12"
        data-image-src="{{asset('/img/welcome/antique-cafe-bg-02.jpg')}}"
    >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 bg-transparent">
            <form method="GET" action="{{route('orders.welcome')}}#orders"
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
                                :data="$rooms"
                                :selected="$filter->room ?? 0"
                        />
                    </div>
                    <div class="">
                        <x-input-label
                                for="date_order"
                                :value="__('Дата заказа')"
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
            <div class="grid max-w-lg gap-10 lg:grid-cols-3 py-4 lg:max-w-none lg:p-6 bg-transparent shadow-xl sm:rounded-lg">
                @foreach($orders->items() as $order)
                    <x-order-card :order="$order" welcome="true"></x-order-card>
                @endforeach
            </div>
            <x-paginate :paginator="$orders" tag="#orders"></x-paginate>
        </div>
    </div>
</x-welcome-layout>

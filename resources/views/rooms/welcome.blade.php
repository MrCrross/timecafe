<x-welcome-layout>
    <x-slot name="header">
        <x-room-header welcome="true"/>
    </x-slot>
    <div
        id="room"
        data-parallax="scroll"
        class="parallax-window py-12"
        data-image-src="{{asset('/img/welcome/antique-cafe-bg-02.jpg')}}"
    >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 bg-transparent">
            <form method="GET" action="{{route('rooms.welcome')}}#room"
                  class="rounded-xl shadow bg-gray-100 dark:bg-gray-800 p-4">
                <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Фильтры</h1>
                <div class="grid grid-cols-2 gap-10">
                    <div class="">
                        <x-input-label
                                for="name"
                                :value="__('Название')"
                        />
                        <x-text-input
                                id="name"
                                name="name"
                                type="text"
                                :value="$filter->name ?? __('')"
                                class="mt-1 block w-full"
                        />
                    </div>
                    <div class="">
                        <x-input-label
                                for="capacity"
                                :value="__('Вместительность')"
                        />
                        <div class="flex flex-row justify-between items-center">
                            <x-input-label
                                    for="min_capacity"
                                    :value="__('от')"
                            />
                            <x-text-input
                                    id="min_capacity"
                                    name="min_capacity"
                                    type="number"
                                    min="1"
                                    :value="$filter->min_capacity ?? __('1')"
                                    class="mt-1"
                            />
                            <x-input-label
                                    for="max_capacity"
                                    :value="__('до')"
                            />
                            <x-text-input
                                    id="max_capacity"
                                    name="max_capacity"
                                    type="number"
                                    min="1"
                                    :value="$filter->max_capacity ?? __('')"
                                    class="mt-1"
                            />
                        </div>
                    </div>
                </div>
                <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight my-2">Сортировка</h1>
                <div class="grid grid-cols-5 gap-10">
                    <div>
                        <x-input-label
                                for="order_name"
                                :value="__('По название')"
                        />
                        <x-select
                                id="order_name"
                                name="order_name"
                                class="mt-1"
                                :data="$order->default"
                                :selected="$order->name ?? 0"
                        />
                    </div>
                    <div>
                        <x-input-label
                                for="order_capacity"
                                :value="__('По вместительности')"
                        />
                        <x-select
                                id="order_capacity"
                                name="order_capacity"
                                class="mt-1"
                                :data="$order->default"
                                :selected="$order->capacity ?? 0"
                        />
                    </div>
                    <div>
                        <x-input-label
                                for="order_rate"
                                :value="__('По тарифу')"
                        />
                        <x-select
                                id="order_rate"
                                name="order_rate"
                                class="mt-1"
                                :data="$order->default"
                                :selected="$order->rate ?? 0"
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
                @foreach($rooms->items() as $room)
                    <x-room-card :room="$room" welcome="true"></x-room-card>
                @endforeach
            </div>
            <x-paginate :paginator="$rooms" tag="#room"></x-paginate>
        </div>
    </div>
</x-welcome-layout>

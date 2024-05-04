<x-welcome-layout>
    <x-slot name="header">
        <x-stock-header welcome="true"/>
    </x-slot>
    <div
        id="stocks"
        data-parallax="scroll"
        class="parallax-window py-12"
        data-image-src="{{asset('/img/welcome/antique-cafe-bg-02.jpg')}}"
    >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 bg-transparent">
            <form method="GET" action="{{route('stocks.welcome')}}#stock"
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
                @foreach($stocks->items() as $stock)
                    <x-stock-card :stock="$stock" welcome="true"></x-stock-card>
                @endforeach
            </div>
            <x-paginate :paginator="$stocks" tag="#stock"></x-paginate>
        </div>
    </div>
</x-welcome-layout>

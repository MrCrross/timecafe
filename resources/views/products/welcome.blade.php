<x-welcome-layout>
    <x-slot name="header">
        <x-product-header welcome="true"/>
    </x-slot>
    <div
        id="menu"
        data-parallax="scroll"
        class="parallax-window py-12"
        data-image-src="{{asset('/img/welcome/antique-cafe-bg-02.jpg')}}"
    >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 bg-transparent">
            <form method="GET" action="{{route('products.welcome')}}#menu"
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
                                for="price"
                                :value="__('Стоимость')"
                        />
                        <div class="flex flex-row justify-between items-center">
                            <x-input-label
                                    for="min_price"
                                    :value="__('от')"
                            />
                            <x-text-input
                                    id="min_price"
                                    name="min_price"
                                    type="number"
                                    min="1"
                                    :value="$filter->min_price ?? __('1')"
                                    class="mt-1"
                            />
                            <x-input-label
                                    for="max_price"
                                    :value="__('до')"
                            />
                            <x-text-input
                                    id="max_price"
                                    name="max_price"
                                    type="number"
                                    min="1"
                                    :value="$filter->max_price ?? __('')"
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
                                for="order_price"
                                :value="__('По стоимости')"
                        />
                        <x-select
                                id="order_price"
                                name="order_price"
                                class="mt-1"
                                :data="$order->default"
                                :selected="$order->price ?? 0"
                        />
                    </div>
                    <div>
                        <x-input-label
                                for="order_type"
                                :value="__('По типу товара')"
                        />
                        <x-select
                                id="order_type"
                                name="order_type"
                                class="mt-1"
                                :data="$order->default"
                                :selected="$order->type ?? 0"
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
                @foreach($products->items() as $product)
                    <x-product-card :product="$product" welcome="true"></x-product-card>
                @endforeach
            </div>
            <x-paginate :paginator="$products" tag="#menu"></x-paginate>
        </div>
    </div>
</x-welcome-layout>

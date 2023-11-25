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
            <form method="GET" action="{{route('orders.welcome')}}#orders" class="rounded-xl shadow bg-gray-100 dark:bg-gray-800 p-4">
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
                    />
                </div>
                <div
                    class="flex items-center gap-4"
                >
                    <x-primary-button>
                        {{ __('Найти') }}
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

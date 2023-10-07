<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
    <div class="flex flex-row items-center justify-between">
        <h1>{{ __('Товары') }}</h1>
        @auth
            <div class="flex flex-row items-center justify-between">
                @if(Auth::user()->params()->has('products_edit'))
                    <x-nav-link :href="route('products.create')" :active="request()->routeIs('products.create')">
                        {{__('Добавить')}}
                    </x-nav-link>
                @endif
            </div>
        @endauth
    </div>
</h2>

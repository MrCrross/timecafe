<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
    <div class="flex flex-row items-center justify-between">
        <h1>{{ __('Тарифы комнат') }}</h1>
        @auth
            <div class="flex flex-row items-center justify-between">
                @if(Auth::user()->params()->has('rooms_rates_edit'))
                    <x-nav-link :href="route('rooms_rates.create')" :active="request()->routeIs('rooms_rates.create')">
                        {{__('Добавить')}}
                    </x-nav-link>
                @endif
            </div>
        @endauth
    </div>
</h2>

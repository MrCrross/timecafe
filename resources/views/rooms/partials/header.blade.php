<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
    <div class="flex flex-row items-center justify-between">
        <h1>{{ __('Комнаты') }}</h1>
        @auth
            <div class="flex flex-row items-center justify-between">
                @if(Auth::user()->params()->has('rooms_edit'))
                    <x-nav-link :href="route('rooms.create')" :active="request()->routeIs('rooms.create')">
                        {{__('Добавить')}}
                    </x-nav-link>
                @endif
            </div>
        @endauth
    </div>
</h2>

<?php
    $textColor = 'text-gray-800 dark:text-gray-200';
    if (isset($attributes['welcome'])) {
        $textColor = 'text-gray-800 dark:text-gold';
    }
?>
<h2 class="font-semibold text-xl {{ $textColor }} leading-tight">
    <div class="flex flex-row items-center justify-between">
        <h1>{{ __('Бронь') }}</h1>
        @auth
            @if(Auth::user()->params()->has('reservation_edit'))
                <div class="flex flex-row items-center justify-between">
                    <x-nav-link :href="route('reservation.create')" :active="request()->routeIs('reservation.create')">
                        {{__('Добавить')}}
                    </x-nav-link>
                </div>
            @endif
        @endauth
        @if(isset($attributes['welcome']))
            <a
                    href="#contact"
                    class="tm-text-gold"
            >
                Забронировать комнату
            </a>
        @endif
    </div>
</h2>

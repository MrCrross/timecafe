<?php
    $textColor = 'text-gray-800 dark:text-gray-200';
    if (isset($attributes['welcome'])) {
        $textColor = 'text-gray-800 dark:text-gold';
    }
?>
<h2 class="font-semibold text-xl {{ $textColor }} leading-tight">
    <div class="flex flex-row items-center justify-between">
        <h1>{{ __('Пользователи') }}</h1>
        @auth
            <div class="flex flex-row items-center justify-between">
                @if(Auth::user()->params()->has('users_edit'))
                    <x-nav-link :href="route('users.create')" :active="request()->routeIs('users.create')">
                        {{__('Добавить')}}
                    </x-nav-link>
                @endif
            </div>
        @endauth
    </div>
</h2>

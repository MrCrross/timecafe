<?php
$textColor = 'text-gray-800 dark:text-gray-200';
if (isset($attributes['welcome'])) {
    $textColor = 'text-gray-800 dark:text-gold';
}
?>
<div class="font-semibold text-xl {{ $textColor }} leading-tight">
    <div class="flex flex-row items-center justify-between">
        <h1>{{ __('Программа лояльности') }}</h1>
        @if(Auth::user()->params()->has('loyalty_edit'))
            <x-nav-link :href="route('loyalty.edit')" :active="request()->routeIs('loyalty.edit')">
                {{__('Изменить')}}
            </x-nav-link>
        @endif
    </div>
</div>

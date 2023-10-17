<?php
    $textColor = 'text-gray-800 dark:text-gray-200';
    if (isset($attributes['welcome'])) {
        $textColor = 'text-gray-800 dark:text-gold';
    }
?>
<h2 class="font-semibold text-xl {{ $textColor }} leading-tight">
    <div class="flex flex-row items-center justify-between">
        <h1>{{ __('Бронь') }}</h1>
    </div>
</h2>

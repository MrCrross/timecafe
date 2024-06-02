@props([
    'maxWidth' => 'xs',
    'welcome' => false,
])
@php
    $maxWidth = [
        'xs' => 'max-w-xs',
        'sm' => 'max-w-sm',
        'md' => 'max-w-md',
        'lg' => 'max-w-lg',
        'xl' => 'max-w-xl',
        '2xl' => 'max-w-2xl',
    ][$maxWidth];

    $bgColor = 'bg-white dark:bg-gray-800';
    $textColor = 'text-gray-800 dark:text-white';
    if ($welcome) {
        $bgColor = 'bg-gold dark:bg-dark';
        $textColor = 'text-gray-800 dark:text-gold';
    }
@endphp
<div
    class="{{$maxWidth}} overflow-hidden mx-auto lg:mx-0 rounded-lg shadow-lg {{$bgColor}}"
>
    <div
        class="px-4 py-2"
    >
        <a href="{{$welcome ? '#stock' : route('stocks.show', $stock->id)}}">
            <h1
                class="text-xl font-bold uppercase {{$textColor}}"
            >
                {{$stock->name}}
            </h1>
        </a>
    </div>
    <div class="px-4 py-2">
        {{$stock->price}} р.
    </div>
    <div class="px-4 py-2">
        {{\Illuminate\Support\Carbon::parse($stock->expired_date)->format('d.m.Y H:i')}}
    </div>

    <div
        class="flex items-center justify-between px-4 py-2 bg-gray-900"
    >
        <div class="flex flex-row justify-between items-center">
            @auth
                @if(Auth::user()->params()->has('stocks_edit'))
                    <a
                        class="mx-2 px-2 py-1 text-xs font-semibold text-gray-900 uppercase transition-colors
                    duration-300 transform bg-white rounded hover:bg-gray-200 focus:bg-gray-400 focus:outline-none"
                        href="{{route('stocks.edit', $stock->id)}}"
                    >
                        Редактировать
                    </a>
                @endif
            @endauth
        </div>
    </div>
</div>

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
        <h1
            class="text-xl font-bold uppercase {{$textColor}}"
        >
            {{$product->name}}
        </h1>
        <p
            class="mt-1 text-sm text-gray-600 dark:text-gray-400"
        >
            {{$product->type->name}}
        </p>
    </div>

    <a href="{{$welcome ? '#menu' : route('products.show', $product->id)}}">
        <img
            class="object-cover w-full h-48 mt-2" src="{{$product->image}}"
            alt="{{$product->name}}"
        >
    </a>


    <div
        class="flex items-center justify-between px-4 py-2 bg-gray-900"
    >
        <h1
            class="text-lg font-bold text-white"
        >
            {{$product->price}} руб.
        </h1>
        <div class="flex flex-row justify-between items-center">
            @auth
                @if(Auth::user()->params()->has('products_edit'))
                    <a
                        class="mx-2 px-2 py-1 text-xs font-semibold text-gray-900 uppercase transition-colors
                    duration-300 transform bg-white rounded hover:bg-gray-200 focus:bg-gray-400 focus:outline-none"
                        href="{{route('products.edit', $product->id)}}"
                    >
                        Редактировать
                    </a>
                @endif
            @endauth
            @guest
                <button
                    class="mx-2 px-2 py-1 text-xs font-semibold text-gray-900 uppercase transition-colors
                duration-300 transform bg-white rounded hover:bg-gray-200 focus:bg-gray-400 focus:outline-none"
                >
                    Заказать
                </button>
            @endguest
        </div>
    </div>
</div>

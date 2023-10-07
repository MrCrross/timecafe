@props([
    'maxWidth' => 'xs'
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
@endphp
<div
    class="{{$maxWidth}} overflow-hidden bg-white mx-auto lg:mx-0 rounded-lg shadow-lg dark:bg-gray-800"
>
    <div
        class="px-4 py-2"
    >
        <h1
            class="text-xl font-bold text-gray-800 uppercase dark:text-white"
        >
            {{$type->name}}
        </h1>

    </div>

    <a href="{{route('products_types.show', $type->id)}}">
        <img
            class="object-cover w-full h-48 mt-2" src="{{$type->image}}"
            alt="{{$type->name}}"
        >
    </a>

    <div
        class="flex items-center justify-between px-4 py-2 bg-gray-900"
    >
        <div class="flex flex-row justify-between items-center">
            @if(Auth::user()->params()->has('products_types_edit'))
                <a
                    class="mx-2 px-2 py-1 text-xs font-semibold text-gray-900 uppercase transition-colors
                duration-300 transform bg-white rounded hover:bg-gray-200 focus:bg-gray-400 focus:outline-none"
                    href="{{route('products_types.edit', $type->id)}}"
                >
                    Редактировать
                </a>
            @endif
        </div>
    </div>
</div>

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
        <a href="{{route('orders.show', $order->id)}}">
            <h1
                class="text-xl font-bold text-gray-800 dark:text-white"
            >
                <p>№{{$order->id}}</p>
                <p>Дата: {{\Illuminate\Support\Carbon::parse($order->date_order)->format('d.m.Y H:i')}}</p>
                <p>Комната: {{$order->room->name}}</p>
            </h1>
        </a>
    </div>

    <div
        class="flex items-center justify-between px-4 py-2 bg-gray-900"
    >
        <div class="flex flex-row justify-between items-center">
            @if(Auth::user()->params()->has('orders_edit'))
                <a
                    class="mx-2 px-2 py-1 text-xs font-semibold text-gray-900 uppercase transition-colors
                duration-300 transform bg-white rounded hover:bg-gray-200 focus:bg-gray-400 focus:outline-none"
                    href="{{route('orders.edit', $order->id)}}"
                >
                    Редактировать
                </a>
{{--                <form method="post"  action="{{ route('orders.update', $order->id) }}">--}}
{{--                    @csrf--}}
{{--                    @method('patch')--}}
{{--                    <x-primary-button name="status" value="2" type="submit">{{__('Закрыть')}}</x-primary-button>--}}
{{--                </form>--}}
            @endif
        </div>
    </div>
</div>

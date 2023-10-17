<x-app-layout>
    <x-slot name="header">
        @include('rooms_reservation.partials.header')
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex flex-col gap-4 justify-center items-start">
                @foreach($reservations as $reservation)
                    <div class="p-4 flex flex-col gap-2 justify-center items-start bg-white dark:bg-gray-800 shadow sm:rounded-lg w-full">
                        <h1 class="font-semibold text-xl leading-tight text-gray-800 dark:text-gray-200">Комната: {{$reservation->room->name}}</h1>
                        <x-item-p label="ФИО бронирующего" value="{{$reservation->fio}}"></x-item-p>
                        <x-item-p label="Почта бронирующего" value="{{$reservation->email}}"></x-item-p>
                        <x-item-p label="Дата брони" value="{{\Illuminate\Support\Carbon::parse($reservation->date_reserve)->format('d.m.Y H:i:s')}}"></x-item-p>
                        <x-item-p label="Количество часов" value="{{$reservation->hours}}"></x-item-p>
                        <x-item-p label="Количество человек" value="{{$reservation->capacity}}"></x-item-p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

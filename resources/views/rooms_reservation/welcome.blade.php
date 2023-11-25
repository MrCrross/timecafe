<x-welcome-layout>
    <x-slot name="header">
        <x-room-reservation-header welcome="true"/>
    </x-slot>
    <div
        id="reservations"
        data-parallax="scroll"
        class="parallax-window py-12"
        data-image-src="{{asset('/img/welcome/antique-cafe-bg-02.jpg')}}"
    >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 bg-transparent">
            <form method="GET" action="{{route('reservations.welcome')}}#reservations"
                  class="rounded-xl shadow bg-gray-100 dark:bg-gray-800 p-4">
                <div class="py-4">
                    <x-input-label
                        for="room_id"
                        :value="__('Комната')"
                    />
                    <x-select
                        id="room_id"
                        name="room_id"
                        class="mt-1 block w-full"
                        :data="$rooms"
                    />
                </div>
                <div
                    class="flex items-center gap-4"
                >
                    <x-primary-button>
                        {{ __('Найти') }}
                    </x-primary-button>
                </div>
            </form>
            <div
                class="grid max-w-lg gap-10 lg:grid-cols-3 py-4 lg:max-w-none lg:p-6 bg-transparent shadow-xl sm:rounded-lg">
                @foreach($reservations->items() as $reservation)
                    <div
                        class="p-4 flex flex-col gap-2 justify-center items-start bg-white dark:bg-gray-800 shadow sm:rounded-lg w-full">
                        <h1 class="font-semibold text-xl leading-tight text-gray-800 dark:text-gray-200">
                            Комната: {{$reservation->room->name}}</h1>
                        <x-item-p label="ФИО бронирующего" value="{{$reservation->fio}}"></x-item-p>
                        <x-item-p label="Почта бронирующего" value="{{$reservation->email}}"></x-item-p>
                        <x-item-p label="Дата брони"
                                  value="{{\Illuminate\Support\Carbon::parse($reservation->date_reserve)->format('d.m.Y H:i:s')}}"></x-item-p>
                        <x-item-p label="Количество часов" value="{{$reservation->hours}}"></x-item-p>
                        <x-item-p label="Количество человек" value="{{$reservation->capacity}}"></x-item-p>
                    </div>
                @endforeach
            </div>
            @if($reservations->isEmpty())
                <div
                    class="p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg w-full">
                    <h1 class="font-semibold text-xl leading-tight text-gray-800 dark:text-gray-200">Пока не было
                        бронирований</h1>
                </div>
            @endif
            <x-paginate :paginator="$reservations" tag="#reservations"></x-paginate>
        </div>
    </div>
</x-welcome-layout>

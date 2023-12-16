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
                <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Фильтры</h1>
                <div class="grid grid-cols-2 gap-10">
                    <div class="">
                        <x-input-label
                                for="room_id"
                                :value="__('Комната')"
                        />
                        <x-select
                                id="room_id"
                                name="room_id"
                                class="mt-1 block w-full"
                                :data="$rooms"
                                :selected="$filter->room ?? 0"
                        />
                    </div>
                    <div class="">
                        <x-input-label
                                for="date_reserve"
                                :value="__('Дата бронирования')"
                        />
                        <div class="flex flex-row justify-between items-center">
                            <x-input-label
                                    for="min_date"
                                    :value="__('от')"
                            />
                            <x-text-input
                                    id="min_date"
                                    name="min_date"
                                    type="datetime-local"
                                    placeholder="Дата бронирования"
                                    min="1"
                                    :value="$filter->min_date ?? null"
                                    class="mt-1"
                            />
                            <x-input-label
                                    for="max_date"
                                    :value="__('до')"
                            />
                            <x-text-input
                                    id="max_date"
                                    name="max_date"
                                    type="datetime-local"
                                    placeholder="Дата бронирования"
                                    min="1"
                                    :value="$filter->max_date ?? null"
                                    class="mt-1"
                            />
                        </div>
                    </div>
                </div>
                <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight my-2">Сортировка</h1>
                <div class="grid grid-cols-5 gap-10">
                    <div>
                        <x-input-label
                                for="order_room"
                                :value="__('По комнате')"
                        />
                        <x-select
                                id="order_room"
                                name="order_room"
                                class="mt-1"
                                :data="$order->default"
                                :selected="$order->room ?? 0"
                        />
                    </div>
                </div>
                <div
                        class="flex items-center gap-4 mt-4"
                >
                    <x-primary-button>
                        {{ __('Применить') }}
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
                        <x-danger-button type="button"
                                         x-data=""
                                         x-on:click.prevent="$dispatch('open-modal', 'confirm-reservation-deletion{{$reservation->id}}')"
                        >
                            {{__('Удалить')}}
                        </x-danger-button>
                        <x-modal name="confirm-reservation-deletion{{$reservation->id}}" focusable>
                            <form method="post" action="{{ route('reservation.destroyWelcome', $reservation->id) }}" class="p-6">
                                @csrf
                                @method('delete')

                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Вы уверены, что хотите удалить бронь на ' . \Illuminate\Support\Carbon::parse($reservation->date_reserve)->format('d.m.Y H:i:s') . '?') }}
                                </h2>

                                <div class="mt-6 flex justify-end">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('Отмена') }}
                                    </x-secondary-button>

                                    <x-danger-button class="ml-3" type="submit">
                                        {{ __('Удалить') }}
                                    </x-danger-button>
                                </div>
                            </form>
                        </x-modal>
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

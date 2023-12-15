<x-app-layout>
    <x-slot
        name="header"
    >
        @include('rooms_reservation.partials.header')
    </x-slot>
    <div
        class="py-12"
    >
        <div
            class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6"
        >
            <section
                class="max-w-4xl p-6 mx-auto bg-white rounded-md shadow-md dark:bg-gray-800"
            >
                <h1 class="font-semibold text-xl leading-tight text-gray-800 dark:text-gray-200">
                    <div>Комната: {{$reservation->room->name}}</div>
                    <x-danger-button type="button"
                                     x-data=""
                                     x-on:click.prevent="$dispatch('open-modal', 'confirm-reservation-deletion')"
                    >
                        {{__('Удалить')}}
                    </x-danger-button>
                </h1>
                <x-item-p label="ФИО бронирующего" value="{{$reservation->fio}}"></x-item-p>
                <x-item-p label="Почта бронирующего" value="{{$reservation->email}}"></x-item-p>
                <form method="post" action="{{ route('reservation.update', $reservation->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <p class="text-gray-800 dark:text-gray-200">
                        <span class="font-bold">Дата брони:</span>
                        <x-text-input
                            id="date_reserve"
                            name="date_reserve"
                            type="datetime-local"
                            value="{{$reservation->date_reserve}}"
                            class="mt-1 block w-full"
                            min="{{\Illuminate\Support\Carbon::now()->addHours(2)->format('Y-m-d H:i')}}"
                            required
                        />
                    </p>
                    <p class="text-gray-800 dark:text-gray-200">
                        <span class="font-bold">Количество часов:</span>
                        <x-text-input
                            id="hours"
                            name="hours"
                            type="number"
                            value="{{$reservation->hours}}"
                            class="mt-1 block w-full"
                            min="1"
                            required
                        />
                    </p>
                    <p class="text-gray-800 dark:text-gray-200">
                        <span class="font-bold">Количество человек:</span>
                        <x-text-input
                            id="capacity"
                            name="capacity"
                            type="number"
                            value="{{$reservation->capacity}}"
                            class="mt-1 block w-full"
                            min="1"
                            required
                        />
                    </p>

                    <div
                        class="flex items-center mt-4"
                    >
                        <x-primary-button>
                            {{ __('Сохранить') }}
                        </x-primary-button>

                        @if (session('status') === 'reservation-updated')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 5000)"
                                class="text-sm text-gray-600 dark:text-gray-400"
                            >{{ __('Сохранено.') }}</p>
                        @endif
                    </div>
                </form>
            </section>
        </div>
    </div>
    <x-modal name="confirm-reservation-deletion" focusable>
        <form method="post" action="{{ route('reservation.destroy', $reservation->id) }}" class="p-6">
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
</x-app-layout>

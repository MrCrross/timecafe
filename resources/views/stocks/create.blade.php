<x-app-layout>
    <x-slot
        name="header"
    >
        @include('stocks.partials.header')
    </x-slot>
    <div
        class="py-12"
    >
        <div
            class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6"
        >
            @if ($message = Session::get('error'))
                <div class="w-full px-10 py-5 bg-red-500">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <section
                class="max-w-4xl p-6 mx-auto bg-white rounded-md shadow-md dark:bg-gray-800"
            >
                <form method="post" action="{{ route('stocks.store') }}">
                    @csrf
                    <div
                        class="py-4"
                    >
                        <x-input-label
                            for="name"
                            :value="__('Название')"
                        />
                        <x-text-input
                            id="name"
                            name="name"
                            type="text"
                            class="mt-1 block w-full"
                            required
                            autofocus
                        />
                        <x-input-error
                            class="mt-2"
                            :messages="$errors->get('name')"
                        />
                    </div>

                    <div
                        class="py-4"
                    >
                        <x-input-label
                            for="description"
                            :value="__('Описание')"
                        />
                        <x-textarea
                            id="description"
                            name="description"
                            class="mt-1 block w-full"
                            required
                        />
                        <x-input-error
                            class="mt-2"
                            :messages="$errors->get('description')"
                        />
                    </div>

                    <div
                        class="py-4"
                    >
                        <x-input-label
                            for="price"
                            :value="__('Стоимость')"
                        />
                        <x-text-input
                            id="price"
                            name="price"
                            type="number"
                            class="mt-1 block w-full"
                            min="0.00"
                            step="0.01"
                            required
                        />
                        <x-input-error
                            class="mt-2"
                            :messages="$errors->get('price')"
                        />
                    </div>

                    <div class="py-4">
                        <x-input-label
                            for="product_id"
                            :value="__('Товар')"
                        />
                        <x-select
                            id="product_id"
                            name="product_id"
                            class="mt-1 block w-full"
                            :data="$products"
                            required
                        />
                    </div>

                    <div class="py-4">
                        <x-input-label for="expired_date" :value="__('Действует до')" />
                        <x-text-input id="expired_date" name="expired_date" type="datetime-local" class="mt-1 block w-full" min="{{\Illuminate\Support\Carbon::now()->format('Y-m-d H:i')}}" required/>
                        <x-input-error class="mt-2" :messages="$errors->get('expired_date')" />
                    </div>

                    <div
                        class="mt-2 flex items-center gap-4"
                    >
                        <x-primary-button>
                            {{ __('Сохранить') }}
                        </x-primary-button>

                        @if (session('status') === 'stock-created')
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
</x-app-layout>

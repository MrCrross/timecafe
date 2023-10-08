<x-app-layout>
    <x-slot
        name="header"
    >
        @include('rooms.partials.header')
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
                <form method="post" action="{{ route('rooms.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div
                        class="py-4"
                    >
                        <x-image-preview/>
                        <x-input-label
                            for="image"
                            :value="__('Изображение')"
                        />
                        <x-text-input
                            id="image"
                            name="image"
                            type="file"
                            accept="image/*"
                            class="use-ImagePreview mt-1 block w-full"
                            required
                        />
                        <x-input-error
                            class="mt-2"
                            :messages="$errors->get('image')"
                        />
                    </div>
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
                            for="capacity"
                            :value="__('Вместительность (чел.)')"
                        />
                        <x-text-input
                            id="capacity"
                            name="capacity"
                            type="number"
                            class="mt-1 block w-full"
                            min="1"
                            required
                            autofocus
                        />
                        <x-input-error
                            class="mt-2"
                            :messages="$errors->get('capacity')"
                        />
                    </div>

                    <div class="py-4">
                        <x-input-label
                            for="rate_id"
                            :value="__('Тариф')"
                        />
                        <x-select
                            id="rate_id"
                            name="rate_id"
                            class="mt-1 block w-full"
                            :data="$rates"
                            required
                        />
                        <x-input-error
                            class="mt-2"
                            :messages="$errors->get('rate_id')"
                        />
                    </div>

                    <div
                        class="flex items-center gap-4"
                    >
                        <x-primary-button>
                            {{ __('Сохранить') }}
                        </x-primary-button>

                        @if (session('status') === 'room-created')
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

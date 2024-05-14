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
                <form method="post" action="{{ route('rooms.update', $room->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div
                        class="py-4"
                    >
                        <x-image-preview
                            src="{{$room->image}}"
                        />
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
                            value="{{$room->name}}"
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
                            value="{{$room->capacity}}"
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
                            selected="{{$room->rate_id}}"
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

                        @if (session('status') === 'room-updated')
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

{{--                <div class="my-4 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">--}}
{{--                    <h1>{{ __('Дополнительные изображения:') }}</h1>--}}
{{--                </div>--}}
{{--                <x-images-preview--}}
{{--                    :images="$room->images"--}}
{{--                    route="rooms_images.delete"--}}
{{--                />--}}
{{--                <form--}}
{{--                    action="{{ route('rooms_images.store', $room->id) }}"--}}
{{--                    method="POST"--}}
{{--                    enctype="multipart/form-data"--}}
{{--                >--}}
{{--                    @csrf--}}
{{--                    <x-input-label--}}
{{--                        for="image"--}}
{{--                        :value="__('Добавить доп. изображение')"--}}
{{--                    />--}}
{{--                    <x-text-input--}}
{{--                        id="images"--}}
{{--                        name="images[]"--}}
{{--                        type="file"--}}
{{--                        accept="image/*"--}}
{{--                        class="use-ImagesPreview my-2 block w-full"--}}
{{--                        required--}}
{{--                        multiple--}}
{{--                    />--}}
{{--                    <x-primary-button>--}}
{{--                        {{ __('Добавить') }}--}}
{{--                    </x-primary-button>--}}

{{--                    @if (session('status') === 'room_image-created')--}}
{{--                        <p--}}
{{--                            x-data="{ show: true }"--}}
{{--                            x-show="show"--}}
{{--                            x-transition--}}
{{--                            x-init="setTimeout(() => show = false, 5000)"--}}
{{--                            class="text-sm text-gray-600 dark:text-gray-400"--}}
{{--                        >{{ __('Добавлено.') }}</p>--}}
{{--                    @endif--}}
{{--                </form>--}}
            </section>
        </div>
    </div>
</x-app-layout>

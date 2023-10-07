<x-app-layout>
    <x-slot
        name="header"
    >
        @include('products_types.partials.header')
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
                <form method="post" action="{{ route('products_types.update', $type->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    <div
                        class="py-4"
                    >
                        <x-image-preview
                            src="{{$type->image}}"
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
                            value="{{$type->name}}"
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
                        class="flex items-center gap-4"
                    >
                        <x-primary-button>
                            {{ __('Сохранить') }}
                        </x-primary-button>

                        @if (session('status') === 'products_type-updated')
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

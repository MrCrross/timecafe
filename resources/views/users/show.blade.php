<x-app-layout>
    <x-slot name="header">
        @include('users.partials.header')
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="max-w-lg flex flex-col justify-center items-center py-4 lg:max-w-none lg:p-6 bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg">
                <div class="flex flex-col justify-center items-start gap-2">
                    <x-item-p label="ФИО: " value="{{$user->fio}}"></x-item-p>
                    <x-item-p label="Логин: " value="{{$user->login}}"></x-item-p>
                    <x-item-p label="Почта: " value="{{$user->email}}"></x-item-p>
                    <x-item-p label="Статус: " value="{{$user->status_name}}"></x-item-p>
                    <x-item-p label="Добавлен: " value="{{\Illuminate\Support\Carbon::parse($user->created_at)->format('d.m.Y H:i:s')}}"></x-item-p>

                    <div class="flex flex-row w-full justify-center items-center gap-2">
                        <x-primary-a :href="route('users.edit', $user->id)">{{__('Редактировать')}}</x-primary-a>
                        <x-danger-button
                            type="submit"
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                        >
                            {{__('Удалить')}}
                        </x-danger-button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-modal name="confirm-user-deletion" focusable>
        <form method="post" action="{{ route('users.destroy', $user->id) }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Вы уверены, что хотите удалить пользователя "' . $user->fio . '" логин: ' . $user->login . ' ?') }}
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

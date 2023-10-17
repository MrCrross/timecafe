<x-app-layout>
    <x-slot
        name="header"
    >
        @include('users.partials.header')
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
                <x-user-param-card clone="1" :params="$params"></x-user-param-card>
                <form method="post" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('patch')

                    <div>
                        <x-input-label for="fio" :value="__('ФИО')" />
                        <x-text-input id="fio" name="fio" type="text" class="mt-1 block w-full" :value="old('fio', $user->fio)" required autofocus autocomplete="fio" />
                        <x-input-error class="mt-2" :messages="$errors->get('fio')" />
                    </div>

                    <div>
                        <x-input-label for="login" :value="__('Логин')" />
                        <x-text-input id="login" name="login" type="text" class="mt-1 block w-full" :value="old('login', $user->login)" required autocomplete="login" />
                        <x-input-error class="mt-2" :messages="$errors->get('login')" />
                    </div>

                    <div>
                        <x-input-label for="email" :value="__('Адрес электронной почты')" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="email" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>

                    <div>
                        <x-input-label for="password" :value="__('Новый пароль')" />
                        <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password_confirmation" :value="__('Подтвердите пароль')" />
                        <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full"/>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="py-4 flex flex-row gap-2 items-center justify-start">
                        <x-input-label
                            for="status"
                            :value="__('Активна')"
                        />
                        <x-text-input
                            id="status"
                            name="status"
                            type="checkbox"
                            class="block p-2 input_checkbox"
                            :checked="$user->status === 1"
                            :value="$user->status"
                            required
                        />
                    </div>

                    <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Права доступа</h1>
                    <div class="py-4 flex flex-col justify-items-stretch container-line-UserParam">
                        @if($user->userParams->isNotEmpty())
                            @foreach($user->userParams as $key => $param)
                                <x-user-param-card :type="$key" :paramID="$param->id" :params="$params"></x-user-param-card>
                            @endforeach
                        @else
                            <x-user-param-card :params="$params"></x-user-param-card>
                        @endif
                    </div>

                    <div
                        class="flex items-center gap-4"
                    >
                        <x-primary-button>
                            {{ __('Сохранить') }}
                        </x-primary-button>

                        @if (session('status') === 'user-updated')
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
<script src="{{asset('/js/UserForm.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        new UserForm();
    })
</script>

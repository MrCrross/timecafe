@props([
    'maxWidth' => 'xs',
    'welcome' => false,
])
@php
    $maxWidth = [
        'xs' => 'max-w-xs',
        'sm' => 'max-w-sm',
        'md' => 'max-w-md',
        'lg' => 'max-w-lg',
        'xl' => 'max-w-xl',
        '2xl' => 'max-w-2xl',
    ][$maxWidth];

    $bgColor = 'bg-white dark:bg-gray-800';
    $textColor = 'text-gray-800 dark:text-white';
@endphp
<div
    class="{{$maxWidth}} overflow-hidden mx-auto lg:mx-0 rounded-lg shadow-lg {{$bgColor}}"
>
    <div
        class="px-4 py-2"
    >
        <a href="{{route('users.show', $user->id)}}">
            <h1
                class="text-xl font-bold uppercase {{$textColor}}"
            >
                {{$user->fio}}
            </h1>
            <p
                class="mt-1 text-sm text-gray-600 dark:text-gray-400"
            >
                {{$user->login}}
            </p>
        </a>
    </div>

    <div
        class="flex flex-col items-start justify-between px-4 py-2 bg-gray-900"
    >
        <h1
            class="text-lg font-bold text-white"
        >
            {{$user->email}}
        </h1>
        <div class="flex flex-row justify-between items-center">
            @auth
                @if(Auth::user()->params()->has('users_edit'))
                    <a
                        class="px-2 py-1 text-xs font-semibold text-gray-900 uppercase transition-colors
                    duration-300 transform bg-white rounded hover:bg-gray-200 focus:bg-gray-400 focus:outline-none"
                        href="{{route('users.edit', $user->id)}}"
                    >
                        Редактировать
                    </a>
                    <form method="post"  action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('patch')
                        @php
                        $status = $user->status === 1 ? 0 : 1;
                        $statusName = $user->status === 1 ? 'Отключить' : 'Включить';
                        @endphp
                        @if($user->status === 1)
                        @endif
                        <x-primary-button class="mx-2" name="status" :value="$status" type="submit">{{$statusName}}</x-primary-button>
                    </form>
                @endif
            @endauth
        </div>
    </div>
</div>

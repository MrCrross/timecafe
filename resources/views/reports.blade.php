@php
    use Carbon\Carbon;
    $startDate = empty($_GET['start_date']) ? Carbon::now()->format('Y-m-01 00:00:00') : Carbon::parse($_GET['start_date'])->toDateTimeString();
    $endDate = empty($_GET['end_date']) ? Carbon::now()->format('Y-m-d 23:59:59') : Carbon::parse($_GET['end_date'])->toDateTimeString();
@endphp
<x-app-layout>
    <x-slot name="header">
        <ul class="flex flex-wrap text-sm font-medium text-center" id="tabs">
            <li class="me-2 border-b-2">
                <a class="tab inline-block p-4 rounded-t-lg dark:text-gray-100" @if(!isset($_GET['orders'])) id="default-tab" @endif href="#attendance">Посещаемости</a>
            </li>
            @auth
                <li class="me-2 border-b-2">
                    <a class="tab inline-block p-4 rounded-t-lg dark:text-gray-100" @if(isset($_GET['orders'])) id="default-tab" @endif href="#profits">Прибыли</a>
                </li>
            @endauth
        </ul>
    </x-slot>
    <div class="py-12">
        <div id="tab-contents">
            <div class="hidden max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6" id="attendance">
                <form action="{{route('reports.attendance')}}" method="GET" class="">
                    @csrf
                    <div class="flex flex-row items-end">
                        <div class="mx-2">
                            <x-input-label for="start_date" :value="__('от')" />
                            <x-text-input id="start_date" name="start_date" type="datetime-local" class="mt-1 block w-full" :value="$startDate" required/>
                            <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
                        </div>
                        <div class="mx-2">
                            <x-input-label for="end_date" :value="__('до')" />
                            <x-text-input id="end_date" name="end_date" type="datetime-local" class="mt-1 block w-full" :value="$endDate" required/>
                            <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
                        </div>
                        <div class="mx-2">
                            <x-primary-button>
                                {{ __('Создать') }}
                            </x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="hidden max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6" id="profits">
                <form action="{{route('reports.profits')}}" method="GET" class="">
                    @csrf
                    <div class="flex flex-row items-end">
                        <div class="mx-2">
                            <x-input-label for="start_date" :value="__('от')" />
                            <x-text-input id="start_date" name="start_date" type="datetime-local" class="mt-1 block w-full" :value="$startDate" required/>
                            <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
                        </div>
                        <div class="mx-2">
                            <x-input-label for="end_date" :value="__('до')" />
                            <x-text-input id="end_date" name="end_date" type="datetime-local" class="mt-1 block w-full" :value="$endDate" required/>
                            <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
                        </div>
                        <div class="mx-2">
                            <x-primary-button>
                                {{ __('Создать') }}
                            </x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        let tabsContainer = document.querySelector("#tabs");
        let tabTogglers = tabsContainer.querySelectorAll("a.tab");
        tabTogglers.forEach(function(toggler) {
            toggler.addEventListener("click", function(e) {
                e.preventDefault();

                let tabName = this.getAttribute("href");

                let tabContents = document.querySelector("#tab-contents");

                for (let i = 0; i < tabContents.children.length; i++) {

                    tabTogglers[i].parentElement.classList.remove("border-blue-400", "border-b", "opacity-100");  tabContents.children[i].classList.remove("hidden");
                    if ("#" + tabContents.children[i].id === tabName) {
                        continue;
                    }
                    tabContents.children[i].classList.add("hidden");

                }
                e.target.parentElement.classList.add("border-blue-400", "border-b-2", "opacity-100");
            });
        });
        document.getElementById("default-tab").click();
    })
</script>

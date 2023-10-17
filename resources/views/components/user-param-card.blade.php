<div
    @php if(!empty($clone)) { echo 'id="line-clone-UserParam"'; } @endphp
    class="flex flex-row justify-between items-end py-4 line-UserParam {{empty($clone) ? '' : 'hidden'}}"
>
    <div>
        <x-input-label
            for="param_id"
            :value="__('Право доступа')"
        />
        <x-select
            id="param_id"
            name="params[]"
            class="mt-1 block w-full"
            :data="$params"
            :selected="!empty($paramID) ? $paramID : 0"
            required
        />
    </div>

    <div class="flex flex-row justify-end items-end">
        <x-green-button
            type="button"
            class="add-line-UserParam {{empty($type) ? '' : 'hidden'}}"
        >
            {{ __('+') }}
        </x-green-button>
        <x-danger-button
            type="button"
            class="remove-line-UserParam {{!empty($type) ? '' : 'hidden'}}"
        >
            {{ __('-') }}
        </x-danger-button>
    </div>
</div>

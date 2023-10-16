<div
    class="drop-shadow-md max-h-60 grid gap-2 grid-cols-5 my-2"
>
    @if(isset($images))
        @foreach($images as $image)
            <form
                action="{{route($route, $image->id)}}"
                class="flex flex-col gap-2 justify-center items-center"
                method="POST"
            >
                @csrf
                @method('delete')
                <img
                    src="{{$image->image}}"
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'modal_ImagesPreview')"
                    class="max-h-48 canvas_ImagesPreview"
                    alt="{{$image->image}}"
                />
                <x-danger-button
                    type="submit"
                >
                    {{__('Удалить')}}
                </x-danger-button>
            </form>
        @endforeach
    @endif
</div>
<img
    id = "canvasClone_ImagesPreview"
    src=""
    x-data=""
    x-on:click.prevent="$dispatch('open-modal', 'modal_ImagesPreview')"
    class="max-h-48 canvas_ImagesPreview hidden"
    alt=""
/>
<div
    id="containerCanvas_ImagesPreview"
    class="drop-shadow-md max-h-48 grid gap-2 grid-cols-5 my-2"
>
</div>
<x-modal id="modal_ImagesPreview" name="modal_ImagesPreview" focusable>
    <div class="flex flex-row justify-center items-center m-4">
        <img
            src=""
            id="modalImage_ImagesPreview"
        >
    </div>
    <div class="m-6 flex justify-end">
        <x-secondary-button x-on:click="$dispatch('close')">
            {{ __('Отмена') }}
        </x-secondary-button>
    </div>
</x-modal>
<script src="{{asset('/js/ImagesPreview.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new ImagesPreview();
    })
</script>

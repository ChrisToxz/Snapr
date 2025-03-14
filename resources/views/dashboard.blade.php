<x-app-layout>
    @if ($images->count())
        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            @foreach ($images as $image)
                <x-image-card :image="$image" />
            @endforeach
        </div>
    @else
        <div class="flex h-screen w-full items-center justify-center text-xl italic">
            <div class="mt-[-33.33vh] text-center">
                No images found.
                <br />
                Upload your first one!
            </div>
        </div>
    @endif
</x-app-layout>

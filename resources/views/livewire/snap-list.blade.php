<div>
    @if ($snaps->count())
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($snaps as $snap)
                <x-snap-card :snap="$snap" />
            @endforeach
        </div>
        <div x-data="{ theEnd: false }" x-on:end-of-snaps.window="theEnd = true">
            <div x-show="!theEnd" x-intersect.full="$wire.loadMore()" class="flex justify-center p-4">
                <div wire:loading wire:target="loadMore">
                    <x-loading />
                </div>
            </div>

            <template x-if="theEnd">
                <p class="mt-4 text-center">No more snaps to load!</p>
            </template>
        </div>
    @else
        <div class="flex h-screen w-full items-center justify-center text-xl italic">
            <div class="mt-[-33.33vh] text-center">
                No snaps found.
                <br />
                Upload your first one!
            </div>
        </div>
    @endif
    <livewire:edit-snap-modal />
</div>

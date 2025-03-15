<div>
    @if ($snaps->count())
        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            @foreach ($snaps as $snap)
                <x-snap-card :snap="$snap" />
            @endforeach
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

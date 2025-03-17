<div>
    @if ($snaps->count())
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($snaps as $snap)
                <x-snap-card :snap="$snap" wire:key="{{ $snap->id }}" />
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
        <div class="relative w-full">
            <div class="absolute left-1/2 mt-[10vh] -translate-x-1/2 transform text-center text-xl italic">
                No snaps found.
                <br />
                Upload your first one!
            </div>
        </div>
    @endif
    <livewire:edit-snap-modal />

    <div
        x-data="{ showDeleteModal: false, snapIdent: null, snapTitle: '' }"
        x-on:confirm-delete.window="showDeleteModal = true; snapIdent = $event.detail.snapIdent; snapTitle = $event.detail.snapTitle"
        x-effect="
            if (showDeleteModal) {
                $refs.deleteModal.showModal()
            } else {
                $refs.deleteModal.close()
            }
        "
    >
        <dialog x-ref="deleteModal" class="modal">
            <div class="modal-box bg-base-200">
                <button class="btn btn-sm btn-circle btn-ghost absolute top-2 right-2" @click="showDeleteModal = false">
                    ✕
                </button>
                <h3 class="text-lg font-bold">
                    Are you sure you want to delete
                    <span x-text="snapTitle"></span>
                    ?
                </h3>
                <div class="modal-action">
                    <button class="btn btn-error" @click="$wire.delete(snapIdent); showDeleteModal = false">
                        Delete
                    </button>
                    <button class="btn" @click="showDeleteModal = false">Cancel</button>
                </div>
            </div>
        </dialog>
    </div>
</div>

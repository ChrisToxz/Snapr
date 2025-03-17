<div
    x-data="{ fileDropped: false, dragCounter: 0, files: null }"
    x-init="
        window.addEventListener('dragenter', (e) => {
            if (e.dataTransfer && e.dataTransfer.types.includes('Files')) {
                dragCounter++
                $wire.set('showModal', true)
                fileDropped = false
            }
        })

        window.addEventListener('dragleave', (e) => {
            if (e.dataTransfer && e.dataTransfer.types.includes('Files')) {
                dragCounter--
                if (dragCounter <= 0 && ! fileDropped) {
                    $wire.set('showModal', false)
                }
            }
        })

        window.addEventListener('drop', (e) => {
            // If the drop is happening on the file input area, let it handle it
            if (! e.target.closest('#FileUpload')) {
                e.preventDefault()
            }
            dragCounter = 0
            if (e.dataTransfer.files && e.dataTransfer.files.length > 0) {
                fileDropped = true
            } else {
                fileDropped = false
                $wire.set('showModal', false)
            }
        })

        window.addEventListener('dragover', (e) => e.preventDefault())
    "
>
    <x-modal wire:model="showModal" title="Upload Snap" box-class="bg-base-200 backdrop-blur" persistent>
        <div class="bg-base-100">
            <div id="FileUpload" class="bg-base-300 relative rounded-md">
                <input
                    x-ref="fileInput"
                    type="file"
                    class="absolute inset-0 z-50 m-0 h-full w-full p-0 opacity-0"
                    x-on:change="
                        files = $event.target.files
                        console.log($event.target.files)
                    "
                    :class="files ? 'pointer-events-none' : 'pointer-events-auto'"
                    wire:model="file"
                />
                <template x-if="files !== null">
                    <div class="flex flex-col space-y-1 px-5 py-5">
                        <div class="flex items-center justify-between">
                            <span class="font-medium text-gray-100" x-text="files[0].name"></span>
                            <button
                                type="button"
                                class="text-red-500"
                                @click="
                  files = null;
                  $refs.fileInput.value = '';
                  $wire.set('file', '');
                "
                            >
                                <x-icon name="o-trash" />
                            </button>
                        </div>
                    </div>
                </template>
                <template x-if="files === null">
                    <div class="flex flex-col items-center justify-center space-y-2 py-10">
                        <x-icon name="o-cloud-arrow-up" class="h-10" />
                        <p class="text-gray-100">Drag your image here or click in this area.</p>
                    </div>
                </template>
            </div>
        </div>
        <div class="flex flex-col items-center justify-center">
            @error("file")
                <span class="text-error mt-3">{{ $message }}</span>
            @enderror
        </div>

        <x-slot:actions>
            <x-button
                label="Cancel"
                class="btn btn-secondary"
                @click="$wire.set('showModal', false); files = null;
                  $refs.fileInput.value = '';"
            />
            <x-button label="Upload" class="btn btn-primary" wire:click="save" />
        </x-slot>
    </x-modal>
</div>

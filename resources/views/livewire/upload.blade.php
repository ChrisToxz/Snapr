<div
    x-data
    x-init="
        window.addEventListener('dragenter', () => {
            $wire.set('showModal', true)
        })
    "
>
    <x-modal wire:model="showModal" title="Upload Snap" box-class="bg-base-200 backdrop-blur">
        <div class="bg-base-100">
            <div x-data="{ files: null }" id="FileUpload" class="bg-base-300 relative rounded-md">
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
                {{-- TODO: Prevent to try to preview file if uploaded file is not validated --}}
                {{-- @if ($file) --}}
                {{-- <img src="{{ $file->temporaryUrl() }}" /> --}}
                {{-- @endif --}}

                <template x-if="files !== null">
                    <div class="flex flex-col space-y-1 px-5 py-5">
                        <div class="flex items-center justify-between">
                            <span class="font-medium text-gray-100" x-text="files[0].name"></span>
                            <button
                                type="button"
                                class="text-red-500"
                                @click="
                                    files = null;
                                    $refs.fileInput.value = ''
                                    $wire.set('file', '')
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
                        {{-- <x-button>Select file</x-button> --}}
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
                @click="
                $wire.set('showModal', false)"
            />
            <x-button label="Upload" class="btn btn-primary" wire:click="save" />
        </x-slot>
    </x-modal>
</div>

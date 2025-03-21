<div x-data="{ showModal: false }" class="card bg-base-200 rounded-xl shadow-xl">
    <div class="card-body">
        <img src="{{ asset("storage/snaps/" . $snap->path) }}" alt="" class="h-64 w-full object-cover" />
        <h2 class="card-title">{{ $snap->title }}</h2>
        <p>{{ $snap->description }}</p>
        <div class="mt-4 flex justify-end gap-2">
            <x-popover position="top">
                <x-slot:trigger>
                    <a href="{{ url(route("snap.show", $snap->ident)) }}" target="_blank">
                        <x-icon
                            name="o-eye"
                            class="cursor-pointer text-gray-500 transition-colors duration-300 hover:text-gray-700"
                        />
                    </a>
                </x-slot>
                <x-slot:content>View</x-slot>
            </x-popover>
            <x-popover position="top">
                <x-slot:trigger>
                    <x-icon
                        name="o-pencil"
                        class="cursor-pointer text-blue-500 transition-colors duration-300 hover:text-blue-700"
                        wire:click="edit('{{$snap->ident}}')"
                    />
                </x-slot>
                <x-slot:content>Edit</x-slot>
            </x-popover>
            <x-popover position="top">
                <x-slot:trigger>
                    <x-icon
                        name="o-trash"
                        class="cursor-pointer text-red-500 transition-colors duration-300 hover:text-red-700"
                        @click="showModal = true"
                        @click="$dispatch('confirm-delete', { snapIdent: '{{ $snap->ident }}', snapTitle: '{{ $snap->title }}' })"
                    />
                </x-slot>
                <x-slot:content>Delete</x-slot>
            </x-popover>
        </div>

        <dialog id="deleteDialog" class="modal">
            <div class="modal-box bg-base-200">
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute top-2 right-2">✕</button>
                </form>
                <h3 class="text-lg font-bold">Are you sure you want to delete?</h3>
                <p>{{ $snap->title }}</p>
                <div class="modal-action">
                    <form method="dialog">
                        <x-button
                            label="Delete"
                            class="btn btn-error"
                            wire:click="delete('{{ $snap->ident }}')"
                            spinner="delete"
                        />
                    </form>
                </div>
            </div>
        </dialog>
    </div>
</div>

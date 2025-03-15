<div class="card bg-base-200 shadow-xl">
    <div class="card-body">
        <img src="{{ asset("storage/snaps/" . $snap->path) }}" alt="" class="h-64 w-full object-cover" />
        <h2 class="card-title">{{ $snap->title }}</h2>
        <p>{{ $snap->description }}</p>
        <div class="mt-4 flex justify-end gap-2">
            <x-popover position="top">
                <x-slot:trigger>
                    <x-icon
                        name="o-eye"
                        class="cursor-pointer text-gray-500 transition-colors duration-300 hover:text-gray-700"
                    />
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
                        wire:click="confirmDelete('{{ $snap->ident }}')"
                    />
                </x-slot>
                <x-slot:content>Delete</x-slot>
            </x-popover>
        </div>
    </div>
</div>

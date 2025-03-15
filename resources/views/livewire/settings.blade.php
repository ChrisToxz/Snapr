<div>
    <x-drawer wire:model="showDrawer" class="w-11/12 lg:w-1/3" right>
        <x-slot:title>Snapr settings</x-slot>

        @foreach($settings as $settingsKey => $group)
            @foreach ($group as $key => $value)
                <div class="mb-4">
                    <label
                        class="block font-semibold capitalize"
                        for="{{ $settingsKey }}-{{ $key }}"
                    >
                        {{ str_replace('_', ' ', $key) }}
                    </label>

                    {{-- Check if boolean --}}
                    @if (is_bool($value))
                        <input
                            id="{{ $settingsKey }}-{{ $key }}"
                            type="checkbox"
                            wire:model="settings.{{ $settingsKey }}.{{ $key }}"
                            class="toggle"  {{-- DaisyUI toggle class, for example --}}
                        />
                        {{-- Check if this key should be a dropdown --}}
                    @elseif (in_array($key, ['some_dropdown_field', 'some_other_field']))
                        <select
                            id="{{ $settingsKey }}-{{ $key }}"
                            wire:model="settings.{{ $settingsKey }}.{{ $key }}"
                            class="select select-bordered w-full"
                        >
                            <option value="">Please choose</option>
                            <option value="option1">Option #1</option>
                            <option value="option2">Option #2</option>
                        </select>
                    @else
                        {{-- Fallback: normal text input --}}
                        <input
                            id="{{ $settingsKey }}-{{ $key }}"
                            type="text"
                            wire:model="settings.{{ $settingsKey }}.{{ $key }}"
                            class="input input-bordered w-full"
                        />
                    @endif
                </div>
            @endforeach
        @endforeach


        <x-input wire:model=""

        <x-slot:actions class="float-left">
            <x-button label="Close" @click="$wire.showDrawer = false" />
            <x-button label="Confirm" class="btn-primary" icon="o-check" wire:click="test()" />
        </x-slot>
    </x-drawer>
</div>

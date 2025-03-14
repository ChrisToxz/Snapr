<x-dynamic-component :component="auth()->check() ? 'app-layout' : 'guest-layout'">
    <div class="flex h-screen items-center justify-center">
        <div class="card bg-base-200 w-full rounded-xl shadow-xl">
            <figure class="my-10">
                <img src="{{ asset("storage/snaps/$snap->path") }}" alt="Shoes" />
            </figure>
            <div class="card-body">
                <h2 class="card-title">{{ $snap->name }}</h2>
                <p>Snap description</p>
            </div>
        </div>
    </div>
</x-dynamic-component>

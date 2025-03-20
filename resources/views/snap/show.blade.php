<x-dynamic-component :component="auth()->check() ? 'app-layout' : 'guest-layout'">
    <meta property="og:title" content="{{ $snap->name }}" />
    <meta property="og:description" content="A screenshot from CT" />
    <meta property="og:image" content="{{ asset("storage/snaps/$snap->path") }}" />
    <meta property="og:url" content="{{ asset("storage/snaps/$snap->path") }}" />
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

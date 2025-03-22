<x-dynamic-component :component="auth()->check() ? 'app-layout' : 'guest-layout'">
    {{-- <meta property="og:image" content="{{ asset("storage/snaps/$snap->path") }}" /> --}}
    {{-- <meta name="twitter:card" content="summary_large_image"> --}}

    <meta name="description" content="" />

{{--    <!-- Open Graph / Facebook -->--}}
{{--    <meta property="og:type" content="website" />--}}
{{--    <meta property="og:url" content="https://snapr.32bit.nl/yvA9feEP" />--}}
{{--    <meta property="og:title" content=" Snapr" />--}}
{{--    <meta property="og:description" content="" />--}}
{{--    <meta property="og:image" content="{{ asset("storage/snaps/$snap->path") }}" />--}}

{{--    <!-- Twitter -->--}}
{{--    <meta property="twitter:card" content="summary_large_image" />--}}
{{--    <meta property="twitter:url" content="https://snapr.32bit.nl/yvA9feEP" />--}}
{{--    <meta property="twitter:title" content=" Snapr" />--}}
{{--    <meta property="twitter:description" content="" />--}}
{{--    <meta property="twitter:image" content="{{ asset("storage/snaps/$snap->path") }}" />--}}

    <!-- Current meta image --><!-- Social -->
    <meta property="og:image" content="{{ asset("storage/snaps/$snap->path") }}"></meta>
    <meta property="twitter:image" content="{{ asset("storage/snaps/$snap->path") }}"></meta>
    <meta name="image" content="{{ asset("storage/snaps/$snap->path") }}"></meta>
    <meta name="twitter:card" content="summary_large_image"></meta>
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

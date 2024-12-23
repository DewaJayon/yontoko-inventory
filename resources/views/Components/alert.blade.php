@if (session()->has('success'))
    <div class="flash-data" data-swall="{{ session('success') }}"></div>
@endif

@if (session()->has('error'))
    <div class="flash-data" data-error="{{ session('error') }}"></div>
@endif

@if (session()->has('success'))
    <div class="flash-data" data-swall="{{ session('success') }}"></div>
@endif

<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                @if (isset($pagePreTitle))
                    <div class="page-pretitle">
                        {{ $pagePreTitle }}
                    </div>
                @endif
                <h2 class="page-title">
                    {{ $title }}
                </h2>
            </div>
            <!-- Page title actions -->

            <div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

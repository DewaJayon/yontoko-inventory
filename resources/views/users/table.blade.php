<table id="userTable" class="table card-table table-vcenter text-nowrap datatable">
    <thead>
        <tr>
            <th></th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                <td>{{ $user->name }}</td>
                <td>
                    <span class="flag flag-xs flag-country-us me-2"></span>
                    {{ $user->email }}
                </td>
                <td>
                    @if ($user->role == 'admin')
                        <span class="badge bg-success text-white">Admin</span>
                    @else
                        <span class="badge bg-warning text-white">Employee</span>
                    @endif
                </td>
                <td>
                    <div class="row g-2 align-items-center">
                        <div class="col-6 col-sm-4 col-md-2 col-xl-auto py-3">
                            <x-edit-button onclick="show({{ $user->id }})"></x-edit-button>
                        </div>
                        <div class="col-6 col-sm-4 col-md-2 col-xl-auto py-3">
                            <x-show-button onclick="show({{ $user->id }})"></x-show-button>
                        </div>
                        <div class="col-6 col-sm-4 col-md-2 col-xl-auto py-3">
                            <x-delete-button onclick="destroy({{ $user->id }})"></x-delete-button>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

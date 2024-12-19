    <div class="alert alert-danger d-none" id="errors"></div>

    <div class="row mb-3 align-items-end">
        <div class="col-auto">
            <div class="avatar avatar-upload rounded">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                </svg>
            </div>
        </div>
        <div class="col">
            <label class="form-label">Photo</label>
            <input type="file" class="form-control" id="photo">
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label required">Nama</label>
        <div>
            <input type="text" class="form-control" id="name" placeholder="Masukkan Nama">

        </div>
    </div>

    <div class="mb-3">
        <label class="form-label required">Email</label>
        <div>
            <input type="email" id="email" class="form-control" placeholder="Masukkan Email">
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label required">Password</label>
        <div class="input-group input-group-flat">
            <input type="password" id="password" class="form-control" placeholder="Masukkan password" autocomplete="off">
            <span class="input-group-text">
                <button class="btn btn-link link-secondary " onclick="showPassword()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                        <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
                    </svg>
                </button>
            </span>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Role</label>
        <div>
            <select class="form-select" id="role">
                <option hidden>Pilih Role</option>
                <option value="admin">Admin</option>
                <option value="employee">Employee</option>
            </select>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" onclick="store()">Simpan</button>
    </div>

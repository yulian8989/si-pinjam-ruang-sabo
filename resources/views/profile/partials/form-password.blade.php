<div class="col-md-5">
    <div class="card shadow-sm border-0">
        <div class="card-header fw-bold "> Ubah Kata Sandi</div>
        <form action="{{ route('profile.password') }}" method="POST">
            @csrf @method('PATCH')
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label small fw-bold">Kata Sandi Saat Ini</label>
                    <input type="password" name="current_password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Kata Sandi Baru</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Konfirmasi Sandi Baru</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
            </div>
            <div class="card-footer bg-white text-end">
                <button type="submit" class="btn btn-dark btn-sm">Perbarui Sandi</button>
            </div>
        </form>
    </div>
</div>
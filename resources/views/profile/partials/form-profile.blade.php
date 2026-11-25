<div class="col-md-7">
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header  fw-bold">Informasi Akun</div>
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf @method('PATCH')
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label small fw-bold">NIK (Nomor Induk Kependudukan)</label>
                    <input type="text" class="form-control bg-light" value="{{ $user->nik }}" readonly>
                    <small class="text-muted">NIK tidak dapat diubah secara mandiri.</small>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label small fw-bold">No. Telepon</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label small fw-bold">Instansi / Institution</label>
                        <input type="text" name="institution" class="form-control" value="{{ old('institution', $user->institution) }}" required>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white text-end">
                <button type="submit" class="btn btn-primary btn-sm px-4">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
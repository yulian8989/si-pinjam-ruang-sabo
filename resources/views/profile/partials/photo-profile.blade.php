<div class="card shadow-sm border-0 mb-4">
    <div class="card-header fw-bold text-center">Foto Profil</div>
    <div class="card-body text-center">
        @if(auth()->user()->avatar)
            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="rounded-circle img-thumbnail mb-3" style="width: 150px; height: 150px; object-fit: cover;">
        @else
            <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 shadow-sm" style="width: 150px; height: 150px; font-size: 64px;">
                {{ substr(auth()->user()->name, 0, 1) }}
            </div>
        @endif

        <form action="{{ route('profile.avatar') }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PATCH')
            <div class="mb-3">
                <input type="file" name="avatar" class="form-control form-control-sm @error('avatar') is-invalid @enderror">
                @error('avatar') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Unggah Foto Baru</button>
        </form>
    </div>
</div>
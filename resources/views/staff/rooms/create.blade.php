@extends('layouts.master')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Create Ruangan</h3>
            </div>
        </div>
    </div>
</div>
<div class="card card-outline card-primary shadow-sm">
    <form action="{{ route('staff.rooms.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h5><i class="icon fas fa-ban"></i> Terjadi Kesalahan!</h5>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
              
                            @if(str_contains($error, 'failed to upload'))
                                <li>Beberapa gambar gagal diunggah karena ukuran total terlalu besar.</li>
                            @else
                                <li>{{ $error }}</li>
                            @endif
                        @endforeach
                    </ul>
     
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Room Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" 
                               class="form-control @error('name') is-invalid @enderror" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label class="form-label fw-bold">Description & Location</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                                  rows="3" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold">People Capacity</label>
                        <input type="number" name="capacity" value="{{ old('capacity') }}" 
                               class="form-control @error('capacity') is-invalid @enderror" required>
                        @error('capacity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Room Facilities</label>
                        <table class="table table-bordered align-middle @error('facilities') is-invalid @enderror">
                            <thead class="table-light">
                                <tr>
                                    <th width="50" class="text-center">Select</th>
                                    <th>Facility Name</th>
                                    <th width="150">Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($facilities as $facility)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" name="facilities[]" value="{{ $facility->id }}" 
                                               class="form-check-input facility-checkbox"
                                               {{ is_array(old('facilities')) && in_array($facility->id, old('facilities')) ? 'checked' : '' }}>
                                    </td>
                                    <td>{{ $facility->name }}</td>
                                    <td>
                                        <input type="number" name="quantities[{{ $facility->id }}]" 
                                               value="{{ old('quantities.' . $facility->id, 1) }}"
                                               class="form-control form-control-sm qty-input" 
                                               min="1" 
                                               {{ is_array(old('facilities')) && in_array($facility->id, old('facilities')) ? '' : 'disabled' }}>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @error('facilities')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Room Images (Max 5)</label>
                
    
                <input type="file" name="images[]" id="image-input" 
                       class="form-control @if($errors->has('images') || $errors->has('images.*')) is-invalid @endif" 
                       multiple accept="image/*">
                       
                <small class="text-muted">Format: JPG, PNG, JPEG. Maks: 2MB per file.</small>
                
             
                @error('images')
                    <div class="invalid-feedback d-block">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            
    
                @if($errors->has('images.*'))
                    <div class="invalid-feedback d-block">
                        <strong>{{ $errors->first('images.*') }}</strong>
                    </div>
                @endif
            
                <div id="preview-wrapper" class="mt-3 d-flex gap-2 flex-wrap"></div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Room Status</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active') ? 'checked' : '' }} checked>
                    <label class="form-check-label" for="is_active">Set as Active</label>
                </div>
            </div>
        </div>
        <div class="card-body border-top">
            <button type="submit" class="btn btn-primary px-4">Save Room Data</button>
        </div>
    </form>
</div>


@push('js')
<script>

    document.getElementById('image-input').addEventListener('change', function(e) {
        const wrapper = document.getElementById('preview-wrapper');
        wrapper.innerHTML = '';
        const files = Array.from(e.target.files).slice(0, 5); 
        
        files.forEach(file => {
            const reader = new FileReader();
            reader.onload = function(event) {
                const img = document.createElement('img');
                img.src = event.target.result;
                img.className = 'img-thumbnail';
                img.style.width = '120px';
                img.style.height = '120px';
                img.style.objectFit = 'cover';
                wrapper.appendChild(img);
            }
            reader.readAsDataURL(file);
        });
    });


    document.querySelectorAll('.facility-checkbox').forEach(cb => {
        cb.addEventListener('change', function() {
            const row = this.closest('tr');
            const qtyInput = row.querySelector('.qty-input');
            qtyInput.disabled = !this.checked;
            if (!this.checked) qtyInput.value = 1;
        });
    });
</script>
@endpush
@endsection
@extends('layouts.master')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"><h3>Edit Room: {{ $room->name }}</h3></div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="card card-outline card-warning">
            <form action="{{ route('staff.rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Room Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $room->name) }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Description & Location</label>
                                <textarea name="description" class="form-control" rows="3" required>{{ old('description', $room->description) }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Capacity</label>
                                <input type="number" name="capacity" class="form-control" value="{{ old('capacity', $room->capacity) }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Room Facilities</label>
                                <table class="table table-bordered align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="50">Select</th>
                                            <th>Facility Name</th>
                                            <th width="150">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($facilities as $facility)
                                        @php
       
                                            $roomFacility = $room->facilities->firstWhere('id', $facility->id);
                                        @endphp
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox" name="facilities[]" value="{{ $facility->id }}" 
                                                    class="form-check-input facility-checkbox"
                                                    {{ $roomFacility ? 'checked' : '' }}>
                                            </td>
                                            <td>{{ $facility->name }}</td>
                                            <td>
                                                <input type="number" name="quantities[{{ $facility->id }}]" 
                                                    class="form-control form-control-sm qty-input" 
                                                    min="1" 
                                                    value="{{ $roomFacility ? $roomFacility->pivot->quantity : 1 }}" 
                                                    {{ $roomFacility ? '' : 'disabled' }}>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Current Room Images</label>
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            @if(!empty($room->images) && is_array($room->images))
                                @foreach($room->images as $image)
                                    <div class="position-relative shadow-sm border rounded p-1">
                                        <img src="{{ asset('storage/' . $image) }}" 
                                             class="img-thumbnail" 
                                             style="width: 150px; height: 110px; object-fit: cover;">
                                        <span class="badge bg-success position-absolute top-0 start-0 m-2">Tersimpan</span>
                                    </div>
                                @endforeach
                            @else
                                <div class="alert alert-light border w-100">
                                    <i class="bi bi-image text-muted me-2"></i>
                                    <span class="text-muted">Belum ada gambar yang diunggah untuk ruangan ini.</span>
                                </div>
                            @endif
                        </div>
                    
                        <label class="form-label fw-bold">Upload New Images (Max 5)</label>
                        <input type="file" name="images[]" id="image-input" class="form-control @error('images.*') is-invalid @enderror" multiple accept="image/*">
                        <small class="text-secondary">Pilih gambar baru jika ingin mengganti semua gambar lama (maksimal 5 file).</small>
                        
                        <div id="preview-wrapper" class="mt-3 d-flex flex-wrap gap-2"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Room Status</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" 
                                {{ old('is_active', $room->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Set as Active</label>
                        </div>
                    </div>

                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('staff.rooms.index') }}" class="btn btn-light">Cancel</a>
                    <button type="submit" class="btn btn-warning">Update Room Data</button>
                </div>
            </form>
        </div>
    </div>
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
                const div = document.createElement('div');
                div.className = 'position-relative';
                div.innerHTML = `
                    <img src="${event.target.result}" class="img-thumbnail" style="width: 120px; height: 120px; object-fit: cover;">
                    <span class="badge bg-primary position-absolute top-0 start-0 m-1">New</span>
                `;
                wrapper.appendChild(div);
            }
            reader.readAsDataURL(file);
        });
    });


    document.querySelectorAll('.facility-checkbox').forEach(cb => {
        cb.addEventListener('change', function() {
            const row = this.closest('tr');
            const qtyInput = row.querySelector('.qty-input');
            qtyInput.disabled = !this.checked;
        });
    });
</script>
@endpush
@endsection
@extends('layouts.master')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Edit Facility</h3>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-outline card-primary shadow-sm">
                    <form action="{{ route('staff.facilities.update', $facility->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">Facility Name</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $facility->name) }}" placeholder="e.g. Projector, Sound System" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="information" class="form-label fw-bold">Information</label>
                                <textarea name="information" id="information" class="form-control @error('information') is-invalid @enderror" rows="4" placeholder="Add specific details or specifications...">{{ old('information', $facility->information) }}</textarea>
                                @error('information')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer bg-white text-end">
                            <a href="{{ route('staff.facilities.index') }}" class="btn btn-light me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Facility</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
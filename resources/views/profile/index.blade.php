@extends('layouts.master')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <h3 class="fw-bold"><i class="bi bi-person-gear me-2"></i>Pengaturan Profil</h3>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row">

            @include('profile.partials.photo-profile')

            @include('profile.partials.form-profile')

            @include('profile.partials.form-password')
        </div>
    </div>
</div>
@endsection
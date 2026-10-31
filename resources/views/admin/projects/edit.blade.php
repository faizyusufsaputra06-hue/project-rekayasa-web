@extends('layouts.app')
@section('title', 'Edit Project')
@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-body">
        <h5>Edit Project</h5>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Judul Project</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $project->title) }}">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi Project</label>
                <textarea class="form-control" id="description" name="description">{{ old('description', $project->description) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="teknologi" class="form-label">Teknologi yang Digunakan</label>
                <input type="text" class="form-control" id="teknologi" name="teknologi" value="{{ old('teknologi', $project->teknologi) }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Status Project</label>
                <select name="status" class="form-select" required>
                    <option value="Aktif"
                        {{ old('status', $project->status) == 'Aktif' ? 'selected' : '' }}>
                        Aktif
                    </option>
                    <option value="Nonaktif"
                        {{ old('status', $project->status) == 'Nonaktif' ? 'selected' : '' }}>
                        Nonaktif
                    </option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Gambar Project</label>
                @if ($project->image)
                    <div class="mb-2">
                        <img src="{{ str_starts_with($project->image, 'projects/')
                            ? asset('storage/'.$project->image)
                            : asset('images/'.$project->image) }}
                            "style="width: 100px; height: 70px; object-fit: cover;"
                        alt="Gambar saat ini">
                    </div>
                @endif
                <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
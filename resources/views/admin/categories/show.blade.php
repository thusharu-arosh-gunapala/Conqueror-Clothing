@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2>{{ $category->name }}</h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label fw-bold">Category Name</label>
                <p>{{ $category->name }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Slug</label>
                <p><code>{{ $category->slug }}</code></p>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Description</label>
                <p>{{ $category->description ?? 'No description' }}</p>
            </div>

            @if($category->image)
                <div class="mb-3">
                    <label class="form-label fw-bold">Image</label>
                    <div>
                        <img src="{{ asset('storage/' . $category->image) }}" 
                             alt="{{ $category->name }}" 
                             style="max-width: 300px; max-height: 300px; border-radius: 4px; display: block;">
                    </div>
                </div>
            @endif

            <div class="mb-3">
                <label class="form-label fw-bold">Status</label>
                <p>
                    @if($category->status)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Inactive</span>
                    @endif
                </p>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Created At</label>
                <p>{{ $category->created_at->format('M d, Y H:i') }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Last Updated</label>
                <p>{{ $category->updated_at->format('M d, Y H:i') }}</p>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary">Edit Category</a>
                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection

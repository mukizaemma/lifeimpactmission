@extends('layouts.adminbase')

@section('title', 'Page Headers')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('admin.includes.sidenav')
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 py-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="h3 mb-0">Page Headers</h1>
                    </div>

                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <p class="text-muted mb-4">
                        Set one title, one subtitle, and a header image for each page.
                        Images must be <strong>300KB–700KB</strong> and are resized automatically before upload.
                    </p>

                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session()->get('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('updatePageHeaders') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @foreach ($headers as $header)
                            <div class="card mb-4 shadow-sm">
                                <div class="card-header bg-white">
                                    <strong>{{ $header->label }}</strong>
                                    <span class="text-muted small ms-2">({{ $header->page_key }})</span>
                                </div>
                                <div class="card-body">
                                    <div class="row g-4">
                                        <div class="col-lg-4">
                                            @if ($header->image)
                                                <img src="{{ $header->imageUrl() }}" alt="" class="img-fluid rounded border" style="max-height: 200px; width: 100%; object-fit: cover;">
                                            @else
                                                <div class="border rounded d-flex align-items-center justify-content-center text-muted" style="height: 160px; background: #f5f5f5;">
                                                    No image uploaded
                                                </div>
                                            @endif
                                            <div class="mt-3">
                                                <label class="form-label">Change header image</label>
                                                <input type="file" class="form-control" name="headers[{{ $header->id }}][image]" accept="image/*">
                                                <small class="text-muted">Recommended: wide landscape, 1920×1080 or larger</small>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="mb-3">
                                                <label class="form-label">Page title</label>
                                                <input type="text" class="form-control" name="headers[{{ $header->id }}][title]" value="{{ old('headers.'.$header->id.'.title', $header->title) }}" required>
                                            </div>
                                            <div class="mb-0">
                                                <label class="form-label">Caption / subtitle</label>
                                                <textarea class="form-control" name="headers[{{ $header->id }}][subtitle]" rows="3" placeholder="Short line shown below the title on the hero">{{ old('headers.'.$header->id.'.subtitle', $header->subtitle) }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Save All Page Headers
                        </button>
                    </form>
                </div>
            </main>
            @include('admin.includes.footer')
        </div>
    </div>
@endsection

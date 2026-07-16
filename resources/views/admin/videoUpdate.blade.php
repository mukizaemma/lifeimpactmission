<div class="ilm-admin-page">
<main>
            <div class="container-fluid px-4">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{ route('videosAdmin') }}" wire:navigate>Videos</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>

                @if (session()->has('error'))
                    <div class="alert alert-danger">{{ session()->get('error') }}</div>
                @endif

                <div class="card mb-4">
                    <div class="card-header">Edit Video</div>
                    <div class="card-body">
                        <form action="{{ route('updateVideo', $data->id) }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-8">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control" value="{{ old('title', $data->title) }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="Active" @selected(old('status', $data->status) === 'Active')>Active</option>
                                        <option value="Inactive" @selected(old('status', $data->status) === 'Inactive')>Inactive</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">YouTube URL</label>
                                    <input type="url" name="video_url" class="form-control" value="{{ old('video_url', $data->video_url) }}" required>
                                    <div class="form-text">Paste a YouTube link only — videos are not uploaded to the website.</div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Caption</label>
                                    <textarea name="caption" class="form-control" rows="3">{{ old('caption', $data->caption) }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Program (optional)</label>
                                    <select name="program_id" class="form-control">
                                        <option value="">— None —</option>
                                        @foreach($programs as $program)
                                            <option value="{{ $program->id }}" @selected(old('program_id', $data->program_id) == $program->id)>
                                                {{ $program->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">YouTube preview</label>
                                    <div>
                                        <img src="{{ $data->thumbnailUrl() }}" alt="{{ $data->title }}" width="160">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Update Video</button>
                                    <a href="{{ route('videosAdmin') }}" class="btn btn-secondary" wire:navigate>Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
</div>

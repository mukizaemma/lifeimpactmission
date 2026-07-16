<div class="ilm-admin-page">
<main>
            <div class="container-fluid px-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <a href="{{ route('mothersAdmin') }}" class="btn btn-primary" wire:navigate>Back</a>
                    </div>
                    <div class="card-body">
                        @if (session()->has('error'))
                            <div class="alert alert-danger">{{ session()->get('error') }}</div>
                        @endif

                        <form action="{{ route('updateMother', $data->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Current Photo</label>
                                    <div>
                                        <img src="{{ $data->imageUrl() }}" alt="{{ $data->names }}" width="140">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label">Change Photo</label>
                                    <input type="file" name="image" class="form-control" accept="image/*">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Mother's Name</label>
                                    <input type="text" name="names" class="form-control" value="{{ $data->names }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Title / Role</label>
                                    <input type="text" name="title" class="form-control" value="{{ $data->title }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Location</label>
                                    <input type="text" name="location" class="form-control" value="{{ $data->location }}" placeholder="e.g. Rutsiro, Rwanda">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Program</label>
                                    <input type="text" name="program" class="form-control" value="{{ $data->program }}" placeholder="e.g. Tailoring Skills">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Short Description</label>
                                    <textarea name="description" class="form-control" rows="3">{{ $data->description }}</textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Full Story</label>
                                    <textarea name="story" class="form-control" rows="8">{{ $data->story }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Video URL (YouTube)</label>
                                    <input type="url" name="video_url" class="form-control" value="{{ $data->video_url }}" placeholder="https://youtube.com/watch?v=...">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Featured Quote</label>
                                    <input type="text" name="quote" class="form-control" value="{{ $data->quote }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="Active" @selected($data->status === 'Active')>Active</option>
                                        <option value="Inactive" @selected($data->status === 'Inactive')>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary text-black">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
</div>

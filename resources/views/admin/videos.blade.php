<div class="ilm-admin-page">
<main>
            <div class="container-fluid px-4">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Videos Gallery</li>
                </ol>

                @if (session()->has('success'))
                    <div class="alert alert-success">{{ session()->get('success') }}</div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger">{{ session()->get('error') }}</div>
                @endif

                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Videos</span>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                            <i class="fa fa-plus"></i> Add Video
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Thumbnail</th>
                                    <th>Title</th>
                                    <th>Program</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $rs)
                                    <tr>
                                        <td>
                                            <img src="{{ $rs->thumbnailUrl() }}" alt="{{ $rs->title }}" width="120">
                                        </td>
                                        <td>{{ $rs->title }}</td>
                                        <td>{{ $rs->program->title ?? '—' }}</td>
                                        <td>{{ $rs->status }}</td>
                                        <td>
                                            <a href="{{ route('editVideo', $rs->id) }}" class="btn btn-primary btn-sm text-black" wire:navigate>Edit</a>
                                            <a href="{{ route('destroyVideo', $rs->id) }}" class="btn btn-danger btn-sm text-black"
                                               onclick="return confirm('Delete this video?')">Delete</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No videos added yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal fade" id="myModal">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add Video</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('saveVideo') }}" method="POST">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-8">
                                            <label class="form-label">Title</label>
                                            <input type="text" name="title" class="form-control" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Status</label>
                                            <select name="status" class="form-control">
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">YouTube URL</label>
                                            <input type="url" name="video_url" class="form-control" placeholder="https://www.youtube.com/watch?v=..." required>
                                            <div class="form-text">Paste a YouTube link only — videos are not uploaded to the website.</div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Caption</label>
                                            <textarea name="caption" class="form-control" rows="3"></textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Program (optional)</label>
                                            <select name="program_id" class="form-control">
                                                <option value="">— None —</option>
                                                @foreach($programs as $program)
                                                    <option value="{{ $program->id }}">{{ $program->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">Save Video</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
</div>

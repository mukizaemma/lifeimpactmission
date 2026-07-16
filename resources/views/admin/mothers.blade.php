<div class="ilm-admin-page">
<main>
            <div class="container-fluid px-4">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Mothers</li>
                </ol>

                @if (session()->has('success'))
                    <div class="alert alert-success">{{ session()->get('success') }}</div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger">{{ session()->get('error') }}</div>
                @endif
                @if (session()->has('warning'))
                    <div class="alert alert-warning">{{ session()->get('warning') }}</div>
                @endif

                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Young Mothers Profiles</span>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                            <i class="fa fa-plus"></i> Add Mother
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Short Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $rs)
                                    <tr>
                                        <td>
                                            <img src="{{ $rs->imageUrl() }}" alt="{{ $rs->names }}" width="90">
                                        </td>
                                        <td>{{ $rs->names }}</td>
                                        <td>{{ Str::limit(strip_tags($rs->description), 90) }}</td>
                                        <td>{{ $rs->status }}</td>
                                        <td>
                                            <a href="{{ route('editMother', $rs->id) }}" class="btn btn-primary btn-sm text-black" wire:navigate>Edit</a>
                                            <a href="{{ route('destroyMother', $rs->id) }}" class="btn btn-danger btn-sm text-black"
                                               onclick="return confirm('Delete this mother profile?')">Delete</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No mothers added yet.</td>
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
                                <h4 class="modal-title">Add Mother Profile</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('saveMother') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Mother's Name</label>
                                            <input type="text" name="names" class="form-control" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Title / Role (optional)</label>
                                            <input type="text" name="title" class="form-control" placeholder="e.g. Tailoring graduate">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Location</label>
                                            <input type="text" name="location" class="form-control" placeholder="e.g. Rutsiro, Rwanda">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Program</label>
                                            <input type="text" name="program" class="form-control" placeholder="e.g. Tailoring Skills">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Short Description</label>
                                            <textarea name="description" class="form-control" rows="3" placeholder="Shown on cards and profile summary"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Full Story</label>
                                            <textarea name="story" class="form-control" rows="6" placeholder="Shown in Her Story section"></textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Video URL (YouTube)</label>
                                            <input type="url" name="video_url" class="form-control" placeholder="https://youtube.com/watch?v=...">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Featured Quote</label>
                                            <input type="text" name="quote" class="form-control" placeholder="I found strength and purpose through this program.">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Photo</label>
                                            <input type="file" name="image" class="form-control" accept="image/*" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Status</label>
                                            <select name="status" class="form-control">
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary text-black">Save Mother</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
</div>

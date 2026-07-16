<div class="ilm-admin-page">
<main>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="btn btn-primary">Our Background</h2>
                                    @if(session()->has('success'))
                                        <div class="alert alert-success mt-2">{{ session()->get('success') }}</div>
                                    @endif
                                    @if(session()->has('error'))
                                        <div class="alert alert-danger mt-2">{{ session()->get('error') }}</div>
                                    @endif
                                    @if($errors->any())
                                        <div class="alert alert-danger mt-2">
                                            <ul class="mb-0">
                                                @foreach($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <form class="form" action="{{ route('saveBackg', $data->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="description">About Us Details</label>
                                                        <textarea id="description" rows="10" class="form-control" name="description">{{ old('description', $data->description) }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="donations">About Donations at Impact Life Mission</label>
                                                        <textarea id="donations" rows="10" class="form-control" name="donations">{{ old('donations', $data->donations) }}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr class="my-4">
                                            <h5 class="mb-3">Homepage images</h5>
                                            <p class="text-muted small mb-4">Each homepage band has its own image so they do not share the same photo.</p>

                                            <div class="row mt-3">
                                                <div class="col-lg-6 col-sm-12">
                                                    <label>About section image (homepage)</label><br>
                                                    @if(!empty($data->image))
                                                        <img src="{{ function_exists('ilm_image_url') ? ilm_image_url('images', $data->image) : asset('storage/images/' . ltrim($data->image, '/')) }}" width="150" alt="About cover">
                                                    @else
                                                        <p class="text-muted mb-0">No image uploaded yet.</p>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 col-sm-12">
                                                    <label for="image">Change about section image</label>
                                                    <div class="ilm-upload-field">
                                                        <input type="file" id="image" name="image" accept="image/*">
                                                    </div>
                                                    <small class="text-muted">Used in the About / Vision block near the top of the homepage.</small>
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-lg-6 col-sm-12">
                                                    <label>Agriculture band image (homepage)</label><br>
                                                    @if(!empty($data->image3))
                                                        <img src="{{ function_exists('ilm_image_url') ? ilm_image_url('images', $data->image3) : asset('storage/images/' . ltrim($data->image3, '/')) }}" width="150" alt="Agriculture band">
                                                    @else
                                                        <p class="text-muted mb-0">No image uploaded yet.</p>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 col-sm-12">
                                                    <label for="image3">Change agriculture band image</label>
                                                    <div class="ilm-upload-field">
                                                        <input type="file" id="image3" name="image3" accept="image/*">
                                                    </div>
                                                    <small class="text-muted">Fallback photo if no YouTube URL is set below.</small>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-12">
                                                    <label for="agriculture_video_url">Agriculture band YouTube video (landscape)</label>
                                                    <input
                                                        type="url"
                                                        id="agriculture_video_url"
                                                        name="agriculture_video_url"
                                                        class="form-control"
                                                        value="{{ old('agriculture_video_url', $data->agriculture_video_url) }}"
                                                        placeholder="https://www.youtube.com/watch?v=…"
                                                    >
                                                    <small class="text-muted">Paste a YouTube link. It fills the right-hand box on the homepage agriculture section.</small>
                                                    @error('agriculture_video_url')
                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-lg-6 col-sm-12">
                                                    <label>Donate CTA band image (homepage)</label><br>
                                                    @if(!empty($data->image1))
                                                        <img src="{{ function_exists('ilm_image_url') ? ilm_image_url('images', $data->image1) : asset('storage/images/' . ltrim($data->image1, '/')) }}" width="150" alt="Donate CTA background">
                                                    @else
                                                        <p class="text-muted mb-0">No image uploaded yet.</p>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 col-sm-12">
                                                    <label for="image1">Change donate CTA band image</label>
                                                    <div class="ilm-upload-field">
                                                        <input type="file" id="image1" name="image1" accept="image/*">
                                                    </div>
                                                    <small class="text-muted">Full-width band with “When a young heart kneels…” / Donate Now.</small>
                                                </div>
                                            </div>

                                            <hr class="my-4">
                                            <h5 class="mb-3">Site-wide page headers</h5>

                                            <div class="row mt-3">
                                                <div class="col-lg-6 col-sm-12">
                                                    <label>Default page header image</label><br>
                                                    @if(!empty($data->image2))
                                                        <img src="{{ function_exists('ilm_image_url') ? ilm_image_url('images', $data->image2) : asset('storage/images/' . ltrim($data->image2, '/')) }}" width="150" alt="Default page header">
                                                    @else
                                                        <p class="text-muted mb-0">No default image yet. Pages without their own header will use a theme fallback.</p>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 col-sm-12">
                                                    <label for="image2">Change default page header image</label>
                                                    <div class="ilm-upload-field">
                                                        <input type="file" id="image2" name="image2" accept="image/*">
                                                    </div>
                                                    <small class="text-muted">Used on inner pages that do not have their own image in Page Headers.</small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-actions mt-5">
                                            <button type="submit" class="btn btn-primary text-black">
                                                <i class="fa fa-save"></i> Save Changes
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
</div>

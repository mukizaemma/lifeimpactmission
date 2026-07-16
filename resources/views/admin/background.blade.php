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

                                            <div class="row mt-3">
                                                <div class="col-lg-6 col-sm-12">
                                                    <label>About cover image</label><br>
                                                    @if(!empty($data->image))
                                                        <img src="{{ ilm_image_url('images', $data->image) }}" width="150" alt="About cover">
                                                    @else
                                                        <p class="text-muted mb-0">No image uploaded yet.</p>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 col-sm-12">
                                                    <label for="image">Change the about image</label>
                                                    <div class="ilm-upload-field">
                                                        <input type="file" id="image" name="image" accept="image/*">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-lg-6 col-sm-12">
                                                    <label>Home / CTA background image</label><br>
                                                    @if(!empty($data->image1))
                                                        <img src="{{ ilm_image_url('images', $data->image1) }}" width="150" alt="CTA background">
                                                    @else
                                                        <p class="text-muted mb-0">No image uploaded yet.</p>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 col-sm-12">
                                                    <label for="image1">Change the home background image</label>
                                                    <div class="ilm-upload-field">
                                                        <input type="file" id="image1" name="image1" accept="image/*">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-lg-6 col-sm-12">
                                                    <label>Pages header image</label><br>
                                                    @if(!empty($data->image2))
                                                        <img src="{{ ilm_image_url('images', $data->image2) }}" width="150" alt="Page header">
                                                    @else
                                                        <p class="text-muted mb-0">No image uploaded yet.</p>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 col-sm-12">
                                                    <label for="image2">Change the pages header image</label>
                                                    <div class="ilm-upload-field">
                                                        <input type="file" id="image2" name="image2" accept="image/*">
                                                    </div>
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

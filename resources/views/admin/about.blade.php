<div class="ilm-admin-page">
<main>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="btn btn-primary">About us</h2>
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
                                    <form class="form" action="{{ route('saveAbout', $data->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-lg-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="mission">Mission</label>
                                                        <textarea id="mission" rows="5" class="form-control" name="mission">{{ old('mission', $data->mission) }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="vision">Vision</label>
                                                        <textarea id="vision" rows="5" class="form-control" name="vision">{{ old('vision', $data->vision) }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="values">Our Core Values</label>
                                                        <textarea id="values" rows="5" class="form-control" name="values">{{ old('values', $data->values) }}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-lg-6 col-sm-12">
                                                    <label>Background image below programs</label><br>
                                                    @if(!empty($ctaImage))
                                                        <img src="{{ ilm_image_url('images', $ctaImage) }}" alt="CTA background" width="150">
                                                    @else
                                                        <p class="text-muted mb-0">No image uploaded yet.</p>
                                                    @endif
                                                </div>

                                                <div class="col-lg-6 col-sm-12">
                                                    <label for="backImage">Change background image below programs</label>
                                                    <div class="ilm-upload-field">
                                                        <input type="file" id="backImage" name="backImage" accept="image/*">
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

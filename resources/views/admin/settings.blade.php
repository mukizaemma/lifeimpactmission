@extends('layouts.adminbase')

@section('title', 'Settings')

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
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h2 class="btn btn-primary">Setting</h2>
                                        @if (session()->has('success'))
                                            <div class="arlert alert-success">
                                                <button class="close" type="button" data-dismiss="alert">X</button>
                                                {{ session()->get('success') }}
                                            </div>
                                        @endif
                                    </div>
                                    <!-- ./card-header -->
                                    <div class="card-body">
                                        <form class="form" action="{{ route('saveSetting', $data->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-lg-4 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Company Name</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $data->company }}" name="company">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="projectinput4">Address</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $data->address }}" name="address">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="projectinput4">Email</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $data->email }}" name="email">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Phone</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $data->phone }}" name="phone">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Phone2</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $data->phone1 }}" name="phone1">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Phone3</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $data->phone2 }}" name="phone2">
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row mt-5">
                                                    <div class="col-12">
                                                        <h5 class="mb-3">Social Media Links</h5>
                                                        <p class="text-muted small">Only platforms with a URL will appear on the website.</p>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-12">
                                                        <div class="form-group">
                                                            <label>Facebook URL</label>
                                                            <input type="url" class="form-control" value="{{ $data->facebook }}" name="facebook" placeholder="https://facebook.com/...">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-12">
                                                        <div class="form-group">
                                                            <label>Instagram Profile URL</label>
                                                            <input type="url" class="form-control" value="{{ $data->instagram }}" name="instagram" placeholder="https://instagram.com/...">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-12">
                                                        <div class="form-group">
                                                            <label>LinkedIn URL</label>
                                                            <input type="url" class="form-control" value="{{ $data->linkedin ?? '' }}" name="linkedin" placeholder="https://linkedin.com/...">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-12">
                                                        <div class="form-group">
                                                            <label>TikTok URL</label>
                                                            <input type="url" class="form-control" value="{{ $data->tiktok ?? '' }}" name="tiktok" placeholder="https://tiktok.com/@...">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-12">
                                                        <div class="form-group">
                                                            <label>YouTube URL</label>
                                                            <input type="url" class="form-control" value="{{ $data->youtube }}" name="youtube" placeholder="https://youtube.com/...">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-12">
                                                        <div class="form-group">
                                                            <label>Linktree URL</label>
                                                            <input type="url" class="form-control" value="{{ $data->linktree ?? '' }}" name="linktree" placeholder="https://linktr.ee/...">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="instagram_post_url">Latest Instagram Post or Reel URL <small class="text-muted">(homepage Events &amp; Highlights)</small></label>
                                                            <input type="url" class="form-control" id="instagram_post_url"
                                                                value="{{ $data->instagram_post_url ?? '' }}" name="instagram_post_url"
                                                                placeholder="https://www.instagram.com/p/... or https://www.instagram.com/reel/...">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-lg-6 col-sm-12">
                                                        <label>Company Logo </label><br>
                                                        <label id="projectinput7" class="file center-block">
                                                            <img src="{{ asset('storage/images/' . ltrim($data->logo ?? '', '/')) }}"
                                                                alt="Company logo" width="150">
                                                        </label>
                                                    </div>

                                                    <div class="col-lg-6 col-sm-12">
                                                        <label>Change the Company Logo </label>
                                                        <label id="projectinput7" class="file center-block">
                                                            <input type="file" id="image" name="logo" data-ilm-allow-small="1">
                                                            <span class="file-custom"></span>
                                                        </label>
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
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    </main>
    @include('admin.includes.footer')
    </div>
    </div>

@section('scripts')

    <script src="{{ asset('assets') }}/js/summernote.js"></script>

@endsection

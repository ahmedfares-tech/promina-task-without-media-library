<nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="container text-center">
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav  mt-2 mt-lg-0 w-100">
                <li class="nav-item me-auto">
                    <a class="nav-link active" href="#" aria-current="page">Home <span
                            class="visually-hidden">(current)</span></a>
                </li>
                <li class="nav-item ms-auto me-auto">
                    <div class="row">
                        <div class="col">

                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#newAlbum">
                                + New Album
                            </button>
                        </div>
                        <div class="col">

                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#uploadImage">
                                + New Image
                            </button>
                        </div>

                    </div>


                </li>
                <li class="nav-item dropdown ms-auto">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Ahmed Fares</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                    </div>
                </li>
            </ul>

        </div>
    </div>
</nav>

{{--  {{DD($data)}}  --}}
<div class="modal fade text-center" id="newAlbum" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">New Album</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('newAlbum', $data->slug) }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Album Name</label>
                        <input type="text" class="form-control" name="name" id="name"
                            aria-describedby="helpId" placeholder="album name">
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>

@isset($data->slug)
    <div class="modal fade text-center" id="uploadImage" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">New Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('uploadImage', $data->slug) }}" enctype="multipart/form-data" method="post"
                        id="dropzone" class="dropzone">
                        @csrf
                        <div class="dz-preview dz-file-preview">
                            <div class="dz-details">
                                <div class="dz-filename"><span data-dz-name></span></div>
                                <div class="dz-size" data-dz-size></div>
                                <img data-dz-thumbnail />
                            </div>
                            <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                            <div class="dz-success-mark"><span>✔</span></div>
                            <div class="dz-error-mark"><span>✘</span></div>
                            <div class="dz-error-message"><span data-dz-errormessage></span></div>
                        </div>
                        {{--  <button type="submit" class="btn btn-primary">Create</button>  --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endisset



@section('scripts')
@endsection

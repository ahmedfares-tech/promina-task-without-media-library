@foreach ($data->childrenAlbums as $folder)
    <div class="col-lg-2 col-md-6 col-sm-6 align-self-stretch d-flex">
        <div class="card">
            <div class="card-body " onclick="goToAlbum('{{ $folder->slug }}')">
                <img class="card-img-top img-thumbnail " style="width:100%" src="{{ asset('images/folder.png') }}"
                    alt="Title">
                <h6 class="card-title ">{{ $folder->name }}</h6>
                <h6 class="card-text ">Total Items: {{ $folder->dataCount > 0 ? $folder->dataCount : 'Empty' }}</h6>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#editAlbum{{ $folder->id }}">
                    Edit
                </button>
                @if ($folder->dataCount > 0)
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#deleteAlbum{{ $folder->id }}">
                        Delete
                    </button>
                @else
                    <form action="{{ route('deleteAlbum', $folder->slug) }}" method="post">
                        @csrf
                        <input type="hidden" name="deleteOption" value="3">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
    <div class="modal fade text-center" id="editAlbum{{ $folder->id }}" tabindex="-1" data-bs-backdrop="static"
        data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Edit Album</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('editAlbum', $folder->slug) }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Album Name</label>

                            <input type="text" class="form-control" name="name" id="name"
                                aria-describedby="helpId" placeholder="album name" value="{{ $folder->name }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-center" id="deleteAlbum{{ $folder->id }}" tabindex="-1" data-bs-backdrop="static"
        data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Delete Album</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('deleteAlbum', $folder->slug) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">

                                <label class="btn active">
                                    <input type="radio" class="me-2" name="deleteOption" id="deleteOption"
                                        value="1" autocomplete="off" checked> Delete All folders and pictures in
                                    folder
                                </label>
                            </div>
                            <div class="col-12">

                                <label class="btn active">
                                    <input type="radio" class="me-2" name="deleteOption" id="deleteOption"
                                        value="2" autocomplete="off"> Move All Folders and pictures to this
                                    folder
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

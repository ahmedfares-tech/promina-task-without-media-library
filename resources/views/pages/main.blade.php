@extends('layouts.app')
@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>{{ $errors->first() }}</strong>
        </div>

        <script>
            var alertList = document.querySelectorAll('.alert');
            alertList.forEach(function(alert) {
                new bootstrap.Alert(alert)
            })
        </script>
    @endif
    @isset($data->parentAlbum)
        <div class="row">
            <div class="col">
                <button type="button" class="btn btn-primary" onclick="goToAlbum('{{ $data->parentAlbum->slug }}')">
                    <- Back</button>
            </div>
        </div>
    @endisset
    <div class="row text-center">
        @if (isset($data->childrenAlbums))
            @if (count($data->childrenAlbums) > 0)
                @include('pages.albums.albumCard', $data)
            @endif
        @endif
        @if (isset($data->pictures))
            @if (count($data->pictures) > 0)
                @include('pages.pictures.pictureCard', $data)
            @endif
        @endif
    </div>
@endsection
@section('scripts')
    <script>
        function goToAlbum(folder) {
            window.location.replace(`/album/${folder}`)
        }
    </script>
@endsection

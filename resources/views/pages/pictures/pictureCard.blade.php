@foreach ($data->pictures as $pictures)
    <div class="col-lg-2 col-md-6 col-sm-6 align-self-stretch d-flex">
        <div class="card">
            <img class="card-img-top img-thumbnail " style="width:100%"
                src="{{ env('ASSET_URL') . '/' . $pictures->picture }}" alt="Title">
            <div class="card-body">
                <h6 class="card-text ">{{ $pictures->name }}</h6>

            </div>
            <div class="card-footer">
                <form action="{{ route('deleteImage', $pictures->id) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endforeach

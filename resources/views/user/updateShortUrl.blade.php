@extends('layouts.app')
@vite('resources/js/user/createShortUrl.js')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Short Url') }}</div>

                <div class="card-body">
                    <form method="post" action="{{ route('shortUrl.update', $shortUrl->id) }}">
                        @csrf
                        @method("patch")
                        <div class="mb-3">
                          <label for="title" class="form-label">title</label>
                          <input type="text" class="form-control" id="title" name="title" value="{{ $shortUrl->title }}">
                        </div>
                        <div class="mb-3">
                          <label for="destinationUrl" class="form-lbel">Destination</label>
                          <input type="text" class="form-control" id="destinationUrl" name="destinationUrl" value="{{ $shortUrl->destination_url }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="urlKey" class="form-label">Custom back-half</label>
                            <input type="text" class="form-control" id="urlKey" name="urlKey" value="{{ $shortUrl->url_key }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ url('/') }}" class="btn btn-secondary">Cancel</a>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

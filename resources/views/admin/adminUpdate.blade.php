@extends('layouts.app')
@vite('resources/js/user/createShortUrl.js')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Short Url') }}</div>

                <div class="card-body">
                    <form method="post" action="{{ route('admin.shortUrl.update', $shortUrl->id) }}">
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
                        <div class="mb-3">
                            <label for="userId" class="form-lbel">user_id</label>
                            <input type="text" class="form-control" id="userId" value="{{ $shortUrl->user?$shortUrl->user->id:null }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="userName" class="form-lbel">user_name</label>
                            <input type="text" class="form-control" id="userName" value="{{ $shortUrl->user?$shortUrl->user->name:null }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="createdAt" class="form-lbel">created_at</label>
                            <input type="text" class="form-control" id="createdAt" value="{{ $shortUrl->created_at }}" disabled>
                        </div><div class="mb-3">
                            <label for="updatedAt" class="form-lbel">updated_at</label>
                            <input type="text" class="form-control" id="updatedAt" value="{{ $shortUrl->updated_at }}" disabled>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ url('admin/home') }}" class="btn btn-secondary">Cancel</a>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

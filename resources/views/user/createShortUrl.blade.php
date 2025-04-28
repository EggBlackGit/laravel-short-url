@extends('layouts.app')
@vite('resources/js/user/createShortUrl.js')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Short Url') }}</div>

                <div class="card-body">
                    <form class="needs-validation" method="post" action="{{ route('shortUrl.create') }}" novalidate>
                        @csrf
                        <div class="mb-3">
                          <label for="validationCustom01" class="form-label">title <span style="color: red">*</span></label>
                          <input type="text" class="form-control" id="validationCustom01" name="title" required>
                          <div class="invalid-feedback">
                            Please enter title.
                          </div>
                        </div>
                        <div class="mb-3">
                          <label for="validationCustom02" class="form-lbel">Destination <span style="color: red">*</span></label>
                          <input type="text" class="form-control" id="validationCustom02" name="destinationUrl" required>
                          <div class="invalid-feedback">
                            Please enter destination.
                          </div>
                        </div>
                        <div class="mb-3">
                            <label for="urlKey" class="form-label">Custom back-half</label>
                            <input type="text" class="form-control" id="urlKey" name="urlKey">
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

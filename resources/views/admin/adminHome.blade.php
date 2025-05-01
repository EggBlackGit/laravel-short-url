@extends('layouts.app')

@section('content')
<div class="container">
    <form action="" method="get">
        <div class="row align-items-start">
          <div class="col">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="title, destination_url, url_key, default_short_url" name="search" value={{ $search }}>
            </div>
          </div>
          <div class="col">
            <select class="form-select" name="searchUserId">
                <option value="">ทั้งหมด</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}"
                        @if ($searchUserId==$user->id)
                            selected
                        @endif
                    >{{ $user->id }} : {{ $user->name }}</option>
                @endforeach
              </select>
          </div>
          <div class="col">
            <button type="submit" class="btn btn-primary">search</button>
          </div>
        </div>
    </form>

    <div class="card">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">title</th>
                    <th scope="col">destination_url</th>
                    <th scope="col">url_key</th>
                    <th scope="col">default_short_url</th>
                    <th scope="col">copy_url</th>
                    <th scope="col">user_id</th>
                    <th scope="col">user_name</th>
                    <th scope="col">created_at</th>
                    <th scope="col">updated_at</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            @foreach($shortUrls as $shortUrl)
                <tbody>
                    <tr>
                        <th scope="row">{{ $shortUrl->id }}</th>
                        <td>{{ $shortUrl->title }}</td>
                        <td id="destination_url_{{ $shortUrl->id }}">{{$shortUrl->limitUrl(30)}}</td>
                        <td>{{ $shortUrl->url_key }}</td>
                        <td>{{ $shortUrl->default_short_url }}</td>
                        <td>
                            <button class="btn btn-outline-info" onclick="copyToClipboard('{{ $shortUrl->default_short_url }}')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-check" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                                    <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z"/>
                                    <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z"/>
                                </svg>
                            </button>
                        </td>
                        @php
                            $user=$shortUrl->user;
                        @endphp
                        <td>{{ $user?$user->id:null }}</td>
                        <td>{{ $user?$user->name:null }}</td>
                        <td>{{ $shortUrl->created_at }}</td>
                        <td>{{ $shortUrl->updated_at }}</td>
                        <td  class="d-flex align-items-center">
                            <a href="{{ route('admin.shortUrl.view.update', ['id' => $shortUrl->id]) }}" class="btn btn-outline-secondary me-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                </svg>
                            </a>
                            <form method="post" action="{{ route('admin.shortUrl.delete', ['id' => $shortUrl->id]) }}">
                                @csrf
                                @method('delete')
                                <button class="btn btn-outline-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                                    </svg>
                                </button>
                            </form>

                        </td>
                    </tr>
                </tbody>
            @endforeach
        </table>
        {{ $shortUrls->links() }}
    </div>
</div>
<script>
function copyToClipboard(fullUrl) {
    var text = fullUrl;

    navigator.clipboard.writeText(text).then(function() {
        alert("Copy สำเร็จแล้ว");
    }).catch(function(err) {
        console.error('Failed to copy: ', err);
    });
}
</script>
@endsection

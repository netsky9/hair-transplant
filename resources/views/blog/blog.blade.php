@extends('layouts.app')

@section('title') Blog @endsection

@section('content')

    <h1 class="title">
            Blog
    </h1>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>#</th>
                <th>Category</th>
                <th>User</th>
                <th>Title</th>
                <th>Excerpt</th>
                <th>Published</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->category_id }}</td>
                    <td>{{ $item->user_id }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->excerpt }}</td>
                    <td>{{ $item->published_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{ $items->links('vendor.pagination.bootstrap-4') }}
@endsection
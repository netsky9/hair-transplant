@extends('admin.layouts.app')

@section('title') Edit post "{{ $item->title }}" @endsection

@section('content')
    <br>
    <h1 class="title h2">
        Edit post "{{ $item->title }}"
        @if(!$item->is_published)
            <span class="badge badge-danger">Not published</span>
        @endif
    </h1>
    <br>
    <form method="post" action="{{ route('blog.admin.posts.update', $item->id) }}">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}
        <div class="row">
            <div class="col-sm-8">
                @include('admin.inc.errors')
                <div class="card p-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="" value="{{ $item->title }}" required>

                    <label for="slug" class="form-label mt-3">Slug</label>
                    <input type="text" class="form-control" name="slug" id="slug" placeholder="" value="{{ $item->slug }}" >

                    <label for="excerpt" class="form-label mt-3">Short description of article</label>
                    <textarea class="form-control" name="excerpt" id="excerpt" cols="30" rows="3">{{ $item->excerpt }}</textarea>

                    <label for="content_raw" class="form-label mt-3">Content of article</label>
                    <textarea class="form-control" name="content_raw" id="content_raw" cols="30" rows="14">{{ $item->content_raw }}</textarea>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card p-3 mb-3">
                    <input type="submit" class="btn btn-primary" value="Save">
                </div>
                <div class="card p-3 mb-3">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="is_published" id="is_published"
                               @if($item->is_published)
                               checked
                               @endif
                        >
                        <label class="custom-control-label" for="is_published">Publish</label>
                    </div>
                </div>
                <div class="card p-3 mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="custom-select" name="category_id" id="category_id" required="">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @if($category->id == $item->category_id) {{ 'selected' }} @endif>
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Author</h6>
                        </div>
                        <span class="text-muted">{{ $item->user->name }}</span>
                    </li>
                    @if($item->is_published)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Published at</h6>
                            </div>
                            <span class="text-muted">{{ $item->published_at }}</span>
                        </li>
                    @endif
                    @if($item->created_at)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Created at</h6>
                            </div>
                            <span class="text-muted">{{ $item->created_at }}</span>
                        </li>
                    @endif
                    @if($item->updated_at)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Updated at</h6>
                            </div>
                            <span class="text-muted">{{ $item->updated_at }}</span>
                        </li>
                    @endif
                    @if($item->deleted_at)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Deleted at</h6>
                            </div>
                            <span class="text-muted">{{ $item->deleted_at }}</span>
                        </li>
                    @endif
                </ul>
                <div class="card p-3 mb-3">
                    <form method="post" action="{{ route('blog.posts.destroy', $item->id) }}">
                        {{ method_field('delete') }}
                        <button class="btn btn-link stretched-link text-danger" type="submit">Delete post</button>
                    </form>
                </div>
            </div>
        </div>
    </form>
@endsection
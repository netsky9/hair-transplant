@extends('admin.layouts.app')

@section('title') Create new post @endsection

@section('content')
    <br>
    <h1 class="title">
        Create new post
    </h1>
    <br>
    <form method="post" action="{{ route('blog.admin.posts.store') }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-sm-8">
                @include('admin.inc.errors')
                <div class="card p-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="" value="{{ old('title') }}" required>

                    <label for="slug" class="form-label mt-3">Slug</label>
                    <input type="text" class="form-control" name="slug" id="slug" placeholder="" value="{{ old('slug') }}" >

                    <label for="excerpt" class="form-label mt-3">Short description of article</label>
                    <textarea class="form-control" name="excerpt" id="excerpt" cols="30" rows="3">{{ old('excerpt') }}</textarea>

                    <label for="content_raw" class="form-label mt-3">Content of article</label>
                    <textarea class="form-control" name="content_raw" id="content_raw" cols="30" rows="14">{{ old('content_raw') }}</textarea>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card p-3 mb-3">
                    <input type="submit" class="btn btn-primary" value="Create">
                </div>
                <div class="card p-3 mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="custom-select" name="category_id" id="category_id" required="">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @if($category->id == old('category_id')) {{ 'selected' }} @endif>
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </form>
@endsection
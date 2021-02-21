@extends('admin.layouts.app')

@section('title') Edit category "{{ $category->title }}" @endsection

@section('content')
    <br>
    <h1 class="title">
        Edit category "{{ $category->title }}"
    </h1>
    <br>
    <form method="post" action="{{ route('blog.admin.categories.update', $category->id) }}">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}
        <div class="row">
            <div class="col-sm-8">
                @include('admin.inc.errors')
                <div class="card p-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="" value="{{ $category->title }}" required>

                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" name="slug" id="slug" placeholder="" value="{{ $category->slug }}">

                    @if($category->parent_id != 0)
                        <label for="parent_id" class="form-label">Parent category</label>
                        <select class="custom-select" name="parent_id" id="parent_id" required="">
                            @foreach($categoryList as $item)
                                <option value="{{ $item->id }}" @if($item->id == $category->parent_id) {{ 'selected' }} @endif>
                                    {{ $item->title }}
                                </option>
                            @endforeach
                        </select>
                    @endif

                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="description" cols="10" rows="5">{{ $category->description }}</textarea>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card p-3 mb-3">
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
                <ul class="list-group mb-3">
                    @if($category->created_at)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Created at</h6>
                            </div>
                            <span class="text-muted">{{ $category->created_at }}</span>
                        </li>
                    @endif
                    @if($category->updated_at)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Updated at</h6>
                            </div>
                            <span class="text-muted">{{ $category->updated_at }}</span>
                        </li>
                    @endif
                    @if($category->deleted_at)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Deleted at</h6>
                            </div>
                            <span class="text-muted">{{ $category->deleted_at }}</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </form>
@endsection
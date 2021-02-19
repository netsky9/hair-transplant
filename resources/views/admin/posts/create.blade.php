@extends('admin.layouts.app')

@section('title') Create new category @endsection

@section('content')
    <br>
    <h1 class="title">
        Create new category
    </h1>
    <br>
    <form method="post" action="{{ route('blog.admin.categories.store') }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-sm-8">
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        @foreach($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session()->get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card p-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" required>

                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug') }}" >

                    <label for="parent_id" class="form-label">Parent category</label>
                    <select class="custom-select" name="parent_id" id="parent_id" required="">
                        @foreach($categoryList as $item)
                            <option value="{{ $item->id }}" @if(old('parent_id') == $item->id) {{ 'selected' }} @endif>
                                {{ $item->title }}
                            </option>
                        @endforeach
                    </select>

                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="description" cols="10" rows="5">{{ old('description') }}</textarea>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card p-3 mb-3">
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
            </div>
        </div>
    </form>
@endsection
@extends('admin.layouts.app')

@section('title') Edit clinic "{{ $item->title }}" @endsection

@section('content')
    <br>
    <h1 class="title h2 mb-4">
        Edit clinic "{{ $item->title }}"
    </h1>
    <form method="post" action="{{ route('clinics.admin.posts.update', $item->id) }}" enctype="multipart/form-data">
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

                    <label for="text" class="form-label mt-3">Content of clinic</label>
                    <textarea class="form-control" name="text" id="text" cols="30" rows="14">{{ $item->text }}</textarea>

                    <label for="work_time" class="form-label mt-3">Work time</label>
                    <input type="text" class="form-control" name="work_time" id="work_time" placeholder="" value="{{ $item->work_time }}" >

                    <label for="phone" class="form-label mt-3">Phone</label>
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="" value="{{ $item->phone }}" >

                    <label for="email" class="form-label mt-3">Email</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="" value="{{ $item->email }}" >

                    <label for="address" class="form-label mt-3">Address</label>
                    <input type="text" class="form-control" name="address" id="address" placeholder="" value="{{ $item->address }}" >

                    <label for="latitude" class="form-label mt-3">Latitude</label>
                    <input type="text" class="form-control" name="latitude" id="latitude" placeholder="" value="{{ $item->latitude }}" >

                    <label for="longitude" class="form-label mt-3">Longitude</label>
                    <input type="text" class="form-control" name="longitude" id="longitude" placeholder="" value="{{ $item->longitude }}" >
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card p-3 mb-3">
                    <input type="submit" class="btn btn-primary" value="Save">
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
                    <label for="miniature">Main image</label>
                    @if(!empty($miniature))
                        <img src="{{ $miniature->getUrl('thumb') }}" alt="" class="rounded float-left mb-3">
                    @endif
                    <img src="" alt="">
                    <input type="file" name="miniature" class="miniature" id="miniature">
                </div>
            </div>
        </div>
    </form>
    <div class="row mt-4">
        <div class="col-sm-8">
            <div class="card p-3">
                <label class="form-label mb-3">Gallery</label>

                <div class="dropzone-gallery-container">
                @foreach($gallery as $media)
                    <img src="{{ $media->hasGeneratedConversion('thumb') ? $media->getUrl('thumb') : '/images/noimage.jpg' }}" alt="" class="rounded float-left dropzone-gallery_item">
                @endforeach
                </div>

                <form action="{{ route('clinics.admin.posts.upload', $item->id) }}"
                      class="dropzone"
                      id="dropzone-gallery">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
@endsection
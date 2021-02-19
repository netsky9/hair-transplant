@extends('layouts.app')

@section('title') Contacts @endsection

@section('content')
    <div class="m-b-md">
        <h1 class="title">
            Contacts
        </h1>
    </div>

    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach($errors->all() as $er)
                {{ $er }}
            @endforeach
        </div>
    @endif

    <form class="needs-validation" action="{{ route('contact-form') }}" method="post">
        {{ csrf_field() }}

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="firstName">First name</label>
                <input type="text" class="form-control" name="firstName" id="firstName" placeholder="" value="" required="">
                <div class="invalid-feedback">
                    Valid first name is required.
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="lastName">Last name</label>
                <input type="text" class="form-control" name="lastName" id="lastName" placeholder="" value="" required="">
                <div class="invalid-feedback">
                    Valid last name is required.
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="email">Email <span class="text-muted">(Optional)</span></label>
            <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com">
            <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
            </div>
        </div>

        <div class="mb-3">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St">
            <div class="invalid-feedback">
                Please enter your shipping address.
            </div>
        </div>

        <button class="btn btn-primary btn-lg" type="submit">Submit</button>
    </form>

@endsection
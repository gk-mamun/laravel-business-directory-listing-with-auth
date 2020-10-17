@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 card m-2 bg-dark text-white">
        <div class="card-header">{{ __('Dashboard') }}</div>
    </div>
    <div class="col-md-12">
        <a href="/dashboard" class="btn btn-info float-right btn-sm mb-3">Go Back</a>
        @php
            $user_id = auth()->user()->id;
        @endphp
        <h5 class="mt-1">Create New Business Directory</h5>
    </div>

    <div class="col-md-8 card pb-2 pt-2">
        <form action="/listings" method="POST" enctype="multipart/form-data">
        @csrf
            <input name="user-id" type="hidden" value="{{ $user_id }}">
            <div class="form-group">
                <label>Business Name</label>
                <input name="company-name" type="text" class="form-control"  placeholder="Company Name">
            </div>
            <div class="form-group">
                <label>Contact Email</label>
                <input name="contact-email" type="email" class="form-control"  placeholder="Email">
            </div>
            <div class="form-group">
                <label>Company Website</label>
                <input name="company-website" type="url" class="form-control"  placeholder="Website">
            </div>
            <div class="form-group">
                <label>Contact Phone</label>
                <input name="contact-phone" type="text" class="form-control"  placeholder="Contact Phone">
            </div>
            <div class="form-group">
                <label>Company Address</label>
                <input name="address" type="text" class="form-control"  placeholder="Company Address">
            </div>
            <div class="form-group">
                <label>Company Logo/Image</label>
                <input name="company-image" type="file" class="form-control">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="bio" id="" cols="30" rows="10"></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

@endsection
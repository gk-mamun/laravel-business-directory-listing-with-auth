@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 card m-2 bg-dark text-white">
        <div class="card-header">{{ __('Dashboard->Business Detail') }}</div>
    </div>
    <div class="col-md-12">
        @php
            $user_id = auth()->user()->id;
        @endphp
    </div>

    <div class="col-md-8 card pb-2 pt-2">
        <div class="row">
            <div class="col-md-6">
                <img width="100%" src="/storage/company_images/{{ $listing->business_image }}" alt="{{ $listing->business_name }}" class="img-thumbnail">
            </div>
            <div class="col-md-6 p-4">
                <h1>{{ $listing->business_name }}</h1>
                <hr>
                <p><strong>Website: </strong>{{ $listing->website }}</p>
                <p><strong>Email: </strong>{{ $listing->email }}</p>
                <p><strong>Phone: </strong>{{ $listing->phone }}</p>
                <p><strong>Address: </strong>{{ $listing->address }}</p>
                <hr>
                <p><strong>Business Description: </strong>{{ $listing->bio }}</p>
            </div>
            <div class="col-md-12">
                <hr>
                <a href="/dashboard" class="btn btn-info float-right btn-sm mb-3">Go Back</a>
            </div>
        </div>
    </div>
</div>

@endsection
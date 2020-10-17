@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 card m-2 bg-dark text-white">
        <div class="card-header">{{ __('Dashboard') }}</div>
    </div>
    
    <div class="text-white col-md-4 mb-3">
        <div class="card bg-info">
            <div class="card-body text-center">
                @php
                    $username = auth()->user()->name;
                    $avatar = auth()->user()->avatar;
                @endphp
                <img width="60%;" src="/storage/users/{{ $avatar }}" alt="{{ $username }}" class="img-thumbnail rounded-circle">
                <h3>{{ $username }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <a href="/listings/create" class="btn btn-danger mb-3">Create Directory</a>
        <!-- Alert Message -->
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <h3>Your Listings</h3>
                <hr>
                @if(count($listings))
                    @foreach($listings as $listing)
                        <div class="card mb-2">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <img width="80px;" src="/storage/company_images/{{ $listing->business_image }}" alt="{{ $listing->business_name }}" class="img-thumbnail float-left">
                                <h5 class="float-left">{{ $listing->business_name }}</h5>

                                <div>
                                    <form action="/listings/{{ $listing->id }}" class="d-inline-block ml-2  float-right" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input onclick="confirm('Are You Sure?')" type="submit" value="Delete" class="btn btn-danger btn-sm">
                                    </form>
                                    <a href="/listings/{{ $listing->id }}/edit" class="btn btn-primary btn-sm float-right ml-2">Edit</a>
                                    <a href="/listings/{{ $listing->id }}" class="btn btn-success btn-sm float-right">View</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection

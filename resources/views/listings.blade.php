@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    
    <div class="col-md-12 card m-2 bg-info text-white">
        <div class="card-header"><h3>{{ __('Latest Business Directories') }}</h3></div>
    </div>

    <div class="col-md-8">
        @if(count($listings))
            @foreach($listings as $listing)
                <div class="card mb-2">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <img width="80px;" src="/storage/company_images/{{ $listing->business_image }}" alt="{{ $listing->business_name }}" class="img-thumbnail">
                            <h5 class="ml-2">{{ $listing->business_name }}</h5>
                        </div>
                        <div>
                            <a href="/{{ $listing->id }}" class="btn btn-success btn-sm float-right">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        <br>
        <div class="text-center pagination-box">
            {!! $listings->links() !!}
            <!-- {{ $listings->links() }} -->
        </div>
    </div>
    
    
@endsection

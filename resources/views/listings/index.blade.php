@extends('layout/layout_one')

@section('content')

@include('partials._hero')
@include('partials._search')

<div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4" >

    @if(count($listings) == 0)
        <p>No listings found</p>
    @else
        @foreach($listings as $listing) 
        <x-card class="p-6">
            <x-listing-card :listing="$listing"></x-listing-card>
        </x-card>
        @endforeach
        
    @endif
</div>

@if($listings->links())
    <div class="mt-6 p-4">
        {{ $listings->links() }}
    </div>
@endif
@endsection

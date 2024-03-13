@extends('layout')
@section('content')
    @include('layout-dashboard')
    <div class="container w-full h-full mx-auto">
        {{-- @livewire('user-page') --}}
        @livewire('add-skill')
    </div>
@endsection

@extends('layout')
@section('content')
    @include('layout-dashboard')
    <div class="container w-full h-full mx-auto">
        @livewire('user-page')
    </div>
@endsection

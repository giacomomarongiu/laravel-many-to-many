@extends('layouts.app')
@section('content')
    <div class="jumbotron p-5 mb-4 bg-light rounded-3 border">
        <div class="container py-5 ">
            <div class="logo_laravel">
                <div class="logo">
                    <i class="fa-solid fa-briefcase fa-4x"> My Portfolio</i>
                </div>
            </div>
            <h1 class="display-5 fw-bold fst-italic p-1">
                Giacomo Marongiu
            </h1>
            <div class="d-flex align-items-center m-3 gap-3">
                <p class="fs-3 m-0">Welcome! This is a humble collection of my Boolean exercises, check it out! </p>
                <a href="{{ route('home') }}" class="btn btn-light border fw-bold">Explore</a>
            </div>

        </div>
    </div>
@endsection

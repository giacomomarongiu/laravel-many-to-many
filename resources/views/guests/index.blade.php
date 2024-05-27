@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center m-5">Projects</h1>
        <div class="row g-3">
            @foreach ($projects as $project)
                <div class="col-3 d-flex align-items-stretch">
                    <div class="card ">
                        <div class="card-title fw-bold text-center">{{ $project->title }}</div>
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div class="card-text">{{ $project->description }}</div>
                            <div class="card-text mt-1">
                                <strong class="m-0">Technologies: </strong>
                                @if ($project->technologies)
                                    @foreach ($project->technologies as $tech)
                                        <span class="badge text-bg-primary">{{ $tech->name }}</span>
                                    @endforeach
                                @endif
                            </div>

                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
@endsection

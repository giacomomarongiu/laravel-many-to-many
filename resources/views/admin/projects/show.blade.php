@extends('layouts.admin')

@section('content')
    <div class="container py-3">

        <header class="py-3">
            <h1 class="text-primary">{{ $project->title }}</h1>
        </header>

        <div class="row">
            <div class="col">
                <div class="d-flex justify-content-evenly py-3">

                    <a href="{{ route('admin.projects.edit', $project) }}">
                        <i class="fas fa-pencil-alt fa-fw fa-3x text-light bg-primary p-1 rounded"><span
                                class="px-3 text-primary">EDIT</span></i>
                    </a>

                    <!-- Modal  button -->
                    <button type="button" class="btn btn-danger p-1" data-bs-toggle="modal"
                        data-bs-target="#modalId-{{ $project->id }}">
                        <i class="fa-solid fa-toilet fa-3x"> DELETE</i>
                    </button>


                    <!--Modal Body-->
                    <div class="modal fade" id="modalId-{{ $project->id }}" tabindex="-1" data-bs-backdrop="static"
                        data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId-{{ $project->id }}"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTitleId-{{ $project->id }}">
                                        ATTENTION! Cancellation is irreversible!
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body d-flex">
                                    <img width="60" src="{{ $project->img }}" alt="">
                                    <div>Are you sure you want to delete <span class="fw-bold">{{ $project->title }}</span>?
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                    <form action="{{ route('admin.projects.destroy', $project) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            Confirm
                                        </button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card text-start">
                    @if (Str::startsWith($project->img, 'https://'))
                        <img width="" loading="lazy" src="{{ $project->img }}" alt="">
                    @else
                        <!--else i will use asset(...) for print it  -->
                        <img width="" loading="lazy" src="{{ asset('storage/' . $project->img) }}"
                            alt="{{ $project->title }}">
                    @endif
                    <div class="card-body">
                        <h4 class="card-title">{{ $project->title }}</h4>
                        <p class="card-text">{{ $project->description }}</p>
                        <div class="card-text">
                            <strong>Project type: </strong> {{ $project->type ? $project->type->name : 'No Type' }}
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection

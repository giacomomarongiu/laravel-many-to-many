@extends('layouts.admin')

@section('content')
    <div class="container py-3">

        <header class="py-3">
            <h1 class="text-primary">{{ $technology->name }}</h1>
        </header>

        <div class="row">
            <div class="col">
                <div class="d-flex justify-content-evenly py-3">

                    <a href="{{ route('admin.technologies.edit', $technology) }}">
                        <i class="fas fa-pencil-alt fa-fw fa-3x text-light bg-primary p-1 rounded"><span
                                class="px-3 text-primary">EDIT</span></i>
                    </a>

                    <!-- Modal  button -->
                    <button type="button" class="btn btn-danger p-1" data-bs-toggle="modal"
                        data-bs-target="#modalId-{{ $technology->id }}">
                        <i class="fa-solid fa-toilet fa-3x"> DELETE</i>
                    </button>


                    <!--Modal Body-->
                    <div class="modal fade" id="modalId-{{ $technology->id }}" tabindex="-1" data-bs-backdrop="static"
                        data-bs-keyboard="false" role="dialog" aria-labelledby="modalnameId-{{ $technology->id }}"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-name" id="modalnameId-{{ $technology->id }}">
                                        ATTENTION! Cancellation is irreversible!
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body d-flex">
                                    <div>Are you sure you want to delete <span
                                            class="fw-bold">{{ $technology->name }}</span>?
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                    <form action="{{ route('admin.technologies.destroy', $technology) }}" method="post">
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
                    <div class="card-body">
                        <h4 class="card-name">{{ $technology->name }}</h4>
                        <strong>Projects where you use this technology: </strong><br>
                        @if ($technology->projects)
                            @foreach ($technology->projects as $project)
                                <a href="{{ route('admin.projects.show', $project) }}"><span class="badge text-bg-primary">{{ $project->title }}</span></a>
                            @endforeach
                        @endif
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection

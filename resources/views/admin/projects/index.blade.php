@extends('layouts.admin')

@section('content')
    <div class="container">
        <header class="py-3 d-flex justify-content-between">
            <h1 class="text-primary">Projects</h1>
            <button class="btn btn-primary"><a class="text-light" href="{{ route('admin.projects.create') }}">Add New
                    Project</a></button>
        </header>

        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Img</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Description</th>
                        <th scope="col">Link Project</th>
                        <th scope="col">GitHub</th>
                        <th scope="col">Operations</th>
                    </tr>
                </thead>

                {{--             @dd($projects) --}}

                <tbody>

                    @forelse ($projects as $project)
                        <tr class="">
                            <td scope="row">{{ $project->id }}</td>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->slug }}</td>


                            <td>
                                <!--If my url starts with http i print it  -->
                                @if (Str::startsWith($project->img, 'https://'))
                                    <img width="100" loading="lazy" src="{{ $project->img }}" alt="">
                                @else
                                    <!--else i will use asset(...) for print it  -->
                                    <img width="100" loading="lazy" src="{{ asset('storage/' . $project->img) }}"
                                        alt="{{ $project->title }}">
                                @endif
                            </td>

                            <td>{{ $project->start_date }}</td>
                            <td>{{ $project->end_date }}</td>
                            <td>{{ $project->description }}</td>
                            <td>{{ $project->project_link }}</td>
                            <td>{{ $project->github_link }}</td>
                            <td class="text-center">
                                <a class="" href="{{ route('admin.projects.show', $project) }}">
                                    <i class="fas fa-eye fa-sm fa-fw"></i>
                                </a>
                                <a href="{{ route('admin.projects.edit', $project) }}">
                                    <i class="fas fa-pencil-alt fa-sm fa-fw"></i>
                                </a>

                                <!-- Modal  button -->
                                <button type="button" class="btn btn-danger p-1" data-bs-toggle="modal"
                                    data-bs-target="#modalId-{{ $project->id }}">
                                    <i class="fa-solid fa-toilet fa-2xs"></i>
                                </button>


                                <!--Modal Body-->
                                <div class="modal fade" id="modalId-{{ $project->id }}" tabindex="-1"
                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                    aria-labelledby="modalTitleId-{{ $project->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                        role="document">
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
                                                <div>Are you sure you want to delete <span
                                                        class="fw-bold">{{ $project->title }}</span>? </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <form action="{{ route('admin.projects.destroy', $project) }}"
                                                    method="post">
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
                            </td>
                        </tr>

                    @empty
                        <tr class="">
                            <td scope="row" colspan="5">No Project Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection

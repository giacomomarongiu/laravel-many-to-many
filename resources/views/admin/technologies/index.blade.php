@extends('layouts.admin')

@section('content')
    <div class="container">
        <header class="py-3 d-flex justify-content-between">
            <h1 class="text-primary">Technologies</h1>
            <button class="btn btn-primary"><a class="text-light" href="{{ route('admin.technologies.create') }}">Add New
                    technology</a></button>
        </header>

        <main class="d-flex gap-1">
            <form class=" bg-light p-4 col-6 rounded" action="{{ route('admin.technologies.store') }}" method="post">
                @csrf

                <!-- Input for name-->
                <div class="mb-3">
                    <label for="name" class="form-label">Name technology</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        id="name" aria-describedby="nameHelper" placeholder="name" value="{{ old('name') }}" />
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!--Input for projects-->
                <div class="mb-3">
                    <label for="projects" class="form-label">Projects (Hold down ctrl to select more than one)</label>
                    <select multiple class="form-select form-select-lg" name="projects[]" id="projects">
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}"
                                {{ in_array($project->id, old('projects', [])) ? 'selected' : '' }}>
                                {{ $project->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button class="btn btn-primary" type="submit">Create technology</button>


            </form>

            <div class="table-responsive col-6 rounded">
                <table class="table table-primary">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">technology</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Operations</th>
                            <th scope="col">Projects Counter</th>

                        </tr>
                    </thead>

                    {{--             @dd($technologies) --}}

                    <tbody>

                        @forelse ($technologies as $technology)
                            <tr class="">
                                <td scope="row">{{ $technology->id }}</td>
                                <td>{{ $technology->name }}</td>
                                <td>{{ $technology->slug }}</td>

                                <td class="">
                                    <a class="" href="{{ route('admin.technologies.show', $technology) }}">
                                        <i class="fas fa-eye fa-sm fa-fw"></i>
                                    </a>
                                    <a href="{{ route('admin.technologies.edit', $technology) }}">
                                        <i class="fas fa-pencil-alt fa-sm fa-fw"></i>
                                    </a>

                                    <!-- Modal  button -->
                                    <button type="button" class="btn btn-danger p-1" data-bs-toggle="modal"
                                        data-bs-target="#modalId-{{ $technology->id }}">
                                        <i class="fa-solid fa-toilet fa-2xs"></i>
                                    </button>


                                    <!--Modal Body-->
                                    <div class="modal fade" id="modalId-{{ $technology->id }}" tabindex="-1"
                                        data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                        aria-labelledby="modalTitleId-{{ $technology->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalTitleId-{{ $technology->id }}">
                                                        ATTENTION! Cancellation is irreversible!
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body d-flex">
                                                    <div>Are you sure you want to delete <span
                                                            class="fw-bold">{{ $technology->title }}</span>? </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <form action="{{ route('admin.technologies.destroy', $technology) }}"
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
                                <td>{{ count($technology->projects) }}</td>
                            </tr>

                        @empty
                            <tr class="">
                                <td scope="row" colspan="5">No technology Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>


    </div>
@endsection

@extends('layouts.admin')

@section('content')
    <div class="container">

        <form class="form-control bg-light p-4" action="{{ route('admin.projects.update', $project) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Input for title-->
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                    aria-describedby="titleHelper" placeholder="title" value="{{ old('title', $project->title) }}" />
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input for type-->
            <div class="mb-3">
                <label for="type_id" class="form-label">Type</label>
                <select class="form-select" name="type_id" id="type_id">
                    <option selected disabled>Select a type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}"
                            {{ $type->id == old('type_id', $project->type_id) ? 'selected' : '' }}>
                            {{ $type->name }}</option>
                    @endforeach
                </select>
            </div>


            <!--Input for technologies-->
            <div class="mb-3">
                <label for="technologies" class="form-label">Technologies (Hold down ctrl to select more than one)</label>
                <select multiple class="form-select form-select-lg" name="technologies[]" id="technologies">
                    @foreach ($technologies as $tech)
                        @if ($errors->any())
                            <option value="{{ $tech->id }}"
                                {{ in_array($tech->id, old('technologies', [])) ? 'selected' : '' }}>
                                {{ $tech->name }}
                            </option>
                        @else
                            <option value="{{ $tech->id }}"
                                {{ $project->technologies->contains($tech->id) ? 'selected' : '' }}>
                                {{ $tech->name }}
                            </option>
                        @endif
                    @endforeach
                </select>
                @error('technologies')
                    <div class="text-danger py-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <!-- Input for image-->
            <div class="mb-3">
                <label for="img" class="form-label">Image</label>
                <input type="file" class="form-control @error('img') is-invalid @enderror" name="img" id="img"
                    aria-describedby="imgHelper" placeholder="img" value="{{ old('img', $project->img) }}" />
                @error('img')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input for start_date-->
            <div class="mb-3">
                <label for="start_date" class="form-label">Project start date
                </label>
                <input type="text" class="form-control @error('start_date') is-invalid @enderror" name="start_date"
                    id="start_date" aria-describedby="start_dateHelper" placeholder="start_date"
                    value="{{ old('start_date', $project->start_date) }}" />
                @error('start_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input for end_date-->
            <div class="mb-3">
                <label for="end_date" class="form-label">Project end date
                </label>
                <input type="text" class="form-control @error('end_date') is-invalid @enderror" name="end_date"
                    id="end_date" aria-describedby="end_dateHelper" placeholder="end_date"
                    value="{{ old('end_date', $project->end_date) }}" />
                @error('end_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input for description-->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control @error('description') is-invalid @enderror" name="description"
                    id="description" aria-describedby="descriptionHelper" placeholder="description"
                    value="{{ old('description', $project->description) }}" />
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input for project_link-->
            <div class="mb-3">
                <label for="project_link" class="form-label">Project URL</label>
                <input type="text" class="form-control @error('project_link') is-invalid @enderror" name="project_link"
                    id="project_link" aria-describedby="project_linkHelper" placeholder="project_link"
                    value="{{ old('project_link', $project->project_link) }}" />
                @error('project_link')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input for github_link-->
            <div class="mb-3">
                <label for="github_link" class="form-label">GitHub URL</label>
                <input type="text" class="form-control @error('github_link') is-invalid @enderror" name="github_link"
                    id="github_link" aria-describedby="github_linkHelper" placeholder="github_link"
                    value="{{ old('github_link', $project->github_link) }}" />
                @error('github_link')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-primary" type="submit">Modify project</button>


        </form>
    </div>
@endsection

@extends('layouts.admin')

@section('content')
    <div class="container">

        <form class="form-control bg-light p-4" action="{{ route('admin.technologies.update', $technology) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Input for name-->
            <div class="mb-3">
                <label for="name" class="form-label">Name technology</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                    aria-describedby="nameHelper" placeholder="name" value="{{ old('name', $technology->name) }}" />
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!--Input for projects-->
            <div class="mb-3">
                <label for="projects" class="form-label">projects (Hold down ctrl to select more than one)</label>
                <select multiple class="form-select form-select-lg" name="projects[]" id="projects">
                    @foreach ($projects as $project)
                        @if ($errors->any())
                            <option value="{{ $project->id }}"
                                {{ in_array($project->id, old('projects', [])) ? 'selected' : '' }}>
                                {{ $project->name }}
                            </option>
                        @else
                            <option value="{{ $project->id }}"
                                {{ $technology->projects->contains($project->id) ? 'selected' : '' }}>
                                {{ $project->title }}
                            </option>
                        @endif
                    @endforeach
                </select>
                @error('projects')
                    <div class="text-danger py-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button class="btn btn-primary" type="submit">Modify technology</button>


        </form>
    </div>
@endsection

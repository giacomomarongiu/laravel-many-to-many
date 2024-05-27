@extends('layouts.admin')

@section('content')
    <div class="container">

        <form class="form-control bg-light p-4" action="{{ route('admin.types.store') }}" method="post">
            @csrf

            <!-- Input for name-->
            <div class="mb-3">
                <label for="name" class="form-label">Name type</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                    aria-describedby="nameHelper" placeholder="name" value="{{ old('name') }}" />
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-primary" type="submit">Create type</button>


        </form>
    </div>
@endsection

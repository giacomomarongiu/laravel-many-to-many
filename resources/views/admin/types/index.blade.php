@extends('layouts.admin')

@section('content')
    <div class="container">
        <header class="py-3 d-flex justify-content-between">
            <h1 class="text-primary">types</h1>
            <button class="btn btn-primary"><a class="text-light" href="{{ route('admin.types.create') }}">Add New
                    type</a></button>
        </header>

        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Type</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Operations</th>
                    </tr>
                </thead>

                {{--             @dd($types) --}}

                <tbody>

                    @forelse ($types as $type)
                        <tr class="">
                            <td scope="row">{{ $type->id }}</td>
                            <td>{{ $type->name }}</td>
                            <td>{{ $type->slug }}</td>

                            <td class="">
                                <a class="" href="{{ route('admin.types.show', $type) }}">
                                    <i class="fas fa-eye fa-sm fa-fw"></i>
                                </a>
                                <a href="{{ route('admin.types.edit', $type) }}">
                                    <i class="fas fa-pencil-alt fa-sm fa-fw"></i>
                                </a>

                                <!-- Modal  button -->
                                <button type="button" class="btn btn-danger p-1" data-bs-toggle="modal"
                                    data-bs-target="#modalId-{{ $type->id }}">
                                    <i class="fa-solid fa-toilet fa-2xs"></i>
                                </button>


                                <!--Modal Body-->
                                <div class="modal fade" id="modalId-{{ $type->id }}" tabindex="-1"
                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                    aria-labelledby="modalTitleId-{{ $type->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTitleId-{{ $type->id }}">
                                                    ATTENTION! Cancellation is irreversible!
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body d-flex">
                                                <div>Are you sure you want to delete <span
                                                        class="fw-bold">{{ $type->title }}</span>? </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <form action="{{ route('admin.types.destroy', $type) }}"
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
                            <td scope="row" colspan="5">No type Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection

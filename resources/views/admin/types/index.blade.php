@section('title', 'All Types')
@extends('layouts.admin')


@section('content')
    <section class="hype-w-85x100 mx-auto py-5">
        <h1 class="mb-3">Types</h1>
        <a role="button" class="mine-custom-btn mb-3" href="{{ route('admin.types.create') }}">Add a Type</a>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <table id="projects-table"
            class="table table-dark table-hover shadow mb-2 mt-3 hype-unselectable hype-table-clickable">
            <thead>
                <tr>
                    <th scope="col">#id Type</th>
                    <th scope="col">Type Name</th>
                    <th scope="col" class="d-none d-xl-table-cell">Type Slug</th>
                    <th scope="col" class=" text-center">
                        Amministration Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($types as $element)
                    <tr>
                        <td><a>{{ $element->id }} </a></td>
                        <td><a>{{ $element->name }}</a></td>
                        <td class="d-none d-xl-table-cell"><a>{{ $element->slug }}</a></td>
                        </td>
                        <td class="">
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('admin.types.show', $element->slug) }}" class="table-icon m-1">
                                    <div class="icon-container">
                                        <i
                                            class=" fa-solid fa-eye fs-3 text-active-tertiary hype-text-shadow hype-hover-size"></i>
                                    </div>
                                </a>
                                <a href="{{ route('admin.types.edit', $element->slug) }}" class="table-icon m-1">
                                    <div class="icon-container">
                                        <i
                                            class=" fa-solid fa-pen-to-square fs-3 text-active-tertiary hype-text-shadow hype-hover-size"></i>
                                    </div>
                                </a>
                                <form id="delete-form" action="{{ route('admin.types.destroy', $element->slug) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="element-delete default-button text-active-primary hype-text-shadow fs-3 m-1"
                                        type="submit" data-element-id="{{ $element->id }}"
                                        data-element-title="{{ $element->name }}">
                                        <div class="icon-container">
                                            <i class="fa-solid fa-trash-can "></i>
                                        </div>
                                    </button>
                                </form>
                            </div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- {{ $projects->links('vendor.pagination.bootstrap-5') }} --}}
    </section>
@endsection

@section('title', 'Type ' . $type->name)
@extends('layouts.admin')


@section('content')
    <section class="container py-5">


        <div class="container rounded-2 hype-shadow-white p-5 background-gradient-color">
            <h1 class="text-center hype-text-shadow text-white fw-bolder mb-5">All Projects for: {{ $type->name }} Type
            </h1>
            <div class="container">
                <table id="projects-table"
                    class="table table-dark table-hover shadow mb-2 mt-3 hype-unselectable hype-table-clickable">
                    <thead>
                        <tr>
                            <th scope="col">#id Project</th>
                            <th scope="col">Project Title</th>
                            <th scope="col" class="d-none d-xl-table-cell">Created at</th>
                            <th scope="col" class="d-none d-lg-table-cell">Techonlogies</th>
                            <th scope="col" class="text-center">
                                Amministration Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($type->projects as $project)
                            <tr>
                                <td><a>{{ $project->id }} </a></td>
                                <td><a>{{ $project->title }}</a></td>
                                <td class="d-none d-xl-table-cell"><a>{{ $project->created }}</a></td>
                                <td class="d-none d-lg-table-cell"><a>
                                        @if ($project->technologies)
                                            {{ $project->technologies->name }}
                                        @else
                                            Nessuna Tecnologia
                                        @endif
                                    </a></td>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('admin.projects.show', $project->slug) }}" class="table-icon m-1">
                                            <div class="icon-container">
                                                <i
                                                    class=" fa-solid fa-eye fs-3 text-active-tertiary hype-text-shadow hype-hover-size"></i>
                                            </div>
                                        </a>
                                        <a href="{{ route('admin.projects.edit', $project->slug) }}" class="table-icon m-1">
                                            <div class="icon-container">
                                                <i
                                                    class=" fa-solid fa-pen-to-square fs-3 text-active-tertiary hype-text-shadow hype-hover-size"></i>
                                            </div>
                                        </a>
                                        <form id="delete-form" action="{{ route('admin.projects.destroy', $project->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="element-delete default-button text-active-primary hype-text-shadow fs-3 m-1"
                                                type="submit" data-element-id="{{ $project->id }}"
                                                data-element-title="{{ $project->title }}">
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
                <div class="text-center w-25 mx-auto d-flex gap-2">
                    <a href="{{ route('admin.types.index') }}"
                        class="mine-custom-btn min-custom-btn-grey mt-3 w-100">Back</a>
                </div>
            </div>

        </div>

    </section>
@endsection

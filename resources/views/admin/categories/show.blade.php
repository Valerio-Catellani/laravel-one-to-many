@section('title', 'Admin Dashboard / Projects')
@extends('layouts.admin')


@section('content')
    <section class="container py-5">


        <div class="container rounded-2 hype-shadow-white p-5 background-gradient-color">
            <h1 class="text-center hype-text-shadow text-white fw-bolder mb-5">Project: {{ $category->name }} Details</h1>
            <div class="container">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Title</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Update At</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category->projects as $project)
                            <tr>
                                <td>{{ $project->id }}</td>
                                <td>{{ $project->title }}</td>
                                <td>{{ $project->slug }}</td>
                                <td>{{ $project->created_at }}</td>
                                <td>{{ $project->updated_at }}</td>
                                <td>
                                    <a href="{{ route('admin.projects.show', $project->slug) }}" title="Show"
                                        class="text-black px-2"><i class="fa-solid fa-eye"></i></a>
                                    <a href="{{ route('admin.projects.edit', $project->slug) }}" title="Edit"
                                        class="text-black px-2"><i class="fa-solid fa-pen"></i></a>
                                    <form action="{{ route('admin.projects.destroy', $project->slug) }}" method="POST"
                                        class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-button border-0 bg-transparent"
                                            data-item-title="{{ $project->title }}" data-item-id = "{{ $project->id }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>

                                    </form>


                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>

        </div>

    </section>
@endsection

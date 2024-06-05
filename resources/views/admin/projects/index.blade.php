@section('title', 'Admin Dashboard / Projects')
@extends('layouts.admin')


@section('content')
    <section class="hype-w-85x100 mx-auto py-5">
        <h1 class="mb-3">All Projects</h1>
        <a role="button" class="mine-custom-btn mb-3" href="{{ route('admin.projects.create') }}">Add a Project</a>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        @include('partials.table', ['elements' => $projects])
        {{ $projects->links('vendor.pagination.bootstrap-5') }}
    </section>
@endsection

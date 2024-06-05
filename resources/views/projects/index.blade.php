@extends('layouts.app')
@section('title', 'All Projects')
@section('content')
    <section class="hype-w-85x100 mx-auto">
        <h1>All Projects</h1>
        @include('partials.table', ['elements' => $projects])
        {{ $projects->links('vendor.pagination.bootstrap-5') }}
    </section>
@endsection

@section('title', 'Admin Dashboard / Types')
@extends('layouts.admin')


@section('content')
    <section class="container py-5">


        <div class="container rounded-2 hype-shadow-white p-5 background-gradient-color">
            <h1 class="text-center hype-text-shadow text-white fw-bolder">Add a Type</h1>

            <form id="comic-form" action="{{ route('admin.types.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3 @error('name') err-animation @enderror">
                    <label for="name" class="form-label text-white">Type Name</label>
                    <input type="text" class="form-control @error('name') is-invalid err-animation @enderror"
                        id="name" name="name" value="{{ old('name') }}" required maxlength="255" minlength="3">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <br>
                <div class="text-center w-25 mx-auto d-flex gap-2">
                    <button type="submit" class="mine-custom-btn mt-3 w-100">Save</button>
                    <a href="{{ route('admin.types.index') }}"
                        class="mine-custom-btn min-custom-btn-grey mt-3 w-100">Back</a>
                </div>
            </form>
        </div>

    </section>
@endsection

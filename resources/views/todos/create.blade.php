@extends('layouts.app')
@section("title","Create item")
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                     <h4 class="ml-3">
                        Add Todo List Items
                        <a href="{{ route('todolist') }}" class="float-right btn btn-sm btn-dark mr-3">Back</a>
                    </h4>
                    <div class="col-md-12">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    </div>
                    <form action="{{ route("todo/store") }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" name="title" id="title" placeholder="Enter the title" class="form-control @error('title') is-invalid @enderror" value="{{ old("title") }}">
                                @error("title")
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="file" name="image" id="image" class="form-input-control @error('image') is-invalid @enderror">
                                @error("image")
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <textarea name="description" id="description" cols="30" rows="8" class="form-control @error('description') is-invalid @enderror" placeholder="Enter a description">{{ old('description') }}</textarea>
                                @error("description")
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-dark">create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
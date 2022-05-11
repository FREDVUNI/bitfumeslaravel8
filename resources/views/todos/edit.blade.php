@extends('layouts.app')
@section("title","$todo->title")
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                     <h4 class="ml-3">
                       Edit {{ str_limit($todo->title,20) }}
                        <a href="{{ route('todolist') }}" class="float-right btn btn-sm btn-dark mr-3">Back</a>
                    </h4>
                    <div class="col-md-12">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    </div>
                    <form action="{{ route("todo/update",$todo->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method("patch")
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" name="title" id="title" placeholder="Enter the title" class="form-control @error('title') is-invalid @enderror" value="{{ $todo->title ?? old("title") }}">
                                @error("title")
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <img src="/todo/{{ $todo->image }}" alt="item" style="height: 80px" class="img-fluid mb-3 thumbnail">
                                <input type="file" name="image" id="image" class="form-file-control @error('image') is-invalid @enderror" value="{{ $todo->image }}">
                                @error("image")
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <textarea name="description" id="description" cols="30" rows="8" class="form-control @error('description') is-invalid @enderror">{{ $todo->description ?? old('description') }}</textarea>
                                @error("description")
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-dark">save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
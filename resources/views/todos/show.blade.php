@extends('layouts.app')
@section("title", str_limit($todo->title,15))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                     <h4 class="ml-3">
                        {{ str_limit($todo->title,20) }}
                        <a href="{{ route('todolist') }}" class="float-right btn btn-sm btn-dark mr-3">Back</a>
                    </h4>
                    <div class="row">
                        <div class="col-md-4">
                            <img src="/todo/{{ $todo->image }}" alt="todo image" class="w-100">
                        </div>
                        <div class="col-md-8">
                            <div>
                                <div class="d-flex align-items-center">
                                    <img src="/profile/{{ $todo->user->image }}" alt="post image" class="w-100 rounded-circle" style="max-width: 50px">
                                    <div class="font-weight-bold pl-3">
                                        <a href="/{{ $todo->user->id }}/profile">
                                            <span class="text-dark">{{ $user->username }}</span>
                                        </a>
                                    </div>
                                </div>
                                <hr>
                                <p>
                                    <span class="font-weight-bold">
                                        <a href="/{{ $todo->user->id }}/profile">
                                            <span class="text-dark">{{ $todo->user->username }}</span>
                                        </a>
                                    </span>
                                    {{ $todo->description }}
                                </p>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
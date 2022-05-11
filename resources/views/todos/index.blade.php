@extends('layouts.app')
@section("title","Todo list")
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h1 class="ml-5">
                        Todo List Items
                        <a href="{{ route('todo/create') }}" class="float-right btn text-success mt-2">Add Item</a>
                    </h1>
                    <ul>
                        @forelse($todos as $todo)
                            <li class="list-group-item">
                                <img src="/todo/{{ $todo->image }}" alt="item" style="height: 40px">
                                @if($todo->complete)
                                    <a href="{{ route('todo/show',$todo->slug) }}"><del class="ml-5 text-muted">{{ str_limit($todo->title,35) }}</del></a>
                                @else
                                    <a href="{{ route('todo/show',$todo->slug) }}"><span class="ml-5 font-weight-bold text-dark">{{ str_limit($todo->title,35) }}</span></a>
                                @endif
                                <span class="float-right mt-2 d-flex">
                                        <form action="{{ route('todo/complete',$todo->id) }}" id="complete-{{ $todo->id }}" method="post">
                                            @csrf
                                            @method('patch')
                                            <input type="hidden" name="complete" value="{{ $todo->complete }}">
                                            <button type="submit" class="btn text-secondary">complete</button>
                                        </form>
                                    <a href="{{ route("todo/edit",$todo->slug) }}" class="text-primary btn">edit</a>
                                        <form action="{{ route('todo/delete',$todo->id) }}" id="complete-{{ $todo->id }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="complete" value="{{ $todo->complete }}">
                                            <button type="submit" class="text-danger btn">delete</button>
                                        </form>
                                </span>
                            </li>
                        @empty
                            <div class="alert alert-danger">There are no items available!</div>
                        @endforelse
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
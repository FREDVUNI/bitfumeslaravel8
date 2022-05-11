@extends('layouts.app')
@section('title','VUEJS Todolist')
@section('content')
    <div class="w-100 h-100 d-flex flex-column justify-content-center align-items-center">
        <h1 class="text-dark display-5">Vue Js Todo App</h1>
        <todo-component></todo-component>
    </div>
@endsection
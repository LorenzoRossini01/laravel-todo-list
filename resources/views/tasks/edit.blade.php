
@extends('layouts.app')

@section('title', 'Task List')

@section('main-content')
<div class="container">

    <h1>Edit Task</h1>
    <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input
                type="text"
                class="form-control"
                name="title"
                id="title"
                placeholder="inserisci un titolo"
                value='{{$task->title}}'
            />
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea
                type="text"
                class="form-control"
                name="description"
                id="description"
                placeholder="inserisci un titolo"
                wrap="soft"
            >{{$task->description}}</textarea>
        </div>
        <div class="controls d-flex gap-1">
            <button type="submit" class="button-link">Save</button>
            <button type="reset" class="button-link reset">Reset</button>
        </div>
    </form>
</div>
@endsection

@section('css')
<style>
    .container{
        padding-block: 10rem;
    }
</style>
@endsection
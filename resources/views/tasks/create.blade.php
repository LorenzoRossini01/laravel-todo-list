@extends('layouts.app')

@section('title', 'Task List')

@section('main-content')
<div class="container">

    <h1>Create Task</h1>
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input
                type="text"
                class="form-control"
                name="title"
                id="title"
                placeholder="inserisci un titolo"
            />
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea
                class="form-control"
                name="description"
                id="description"
                placeholder="inserisci una descrizione"
                wrap="soft"
            ></textarea>
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
    .container {
        padding-block: 10rem;
    }
</style>
@endsection

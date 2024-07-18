@extends('layouts.app')

@section('title', 'Task List')

@section('main-content')
<div class="content-wrapper">

<div class="row">
<div class="col flex-grow-1">

    <h1>{{ $task->title }}</h1>
</div>
    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="col flex-grow-0">
        @csrf
        @method('DELETE')
        <div class="button-link delete"><i class="fa-solid fa-xmark fa-xl "></i></div>
    </form>
</div>
    <p class="whitespace-pre-wrap">{{ $task->description }}</p>
    <p class="text-center fw-bold">{{ $task->completed ? 'Completed' : null }}</p>
    <div class="progress-title d-flex justify-content-between align-items-center">

        <div id="progressId">Completed Percentage: <strong>{{$task->getCompletedTaskPercentage()}}%</strong></div>
        <form action="{{route('steps.reset',$task)}}" method="POST">
            @csrf
            @method('PATCH')
            <button type="submit" class="button-link reset" id="reset-complete"><i class="fa-solid fa-rotate-left"></i></button>
        </form>
    </div>
    <div class="progress mt-auto mb-3">
        <div class="progress-bar {{$task->progressColorClass()}}"
            role="progressbar"
            style="width: {{$task->getCompletedTaskPercentage()}}%;"
            aria-valuenow="{{$task->getCompletedTaskPercentage()}}"
            aria-valuemin="0"
            aria-valuemax="100">
        </div>
    </div>
    

    <a href="{{ route('tasks.edit', $task) }}" class="button-link reset">Edit</a>


    <hr>
    <h2>Steps</h2>
    {{-- Form per aggiungere nuovi steps --}}
    <form action="{{ route('steps.store') }}" method="POST" class="my-3">
        @csrf
        <div class="">
            <input type="hidden" name="task_id" value="{{ $task->id }}">
            
            <div class="mb-3">
                <label for="title" class="form-label">Step Title</label>
                <div class="d-flex align-items-center justify-content-center">
                    <input type="text" class="form-control" id="title" name="title">
                    <button type="submit" class="button-link"><i class="fa-solid fa-plus"></i></button>
                </div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Step Description</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
        </div>
    </form>

    {{-- Tabella degli Steps --}}
    <div class="table-responsive">
        <table class="table table-striped table-hover table-borderless align-middle">
            <thead class="table-light fixed-header">
                <tr>
                    <th>Details</th>
                    <th>Done</th>
                    <th>Settings</th>
                </tr>
            </thead>
                <tbody class="table-group-divider">
                    @foreach($steps as $step)
                    <tr >
                        <td scope="row" class="py-3">
                            <h5 @class([$step->completed?'text-success':null])>{{ $step->title }} 
                                @if($step->completed)
                                <i class="fa-solid fa-check"></i>
                                 @endif
                            </h5>
                            <p class="mb-0 whitespace-pre-wrap">{{ $step->description }}</p>
                            <small>{{$step->created_at}}</small>
                        </td>
                        
                        <td class="text-center">                           
                            <form action="{{ route('steps.update-completed', $step) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <label class="switch">
                                    <input type="checkbox" id="completed_{{ $step->id }}" @if($step->completed) checked @endif name="completed">
                                    <span class="slider"></span>
                                </label>
                            </form>
                        </td>
                         
                        <td class="text-center">
 
                            <form action="{{ route('steps.destroy', $step) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="button-link delete" ><i class="fa-solid fa-xmark fa-xl "></i></div>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
</div>    
</div>
@endsection

@section('css')
<style>
    
    .whitespace-pre-wrap{
        white-space: pre-wrap;
    }
    .content-wrapper {
        padding-block: 10rem;
        padding-inline: 2rem;
        height: 100vh;
        overflow-y: auto; /* Abilita lo scroll verticale */
    }



    .fixed-header {
        position: sticky; 
        top: 0;
        background-color: #ffffff; /* Colore di sfondo per l'intestazione fissa */
        z-index: 1; /* Assicura che l'intestazione rimanga sopra il contenuto scorrevole */
    }


    .switch {
        font-size: 17px;
        position: relative;
        display: inline-block;
        width: 3.5em;
        height: 2em;
    }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #fff;
        border: 1px solid #adb5bd;
        transition: .4s;
        border-radius: 30px;
        transform: scale(0.7);
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 1.4em;
        width: 1.4em;
        border-radius: 20px;
        left: 0.27em;
        bottom: 0.25em;
        background-color: #adb5bd;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #007bff;
        border: 1px solid #007bff;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #007bff;
    }

    input:checked+.slider:before {
        transform: translateX(1.4em);
        background-color: #fff;
    }
</style>
@endsection

@section('js')

    <script>
const checkboxes = document.querySelectorAll('.switch input[type="checkbox"]');
    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener('change', () => {
            const form = checkbox.closest('form');
            form.submit();
        });
    });

    const deleteButtons = document.querySelectorAll('.fa-xmark');
    deleteButtons.forEach((deleteButton) =>{

        deleteButton.addEventListener('click', () => {
        const confirmation = confirm('Are you sure you want to delete?');
        if (confirmation) {
            const form = deleteButton.closest('form');
            form.submit();
        }
    });
});

    const resetButton = document.querySelector('#reset-complete');
    resetButton.addEventListener('click',()=>{
        const confirmation = confirm('Are you sure you want to reset completed steps?');
        if(confirmation){
            const form = resetButton.closest('form');
            form.submit();
        }
    });
    </script>
@endsection

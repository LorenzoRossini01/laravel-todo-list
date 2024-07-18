
@extends('layouts.app')

@section('title', 'Task List')



@section('main-content')


    <div class="task-wrapper">

        <h1 class="text-center">Tasks</h1>
        <div class="row row-cols-3 g-3 mt-3">

            @foreach ($tasks as $task)


            <div class="col">
                <div @class(['card d-flex flex-column px-3 py-2']) >
                    <div class="d-flex justify-content-center align-items-center h-100 fs-4">

                        <a href="{{ route('tasks.show', $task) }}" class="text-decoration-none text-dark">{{ $task->title }}</a>
                    </div>

                        <div class="progress mt-auto">
                            <div class="progress-bar {{$task->progressColorClass()}}"
                                role="progressbar"
                                style="width: {{$task->getCompletedTaskPercentage()}}%;"
                                aria-valuenow="{{$task->getCompletedTaskPercentage()}}"
                                aria-valuemin="0"
                                aria-valuemax="100">
                            </div>
                        </div>
                    
                </div>
            </div>
            @endforeach
        </div>
</div>
@endsection

@section('css')
<style>
    .task-wrapper{
        height: 100vh;
        overflow: auto;
        padding-block: 10rem;
        padding-inline: 2rem;

    }
    .col{
        height: 200px;
    }
    .card{
        height: 100% !important;
        transition: background-color 0.3s ease;
        &.completed{

            background-color: rgb(95, 159, 0);
        }
        &.incompleted{
            background-color: rgba(159, 0, 0, 0.995);

        }
        a{
            text-decoration: none;
            color: white;
        }
    }

    .card:hover{
        cursor: pointer;
        transition: background-color 0.3s ease;
        transform: scale(1.02);
        transform: translate3d(10px,10px,10px);
        
        
    }
    
    .card:hover {
        -webkit-animation: slide-fwd-bottom 0.45s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        z-index: 3;
        animation: slide-fwd-bottom 0.45s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        box-shadow: 10px 10px 10px 10px rgba(200, 200, 200, 0.18) ;
        transition: box-shadow 0.3s ease;
}
/**
 * ----------------------------------------
 * animation slide-fwd-bottom
 * ----------------------------------------
 */
 @-webkit-keyframes slide-fwd-bottom {
  0% {
    -webkit-transform: translateZ(0) translateY(0) scale(1);
            transform: translateZ(0) translateY(0) scale(1);
  }
  100% {
    -webkit-transform: translateZ(16px) translateY(10px) scale(1.1);
            transform: translateZ(16px) translateY(10px) scale(1.1);
  }
}
@keyframes slide-fwd-bottom {
  0% {
    -webkit-transform: translateZ(0) translateY(0) scale(1);
            transform: translateZ(0) translateY(0) scale(1);
  }
  100% {
    -webkit-transform: translateZ(16px) translateY(10px) scale(1.1);
            transform: translateZ(16px) translateY(10px) scale(1.1);
  }
}
</style>
@endsection
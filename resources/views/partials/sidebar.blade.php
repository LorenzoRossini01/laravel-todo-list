<aside >
    <div class="title d-flex justify-content-center align-items-center gap-3 w-100 px-2 position-relative">
        @if(Route::currentRouteName()!='tasks.index')
        <i class="fa-solid fa-arrow-left me-auto flex-grow-0 position-absolute"></i>
        @endif
        <h1 class="flex-grow-1 text-center">Todo-List</h1>
    </div>

    <div class="text-start my-4">
        <a href="{{route('tasks.create')}}"
            class="button-link"
        >
        <i class="fa-solid fa-plus me-2"></i>
            Crea una task
        </a>
    </div>
    

    <ul class="px-0">
        @foreach($tasks as $task)
            <li @class([
                'px-3',
                'py-2',
                'active' => (Route::currentRouteName() == 'tasks.show' && Route::current()->parameter('task')->id == $task->id)
            ])>
                <a aria-current="page" href="{{ route('tasks.show', $task) }}">
                    <span>{{ $task->title }}</span>
                    <br>
                    <small>{{ $task->updated_at->diffForHumans() }}</small>
                </a>
            </li>
        @endforeach
    </ul>
</aside>

<style>
    
    .fa-arrow-left{
        font-size: 1.5rem;
        cursor: pointer;
        transition: transform 0.3s ease;
        left: 1rem;
    }


    ul {
        list-style: none;
        margin: 0;
    }

    ul li {
        border-bottom: 1px solid grey;
    }

    ul li:hover {
        background-color: rgb(26, 26, 26);
    }

    ul li a {
        text-decoration: none;
        color: white;
    }

    ul li.active {
        background-color: rgb(26, 26, 26);
    }


    aside {
        height: 100vh;
        min-width: 400px;
        max-width: 400px;
        display: flex;
        flex-direction: column;
        align-items: center;
        overflow: auto;
        background-color: black;
        color: white;
        padding-block: 10rem;
        z-index: 0;
    }
</style>

<script>
    document.querySelector('.fa-arrow-left').addEventListener('click', function() {
        window.location.href = "{{ route('tasks.index') }}";
    });
</script>
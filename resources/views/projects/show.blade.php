<x-layout>

    <header class=" items-center  flex">
        <p class="font-normal text-3xl text-gray-500 mb-8"><a href="/projects" class="no-underline text-gray-500"> My Projects</a> / {{$project->title}}
        <a href="/projects/create">
            <button type="submit" class="m-4 bg-cyan-400 text-white text-normal text-sm rounded p-1 shadow-sm hover:bg-cyan-500 active:translate-y-0.5"
                    href="/projects/create">Create new task</button>
        </a>
        </p>
    </header>
    <main class="lg:flex justify-between">

        <div class="lg:w-2/3 mr-5">
            <div class="mb-10">
                <h3 class="font-normal text-gray-500 text-lg">Task</h3>
                @foreach($project->tasks as $task)

                        <div class="card mb-4 ">
                            <form method="POST" action="{{$task->path()}}">
                                @method('PATCH')
                                @csrf
                                <div class="flex justify-between ">
                                <input class="w-3/4 {{$task->completed ? 'text-gray-400' : ''}}" id="body" name="body" value="{{$task->body}}">
                                <input type="checkbox" name="completed" class="m-1" onchange="this.form.submit()" {{$task->completed ? 'checked' : ''}}>
                                </div>
                            </form>
                        </div>

                @endforeach
                <div class="card mb-4">
                    <form method="POST" action="{{$project->path().'/tasks'}}" >
                        @csrf
                        <input type="text" name="body" id="body" placeholder="Add a new task" class="w-100">
                    </form>
                </div>

            </div>
            <div class>
                <h3 class="font-normal text-gray-500 text-lg ">General move</h3>
                <form method="POST" action="{{$project->path()}}">
                    @method('PATCH')
                    @csrf
                    <div class="flex justify-between card">
                        <textarea class="w-100" id="notes" name="notes" placeholder="Do you want a place some notes?" >{{$project->notes}}</textarea>
                        <button class="m-1 w-12 bg-cyan-400 text-white text-normal text-sm rounded p-1 shadow-sm hover:bg-cyan-500 active:translate-y-0.5"
                                type="submit">Save</button>
                    </div>

                </form>
            </div>
        </div>



        <div class="lg:w-1/3">
            <h3 class="font-normal text-gray-500 text-lg">General Notes</h3>
            <x-project-card :project="$project">
            </x-project-card>
        </div>



    </main>

</x-layout>

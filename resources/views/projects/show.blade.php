<x-layout>

    <header class="flex justify-between max-h-20">
        <div class="flex justify-between w-full">
            <p class="font-normal text-3xl text-gray-500 mb-8">
                <a href="/projects" class="no-underline text-gray-500">
                    My Projects
                </a> / {{$project->title}}
            </p>
{{--            <a href="/projects/create"--}}
{{--               class=" no-underline w-25 m-4 bg-cyan-400 text-white text-normal text-sm rounded p-1 shadow-sm hover:bg-cyan-500 active:translate-y-0.5"--}}
{{--            >--}}
{{--                Create new tasks--}}
{{--            </a>--}}
            <div class="flex ">
                @foreach($project->members as $member)
                    <img src="{{gravatar_url($member->name)}}"
                         height="60" width="60"
                         alt="{{$member->name}}'s avatar"
                         class="m-2 rounded-full"/>

                @endforeach
                    <img src="{{gravatar_url($project->owner->name)}}"
                         height="60" width="60"
                         alt="{{$project->owner->name}}'s avatar"
                         class="m-2 rounded-full"/>

                <a href="{{$project->path()}}/edit"
                   class=" no-underline p-2 m-4 bg-cyan-400 text-white text-sm rounded text-center shadow-sm hover:bg-cyan-500 active:translate-y-0.5">
                    Edit project
                </a>
            </div>


        </div>
    </header>
    <main class="lg:flex justify-between">

        <div class="lg:w-2/3 mr-5">
            <div class="mb-10">
                <h3 class="font-normal text-gray-500 text-lg">Task</h3>
                @foreach($tasks as $task)

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
                    <div>
                            @error('notes')
                            <p class="text-red-700">{{$message}}</p>
                            @enderror
                    </div>
                </form>
            </div>
        </div>



        <div class="lg:w-1/3">
            <h3 class="font-normal text-gray-500 text-lg">General Notes</h3>
            <x-project-card :project="$project"/>
            @can('manage', $project)
                <x-activity.invite_card :project="$project"/>
            @endcan
            <x-activity.card :project="$project"/>

        </div>



    </main>

</x-layout>

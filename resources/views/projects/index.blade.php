<x-layout>
<header class=" items-center flex justify-between">
    <h2 class="font-normal text-gray-500 text-default">My Projects</h2>
    <p class=>
        <a href="/projects/create">
            <button type="submit" class="button"  href="/projects/create">Create new project</button>
        </a>
    </p>
</header>
    <main class="lg:flex lg:flex-wrap -mx-4">
        @forelse($projects as $project)
            <div class="lg:w-1/3 px-3 pb-6">
                <div class="card bg-card">
                    <h3 class="header_card">
                        <a href="{{$project->path()}}" class="no-underline text-default">
                        {{\Illuminate\Support\STR::limit($project->title, 30)}}
                        </a>
                    </h3>
                    <div class="text-default">{{ \Illuminate\Support\STR::limit($project->description, 100)}}</div>
                    @can('manage', $project)

                    <footer>
                    <form method="POST" action="{{$project->path()}}" class="text-right">
                        @csrf
                        @method('DELETE')
                    <button type="submit" class=" button">Delete</button>
                    </form>
                    </footer>
                    @endcan
                </div>
            </div>

        @empty
            <div>
                <h3>
                No project yet
                </h3>
            </div>
        @endforelse
    </main>



</x-layout>

<x-layout>
<header class=" items-center flex justify-between">
    <h2 class="font-normal text-gray-500">My Projects</h2>
    <p class=>
        <a href="/projects/create">
            <button type="submit" class="m-4 bg-cyan-400 text-white rounded p-1 shadow-sm hover:bg-cyan-500 active:translate-y-0.5"  href="/projects/create">Create new project</button>
        </a>
    </p>
</header>
    <main class="lg:flex lg:flex-wrap -mx-4">
        @forelse($projects as $project)
            <div class="lg:w-1/3 px-3 pb-6">
                <div class="card">
                    <h3 class="header_card">
                        <a href="{{$project->path()}}" class="no-underline text-black">
                        {{\Illuminate\Support\STR::limit($project->title, 15)}}
                        </a>
                    </h3>
                    <div class="text-gray-400">{{ \Illuminate\Support\STR::limit($project->description, 100)}}</div>
                    <footer>
                    <form method="POST" action="{{$project->path()}}" class="text-right">
                        @csrf
                        @method('DELETE')
                    <button type="submit" class=" w-1/4 m-1 bg-cyan-400 text-white rounded p-1 shadow-sm hover:bg-cyan-500 active:translate-y-0.5">Delete</button>
                    </form>
                    </footer>
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

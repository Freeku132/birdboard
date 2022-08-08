<x-layout>
<div class=" items-center">

    <p><a href="/projects/create">Create another one project!</a> </p>
</div>
    <div class="flex">
        @forelse($projects as $project)
        <div class="bg-white m-lg-3 rounded-2 shadow w-1/3 p-3">
            <h3 class="font-normal text-xl mb-4 py-2">{{$project->title}}</h3>
            <div class="text-gray-400">{{ \Illuminate\Support\STR::limit($project->description, 100)}}</div>
        </div>
        @empty
            <div>
                <h3>
                No project yet
                </h3>
            </div>
        @endforelse
    </div>
</x-layout>

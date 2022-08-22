@props(['project'])
<div class="card flex flex-col">
    <h3 class="header_card">
        <a href="{{$project->path()}}" class="no-underline text-default flex-1">
            {{$project->title}}
        </a>
    </h3>
    <div class="text-gray-400 flex-1">{{$project->description}}</div>
    @can('manage', $project)
    <footer>
        <form method="POST" action="{{$project->path()}}" class="text-right">
            @csrf
            @method('DELETE')
            <button type="submit" class=" w-1/4 m-1 bg-cyan-400 text-white rounded p-1 shadow-sm hover:bg-cyan-500 active:translate-y-0.5">Delete</button>
        </form>
    </footer>
    @endcan

</div>

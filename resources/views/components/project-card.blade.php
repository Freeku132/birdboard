@props(['project'])
<div class="card">
    <h3 class="header_card">
        <a href="{{$project->path()}}" class="no-underline text-black">
            {{\Illuminate\Support\STR::limit($project->title, 15)}}
        </a>
    </h3>
    <div class="text-gray-400">{{ \Illuminate\Support\STR::limit($project->description, 100)}}</div>
</div>

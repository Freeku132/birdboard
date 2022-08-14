<x-layout>

    <h1>Birdboard</h1>

    <div class="mt-8">
        <form method="POST" action="{{$project->path()}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <h3>Title:</h3>
            <input type="text" name="title" id="title" value="{{$project->title}}" required><br/>
            <h3>Description</h3>
            <textarea type="text" name="description" id="description" required>{{$project->description}}</textarea><br/>
            <button type="submit" class="mt-2 bg-cyan-400 text-white rounded p-1 shadow-sm hover:bg-cyan-500 active:translate-y-0.5">Create!</button><br/>
            <a href="/projects">Back to projects</a>
        </form>
    </div>
    <div class="field">
{{--        @error('title')--}}
{{--        <p class="text-red-700">{{$message}}</p>--}}
{{--        @enderror--}}
        @if ($errors->any())
            @foreach($errors->all() as $error)
               <li class="text-red-700">{{$error}}</li>
            @endforeach
        @endif
    </div>
</x-layout>

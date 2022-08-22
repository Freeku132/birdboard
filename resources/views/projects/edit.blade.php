<x-layout>

    <h1>Birdboard</h1>

    <div class="mt-8">
        <form method="POST" action="{{$project->path()}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="card w-2/3 text-default">
            <h3>Title:</h3>
            <input type="text" class="bg-card border-2 border-border rounded" name="title" id="title" value="{{$project->title}}" required><br/>
            <h3>Description</h3>
            <textarea type="text" class="bg-card border-2 border-border rounded" name="description" id="description" required>{{$project->description}}</textarea><br/>
            <button type="submit" class="button w-1/12">Create!</button><br/>
            <a href="/projects">Back to projects</a>
            </div>
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

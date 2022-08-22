<x-layout>

<h1>Birdboard</h1>

<div class="mt-8">
<form method="POST" action="/projects" enctype="multipart/form-data">
    @csrf
    <div class="card text-default">
    <h3>Title:</h3>
    <input type="text" class="bg-card border-2 border-border rounded" name="title" id="title" value="{{old('title')}}" required><br/>
    <h3>Description</h3>
    <textarea type="text" class="bg-card border-2 border-border rounded" name="description" id="description" required>{{old('description')}}</textarea><br/>
    <button type="submit" class="button w-1/12">Create!</button><br/>
    <a href="/projects">Back to projects</a>
    </div>
</form>
</div>
    @if ($errors->any())
        @foreach($errors->all() as $error)
            <li class="text-red-700">{{$error}}</li>
        @endforeach
    @endif
</x-layout>


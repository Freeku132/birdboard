<x-layout>

<h1>Birdboard</h1>

<div class="mt-8">
<form method="POST" action="/projects/store" enctype="multipart/form-data">
    @csrf
    <h3>Title:</h3>
    <input type="text" name="title" id="title" value="{{old('title')}}"><br/>
    <h3>Description</h3>
    <textarea type="text" name="description" id="description">{{old('description')}}</textarea><br/>
    <button type="submit" class="mt-2 rounded-2">Create!</button><br/>
    <a href="/projects">Back to projects</a>
</form>
</div>
</x-layout>
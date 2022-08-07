<!doctype html>

<title>Birdboard</title>
{{--<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">--}}
{{--<link rel="preconnect" href="https://fonts.gstatic.com">--}}
{{--<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">--}}
{{--<script src="//unpkg.com/alpinejs" defer></script>--}}

<style>
    html
    {
        scroll-behavior: smooth;
    }
</style>

<body style="font-family: Open Sans, sans-serif">
<h1>Birdboard</h1>

<ul>
@forelse($projects as $project)
    <li>
        <a href="{{$project->path()}}">{{$project->title}}</a>
    </li>
    @empty
    <li>No project yet</li>
    @endforelse
</ul>

</body>

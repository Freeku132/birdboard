@props(['activity'])
<h5>You created a new task</h5>
<h6 class="">{{$activity->updated_at->diffForHumans()}}</h6>

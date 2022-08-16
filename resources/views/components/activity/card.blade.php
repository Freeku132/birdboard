@props(['project'])
<div class="mt-5 card">
    <h3 class="header_card">Last Activity</h3>
    <ul>
        @foreach($project->activity as $activity)
            <li class="text-xs {{$loop->last ? '' : 'mb-6'}}">
                @if($activity->description == 'created')
                    <h5>You created a new project</h5>
                    <h6 class="text-gray-500">{{$activity->updated_at->diffForHumans()}}</h6
                @elseif($activity->description == 'created_task')
                    <h5>You created a "{{$activity->subject->body}}"</h5>
                    <h6 class="text-gray-500">{{$activity->updated_at->diffForHumans()}}</h6>
                @elseif($activity->description == 'updated_task')
                    <h5>You updated a "{{$activity->subject->body}}"</h5>
                    <h6 class="text-gray-500">{{$activity->updated_at->diffForHumans()}}</h6>
                @elseif($activity->description == 'completed_task')
                    <h5>You completed a "{{$activity->subject->body}}"</h5>
                    <h6 class="text-gray-500">{{$activity->updated_at->diffForHumans()}}</h6>
                @elseif($activity->description == 'incompleted_task')
                    <h5>You incompleted a "{{$activity->subject->body}}"</h5>
                    <h6 class="text-gray-500">{{$activity->updated_at->diffForHumans()}}</h6>
                @elseif($activity->description == 'updated')
                    <h5>Before: {{$activity->changes['before']['notes'] ? $activity->changes['before']['notes'] : 'Null'}}</h5>
                    <h5>After: {{$activity->changes['after']['notes']}}</h5>
                    <h6 class="text-gray-500">{{$activity->updated_at->diffForHumans()}}</h6>
                @else
                    <p class="mr-3">{{$activity->description}}</p>
                    <p>{{$activity->updated_at->diffForHumans()}}</p>

                @endif
            </li>
        @endforeach
    </ul>
</div>

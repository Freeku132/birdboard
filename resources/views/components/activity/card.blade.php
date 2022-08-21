@props(['project'])
<div class="mt-3 card">
    <h3 class="header_card">Last Activity</h3>
    <ul>
        @foreach($project->activity as $activity)

            <li class="text-xs {{$loop->last ? '' : 'mb-6'}}">
                @if($activity->description == 'created_project')
                    <h5>{{auth()->id()==$activity->user->id ? 'You' : $activity->user->name}} created a new project</h5>
                    <h6 class="text-gray-500">{{$activity->updated_at->diffForHumans()}}</h6
                @elseif($activity->description == 'created_task')
                    <h5>{{auth()->id()==$activity->user->id ? 'You' : $activity->user->name}} created a "{{$activity->subject->body}}"</h5>
                    <h6 class="text-gray-500">{{$activity->updated_at->diffForHumans()}}</h6>
                @elseif($activity->description == 'updated_task')
                    <h5>{{auth()->id()==$activity->user->id ? 'You' : $activity->user->name}} updated a "{{$activity->subject->body}}"</h5>
                    <h6 class="text-gray-500">{{$activity->updated_at->diffForHumans()}}</h6>
                @elseif($activity->description == 'completed_task')
                    <h5>{{auth()->id()==$activity->user->id ? 'You' : $activity->user->name}} completed a "{{$activity->subject->body}}"</h5>
                    <h6 class="text-gray-500">{{$activity->updated_at->diffForHumans()}}</h6>
                @elseif($activity->description == 'incompleted_task')
                    <h5>{{auth()->id()==$activity->user->id ? 'You' : $activity->user->name}} incompleted a "{{$activity->subject->body}}"</h5>
                    <h6 class="text-gray-500">{{$activity->updated_at->diffForHumans()}}</h6>
                @elseif($activity->description == 'updated_project')
                        @isset($activity->changes['after']['notes'])
                            <h5>{{auth()->id()==$activity->user->id ? 'You' : $activity->user->name}} updated a notes</h5>
                            <h6>{{$project->notes != $activity->changes['after']['notes'] ? "After:". $activity->changes['after']['notes'] : ''}}</h6>
                            <h6>Before: {{$activity->changes['before']['notes'] ? $activity->changes['before']['notes'] : 'Null'}}</h6>
                        @endisset
                        @isset($activity->changes['after']['title'])
                                <h5>{{auth()->id()==$activity->user->id ? 'You' : $activity->user->name}} updated a title</h5>
                                <h6>{{$project->title != $activity->changes['after']['title'] ? "After:". $activity->changes['after']['title'] : ''}}</h6>
                                <h6>Before: {{$activity->changes['before']['title'] ? $activity->changes['before']['title'] : 'Null'}}</h6>
                        @endisset
                            @isset($activity->changes['after']['description'])
                                <h5>{{auth()->id()==$activity->user->id ? 'You' : $activity->user->name}} updated a description</h5>
                                <h6>{{$project->description != $activity->changes['after']['description'] ? "After:". $activity->changes['after']['description'] : ''}}</h6>
                                <h6>Before: {{$activity->changes['before']['description'] ? $activity->changes['before']['description'] : 'Null'}}</h6>
                            @endisset
                    <h6 class="text-gray-500">{{$activity->updated_at->diffForHumans()}}</h6>
                @else
                    <p class="mr-3">{{$activity->description}}</p>
                    <p>{{$activity->updated_at->diffForHumans()}}</p>

                @endif
            </li>
        @endforeach
    </ul>
</div>

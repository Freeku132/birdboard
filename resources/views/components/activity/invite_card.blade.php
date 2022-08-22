@props(['project'])
<div class="card flex flex-col mt-3">
    <h2 class="header_card">
       Invite memebers
    </h2>
    <div>
        <form method="POST" action="{{$project->path().'/invitations'}}" class=>
            @csrf
            @method('POST')
            <input type="text" name="email" id="email" class="border-2 border-border p-0.5 rounded-3 w-full bg-card" placeholder="Email"/>
            <footer>
                <div class="text-right mt-1">
            <button type="submit" class=" w-1/4 m-1 bg-cyan-400 text-white rounded p-1 shadow-sm hover:bg-cyan-500 active:translate-y-0.5">Invite</button>
                </div>
            </footer>
        </form>
{{--        @error('email')--}}
{{--        <p class="text-red-700">{{$message}}</p>--}}
{{--        @enderror--}}
        @if ($errors->invitations->any())
            @foreach($errors->invitations->all() as $error)
                <li class="text-red-700">{{$error}}</li>
            @endforeach
        @endif
    </div>
</div>

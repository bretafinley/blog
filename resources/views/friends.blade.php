@extends('app')

@section('content')

@foreach($players as $player)

<div class="row">
<div class="col-md-2"></div>
<div class="well col-md-8 friend-well">
    <div class="col-md-4">
        <img src="{{ $player["avatarfull"]}}" class="img-responsive center-block" />
    </div>
    <div class="col-md-8">
        {{ $player["personaname"] }}<br />
        Last Online: {{ date("m-d-Y", $player["lastlogoff"]) }}<br />
        @if($player["personastate"] == 0)
            <span class="offline">Offline</span>
        @elseif($player["personastate"] == 1)
            <span class="online">Online</span>
        @elseif($player["personastate"] == 2)
            <span class="busy">Busy</span>
        @elseif($player["personastate"] == 3)
            <span class="away">Away</span>
        @elseif($player["personastate"] == 4)
            <span class="snooze">Snooze</span>
        @elseif($player["personastate"] == 5)
            <span class="trade">Looking to Trade</span>
        @else
            <span class="play">Looking to Play</span>
        @endif
    </div>
</div>
</div>

@endforeach

@stop

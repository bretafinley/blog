@extends('app')

@section('content')

<div class="col-md-2"></div>
<div class="well col-md-8 friend-well">
    <div class="col-md-4">
        <img src="{{ $avatarfull }}" class="img-responsive center-block" />
    </div>
    <div class="col-md-8">
        @if(isset($personaname))
        Username: {{ $personaname }}<br />
        @endif
        @if(isset($realname))
        Real Name: {{ $realname }}<br />
        @endif
        @if(isset($profileurl))
        <a href='{{ $profileurl }}'>Profile Link</a><br />
        @endif
        @if(isset($timecreated))
        Created: {{ date("m-d-Y", $timecreated) }}<br />
        @endif
        @if(isset($lastlogoff))
        Last Online: {{ date("m-d-Y", $lastlogoff) }}<br />
        @endif
        @if(isset($loccountrycode))
        Location: {{ $locstatecode }}, {{ $loccountrycode }}<br />
        @endif
    </div>
</div>

@stop

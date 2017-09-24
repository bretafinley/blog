
@extends('app')

@section('content')

<div class="col-md-2"></div>
<div class="well col-md-8">
    <img src="http://cdn.akamai.steamstatic.com/steam/apps/{{$AppID}}/header.jpg" class="img-responsive center-block" />
    <h3>Achievements</h3>
    <table class="table table-bordered sortable">
        <thead>
            <tr>
                <th>Icon</th>
                <th>Name</th>
                <th>Description</th>
                <th>Unlocked</th>
                <th>Percentage</th>
            </tr>
        </thead>
    <tbody>
    <?php $index = 0; ?>
    @foreach($achievements as $achievement)
        <tr>
            <td>
                @if($achievement["achieved"] == 1)
                <img src='{{ $schema[$index]["icon"] }}' />
                @else
                <img src='{{ $schema[$index]["icongray"] }}' />
                @endif
            </td>
            <td style="vertical-align:middle">{{ $achievement["name"] }}</td>
            @if(!empty($achievement["description"]))
            <td style="vertical-align:middle">{{ $achievement["description"] }}</td>
            @else
            <td style="vertical-align:middle">No Description Provided</td>
            @endif
            <td style="vertical-align:middle" align="center"><?php
                if($achievement["achieved"] == 1)
                    echo '&#10004';
                else
                    echo '&#10006';
                ?></td>
            <td style="vertical-align:middle" align="center">{{ round($percentages[$index]["percent"], 2) }}%</td>
        </tr>
    <?php $index++; ?>
    @endforeach
</div>

@stop

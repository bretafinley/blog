@extends('app')

@section('content')

<div class="col-md-2"></div>
<div class="well col-md-8">
<table class="table table-bordered table-hover sortable">
	<thead>
		<tr>
			<th>AppID</th>
			<th>Name</th>
			<th>Price</th>
		    <th>Hours Played</th>
		</tr>
	</thead>
<tbody>
<?php $totalprice = 0; use App\Steamapps; ?>
<?php $totalhours = 0; ?>
<?php $totalgames = 0; ?>
@foreach($games as $game)
<tr>
    <?php $totalgames++; ?>
    <?php $price = Steamapps::find($game["appid"])["price"]; $totalprice += $price; ?>
    <?php $hours = round($game["playtime_forever"] / 60, 2); $totalhours += $hours; ?>
    <td>{{ $game["appid"] }}</td>
	@if(Steamapps::find($game["appid"])["achievements"])
    <td><a href='/game/{{$game["appid"]}}'>{{ $game["name"] }}</a></td>
	@else
	<td>{{ $game["name"] }}</td>
	@endif
	@if(!empty($price))
	<td>{{ $price }}</td>
	@else
	<td>----</td>
	@endif
    <td>{{ $hours }}</td>
</tr>
@endforeach
</tbody>
</table>
<hr />
<div class="results pull-left col-md-6">
<strong>Total Number of Hours:</strong><br />
<strong>Number of Games:</strong><br />
<strong>Library Net Worth:</strong><br />
<strong>Average Price Per Game:</strong><br />
<strong>Average Hours Per Game:</strong><br />
</div>
<div class="results pull-right col-md-6">
<strong class="pull-right">{{ $totalhours }}</strong><br />
<strong class="pull-right">{{ $totalgames }}</strong><br />
<strong class="pull-right">${{ $totalprice }}</strong><br />
<strong class="pull-right">${{ round($totalprice / $totalgames, 2) }}</strong><br />
<strong class="pull-right">{{ round($totalhours / $totalgames, 2) }}</strong><br />
</div>
</div>

@stop

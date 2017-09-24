<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <script type='text/javascript' src='s/common.js'></script>
        <script type='text/javascript' src='s/css.js'></script>
        <script type='text/javascript' src='s/standardista-table-sorting.js'></script>
        <script type='text/javascript' src='../s/common.js'></script>
        <script type='text/javascript' src='../s/css.js'></script>
        <script type='text/javascript' src='../s/standardista-table-sorting.js'></script>
        <title>MySteamPipe</title>
    </head>
    <body style="color: white; background-color: #183F53;">
    <div class="container">
        @if(Session::has('message_info'))
            <div class="alert alert-success text-center">{{ Session::get('message_info') }}</div>
        @endif

        @if(Session::has('message_error'))
            <div class="alert alert-danger text-center">{{ Session::get('message_error') }}</div>
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
              <div class="alert alert-danger text-center">{{ $error }}</div>
            @endforeach
        @endif
        <div class="page-header" style="background-color:#183F53; border-bottom: 0px solid black; text-align:center">
            <h1 style="color:black;">My Steam Pipe</h1>
        </div>
        <nav class="navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">MySteamPipe</a>
            </div>
            <ul class="nav navbar-nav">
                @if(Session::get('steamid'))
                <li><a href="/profile">Profile</a></li>
                <li><a href="/library">Library</a></li>
                <li><a href="/friends">Friends</a></li>
                <li><a href="/logout">Log Out</a></li>
                @else
                <li><a href="/help">Help</a></li>
                <li><a href="/about">About</a></li>
                @endif
            </ul>
            @if(!Session::get('steamid'))
            {!! Form::open(['url' => '/login']) !!}
            <form class="navbar-form navbar-right" role="login" action="/login">
                <div class="navbar-form navbar-right">
                <div class="form-group">
                    <label for="steamid">http://steamcommunity.com/id/</label>
                  <input type="text" id="steamid" name="steamid" class="form-control" placeholder="XXXXXXXX">
                </div>
                <button type="submit" class="btn btn-primary">Log In</button>
            </div>
          {!! Form::close() !!}
          @endif
        </nav>
    </div>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>

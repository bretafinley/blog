<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SteamAPIController;
use App\Steamapps;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'steamid' => 'required|numeric'
            ]);
        $input = $request->all();
        $id = $input["steamid"];
        $api = new SteamAPIController();
        $array = array();
        array_push($array, $id);
        $data = $api->getPlayerSummaries($array)["response"]["players"];

        if(empty($data))
        {
            Session::flash('message_error', 'Error: Invalid Steam ID');
            return redirect('/');
        }

        $data = $data[0];
        if($data["communityvisibilitystate"] == -1)
        {
            Session::flash('message_error', 'Error: Your Profile is not Completely Visible');
            return redirect('/');
        }

        Session::put('steamid', $id);

        Session::flash('message_info', 'Successfully Logged In');
        return redirect('/');
    }

    public function logout()
    {
        Session::forget('steamid');
        Session::flash('message_info', 'Successfully Logged Out');
        return redirect('/');
    }

    public function library()
    {
        if(!Session::has('steamid'))
        {
            Session::flash('message_error', 'Error: Not Logged In');
            return redirect('/');
        }

        $steamid = Session::get('steamid');
        $api = new SteamAPIController();
        $data = $api->getLibraryVerbose((string)$steamid);
        $data = $data["response"];
        return view('library', $data);
    }

    public function friends()
    {
        if(!Session::has('steamid'))
        {
            Session::flash('message_error', 'Error: Not Logged In');
            return redirect('/');
        }

        $steamid = Session::get('steamid');
        $api = new SteamAPIController();
        $data = NULL;

        try {
            $data = $api->getFriends((string)$steamid);
        } catch (\Exception $e) {
            Session::flash('message_error', 'Error: Profile Not Completely Visible');
            return redirect('/');
        }

        $friends = $data["friendslist"];
        $friends = $friends["friends"];
        $array = array();
        foreach($friends as $friend)
        {
            array_push($array, $friend["steamid"]);
        }

        $data = $api->getPlayerSummaries($array);
        $data = $data["response"];

        return view('friends', $data);
    }
}

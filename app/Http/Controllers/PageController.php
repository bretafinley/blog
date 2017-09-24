<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SteamAPIController;
use App\Http\Requests;
use Session;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function game($AppID)
    {
        if(!Session::has('steamid'))
        {
            return redirect('/');
        }

        $api = new SteamAPIController();
        $SteamID = Session::get("steamid");

        $data["achievements"] = $api->getAchievements($SteamID, $AppID)["playerstats"]["achievements"];
        $data["schema"] = $api->getSchema($AppID)["game"]["availableGameStats"]["achievements"];
        $data["percentages"] = $api->getAchievementPercentage($AppID)["achievementpercentages"]["achievements"];
        $data["SteamID"] = $SteamID;
        $data["AppID"] = $AppID;

        return view('game', $data);
    }

    public function profile()
    {
        if(!Session::has('steamid'))
        {
            return redirect('/');
        }

        $api = new SteamAPIController();
        $SteamID = Session::get("steamid");
        $array = array();
        array_push($array, $SteamID);
        $data = NULL;

        try {
            $data = $api->getPlayerSummaries($array)["response"]["players"][0];
        } catch (\Exception $e) {
            Session::flash('message_error', 'Error: Your profile is not completely visible.');
            return redirect('/');
        }

        return view('profile', $data);
    }
}

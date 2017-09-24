<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SteamAPIController extends Controller
{
    private $apikey = "9B2F458F83603FD76DC7DC63CB132782";

    //***********************************************************
    // USER FUNCTIONS
    //***********************************************************
    public function getFriends($steamid)
    {
        $url = 'http://api.steampowered.com/ISteamUser/GetFriendList/v0001/?key=' . $this->apikey . '&steamid=' . $steamid . '&relationship=friend';
        $json = file_get_contents($url);
        $data = json_decode($json, true);
        return $data;
    }

    public function getStatsForGame($steamid, $appid)
    {
        $url = 'http://api.steampowered.com/ISteamUserStats/GetUserStatsForGame/v0002/?appid=' . $appid . '&key=' . $this->apikey . '&steamid=' . $steamid;
        $json = file_get_contents($url);
        $data = json_decode($json, true);
        return $data;
    }

    public function getLibraryVerbose($steamid)
    {
        $url = 'http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=' . $this->apikey . '&steamid=' . $steamid . '&format=json&include_appinfo=1&include_played_free_games=1';
        $json = file_get_contents($url);
        $data = json_decode($json, true);
        return $data;
    }

    public function getLibraryPlain($steamid)
    {
        $url = 'http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=' . $this->apikey . '&steamid=' . $steamid . '&format=json';
        $json = file_get_contents($url);
        $data = json_decode($json, true);
        return $data;
    }

    public function getAchievements($steamid, $appid)
    {
        $url = 'http://api.steampowered.com/ISteamUserStats/GetPlayerAchievements/v0001/?appid=' . $appid . '&key=' . $this->apikey . '&steamid=' . $steamid . '&l=english';
        $json = file_get_contents($url);
        $data = json_decode($json, true);
        return $data;
    }

    public function getPlayerSummaries($steamids)
    {
        $cdl = join(',', $steamids);
        $url = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=' . $this->apikey . '&steamids=' . $cdl;
        $json = file_get_contents($url);
        $data = json_decode($json, true);
        return $data;
    }

    //***********************************************************
    // GAME FUNCTIONS
    //***********************************************************

    public function getAchievementPercentage($appid)
    {
        $url = 'http://api.steampowered.com/ISteamUserStats/GetGlobalAchievementPercentagesForApp/v0002/?gameid=' . $appid . '&format=json';
        $json = file_get_contents($url);
        $data = json_decode($json, true);
        return $data;
    }

    public function getGlobalStatsForGame($appid)
    {
        $url = 'http://api.steampowered.com/ISteamUserStats/GetGlobalStatsForGame/v0001/?format=json&appid=' . $appid . '&count=1&name';
        $json = file_get_contents($url);
        $data = json_decode($json, true);
        return $data;
    }

    public function getSchema($appid)
    {
        $url = 'http://api.steampowered.com/ISteamUserStats/GetSchemaForGame/v2/?key=' . $this->apikey . '&appid=' . $appid;
        $json = file_get_contents($url);
        $data = json_decode($json, true);
        return $data;
    }

    public function getNews($appid)
    {
        $url = 'http://api.steampowered.com/ISteamNews/GetNewsForApp/v0002/?appid=' . $appid . '&count=3&maxlength=300&format=json';
        $json = file_get_contents($url);
        $data = json_decode($json, true);
        return $data;
    }
}

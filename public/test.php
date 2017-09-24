<?php
$steamfile =  file_get_contents("http://store.steampowered.com/search/?sort_by=&sort_order=0&page=1");
echo $steamfile;

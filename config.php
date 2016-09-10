<?php

$Title = "Unturned Server Status";

$News = "<a href=\"#\" target=\"_blank\">Status Updates</a>";

/* Google Ads */
$data_ad_enable = false; //Set to true and update the information below. :)
$data_ad_client = "ca-pub-6160285399625488";
$data_ad_slot = "2146448098";

$Status = array(
    array(
        Name => "ServerName | PvE1",
        HostName => "pve1.ut.yourdomain.com",
        Port => "27015",
        Mode => "PVE",
        //unturned-servers.net API Key
        API => "",
        Vote1 => "http://unturned-servers.net/server/<ID NUMBER>/vote",
        Vote2 => "http://unturnedsl.com/dedicated/show/<ID NUMBER>"        
    ),
    array(
        Name => "ServerName | PvP1",
        HostName => "pvp1.ut.yourdomain.com",
        Port => "27015",
        Mode => "PVP",
        //unturned-servers.net API Key
        API => "",
        Vote1 => "http://unturned-servers.net/server/<ID NUMBER>/vote",
        Vote2 => "http://unturnedsl.com/dedicated/show/<ID NUMBER>"       
    ),
    array(
        Name => "ServerName | Arena1",
        HostName => "arena1.ut.yourdomain.com",
        Port => "27015",
        Mode => "ARENA",
        //unturned-servers.net API Key
        API => "",
        Vote1 => "http://unturned-servers.net/server/<ID NUMBER>/vote",
        Vote2 => "http://unturnedsl.com/dedicated/show/<ID NUMBER>"       
    )
);

?>
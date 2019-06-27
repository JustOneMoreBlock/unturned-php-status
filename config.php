<?php
//Let's just suppress rest of the errors for now.
error_reporting( error_reporting() & ~E_NOTICE );

$Title = "Unturned Server Status";

$News = "<a href=\"#\" target=\"_blank\">Status Updates</a>";

/* Google Ads */
$data_ad_enable = false; //Set to true and update the information below. :)
$data_ad_client = "ca-pub-6160285399625488";
$data_ad_slot = "2146448098";

$Status = array(
    array(
        "ID"       => "PvE1",
        "Name"     => "Russia PvE|Kits|TPA|CallVote|Home|Vault|AirDrop",
        "HostName" => "pve1.ut.justplayhere.com",
        "Port"     => "27015",
        "Mode"     => "PVE",
        //unturned-servers.net API Key
        "API"      => "",
        "Vote1"    => "http://unturned-servers.net/server/<ID NUMBER>/vote",
        "Vote2"    => "http://unturnedsl.com/dedicated/show/<ID NUMBER>"
    ),
    array(
        "ID"       => "PvP1",
        "Name"     => "Russia PvE|Kits|TPA|CallVote|Home|Vault|AirDrop",
        "HostName" => "pvp1.ut.justplayhere.com",
        "Port"     => "27015",
        "Mode"     => "PVP",
        //unturned-servers.net API Key
        "API"      => "",
        "Vote1"    => "http://unturned-servers.net/server/<ID NUMBER>/vote",
        "Vote2"    => "http://unturnedsl.com/dedicated/show/<ID NUMBER>"    
    ),
    array(
        "ID"       => "Arena1",
        "Name"     => "Russia PvE|Kits|TPA|CallVote|Home|Vault|AirDrop",
        "HostName" => "arena1.ut.justplayhere.com",
        "Port"     => "27015",
        "Mode"     => "ARENA",
        //unturned-servers.net API Key
        "API"      => "",
        "Vote1"    => "http://unturned-servers.net/server/<ID NUMBER>/vote",
        "Vote2"    => "http://unturnedsl.com/dedicated/show/<ID NUMBER>"
    )
);

?>

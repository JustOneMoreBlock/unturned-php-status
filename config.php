<?php
//Let's just suppress rest of the errors for now.
error_reporting( error_reporting() & ~E_NOTICE );

$Title = "Unturned Server Status";

$News = "<a href=\"#\" target=\"_blank\">Status Updates</a>";

/* Google Ads */
$data_ad_enable = false; //Set to true and update the information below. :)
$data_ad_client = "ca-pub-ID";
$data_ad_slot = "ad-slot";

/* Global Enable Vote */
# Empty "Vote1" or "Vote2" to disable voting for specific vote sites.
# If you use at least one vote site. Leave this enabled.
$enable_vote = 1;

$Status = array(
    array(
        "ID"       => "PvE1",
        "Name"     => "France PvE 1 | Kits | TPA | CallVote |Home | Vault | AirDrop",
        "HostName" => "ip or domain",
        "Port"     => "27015",
        "Mode"     => "PVE",
        "API"      => "", //unturned-servers.net API Key
        "Vote1"    => "http://unturned-servers.net/server/<ID NUMBER>/vote",
        "Vote2"    => ""
    ),
    array(
        "ID"       => "PvP1",
        "Name"     => "Russia PvP 1 | Kits | TPA | CallVote |Home | Vault | AirDrop",
        "HostName" => "ip or domain",
        "Port"     => "27015",
        "Mode"     => "PVP",
        "API"      => "", //unturned-servers.net API Key
        "Vote1"    => "",
        "Vote2"    => "http://unturnedsl.com/dedicated/show/<ID NUMBER>"    
    ),
    array(
        "ID"       => "Arena1",
        "Name"     => "PEI Arena 1 | Kits | TPA | CallVote |Home | Vault | AirDrop",
        "HostName" => "ip or domain",
        "Port"     => "27015",
        "Mode"     => "ARENA",
        "API"      => "", //unturned-servers.net API Key
        "Vote1"    => "http://unturned-servers.net/server/<ID NUMBER>/vote",
        "Vote2"    => "http://unturnedsl.com/dedicated/show/<ID NUMBER>"
    )
);

?>
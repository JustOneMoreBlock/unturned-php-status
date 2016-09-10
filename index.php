<?php
require __DIR__ . '/SourceQuery/SourceQuery.class.php';
include("config.php");
?>

<!DOCTYPE html>
<head>
  <title><?php echo $Title; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/global.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

<?php
$action = filter_input(INPUT_GET, 'toggle');
if($action == "stopRefresh") {
echo "";
} else {
?>
  <script type="text/javascript">
    function startRefresh() {
      $.get('#', function(data) {
          $(document.body).html(data);    
      });
  }
      $(function() {
        setTimeout(startRefresh,30000);
  });
</script>
<?php
}
?>
</head>

<body>
  <div class="container">
    <div class="jumbotron center">
    <?php
    if($data_ad_enable == true) {
    ?>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <ins class="adsbygoogle"
        style="display:block"
        data-ad-client="<?php echo $data_ad_client; ?>"
        data-ad-slot="<?php echo $data_ad_slot; ?>"
        data-ad-format="auto"></ins>
    <script>
    (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
    <?php
	} else {
	echo "&nbsp;";
	}
	?>
      <h1><?php echo $Title; ?></h1>
      <p>Check the status of <?php echo $Title; ?>.</p>
      <a class="btn btn-info btn-lg center" href="?toggle=stopRefresh" role="button">Stop AutoRefresh</a>
      <button class="btn btn-primary btn-lg center" onclick="$('.collapse').collapse('toggle')">Toggle Collapse</button>
    </div>
    <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><div class="panel panel-default"><div class="panel-heading"><h1 class="center panel-title"><?php echo $News; ?></h1></div></div></div>

<?php

for ($Config = 0; $Config < count($Status); $Config++) {
    $TotalServers = count($Status);
    $TotalPlayers = $TotalServers * 24;
    $Name         = $Status[$Config]["Name"];
    $HostName     = $Status[$Config]["HostName"];
    $ID           = $Status[$Config]["ID"];
    $Mode         = $Status[$Config]["Mode"];
    $Port         = $Status[$Config]["Port"];
    $Vote1        = $Status[$Config]["Vote1"];
    $Vote2        = $Status[$Config]["Vote2"];
    $SourceQuery  = $Port + 1;
    
    $Query = new SourceQuery();
    
    $Info    = Array();
    $Players = Array();
    $Rocket  = Array();
    
    try {
        $Query->Connect($HostName, $SourceQuery, 1, 'SourceQuery :: SOURCE');
        $Info    = $Query->GetInfo();
        $Players = $Query->GetPlayers();
        $Rocket  = $Query->GetRules();
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }
    
    $Query->Disconnect();
    

    if ($Info["ModDesc"] >= "Unturned") {
        
        $GameTags    = explode(',', $Info["GameTags"]);
        $Combat      = $GameTags["0"];
        $Difficulty  = $GameTags["1"];
        $Prespective = $GameTags["2"];
        $SteamWorks  = $GameTags["3"];
        $Version     = $Rocket["rocket"];
        $Plugins     = str_replace(",", "<tr><td><li class=\"list-group-item\"><i class=\"fa fa-plug\"></i>&nbsp;", $Rocket["rocketplugins"]);
        
        if ($Combat == "PVE") {
            $OnlinePVE += count($Combat);
        } elseif ($Combat == "PVP") {
            $OnlinePVP += count($Combat);
        }

        if($Mode == "PVE") {
          $ModePvE += count($Mode);
        } elseif ($Mode == "PVP") {
          $ModePvP += count($Mode);
        } elseif ($Mode == "ARENA") {
          $ModeArena += count($Mode);
        }
        
        $TotalPlugins = substr_count($Rocket["rocketplugins"], ',') + 1;
        $OnlinePlayers += $Info["Players"];
        $OnlineMaxPlayers += $Info["MaxPlayers"];

?>

      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h1 class="panel-title center"><?php echo $Name; ?></h1> <div align="center" class="large"><?php echo $HostName; ?> &nbsp; <button class="btn-copy btn btn-xs btn-primary" data-clipboard-text="<?php echo $HostName; ?>"><i class="fa fa-clipboard"></i></button></div>
            <div class="btn-group btn-group-xs btn-group-justified click-actions" role="group">
              <span class="btn btn-xs btn-success" style="width:70%;">Online | Players:&nbsp;<?php echo "".$Info["Players"]."/".$Info["MaxPlayers"]."";?></span>
              <a class="btn btn-default" style="width:30%;" role="button" data-toggle="collapse" href="#Unturned<?php echo $ID;?>Vote" aria-expanded="false" aria-controls="Unturned<?php echo $ID;?>Vote"><i class="fa fa-thumbs-up"></i>&nbsp;Vote</a>
            </div>
            <div class="btn-group btn-group-xs btn-group-justified click-actions" role="group">
              <a class="btn btn-info" role="button" data-toggle="collapse" href="#Unturned<?php echo $ID;?>" aria-expanded="false" aria-controls="Unturned<?php echo $ID;?>">Click for More Info</a>
              <a href="steam://connect/<?php echo $HostName; ?>:<?php echo $SourceQuery; ?>" class="btn btn-warning">Click to Connect</a>
            </div>
          </div>
          <ul class="list-group">
            <div class="collapse" id="Unturned<?php echo $ID;?>Vote">
              <a href="<?php echo $Vote1; ?>" target="_blank" class="list-group-item list-group-item-warning"><i class="fa fa-comments"></i>&nbsp;Vote on unturned-servers.net</a>
              <a href="<?php echo $Vote2; ?>" target="_blank" class="list-group-item list-group-item-warning"><i class="fa fa-comments"></i>&nbsp;Vote on unturnedls.com</a>
            </div>
            <div class="collapse" id="Unturned<?php echo $ID;?>">
              <li class="list-group-item"><i class="fa fa-group"></i>&nbsp;Players: <b><?php echo "".$Info["Players"]."/".$Info["MaxPlayers"]."";?></b>&nbsp;&nbsp;&nbsp;<span class="label label-info" role="button" data-toggle="collapse" href="#Unturned<?php echo $ID;?>Players" aria-expanded="false" aria-controls="Unturned<?php echo $ID;?>Players">Full List</span></li>
                <div class="collapse" id="Unturned<?php echo $ID;?>Players">
                  <table class="table table-condensed table-responsive no-margin">
                    <tbody>
                    <?php if( !empty( $Players ) ): ?>
                    <?php foreach( $Players as $Player ): ?>
                      <tr>
                        <td><li class="list-group-item"><i class="fa fa-user"></i>&nbsp;<?php echo htmlspecialchars( $Player[ 'Name' ] ); ?></li></td>
                      </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="3">No players received</td>
                      </tr>
                    <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              <li class="list-group-item"><i class="fa fa-gear"></i>&nbsp;Unturned: <b><?php echo $Info["Version"]; ?></b></li>
              <li class="list-group-item"><i class="fa fa-rocket"></i>&nbsp;Rocket: <b><?php echo $Version; ?></b></li>
              <li class="list-group-item"><i class="fa fa-product-hunt"></i>&nbsp;Rocket Plugins: <b><?php echo $TotalPlugins; ?></b>&nbsp;&nbsp;&nbsp;<span class="label label-info" role="button" data-toggle="collapse" href="#Unturned<?php echo $ID;?>Plugins" aria-expanded="false" aria-controls="Unturned<?php echo $ID;?>Plugins">Full List</span></li>
                <div class="collapse" id="Unturned<?php echo $ID;?>Plugins">
                  <table class="table table-condensed table-responsive no-margin">
                    <tbody>
                    <tr>
                        <td>
                      <?php
                      echo "
                      <li class=\"list-group-item\"><i class=\"fa fa-plug\"></i>&nbsp;$Plugins</li></td>
                      </tr>";
                      ?>
                    </tbody>
                  </table>
                </div>
              <li class="list-group-item"><i class="fa fa-compass"></i>&nbsp;Map: <b><?php echo $Info["Map"]; ?></b></li>
              <li class="list-group-item"><i class="fa fa-eye"></i>&nbsp;Perspective: <b><?php echo $Prespective; ?></b></li>
              <li class="list-group-item"><i class="fa fa-wrench"></i>&nbsp;Difficulty: <b><?php echo $Difficulty; ?></b></li>
              <li class="list-group-item"><i class="fa fa-server"></i>&nbsp;IP: <b><?php echo $HostName; ?></b></li>
              <li class="list-group-item"><i class="fa fa-play"></i>&nbsp;Port: <b><?php echo $Port; ?></b></li>
            </div>
          </ul>
        </div>

      </div>

<?php
} else {
?>
      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h1 class="panel-title center"><?php echo $Name; ?> <p class="small"><?php echo $HostName; ?></p></h1>
            <div class="btn-group btn-group-xs btn-group-justified click-actions" role="group">
              <span class="btn btn-xs btn-danger" style="width:70%;">Offline</span>
              <a class="btn btn-default" style="width:30%;" role="button" data-toggle="collapse" href="#Unturned<?php echo $ID;?>Vote" aria-expanded="false" aria-controls="Unturned<?php echo $ID;?>Vote"><i class="fa fa-thumbs-up"></i>&nbsp;Vote</a>
            </div>
            <div class="btn-group btn-group-xs btn-group-justified click-actions" role="group">
              <a class="btn btn-info disabled" role="button" data-toggle="collapse" href="#Unturned<?php echo $ID;?>" aria-expanded="false" aria-controls="Unturned<?php echo $ID;?>">Click for More Info</a>
              <a href="#" class="btn btn-warning disabled">Click to Connect</a>
            </div>
          </div>
          <ul class="list-group">
            <div class="collapse" id="Unturned<?php echo $ID;?>Vote">
              <a href="<?php echo $Vote1; ?>" target="_blank" class="list-group-item list-group-item-warning"><i class="fa fa-comments"></i>&nbsp;Vote on unturned-servers.net</a>
              <a href="<?php echo $Vote2; ?>" target="_blank" class="list-group-item list-group-item-warning"><i class="fa fa-comments"></i>&nbsp;Vote on unturnedls.com</a>
            </div>
          </ul>
        </div>
      </div>
<?php
}
}

?>

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h1 class="panel-title stats center">Overall Stats</h1>
        <div class="center"><div class="btn-group" role="group">
      <span class="btn btn-primary"><i class="fa fa-group"></i> Total Players: <?php echo $TotalPlayers; ?></span>
      <span class="btn btn-primary"><i class="fa fa-globe"></i> Total Servers: <?php echo $TotalServers; ?></span>
      <span class="btn btn-info"><i class="fa fa-group"></i> Current Players: <?php echo $OnlinePlayers; ?></span>
      <span class="btn btn-info"><i class="fa fa-group"></i> Current Max Players: <?php echo $OnlineMaxPlayers; ?></span>
      </div>
      <br />
      <br />
      <div class="center"><div class="btn-group" role="group">
      <span class="btn btn-success"><i class="fa fa-globe"></i> PvE Online: <?php echo $OnlinePVE; ?></span>
      <span class="btn btn-success"><i class="fa fa-globe"></i> PvP Online: <?php echo $OnlinePVP; ?></span>
      <span class="btn btn-success"><i class="fa fa-globe"></i> Arena Online: <?php echo $ModeArena; ?></span>
      <span class="btn btn-warning"><i class="fa fa-globe"></i> Total PvE Servers: <?php echo $ModePvE; ?></span>
      <span class="btn btn-warning"><i class="fa fa-globe"></i> Total PvP Servers: <?php echo $ModePvP; ?></span>
      <span class="btn btn-warning"><i class="fa fa-globe"></i> Total Arena Servers: <?php echo $ModeArena; ?></span>
  </div>
        </div>
      </div>
    </div>
  </div>

    </div>
  </div>

  <script src="js/clipboard.min.js"></script>

    <script>
    var clipboard = new Clipboard('.btn-copy');

    clipboard.on('success', function(e) {
    console.info('Action:', e.action);
    console.info('Text:', e.text);
    console.info('Trigger:', e.trigger);

    e.clearSelection();
    });


    clipboard.on('error', function(e) {
        console.log(e);
    });
    </script>
    
</body>
</html>

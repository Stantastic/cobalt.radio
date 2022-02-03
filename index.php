<!-- lethal.network -->
<!-- Copyright (c) 2021 Stan Richter <stan@lethal.network> -->
<?php
    include ('config.php');
    require ('assets/php/steamauth/steamauth.php');

    if(!isset($_SESSION['steamid'])) {
        $logged_in = false;
    }else{
        $logged_in = true;
        include ('assets/php/steamauth/userInfo.php');
    }

    // Get a list of albums/categories
    $dir = 'tracks';
    $directories = glob($dir . '/*', GLOB_ONLYDIR);

    // Display the currently active tracks name
    $now_playing_txt = fopen('stream/live.txt','r');
    while (($line = fgets($now_playing_txt)) !== false) {
            $now_playing = $line;
    };
    fclose($now_playing_txt);

    // Build the full url for setup instructions


    $stationurl = str_replace('/index.php', '', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php if (!empty($_App_Title)) { echo $_App_Title; } ?></title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" href="assets/img/favicon.png">
        <meta name="msapplication-TileColor" content="#ce412b">
        <meta name="theme-color" content="#00f078">
        <link rel="stylesheet" href="assets/css/twitter-bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/fontawesome/all.min.css">
        <link rel="stylesheet" href="assets/css/cobalt.radio.css">
        <script src="assets/js/vendor/jquery/jquery-3.5.1.min.js"></script>
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!-- Logo -->
        <div class="container text-center mt-3 mb-3">
            <img src="assets/img/cobaltradio.png">
        </div>
        <!-- /Logo -->

        <!-- Now Playing -->
        <div class="container text-center mt-3 mb-3">
            <div class="row">
                <div class="col-6 offset-3">
                    <span class="now-playing-label font-rust">Now Playing: </span>
                    <marquee class="now-playing"><?php echo $now_playing; ?></marquee>
                </div>
            </div>
        </div>
        <!-- /Now Playing -->

        <?php
            if ($logged_in && in_array($_SESSION['steamid'],$_Station_Admin))
            {
                include('includes/menu.php');
                include('includes/tracks.php');
                include('includes/modals.php');
            }
            else
            {
        ?>
                <div class="container text-center mb-3">
                    <h5>Please log in using steam by clicking below!</h5>
                    <a href="?login"><img src="assets/img/steam_small.png"></a>
                </div>
        <?php
            }
        ?>

        <!-- Footer/Copyright Notice -->
        <div class="container p-3 text-center">
            &copy;<?php echo date('Y') . ' ' . $_App_Title; ?> | <a href="https://code.lethal.network">lethal.network</a>
        </div>
        <!-- /Footer/Copyright Notice -->

        <!-- Scripts -->
        <script src="assets/js/vendor/aos/aos.js"></script>
        <script src="assets/js/vendor/twitter-bootstrap/bootstrap.bundle.min.js"></script>
        <script>
            function c2c() {
                var copyText = document.getElementById("boomboxcmd");
                copyText.select();
                copyText.setSelectionRange(0, 99999); /* mobile fix */
                document.execCommand("copy");
            }
        </script>
        <!-- /Scripts -->
    </body>
</html>
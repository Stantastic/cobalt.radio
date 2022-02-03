<?php
include('../../config.php');
require ('steamauth/steamauth.php');

$logged_in = false;
if ($logged_in) {
    include ('assets/php/steamauth/userInfo.php');
    $steamid = $steamprofile['steamid'];
    if (in_array($steamid,$_Station_Admin)){
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
else{
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if (isset($_POST['track_path']) && isset($_POST['track_name']))
{
    $file_path = $_POST['track_path'];
    $file_name = $_POST['track_name'];
    $now_playing = preg_replace('/\\.[^.\\s]{3,4}$/', '', $file_name);

    file_put_contents('../../stream/live.txt', $now_playing);
    copy('../../' . $file_path, '../../stream/live.mp3');

    if (!empty($_Discord_NowPlaying_Hook))
    {
        $timestamp = date("c", strtotime("now"));
        $json_data = json_encode([
            "embeds" => [
                [
                    "title" => $_Station_Name,
                    "type" => "rich",
                    "description" => "♫ Now playing: " . $now_playing,
                    "timestamp" => $timestamp,
                    "color" => hexdec( "00F078" ),
                ]
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

        $ch = curl_init($_Discord_NowPlaying_Hook);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt( $ch, CURLOPT_POST, 1);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt( $ch, CURLOPT_HEADER, 0);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec( $ch );
        curl_close( $ch );
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if (isset($_POST['dir_add']))
{
    $dir_name = $_POST['dir_add'];

    mkdir('../../tracks/' . $dir_name,0777,true);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if (isset($_POST['del_album']))
{
    $album_name = $_POST['del_album'];
    $files = glob(dirname(__FILE__).'/../../tracks/' . $album_name . '/*');
    foreach ($files as $file) {
        unlink($file);
    }
    rmdir(dirname(__FILE__).'/../../tracks/' . $album_name);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if (isset($_POST['del_track']))
{
    $track_name = $_POST['del_track'];
    unlink(dirname(__FILE__). '/../../' . $track_name);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if (isset($_POST['upload_album']))
{
    $album = $_POST['upload_album'];

    $target_dir = "uploads/";
    $target_file = '../../tracks/' . $album . '/' . basename($_FILES["fileToUpload"]["name"]);

    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
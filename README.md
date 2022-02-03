##### Important: This will not have any purpose if you don't have access to the server console i.e. you are just a player!

# Cobalt Radio ♫
CobaltRadio is a simple user interface to upload mp3s to your webserver and then play it in RUST.
### Features
- 'now playing' discord webhook support
- no database requirement
- steam admin login

### READ!
> This was a quick project! The only authorization
> is using steam as a login. Do not give players
> access to this, except you want to have all their
> porn and russian trojans on your web server! The is
> no feedback(popups/alerts) on actions beeing executed
> if you use it without messing around nothing will break!

The following files & folder need to be readable & writable,
you can check this by going to `Setup Instructions > Check Permissions`.
I recommend to run `chmod -R 777 /CobaltRadio` if you run into permission issues!

- `stream/`
- `stream/live.mp3`
- `stream/live.txt`
- `tracks/`

There is no complicated databse setup only one simple config file calle `config.cfg` which should be self explainatory,
```sh
    // Website Title
    $_App_Title                 = "Cobalt Radio ♫";
    // Website URL
    $_App_URL                   = "https://cobalt.radio";
    // In-Game Station Name
    $_Station_Name              = "Cobalt Radio ♫";
    // Get it here: http://steamcommunity.com/dev/apikey
    $_Steam_API_Token           = "";
    // List of Steam IDs with administrative access
    $_Station_Admin             = array("76561198086994761", "");
    // Add a webhook to post 'NowPlaying' to Discord: https://support.discord.com/hc/en-us/articles/228383668-Intro-to-Webhooks, leave empty to disable
    $_Discord_NowPlaying_Hook   = "";
```

###File Uploads

If you run into trouble with file uploads or filesize limits:

####nginx 
- add this to your vhost.conf file `client_max_body_size 20M;`
- /etc/nginx/`sites-enabled`

####apache 
- edit the `.htaccess` file to your liking


#### Still stuck?

For support reach out to `Stantastic#2021` on Discord!
<!-- Setup Modal -->
<div class="modal" tabindex="-1" id="setupModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header text-center font-rust">
                <h5 class="modal-title"><i class="fas fa-wrench"></i> Setup Instructions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">

                RUST requires administrators to whitelist a radio stream for a server. Copy the below command and run it in the servers console or request it to be run if your are not a server administrator.

                <div class="container text-center mt-3">
                    <code class="mt-2">boombox.serverurllist "<?php echo $_Station_Name; ?>,<?php echo $stationurl; ?>/stream/live.mp3"</code>
                    <i onclick="c2c()" class="fas fa-copy" style="cursor: pointer;"></i>

                    <input type="text" hidden value='boombox.serverurllist "<?php echo $_Station_Name; ?>,<?php echo $stationurl; ?>/stream/live.mp3"' id="boomboxcmd">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#limitationModal">Software Limitations</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal" data-toggle="modal" data-target="#permissionModal">Check File Permissions</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- /Setup Modal -->

<!-- File Permissions Modal -->
<div class="modal" tabindex="-1" id="permissionModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header text-center font-rust">
                <h5 class="modal-title"><i class="fas fa-shield-alt"></i> File Permissions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                In order to copy/remove/upload tracks on/from/to the server files and folders need <br>
                the correct read/write permissions, make sure to check below!
                <div class="container text-center mt-3">
                    Streaming:<br>
                    <code>stream/</code><span class="badge badge-<?php echo is_writable( "stream" ) ? 'success' : 'danger'; ?>"><?php echo is_writable( "stream" ) ? 'writable' : 'not writable'; ?></span><br>
                    <code>stream/live.mp3</code><span class="badge badge-<?php echo is_writable( "stream/live.mp3" ) ? 'success' : 'danger'; ?>"><?php echo is_writable( "stream/live.mp3" ) ? 'writable' : 'not writable'; ?></span><br>
                    <code>stream/live.txt</code><span class="badge badge-<?php echo is_writable( "stream/live.txt" ) ? 'success' : 'danger'; ?>"><?php echo is_writable( "stream/live.txt" ) ? 'writable' : 'not writable'; ?></span><br>
                    <br>
                    Track Storage:<br>
                    <code>tracks/</code><span class="badge badge-<?php echo is_writable( "tracks" ) ? 'success' : 'danger'; ?>"><?php echo is_writable( "tracks" ) ? 'writable' : 'not writable'; ?></span><br>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- /File Permissions Modal -->

<!-- Limitations Modal -->
<div class="modal" tabindex="-1" id="limitationModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header text-center font-rust">
                <h5 class="modal-title"><i class="fas fa-sliders-h"></i> Software Limitations</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <div class="container text-center mt-3">

                    This software/user-interface is <b>no streaming server</b> by any means. There is no continuous<br>
                    audio stream, this means once you have started playing the next track players will have to<br>
                    stop and start their boombox, everytime the track is switched. Think of it more as a cd or<br>
                    cassette player, you turn it off, switch the media and then turn it on again.<br>
                    <br>
                    <b>dev-fact:</b><br>
                    The way it works is by overwriting <code>/stream/live.mp3</code> with a previously uploaded track.<br>
                    <br>
                    <b>lazy-fact:</b><br>
                    There is no step-by-step installation, no fancy flash messages and no confirmation pop-ups.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- /Limitations Modal -->

<!-- Upload Modal -->
<div class="modal" tabindex="-1" id="uploadModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="assets/php/app.php" method="post" enctype="multipart/form-data">
                <div class="modal-header text-center font-rust">
                    <h5 class="modal-title"><i class="fas fa-upload"></i> Upload a new Track</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <code>
                        For the sake of simplicity of this there are no checks made on files uploaded!<br>
                        The only sound files that will work however are <b>.mp3</b> files!
                    </code>
                    <div class="container text-center mt-3">
                        <div class="row">
                            <div class="col-6">
                                <select class="custom-select custom-select-md mb-3" name="upload_album">
                                    <option selected>Select Album/Category</option>
                                    <?php
                                    foreach ($directories as $album)
                                    {
                                        $album_name = explode("/", $album);
                                        echo '<option value="' . $album_name[1] . '">' . $album_name[1] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-6">
                                <input type="file" name="fileToUpload" id="fileToUpload">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Upload</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Upload Modal -->

<!-- Add Directory Modal -->
<div class="modal" tabindex="-1" id="addDirModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form method="post" action="assets/php/app.php">
                <div class="modal-header text-center font-rust">
                    <h5 class="modal-title"><i class="fas fa-folder-plus"></i> Add new Directory</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">

                    Add a new Album/Directory to keep your tracks sorted nicely!

                    <div class="container text-center mt-3">

                        <input class="w-75 text-center text-input" type="text" name="dir_add" placeholder="Best of RUST">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<!-- /Add Directory Modal -->

<div class="container">
    <div class="accordion" id="accordion">
    <?php
        $dir = 'tracks';
        $directories = glob($dir . '/*', GLOB_ONLYDIR);
        foreach($directories as $dirpath)
        {
            $dir  = explode("/", $dirpath);
            ?>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-11"  data-toggle="collapse" data-target="#collapse<?php echo str_replace(' ', '_', $dir[1]);?>" style="cursor: pointer;">
                            <h3 class="my-auto">
                            <i class="fas fa-folder-open"></i>
                            <?php echo $dir[1] ?>
                            </h3>
                        </div>
                        <div class="col-1 text-right">
                            <form method="post" action="assets/php/app.php">
                                <input type="text" hidden name="del_album" value="<?php echo $dir[1] ?>">
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                $scanned_dir= scandir($dirpath);
                $tracks = array_diff(scandir($dirpath), array('..', '.'));
                foreach ($tracks as $track)
                {
                    ?>
                    <div id="collapse<?php echo str_replace(' ', '_', $dir[1]);?>"  class="collapse tb">
                        <div class="card-body">
                            <div class="row font-weight-bold">
                                <div class="col-10 my-auto">
                                    <span class="align-middle"><i class="fas fa-fw fa-music"></i> <?php echo $track; ?></span>
                                </div>
                                <div class="col-2">
                                    <form method="post" action="assets/php/app.php">
                                        <input type="text" name="track_name" hidden value="<?php echo $track; ?>">
                                        <input type="text" name="track_path" hidden value="<?php echo $dirpath . '/' . $track; ?>">
                                        <div class="btn-group float-right" role="group">
                                            <button type="submit" class="btn btn-success"><i class="fas fa-play-circle"></i></button>
                                    </form>
                                    <form method="post" action="assets/php/app.php">
                                        <button type="submit" class="btn bff btn-danger"><i class="fas fa-trash"></i></button>
                                        </div>
                                        <input type="text" name="del_track" hidden value="<?php echo $dirpath . '/' . $track; ?>">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        <?php
        }
    ?>
    </div>
</div>
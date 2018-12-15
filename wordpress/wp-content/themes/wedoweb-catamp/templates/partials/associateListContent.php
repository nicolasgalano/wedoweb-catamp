<?php
    $div = ceil(count($associatelist_list)/3);
    $columns = array();
    for($i = 0; $i < 3; $i++) {
        $content = array();
        for($c = $i*$div; $c < ($i+1)*$div; $c++) {
            if(isset($associatelist_list[$c])) {
                array_push($content, $associatelist_list[$c]);
            }
        }
        array_push($columns, $content);
    }

    $columns2 = array();
    if(isset($associatelist2_list)) {
        $div2 = ceil(count($associatelist2_list)/3);
        for($i = 0; $i < 3; $i++) {
            $content = array();
            for($c = $i*$div2; $c < ($i+1)*$div2; $c++) {
                if(isset($associatelist2_list[$c])) {
                    array_push($content, $associatelist2_list[$c]);
                }
            }
            array_push($columns2, $content);
        }
    }
?>
<div class="section-row row-asociados"
    <?php if($associatelist_setId){ ?> id="<?php echo $associatelist_setId; ?>"<?php } ?>
    >
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h2><?php echo $associateslist_title; ?></h2>
            </div>
            <?php
            if($columns[0]) {
                ?>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <ul class="asociados">
                    <?php
                    foreach($columns[0] as $content) {
                        ?>
                        <li>
                            <p><?php echo $content; ?></p>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <?php
            }
            ?>
            <?php
            if($columns[1]) {
                ?>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <ul class="asociados">
                    <?php
                    foreach($columns[1] as $content) {
                        ?>
                        <li>
                            <p><?php echo $content; ?></p>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <?php
            }
            ?>
            <?php
            if($columns[2]) {
                ?>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <ul class="asociados">
                    <?php
                    foreach($columns[2] as $content) {
                        ?>
                        <li>
                            <p><?php echo $content; ?></p>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <?php
            }
            if(count($columns2)) {
            ?>
            <div class="col-xs-12">
                <h2><?php echo $associateslist2_title; ?></h2>
            </div>
            <?php
            }
            ?>
            <?php
            if(isset($columns2[0])) {
                ?>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <ul class="adherentes">
                        <?php
                        foreach($columns2[0] as $content) {
                            ?>
                            <li>
                                <p><?php echo $content; ?></p>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
                <?php
            }
            ?>
            <?php
            if(isset($columns2[1])) {
                ?>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <ul class="adherentes">
                        <?php
                        foreach($columns2[1] as $content) {
                            ?>
                            <li>
                                <p><?php echo $content; ?></p>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
                <?php
            }
            ?>
            <?php
            if(isset($columns2[2])) {
                ?>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <ul class="adherentes">
                        <?php
                        foreach($columns2[2] as $content) {
                            ?>
                            <li>
                                <p><?php echo $content; ?></p>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
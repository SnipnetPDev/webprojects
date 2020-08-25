<?php 
$basename = basename($_SERVER["SCRIPT_FILENAME"], '.php');
if($basename == "help") {
?>
<div class="col-xl-8">
 <h4 class="u-h6 u-text-bold u-mb-xsmall">FAQ</h4>
 <article class="c-stage" id="stages">
<?php 
$sel_query="Select * from help ORDER BY id desc;";
$result = $con->query($sel_query) or die($con->error);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
 ?>
                            <a class="c-stage__header u-flex u-justify-between" href="#stage-panel<?php echo $row["id"]; ?>" data-toggle="collapse" aria-expanded="false" aria-controls="stage-panel<?php echo $row["id"]; ?>">
                                <div class="o-media">
                                    <div class="c-stage__header-title o-media__body">
                                        <h6 class="u-mb-zero"><?php echo $row["question"]; ?></h6>
                                    </div>
                                </div>
                                
                                <i class="fa fa-angle-down u-text-mute"></i>
                            </a>
 <div class="c-stage__panel c-stage__panel--mute collapse" id="stage-panel<?php echo $row["id"]; ?>" style="padding:20px;">
<?php echo $row["answer"]; ?>
							</div>
<?php
}
}else {
   echo "<div class='c-alert c-alert--warning alert'><i class='c-alert__icon fa fa-times-circle'></i> No data found <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
}
?>
</article><!-- // .c-stage -->
 </div>
<?php 
}else {
?>
<div class="col-xl-4">
 <h4 class="u-h6 u-text-bold u-mb-xsmall">FAQ</h4>
 <article class="c-stage" id="stages">
<?php 
$sel_query="Select * from help ORDER BY id desc LIMIT 5;";
$result = $con->query($sel_query) or die($con->error);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
 ?>
                            <a class="c-stage__header u-flex u-justify-between" href="#stage-panel<?php echo $row["id"]; ?>" data-toggle="collapse" aria-expanded="false" aria-controls="stage-panel<?php echo $row["id"]; ?>">
                                <div class="o-media">
                                    <div class="c-stage__header-title o-media__body">
                                        <h6 class="u-mb-zero"><?php echo $row["question"]; ?></h6>
                                    </div>
                                </div>
                                
                                <i class="fa fa-angle-down u-text-mute"></i>
                            </a>
 <div class="c-stage__panel c-stage__panel--mute collapse" id="stage-panel<?php echo $row["id"]; ?>" style="padding:20px;">
<?php echo $row["answer"]; ?>
							</div>
<?php
}
}else {
   echo "<div class='c-alert c-alert--warning alert'><i class='c-alert__icon fa fa-times-circle'></i> No data found <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
}
?>
  </article><!-- // .c-stage -->
<a class="u-text-small u-color-blue" href="help.php">Visit FAQ Page</a>
 </div>
<?php } ?>
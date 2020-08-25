<?php

require('../../db/index.php');
$id=$_REQUEST['PLUGIN'];
$sel_query="Select * from plugins WHERE id=$id ORDER BY id desc;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) { 
$page_inf=$row["p_link"];
?>
        <style type="text/css">
            body, html
            {
                margin: 0; padding: 0; height: 100%; overflow: hidden;
            }

            #content
            {
                position:absolute; left: 0; right: 0; bottom: 0; top: 0px; 
            }
        </style>		
<iframe src="<?php echo $page_inf; ?>" scrolling="yes" width="100%" height="100%" frameborder="0" ></iframe>				


<?php } ?>
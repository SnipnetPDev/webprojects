<div class="col-xl-8">
                        <article class="c-stage" id="stages">
                            <a class="c-stage__header u-flex u-justify-between" href="#stage-panel1" data-toggle="collapse" aria-expanded="false" aria-controls="stage-panel1">
                                <div class="o-media">
                                    <div class="c-stage__header-title o-media__body">
                                        <h6 class="u-mb-zero"><?php echo strtoupper("ACTIVITY"); ?></h6>
                                        <p class="u-text-xsmall u-text-mute">Recent transactional activity on your account</p>
                                    </div>
                                </div>
                                
                                <i class="fa fa-angle-down u-text-mute"></i>
                            </a>
 <div class="c-stage__panel c-stage__panel--mute collapse show" id="stage-panel1">
 <table class="c-table u-mb-small">

                        <thead class="c-table__head c-table__head--slim">
                            <tr class="c-table__row">
                              <th class="c-table__cell c-table__cell--head">Date</th>
                              <th class="c-table__cell c-table__cell--head">Description</th>
                              <th class="c-table__cell c-table__cell--head">Money OUT/IN</th>
							  <th class="c-table__cell c-table__cell--head">Status</th>
                              <th class="c-table__cell c-table__cell--head">
                                  <span class="u-hidden-visually">Actions</span>
                              </th>
                            </tr>
                        </thead>

                        <tbody>
<?php 
$sel_query="Select * from trans_history WHERE trans_user_id LIKE '$u_id' OR receiver_acc_no LIKE '$us_acc' ORDER BY tr_id desc;";
$result = $con->query($sel_query) or die($con->error);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
 ?>
                           <?php if($row["trans_user_id"] == $u_id) { ?>
                            <tr class="c-table__row c-table__row--danger">
							<?php }else { ?>
							<tr class="c-table__row c-table__row--success">
							<?php } ?>
                                <td class="c-table__cell"><?php echo strtoupper($row["trans_date"]); ?>
                                  <strong><small class="u-block u-text-info"><?php echo strtoupper("TX"); ?><?php echo $row["trans_id"] ?></small></strong>
                                </td>
                                <td class="c-table__cell">
                                    <div class="o-media">
                                  <div class="o-media__body">
                                  <small class="u-block u-text-mute"><?php echo strtoupper($row["tr_desc"]); ?></small>
                                        </div>
                                    </div>
                                </td>

                                <td class="c-table__cell">
								<?php if($row["trans_user_id"] == $u_id) {
									?>
                                 <?php echo $acc_curency; ?><?php echo number_format($row["tr_total"], 2); ?>
                                    <small class="u-block u-text-danger"><?php echo strtoupper("Debit"); ?></small>
								<?php }else { ?>
								<?php echo $acc_curency; ?><?php echo number_format($row["tr_amount"], 2); ?>
                                    <small class="u-block u-text-success"><?php echo strtoupper("Credit"); ?></small>
								<?php } ?>
                                </td>
								                                <td class="c-table__cell">
                                  <?php 
$ts_id = $row["trans_id"];
$sel_query2="Select * from trans_record WHERE trans_his_id LIKE '$ts_id' ORDER BY id desc;";
$result2 = $con->query($sel_query2) or die($con->error);
if($row = $result2->fetch_assoc()) {
	$t_stat = $row["tr_status"];
	if($t_stat == "On-Hold") {
		echo "<span class='c-badge c-badge--warning'>$t_stat</span>";
	} elseif($t_stat == "Completed") {
		echo "<span class='c-badge c-badge--success'>$t_stat</span>";
		}elseif($t_stat == "Declined") {
		echo "<span class='c-badge c-badge--danger'>$t_stat</span>";
		}
} else {
	echo "<span class='c-badge c-badge--default'>Unknown</span>";
}
?>
                                </td>

                                <td class="c-table__cell u-text-right">
<a href="authorize.php?transaction_id=<?php echo $ts_id; ?>" ><span class="c-badge c-badge--info">Full Receipt <i class="fa fa-angle-down"></i></span></a>
                                </td>
                            </tr>
<?php }
}else {
   echo "<div class='c-alert c-alert--warning alert'><i class='c-alert__icon fa fa-times-circle'></i> You've not done any transactions with your account <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
}	?>
                        </tbody>
                    </table>
							</div>
                        </article><!-- // .c-stage -->
						</div>
<div class="c-graph-card" data-mh="secondary-graphs">
                            <div class="c-graph-card__content u-justify-between u-align-items-baseline">
                                <div class="u-text-right">
                                    <h4 class="u-h2 u-mb-zero" style="font-family:courier new;"><?php echo $t_cur; echo $ac_bal; ?></h4>
									<h3 class="c-graph-card__title u-h6"><?php echo strtoupper($us_type); ?> <span class="u-color-warning u-ml-xsmall"><?php echo $us_acc; ?><a class="u-color-warning" href="settings.php?config_section=account"><i class="fa fa-angle-down"></i></a></span></h3>
                                    <?php include("core/status.php"); ?>
                                </div>
                            </div>
					<?php if($perm_cards == $perm_act) { ?>
							<br/>
                      <h4 class="c-menu__title"><strong>CARDS</strong></h4>
					<?php include("core/cards.php"); ?> 
					  <a class="c-menu__link" data-toggle="modal" data-target="#modal9">
                           <img src="../../img/sidebar-icon6.png" class="u-mr-xsmall" style="width: 14px;" alt="Add icon"><strong>ADD NEW CARD</strong> </a>
					<?php }else{ } ?>
                            <div class="c-graph-card__chart">
						  <canvas id="js-chart-earnings" width="300" height="74"></canvas>							
                            </div>
                        </div>
<div class="c-graph-card">
                            <div class="c-graph-card__content u-justify-between u-align-items-baseline">
<?php include("core/menu.php"); ?>
                            </div>
                        </div>
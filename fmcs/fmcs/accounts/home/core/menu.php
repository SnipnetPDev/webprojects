<aside class="c-menu u-ml-medium">
                        <h4 class="c-menu__title">Menu</h4>
                        <ul class="u-mb-medium">
                            <li class="c-menu__item">
                                <a class="c-menu__link" href="settings.php">
                                    <i class="fa fa-user u-mr-xsmall"></i>Account Settings
                                </a>
                            </li>
                            <li class="c-menu__item">
                                <a class="c-menu__link" href="transfer.php">
                                    <i class="c-menu__icon fa fa-calendar"></i>Pay Bills
                                </a>
                            </li>
							<?php 
							$hide = 1;
							$show = 2;
							if($hide == 2) { ?>
                            <li class="c-menu__item">
                                <a class="c-menu__link" href="request.php">
                                    <i class="c-menu__icon fa fa-newspaper-o"></i>Request Center
                                </a>
                            </li>
							<?php }else{ } ?>
							<?php if($perm_help == $perm_act) { ?>
                            <li class="c-menu__item">
                                <a class="c-menu__link" href="help.php">
                                    <i class="c-menu__icon fa fa-exclamation-triangle"></i>Help
                                </a>
                            </li>
							<?php }else{ } ?>
                            <li class="c-menu__item">
                                <a class="c-menu__link" href="../../logout.php">
                                    <i class="c-menu__icon fa fa-angle-down"></i>Switch Accounts
                                </a>
                            </li>
                        </ul>
                    </aside>
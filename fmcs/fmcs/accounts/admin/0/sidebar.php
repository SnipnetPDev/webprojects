  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel (optional) -->

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
      <!-- /.search form -->
<?php $basename = basename($_SERVER["SCRIPT_FILENAME"], '.php'); ?>
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">HEADER</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="<?php if ($basename == "index") { echo "active"; } ?>"><a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li class="<?php if ($basename == "clients") { echo "active"; } ?>"><a href="clients.php"><i class="fa fa-user"></i> <span>Clients</span></a></li>
		<?php 
							$hide = 1;
							$show = 2;
							if($hide == 2) { ?>
		<li class="treeview <?php if ($basename == "request") { echo "active"; } ?>">
          <a href="#"><i class="fa fa-pencil-square-o"></i> <span>Client Request</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Link in level 2</a></li>
            <li><a href="#">Link in level 2</a></li>
          </ul>
        </li>
		<?php }else{ } ?>
        <li class="treeview <?php if ($basename == "transfer") { echo "active"; } ?>">
          <a href="#"><i class="fa fa-money"></i> <span>Transfer</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
		   <li><a href="transfer.php">Transfer method</a></li>
            <li><a href="transfer.php?action=list">List Transactions</a></li>
          </ul>
        </li>
		
		<li class="treeview <?php if ($basename == "module") { echo "active"; } ?>">
          <a href="#"><i class="fa fa-plug"></i> <span>Module</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="module.php?action=list">Installed Module</a></li>
            <li><a href="module.php?action=new">Install Module</a></li>
          </ul>
        </li>
		
       <li class="<?php if ($basename == "settings") { echo "active"; } ?>"><a href="settings.php"><i class="fa fa-wrench"></i> <span>Configuration</span></a></li>
	   <li class="<?php if ($basename == "info") { echo "active"; } ?>"><a href="info.php"><i class="fa fa-info-circle"></i> <span>About</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

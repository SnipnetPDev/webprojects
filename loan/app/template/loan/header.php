<?php 
	if ( isset($_SESSION["loggedin"]) == true) {
?>
    <!-- Fixed navbar -->
    <header class="header fixed-top">
        <nav class="navbar">
            <div>
                <a href="#" onclick="page('notification')" class="btn btn-link p-2">
                   <i class="material-icons">notifications</i>
                </a>
            </div>
            <div>
                <a href="#" onclick="logout()" class="btn btn-link p-2"><i class="material-icons">power_settings_new</i></a>
               
            </div>
        </nav>
    </header>
    <!-- Fixed navbar ends -->
<?php } ?>
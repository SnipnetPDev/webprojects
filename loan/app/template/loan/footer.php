<?php 
	if ( isset($_SESSION["loggedin"]) == true) {
?>
    <!-- sticky footer tabs -->
    <div class="footer-tabs footer-spaces border-top text-center">
        <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="#" onclick="page('index')">
                    <i class="material-icons">home</i>
                    <small class="sr-only">Home</small>
                </a>
            </li>
            <li class="nav-item centerlarge">
                <a class="nav-link bg-default" href="#" onclick="page('apply')">
                    <i class="material-icons">add</i>
                    <small class="sr-only">Add Expense</small>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#" onclick="page('account')">
                   <i class="material-icons">account_circle</i>
                    <small class="sr-only">Account</small>
                </a>
            </li>
        </ul>
    </div>
    <!-- sticky footer tabs ends -->

<?php } ?>
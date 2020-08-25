<?php
include 'templates/header.php';
?>
        
            <!-- Left nav
            ================================================== -->
            <div class="row">
<br/>
              <div class="span9">
                
   <style>
.user-row {
    margin-bottom: 14px;
}

.user-row:last-child {
    margin-bottom: 0;
}

.dropdown-user {
    margin: 13px 0;
    padding: 5px;
    height: 100%;
}

.dropdown-user:hover {
    cursor: pointer;
}

.table-user-information > tbody > tr {
    border-top: 1px solid rgb(221, 221, 221);
}

.table-user-information > tbody > tr:first-child {
    border-top: 0;
}


.table-user-information > tbody > tr > td {
    border-top: 0;
}
.toppad
{margin-top:20px;
}
</style>
   <div class='alert alert-warning'><strong>Note!</strong> Changes made will take effect next time you login to your online banking account.</div>
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $_SESSION['usr_name']; ?></h3>
            </div>
            <div class="panel-body">
              <div class="row">
			  <?php
$imageU = $_SESSION['imgname'];
$image_src = "assets/img/DP/".$imageU;
?>
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="<?php echo $image_src;  ?>" class="img-circle img-responsive"> 
				<a href="change_photo.php?id=<?php echo $_SESSION["usr_id"]; ?>" class="btn btn-primary">Change Photo</a>
</div>
                
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Login ID</td>
                        <td><?php echo $_SESSION['usr_loginid']; ?></td>
                      </tr>
                      <tr>
                        <td>Screen Name</td>
                        <td><?php echo $_SESSION['usr_name']; ?></td>
                      </tr>
                        <tr>
                        <td>Email</td>
                        <td><?php echo $_SESSION['usr_email']; ?></td>
                      </tr>
					    <tr>
                        <td>Phone</td>
                        <td><?php echo $_SESSION['usr_phone']; ?></td>
                      </tr>
                        <tr>
                        <td>Country of Residence</td>
                        <td><?php echo $_SESSION['usr_country']; ?></td>
                      </tr>
					                          <tr>
                        <td>Password</td>
                        <td> <a href="change_pwd.php?id=<?php echo $_SESSION["usr_id"]; ?>" class="btn btn-primary">Change Password</a></td>
                      </tr>
                                          
                    </tbody>
                  </table>
                  
                  </div>
              </div>
            </div>
              
          </div>






<script>
$(document).ready(function() {
    var panels = $('.user-infos');
    var panelsButton = $('.dropdown-user');
    panels.hide();

    //Click dropdown
    panelsButton.click(function() {
        //get data-for attribute
        var dataFor = $(this).attr('data-for');
        var idFor = $(dataFor);

        //current button
        var currentButton = $(this);
        idFor.slideToggle(400, function() {
            //Completed slidetoggle
            if(idFor.is(':visible'))
            {
                currentButton.html('<i class="glyphicon glyphicon-chevron-up text-muted"></i>');
            }
            else
            {
                currentButton.html('<i class="glyphicon glyphicon-chevron-down text-muted"></i>');
            }
        })
    });


    $('[data-toggle="tooltip"]').tooltip();

    $('button').click(function(e) {
        e.preventDefault();
        alert("This is a demo.\n :-)");
    });
});
</script>
</div>                   

        
              </div>
            </div>
        
    <?php include 'templates/footer.php'; ?>    
  </body>
</html>


function myaccount(accountfunction)
  {
$("#"+accountfunction).html("<center><img id='loading-image' class='ajaxpic' src='"+APP_URL+"core/images/loading.svg' width='60px' height=''></center>");
   $.ajax({
   url: appFile+'account'+appExtn,
   method:"POST",
   data:{accountfunction:accountfunction},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
    $('#'+accountfunction).html(data);
   }
  });
}

function accountInfo()
  {
	  var accountInfo = 'user';
$("#accountInfo").html("<center><img id='loading-image' class='ajaxpic' src='"+APP_URL+"core/images/loading.svg' width='16px' height=''></center>");
   $.ajax({
   url: appFile+'account'+appExtn,
   method:"POST",
   data:{accountInfo:accountInfo},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
    $('#accountInfo').html(data);
   }
  });
}

function updateinfo()
  {
	  $("#updateButton").html("<center><img id='loading-image' class='ajaxpic' src='"+APP_URL+"core/images/loading.svg' width='30px' height=''></center>");
	  var firstName = $("#firstName").val();
	  var lastName = $("#lastName").val();
	  var email = $("#email").val();
	  var line1 = $("#line1").val();
	  var line2 = $("#line2").val();
	  var city = $("#city").val();
	  var state = $("#state").val();
	  var country = $("#country").val();
   $.ajax({
   url: appFile+'account'+appExtn,
   method:"POST",
   data:{firstName:firstName,lastName:lastName,email:email,line1:line1,line2:line2,city:city,state:state,country:country},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
		   window.location.href = 'console';
   }
  });
}
function myaccount(accountfunction)
  {
$("#"+accountfunction).html("<img id='loading-image' class='ajaxpic' src='"+APP_URL+"core/images/loading.svg' width='16px' height=''>");
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

function accountInfo(accountInfo, infoType, altReport)
  {
$("#"+accountInfo+"").html("<img id='loading-image' class='ajaxpic' src='"+APP_URL+"core/images/loading.svg' width='16px' height=''>");
   $.ajax({
   url: appFile+'account'+appExtn,
   method:"POST",
   data:{accountInfo:accountInfo},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
	   if(infoType === 'img'){
var image = $("<img>", {
                    "src": data
                });
$("#"+altReport+"").append(image);
	   }else{
    $("#"+altReport+"").html(data);
	   }
   }
  });
}

function uploadAvatar(base64Img)
  {
   $.ajax({
   url: appFile+'account'+appExtn,
   method:"POST",
   data:{base64Img:base64Img},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
	
   }
  });
}
function updateinfo()
  {
	  var firstName = $("#firstName").val();
	  var lastName = $("#lastName").val();
	  var company = $("#company").val();
	  var line1 = $("#line1").val();
	  var line2 = $("#line2").val();
	  var city = $("#city").val();
	  var state = $("#state").val();
	  var country = $("#country").val();
   $.ajax({
   url: appFile+'account'+appExtn,
   method:"POST",
   data:{firstName:firstName,lastName:lastName,company:company,line1:line1,line2:line2,city:city,state:state,country:country},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
		   $("#saveInfoBtn").html("<i class='material-icons' style='color:green;' title='Changes Saved'>check</i>");
   }
  });
}
function loanProducts(productPanel, viewMode)
  {
   $("#"+productPanel+"").html("<img id='loading-image' class='ajaxpic' src='"+APP_URL+"core/images/loading.svg' width='16px' height=''>");
   $.ajax({
   url: appFile+'loanui'+appExtn,
   method:"POST",
   data:{productPanel:productPanel,viewMode:viewMode},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
    $('#'+productPanel+'').html(data);
   }
  });
}

function submitApplication()
  {
   $("#subAppBtn").html("<img id='loading-image' class='ajaxpic' src='"+APP_URL+"core/images/loading.svg' width='16px' height=''>");
   var fname =$("#fname").val();
   var lname =$("#lname").val();
   var company =$("#company").val();
   var number =$("#number").val();
   var email =$("#email").val();
   var address =$("#address").val();
   var city =$("#city").val();
   var state =$("#state").val();
   var country =$("#country").val();
   var amount =$("#amount").val();
   var loanProdSelect =$("#loanProdSelect").val();
   var loanTerm =$("#loanTerm").val();
   var loanPurpose =$("#loanPurpose").val();
   var Additionalnote =$("#Additionalnote").val();
   $.ajax({
   url: appFile+'loanui'+appExtn,
   method:"POST",
   data:{fname:fname,lname:lname,company:company,number:number,email:email,address:address,city:city,state:state,country:country,amount:amount,loanProdSelect:loanProdSelect,loanTerm:loanTerm,loanPurpose:loanPurpose,Additionalnote:Additionalnote},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
	   if(data == 0){
		   $("#appBody").html("<h1 style='color:green;'>Application submitted,</h1> <br/><p>you'll be notified via email or sms shortly.</p>");
		   $('#subAppReport').html("");
		   $('#subAppBtn').html("");
	   }else{
		   $("#subAppBtn").html('<button type="button" onclick="submitApplication()" class="btn btn-primary">Submit Application</button>');
           $('#subAppReport').html(data+"<br/><br/>");
	   }
   }
  });
}

function sendMessage()
  {
   $("#sendMbutton").html("<img id='loading-image' class='ajaxpic' src='"+APP_URL+"core/images/loading.svg' width='16px' height=''>");
   var Cfname =$("#Cfname").val();
   var Clname =$("#Clname").val();
   var Cemail =$("#Cemail").val();
   var Cphone =$("#Cphone").val();
   $.ajax({
   url: appFile+'loanui'+appExtn,
   method:"POST",
   data:{Cfname:Cfname,Clname:Clname,Cemail:Cemail,Cphone:Cphone},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
    if(data == 0){
		   $("#contactRow").html("<h1 style='color:green;'>Request Sent,</h1> <br/><p>A representative will contact you shortly via email or sms.</p>");
		   $('#sendMbutton').html("");
	   }
   }
  });
}
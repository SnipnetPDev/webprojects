var afterLog = 'index';
function login()
  {
var _token =$("#_token").val();
var mobile =$("#mobile").val();
if ( mobile == '' ) {
	$("#report").html("<font style='color:red;padding:5px;'>A valid phone number is required.</font>");
}else {
$("#load").html("<center><br/><br/><br/><br/><br/><br/><img id='loading-image' class='ajaxpic' src='"+APP_URL+"core/images/loading.svg' width='60px' height=''><br/><br/><br/><br/></center>");
   $.ajax({
   url: appFile+'login'+appExtn,
   method:"POST",
   data:{mobile:mobile,_token:_token},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
    $('#load').html(data);
   }
  });
}
  }

function resendSMS()
  {
var resendV =$("#resID").val();
$("#load").html("<center><br/><br/><br/><br/><br/><br/><img id='loading-image' class='ajaxpic' src='"+APP_URL+"core/images/loading.svg' width='60px' height=''><br/><br/><br/><br/></center>");
   $.ajax({
   url: appFile+'login'+appExtn,
   method:"POST",
   data:{resendV:resendV},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
    $('#load').html(data);
   }
  });
  }
  

function resendSMSL()
  {
var resendVL =$("#resID").val();
$("#load").html("<center><br/><br/><br/><br/><br/><br/><img id='loading-image' class='ajaxpic' src='"+APP_URL+"core/images/loading.svg' width='60px' height=''><br/><br/><br/><br/></center>");
   $.ajax({
   url: appFile+'login'+appExtn,
   method:"POST",
   data:{resendVL:resendVL},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
    $('#load').html(data);
   }
  });
  }
  
function logout()
  {
var exit = 'quit';
var mode = 'user_mode';
$.ajax({
   url: appFile+'login'+appExtn,
   method:"POST",
   data:{exit:exit,mode:mode},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
	window.location.href = 'login';
   }
  });
  }

var verify = function verify(num) {

  if (num.length === 6) {
var Vcode =$("#Vcode").val();
var resID =$("#resID").val();
var mode =$("#mode").val();
   $.ajax({
   url: appFile+'login'+appExtn,
   method:"POST",
   data:{Vcode:Vcode,resID:resID,mode:mode},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
    if (data == 0) {
		window.location.href = afterLog;
	}else{
		$("#Vreport").html("<font style='color:red;padding:5px;'>Invalid code</font>");
	}
   }
  });
  }
}
var verifypin = function verifypin(num) {

  if (num.length === 4) {
var phone =$("#phone").val();
var pin =$("#pin").val();
   $.ajax({
   url: appFile+'login'+appExtn,
   method:"POST",
   data:{pin:pin,phone:phone},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
    if (data == 0) {
		window.location.href = afterLog;
	}else{
		$("#Vreport").html("<font style='color:red;padding:5px;'>Incorrect PIN</font>");
	}
   }
  });
  }
}

var enrollpinF = function enrollpinF(num) {
  var x2 = document.getElementById("second");
  if (num.length === 4) {
    x2.style.display = "block";
  }
  if (num.length < 4){
    x2.style.display = "none";
  }
}
var enrollpin = function enrollpin(num) {

  if (num.length === 4) {
var pinS =$("#pinS").val();
var pinSV =$("#pinSV").val();
if (pinS === pinSV) {
   $.ajax({
   url: appFile+'login'+appExtn,
   method:"POST",
   data:{pinS:pinS,pinSV:pinSV},
   success:function(data)
   {
    if (data == 0) {
		window.location.href = afterLog;
	}else{
		$("#report").html("<font style='color:red;padding:5px;'>Oops! something went wrong, refresh page and try again.</font>");
	}
   }
  });
  }else{
	  $("#report").html("<font style='color:red;padding:5px;'>PIN does not match</font>");
  }
  }
}

  
var cfpin = function cfpin(num) {
  var newpin_body = document.getElementById("newpin_body");
  var cnewpin_body = document.getElementById("cnewpin_body");
  if (num.length === 4) {
  newpin_body.style.display = "block";
  } else {
  newpin_body.style.display = "none";
  cnewpin_body.style.display = "none";
  }
}
var newpin = function newpin(num) {
  var cnewpin_body = document.getElementById("cnewpin_body");
  if (num.length === 4) {
  cnewpin_body.style.display = "block";
  } else {
  cnewpin_body.style.display = "none";
  }
}
  var cnewpin = function cnewpin(num) {
  var pinC =$("#pinC").val();
  var pinCN =$("#pinCN").val();
  var pinCNC =$("#pinCNC").val();
  var form_body = document.getElementById("form_body");
  if (num.length === 4) {
	  $("#pin_report").html("<center><img id='loading-image' class='ajaxpic' src='"+APP_URL+"core/images/loading.svg' width='60px' height=''></center>");
     $.ajax({
   url: appFile+'login'+appExtn,
   method:"POST",
   data:{pinC:pinC,pinCN:pinCN,pinCNC:pinCNC},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
    if (data == 0) {
		form_body.style.display = "none";
		$("#pin_report").html("<div class='alert alert-primary' role='alert'><i class='fa fa-check-circle'></i> PIN changed</div>");
	}else{
		$("#pin_report").html(data);
	}
   }
  });
  }
}
  var nmobile = function nmobile(num) {
  var newmobile =$("#newmobile").val();
  var ver_body = document.getElementById("ver_body");
  if (num.length === 11) {
$("#load_img").html("<center><img id='loading-image' width='24px' height='24px' class='ajaxpic' src='"+APP_URL+"core/images/loading.svg'></center>");
     $.ajax({
   url: appFile+'login'+appExtn,
   method:"POST",
   data:{newmobile:newmobile},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
    if (data == 0) {
	  $("#nmobile_body").html(newmobile);
	  ver_body.style.display = "block";
	  $("#load_img").html("");
	}else{
		$("#nmreport").html(data);
		$("#load_img").html("");
	}
   }
  });
  }
}

var verifynm = function verifynm(num) {

  if (num.length === 6) {
var Vcode =$("#VNMcode").val();
var resID =$("#newmobile").val();
var mode =$("#mode").val();
   $.ajax({
   url: appFile+'login'+appExtn,
   method:"POST",
   data:{Vcode:Vcode,resID:resID,mode:mode},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
    if (data == 0) {
		$("#nmreport").html("<font style='color:blue;padding:5px;'>Phone number changed, you will be redirected to login.</font>");
	}else{
		$("#nmreport").html("<font style='color:red;padding:5px;'>Invalid code</font>");
	}
   }
  });
  }
}

function sendOtp() {
	 $("#nextBtn").html("<center><img id='loading-image' class='ajaxpic' src='"+APP_URL+"core/images/loading.svg' width='16px' height=''></center>");
	var _token =$("#_token").val();
	var mobileOtp =$("#mobile").val();
   $.ajax({
   url: appFile+'login'+appExtn,
   method:"POST",
   data:{mobileOtp:mobileOtp,_token:_token},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
		   $("#otpDiv").html(data);
		   $("#nextBtn").html('');
   }
  });
}

var verifyOtp = function verifyOtp(num) {

  if (num.length === 6) {
var OtpCode =$("#OtpCode").val();
var OtpresID =$("#mobile").val();

var mobileDiv = document.getElementById("mobileDiv");
var otpDiv = document.getElementById("otpDiv");
var nPinDiv = document.getElementById("nPinDiv");
var nPinDivC = document.getElementById("nPinDivC");
   $.ajax({
   url: appFile+'login'+appExtn,
   method:"POST",
   data:{OtpCode:OtpCode,OtpresID:OtpresID},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
    if (data == 0) {
		mobileDiv.style.display = "none";
		otpDiv.style.display = "none";
		nPinDiv.style.display = "block";
		nPinDivC.style.display = "block";
	}else{
		$("#OtpReport").html("<font style='color:red;padding:5px;'>Invalid code</font>");
	}
   }
  });
  }
}
var checkPinMatch = function checkPinMatch(num) {

  if (num.length === 4) {
$("#pinChkDiv").html('');
var npin =$("#npin").val();
var Cnpin =$("#Cnpin").val();
var resetBtn = document.getElementById("resetBtn");
if(npin == Cnpin){
resetBtn.style.display = "block";
}else{
	$("#pinChkDiv").html("<font style='color:red;padding:5px;'>Pin does not match</font>");
}
  }
}

function resetPin() {
	 $("#resetBtn").html("<center><img id='loading-image' class='ajaxpic' src='"+APP_URL+"core/images/loading.svg' width='16px' height=''></center>");
	var userToreset =$("#mobile").val();
	var userPin =$("#npin").val();
    var userCnpin =$("#Cnpin").val();
   $.ajax({
   url: appFile+'login'+appExtn,
   method:"POST",
   data:{userToreset:userToreset,userPin:userPin,userCnpin:userCnpin},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
		   $("#resetBtn").html('');
		   $("#formBody").html(data);
   }
  });
}

 // Restricts input for the given textbox to the given inputFilter.
function setInputFilter(textbox, inputFilter) {
  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
    textbox.addEventListener(event, function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      }
    });
  });
}

setInputFilter(document.getElementById("pin"), function(value) {
  return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 9999999999); });

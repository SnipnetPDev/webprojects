function section(secId)
  {
	   var trade = document.getElementById('trade');
	   var withdraw = document.getElementById('withdraw');
	   var deposit = document.getElementById('deposit');
	   
	  if(secId == 'trade'){
		  $('#dropdownMenuButton').text('Trade');
		  trade.style.display = 'block';
		  withdraw.style.display = 'none';
		  deposit.style.display = 'none';
	  }
	  if(secId == 'withdraw') {
		 $('#dropdownMenuButton').text('Withdraw');
		  trade.style.display = 'none';
		  withdraw.style.display = 'block';
		  deposit.style.display = 'none';
	  }
	  if(secId == 'deposit'){
		  $('#dropdownMenuButton').text('Deposit');
		  trade.style.display = 'none';
		  withdraw.style.display = 'none';
		  deposit.style.display = 'block';
	  }
}
var getBTCamt = function getBTCamt(USDAmt) {
	var addFButton = document.getElementById('addFButton');
  if (USDAmt.length > 0) {
  $("#LoadingBody").html("<img id='loading-image' class='ajaxpic' src='"+APP_URL+"core/images/loading.svg' width='30px' height=''>");
  addFButton.style.display = 'none';
   $.ajax({
   url: appFile+'console'+appExtn,
   method:"POST",
   data:{USDAmt:USDAmt},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
	   if(data == 0){
    $("#LoadingBody").html("");
	document.getElementById("fundAmtBTC").value = '0';
	addFButton.style.display = 'none';
	   }else{
	$("#LoadingBody").html("");
	document.getElementById("fundAmtBTC").value = data;
	addFButton.style.display = 'block';
	   }
   }
  });
  }else{
	  document.getElementById("fundAmtBTC").value = '0';
  }
}

function addFunds()
  {
	  var addFButton = document.getElementById('addFButton');
$("#LoadingBody").html("<img id='loading-image' class='ajaxpic' src='"+APP_URL+"core/images/loading.svg' width='30px' height=''>");
addFButton.style.display = 'none';
var fundAmtUSD =$("#fundAmtUSD").val();
var fundAmtBTC =$("#fundAmtBTC").val();
var transId =$("#transId").val();
   $.ajax({
   url: appFile+'console'+appExtn,
   method:"POST",
   data:{fundAmtUSD:fundAmtUSD,fundAmtBTC:fundAmtBTC,transId:transId},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
    $('#formBody').html(data);
	checkTrans(transId);
   }
  });
}

function checkTrans(transIdCheck)
  {
 $.ajax({
   url: appFile+'console'+appExtn,
   method:"POST",
   data:{transIdCheck:transIdCheck},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
	   if(data == 0)
	   {
		   $('#formBody').html('Transaction Complete');
		   window.location.href = 'console';
	   }else{
		   checkTrans(transIdCheck);
	   }
   }
  });	    
  }
 
 var getProfitUSD = function getProfitUSD(tradeAmtUSD) {
	var addFButton = document.getElementById('addFButton');
var ele = document.getElementsByName('trDate');
            for(i = 0; i < ele.length; i++) { 
                if(ele[i].checked) 
        var trDate = ele[i].value;
			}
  if (tradeAmtUSD.length > 0) {
	  var trMargin = +trDate + +9.25;
	  var data = tradeAmtUSD * trMargin;
	  document.getElementById("profitUSD").value = data;
  }else{
	  document.getElementById("profitUSD").value = '0';
  }
}

function setNewProfit(duration)
{
	var tradeAmtUSD =$("#tradeAmtUSD").val();
	var trMargin = +duration + +9.25;
	var data = tradeAmtUSD * trMargin;
	document.getElementById("profitUSD").value = data;
	
}


function stTrade(tradeCap)
  {
var tradeAmtUSD =$("#tradeAmtUSD").val();
var profitUSD =$("#profitUSD").val();
var ele = document.getElementsByName('trDate');
            for(i = 0; i < ele.length; i++) { 
                if(ele[i].checked) 
        var trDuration = ele[i].value;
			}
 $.ajax({
   url: appFile+'console'+appExtn,
   method:"POST",
   data:{tradeCap:tradeCap,tradeAmtUSD:tradeAmtUSD,profitUSD:profitUSD,trDuration:trDuration},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
	   if(data == 0)
	   {
		  Refresh();
		  document.getElementById("tradeAmtUSD").value = '';
		  document.getElementById("profitUSD").value = '0';
		  $('#tradeAlert').html('');
	   }else{
		   $('#tradeAlert').html(data);
	   }
   }
  });	    
  }
 
function loadTradeHistory(){
$("#TradeHistory").html("<center><img id='loading-image' class='ajaxpic' src='"+APP_URL+"core/images/loading.svg' width='30px' height=''></center>");
	var TradeHistory = 'all';
$.ajax({
   url: appFile+'console'+appExtn,
   method:"POST",
   data:{TradeHistory:TradeHistory},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
	   $('#TradeHistory').html(data);
   }
});
} 

function loadDepositHistory(){
$("#DepositHistory").html("<center><img id='loading-image' class='ajaxpic' src='"+APP_URL+"core/images/loading.svg' width='30px' height=''></center>");
	var DepositHistory = 'all';
$.ajax({
   url: appFile+'console'+appExtn,
   method:"POST",
   data:{DepositHistory:DepositHistory},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
	   $('#DepositHistory').html(data);
   }
});
}

function loadWithdrawHistory(){
	alert('Trade history loaded');
}



function consoleInfo(Infosection)
  {
   $.ajax({
   url: appFile+'console'+appExtn,
   method:"POST",
   data:{Infosection:Infosection},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
    $('#'+Infosection).html(data);
   }
  });
}

function Refresh(){
accountInfo();
loadTradeHistory();
loadDepositHistory();
myaccount('personalTab');
myaccount('addressTab');
consoleInfo('CBalance');
consoleInfo('lDeposit');
consoleInfo('lTrAmt');
consoleInfo('lTrProfit');
consoleInfo('lTrDuration');
}
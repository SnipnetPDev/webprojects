function nestable(action, nest, nest2, nest3, nest4, nest5, nest6, nest7){if(action == 'open'){ var action = 'block'; }else if(action == 'close'){ var action = 'none'; }var pageNest = document.getElementById(nest); var pageNest = document.getElementById(nest); var pageNest2 = document.getElementById(nest2); var pageNest3 = document.getElementById(nest3); var pageNest4 = document.getElementById(nest4); var pageNest5 = document.getElementById(nest5); var pageNest6 = document.getElementById(nest6); var pageNest7 = document.getElementById(nest7); $.when(pageNest.style.display = action).then(function () { $.when(pageNest2.style.display = action).then(function () { $.when(pageNest3.style.display = action).then(function () { $.when(pageNest4.style.display = action).then(function () { $.when(pageNest5.style.display = action).then(function () { $.when(pageNest6.style.display = action).then(function () { pageNest7.style.display = action; }); }); }); }); }); }); $("#NestLoader").html('');}

function onload_noAuth(){
popularFAQ();
}

function onload_afterAuth(){
accountInfo();
loadTradeHistory();
loadDepositHistory();
myaccount('personalTab');
myaccount('addressTab');
setTimeout(function(){ consoleInfo('lDeposit'); }, 3000);
setTimeout(function(){ consoleInfo('CBalance'); }, 3000);
setTimeout(function(){ consoleInfo('lTrAmt'); }, 3000);
setTimeout(function(){ consoleInfo('lTrProfit'); }, 3000);
setTimeout(function(){ consoleInfo('lTrDuration'); }, 3000);
}

function onload_afterAccessDenied(){
//alert('access denied');
}

//CUSTOM VARIABLES
var appFile = 'core/app/';
var appExtn = '.php';

//LOAD CUSTOM SCRIPTS
$.getScript(costURLjs+'login.js');
$.getScript(costURLjs+'faq.js');
$.getScript(costURLjs+'console.js');
$.getScript(costURLjs+'account.js');
function nestable(action, nest, nest2, nest3, nest4, nest5, nest6, nest7){if(action == 'open'){ var action = 'block'; }else if(action == 'close'){ var action = 'none'; }var pageNest = document.getElementById(nest); var pageNest = document.getElementById(nest); var pageNest2 = document.getElementById(nest2); var pageNest3 = document.getElementById(nest3); var pageNest4 = document.getElementById(nest4); var pageNest5 = document.getElementById(nest5); var pageNest6 = document.getElementById(nest6); var pageNest7 = document.getElementById(nest7); $.when(pageNest.style.display = action).then(function () { $.when(pageNest2.style.display = action).then(function () { $.when(pageNest3.style.display = action).then(function () { $.when(pageNest4.style.display = action).then(function () { $.when(pageNest5.style.display = action).then(function () { $.when(pageNest6.style.display = action).then(function () { pageNest7.style.display = action; }); }); }); }); }); }); $("#NestLoader").html('');}

function onload_noAuth(){
loanProducts('prodList', 'select');
}

function onload_afterAuth(){
//loanHistory('html');
loanProducts('prodList', 'select');
myaccount('personalTab');
myaccount('addressTab');
accountInfo('firstName', 'text', 'usrFirstName');
accountInfo('lastName', 'text', 'usrLastName');
accountInfo('phoneNumber', 'text', 'phoneNumber');
accountInfo('Borrowlimit', 'text', 'Borrowlimit');
accountInfo('avatar', 'img', 'usrAvatar');
}
function onload_afterAccessDenied(){
//alert('access denied');
}

//CUSTOM VARIABLES
var appFile = 'core/app/';
var appExtn = '.php';

//LOAD CUSTOM SCRIPTS
$.getScript(costURLjs+'login.js');
$.getScript(costURLjs+'loan.js');
$.getScript(costURLjs+'account.js');
$.getScript(costURLjs+'upload.js');
$.getScript(costURLjs+'download.js');
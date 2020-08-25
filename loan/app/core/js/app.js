function stripHtml(html){
    // Create a new div element
    var temporalDivElement = document.createElement("div");
    // Set the HTML content with the providen
    temporalDivElement.innerHTML = html;
    // Retrieve the text property of the element (cross-browser support)
    return temporalDivElement.textContent || temporalDivElement.innerText || "";
}
function getMeta(metaName) {
  const metas = document.getElementsByTagName('meta');

  for (let i = 0; i < metas.length; i++) {
    if (metas[i].getAttribute('name') === metaName) {
      return metas[i].getAttribute('content');
    }
  }

  return '';
}
var APP_URL = stripHtml(getMeta('APP_URL'));
var token = stripHtml(getMeta('APP_KEY'));
var costURL = APP_URL+'core/app/';
var costURLjs = APP_URL+'core/js/custom/';
 var project_manifest = (function () {
    var project_manifest = null;
    $.ajax({
        'async': false,
        'global': false,
        'url': APP_URL+'manifest.json',
        'dataType': "json",
        'success': function (data) {
            project_manifest = data;
        }
    });
    return project_manifest;
})(); 
var project_manifest = JSON.stringify(project_manifest);
var project_manifest = JSON.parse(project_manifest);
var templFOLDER = project_manifest.tempFolder;

 var theme_manifest = (function () {
    var theme_manifest = null;
    $.ajax({
        'async': false,
        'global': false,
        'url': APP_URL+templFOLDER+'manifest.json',
        'dataType': "json",
        'success': function (data) {
            theme_manifest = data;
        }
    });
    return theme_manifest;
})(); 
var theme_manifest = JSON.stringify(theme_manifest);
var theme_manifest = JSON.parse(theme_manifest);
var APP_THEME = theme_manifest.template+'/';
var templEXT = theme_manifest.fileExt;

function page(PGid, nest, nest2, nest3, nest4, nest5, nest6, nest7, nest8, nest9, nest10, nest11, nest12, nest13, nest14, nest15, nest16, nest17, nest18, nest19, nest20, nest21) {
	 if (PGid == 'nest' || PGid == 'Supercmd'){
if (PGid == 'Supercmd'){
    if(typeof(LoadConfirmation) != 'undefined' && LoadConfirmation != null){
        $.when(nestable(nest2, nest3)).then(function () {
	    $.when(nestable(nest4, nest5)).then(function () {
	    nestable(nest6, nest7); 
		});
		});

    } else{
        setTimeout(page('Supercmd', nest, nest2, nest3, nest4, nest5, nest6, nest7, nest8, nest9, nest10, nest11, nest12, nest13, nest14, nest15, nest16, nest17, nest18, nest19, nest20, nest21), 1000);
    }
}else{
		$.when(loadPage(nest)).then($("#NestLoader").html("<div style=' position:fixed;top:50%;left:50%;transform: translate(-50%, -50%); z-index:10000;'><center><img class='ajaxpic' src='"+APP_URL+"core/images/loading.svg'></center></div>"), setTimeout(function () { 
    if(typeof(LoadConfirmation) != 'undefined' && LoadConfirmation != null){
        $.when(nestable(nest2, nest3)).then(function () {
	    $.when(nestable(nest4, nest5)).then(function () {
	    $.when(nestable(nest6, nest7)).then(function () {
	    $.when(nestable(nest8, nest9)).then(function () {
	    $.when(nestable(nest10, nest11)).then(function () {
	    $.when(nestable(nest12, nest13)).then(function () {
	    $.when(nestable(nest14, nest15)).then(function () {
	    $.when(nestable(nest16, nest17)).then(function () {
	    $.when(nestable(nest18, nest19)).then(function () {
	    nestable(nest20, nest21);});});});});});});});});});

    } else{
        setTimeout(page('Supercmd', nest, nest2, nest3, nest4, nest5, nest6, nest7, nest8, nest9, nest10, nest11, nest12, nest13, nest14, nest15, nest16, nest17, nest18, nest19, nest20, nest21), 1000);
    }
	    
		}, 1000));
}
	}else{
		loadPage(PGid);
	}
function loadPage(PGid){
$("#appLoader").html("<div style=' position:fixed;top:50%;left:50%;transform: translate(-50%, -50%); z-index:10000;'><center><img class='ajaxpic' src='"+APP_URL+"core/images/loading.svg'></center></div>");
var temp_manifest = (function () {
    var temp_manifest = null;
    $.ajax({
        'async': false,
        'global': false,
        'url': APP_URL+templFOLDER+APP_THEME+'manifest.json',
        'dataType': "json",
        'success': function (data) {
            temp_manifest = data;
        }
    });
    return temp_manifest;
})(); 
var temp_manifest = JSON.stringify(temp_manifest);
var temp_manifest = JSON.parse(temp_manifest);

var auth = (function () {
    var auth = null;
$.ajax({
	'async': false,
        'global': false,
        'url': APP_URL+templFOLDER+APP_THEME+PGid+templEXT,
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
        'success': function (data) {
            auth = temp_manifest[""+PGid+""]["pageAuth"];
        },
        'error': function (data) {
            auth = 'no';
        }
});
    return auth;
})(); 
if (auth == 'yes'){
	applyAuth(PGid, auth);
} else {
$.ajax({
    type: 'GET',
    url: APP_URL+templFOLDER+APP_THEME+PGid+templEXT,
	beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
    },
    success: function(data) {
		if(data.includes("<title>404</title>") == true || data.includes("<title>Page not found</title>") == true || data.includes("<title>404 - Page not found</title>") == true){
			$.when($('#content').load(APP_URL+templFOLDER+APP_THEME+'404'+templEXT)).then(function () {
				$("#appLoader").html('');
				set_headder('404');
				});
		} else {
$.when($('#content').html(data)).then(function () {
	set_headder(PGid);
	$("#appLoader").html('');
	//Call custon JS here after page load
	onload_noAuth();
});
    }
	}
});
}
}
}
function applyAuth(PGid, auth){
	var data = {auth:auth}
    $.ajax({
        url: 'core/auth.php',
        type: 'POST',
        data: data,
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
        success: function (data) {
	if (stripHtml(data) == 1) {
$.ajax({
    type: 'GET',
    url: APP_URL+templFOLDER+APP_THEME+PGid+templEXT,
	beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
    },
    success: function(data) {
		if(data.includes("<title>404</title>") == true || data.includes("<title>Page not found</title>") == true || data.includes("<title>404 - Page not found</title>") == true){
			$.when($('#content').load(APP_URL+templFOLDER+APP_THEME+'404'+templEXT)).then(function () {
				$("#appLoader").html('');
				set_headder('404');
				});
		} else {
$.when($('#content').html(data)).then(function () {
	set_headder(PGid);
	$("#appLoader").html('');
	//Call custon JS here after page load
	onload_afterAuth();
});
    }
	}
});
			}else if (stripHtml(data) == 2){
$.ajax({
    type: 'GET',
    url: APP_URL+templFOLDER+APP_THEME+'noaccess'+templEXT,
	beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
    },
    success: function(data) {
$.when($('#content').html(data)).then(function () {
	set_headder('noaccess');
	$("#appLoader").html('');
	//Call custon JS here after page load
	onload_afterAccessDenied();
});
    }
});
			}else if (stripHtml(data) == 3){
$.when($('#content').load(APP_URL+templFOLDER+APP_THEME+'pinsetup'+templEXT)).then(function () {
	set_headder('pinsetup');
	$("#appLoader").html('');
});
			}else{
$.ajax({
    type: 'GET',
    url: APP_URL+templFOLDER+APP_THEME+'noauth'+templEXT,
	beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
    },
    success: function(data) {
$.when($('#content').html(data)).then(function () {
	set_headder('noauth');
	$("#appLoader").html('');
});
    }
});
			}
	},  
    error: function() {
$.ajax({
    type: 'GET',
    url: APP_URL+templFOLDER+APP_THEME+'noauth'+templEXT,
	beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
    },
    success: function(data) {
$.when($('#content').html(data)).then(function () {
	$("#appLoader").html('');
	set_headder('noauth');
});
    }
});
    }
		});
}
function set_headder(page){
$.getJSON(APP_URL+templFOLDER+APP_THEME+'manifest.json', function(results) {
        var manifest = JSON.stringify(results);
		var pageHeader = JSON.parse(manifest);
document.title = pageHeader[""+page+""]["pageTitle"];
    });
}

//LOAD CUSTOM SCRIPTS
$.getScript(APP_URL+'core/js/custom.js');
$.getScript(APP_URL+'core/js/offline.min.js');
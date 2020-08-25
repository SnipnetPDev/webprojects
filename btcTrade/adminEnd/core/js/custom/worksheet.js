var tmpName = 'admin';
function newWorksheet(hook, cmd)
  {
	   $('#spWorksheet').load('template/'+tmpName+'/worksheet.htm', function() {
		   if(cmd == ''){ hook(); }else{ hook(cmd); }
		});
  }
  
function loadspWorkspace(workspaceType)
  {
	  $('#spWorkspace').html("<center><img class='ajaxpic' src='"+APP_URL+"core/images/loading.svg' width='24px' height='24px'></center>");
	  var workSpace = 'support';
$.ajax({
   url: appFile+'admin'+appExtn,
   method:"POST",
   data:{workSpace:workSpace,workspaceType:workspaceType},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
	 $('#spWorkspace').html(data);
   }
  });
  
  }
function newWorksheet(type, cmd)
  {
	  var Dashboard = document.getElementById("Dashboard");
	  Dashboard.style.display = "none";
	   $('#spWorksheet').load('template/'+tmpName+'/worksheet.htm', function() {
		   if(type == 'page'){
			   $('#worksheet_body').load('template/'+tmpName+'/'+cmd);
		   }
		   if(type == 'data'){
			   var decodedStr = atob(cmd);
	           var Dashboard = document.getElementById("Dashboard");
	           Dashboard.style.display = "none";
	           $('#worksheet_body').html(decodedStr);
		   }
		});
  }
  
function closeWorksheet()
  {
	 $('#content').load('');
  }
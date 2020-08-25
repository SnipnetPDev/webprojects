function loadFiles(filesAppId)
  {
   $("#files"+filesAppId+"").html("<img id='loading-image' class='ajaxpic' src='"+APP_URL+"core/images/loading.svg' width='16px' height=''>");
   $.ajax({
   url: appFile+'admin'+appExtn,
   method:"POST",
   data:{filesAppId:filesAppId},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
	   $("#files"+filesAppId+"").html(data);
   }
  });
}
  
function uploadFiles(PropName, propId, usrMobile, usrName) {
	$("#err"+propId+"").html('Uploading, Please wait...');
    var file_data = $('#'+PropName+'').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('uploadFiles', file_data);     
    form_data.append('uploadFilesId', propId);      
    form_data.append('usrMobile', usrMobile);      
    form_data.append('usrName', usrName);                            
    $.ajax({
        url: appFile+'admin'+appExtn,
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },                         
        type: 'post',
        success: function(data){
            if(data == 0){
				loadFiles(propId);
				$("#err"+propId+"").html('');
			}else{
				$("#err"+propId+"").html(data);
			}
        }
     });
}

function showprevImg(imgProp, inputProp){
document.getElementById(imgProp).src = APP_URL+"core/images/loading.svg";
	var file_data = $('#'+inputProp+'').prop('files')[0];
    var form_data = new FormData();                  
    form_data.append('prevImg', file_data);                            
    $.ajax({
        url: appFile+'admin'+appExtn,
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },                         
        type: 'post',
        success: function(data){
		if(data == 1){
            $('#worksheet_report').html('<font style="color:red;">Failed to upload image, file not supported or too large.</font>');
			}else{
			document.getElementById(imgProp).src = 'data:image'+data;
			 $('#worksheet_report').html('');
			}
        }
     });
}

function updatePage(pageId, pageContent) {
	$("#worksheet_report").html("Uploading, Please wait... <img src='"+APP_URL+"core/images/loading.svg' width='16px' height=''>");
    var file_data = $('#pGdisplay').prop('files')[0];   
	var pGtitle = $("#pGtitle").val();
    var pGdesc = $("#pGdesc").val();
	var pGauth = $('input[name="pGauth"]:checked').val();
	if(pageContent == 'text'){
	var pageTxt = $('#pageTxt').val();
	var pageTxt2 = $('#pageTxt2').val();
	var pageTxt3 = $('#pageTxt3').val();
	var pageTxt4 = $('#pageTxt4').val();
	var pageTxt5 = $('#pageTxt5').val();
	var pageImg = $('#pageImg').prop('files')[0];
	var pageImg2 = $('#pageImg2').prop('files')[0];
	var pageImg3 = $('#pageImg3').prop('files')[0];
	var pageImg4 = $('#pageImg4').prop('files')[0];
	var pageImg5 = $('#pageImg5').prop('files')[0];
	}
	if(pageContent == 'html'){
	var pageTxt = $('#pageTxt').val();
	}
    var form_data = new FormData();                  
    form_data.append('pGdisplay', file_data);     
    form_data.append('pGtitle', pGtitle);      
    form_data.append('pGdesc', pGdesc);     
    form_data.append('pageId', pageId);     
    form_data.append('pGauth', pGauth);     
    form_data.append('pageContent', pageContent); 
    if(pageContent == 'text'){
    form_data.append('pageTxt', pageTxt);     
    form_data.append('pageTxt2', pageTxt2);     
    form_data.append('pageTxt3', pageTxt3);     
    form_data.append('pageTxt4', pageTxt4);     
    form_data.append('pageTxt5', pageTxt5);     
    form_data.append('pageImg', pageImg);     
    form_data.append('pageImg2', pageImg2);     
    form_data.append('pageImg3', pageImg3);     
    form_data.append('pageImg4', pageImg4);     
    form_data.append('pageImg5', pageImg5);    
    }
	if(pageContent == 'html'){
    form_data.append('pageTxt', pageTxt);  
	}
    $.ajax({
        url: appFile+'admin'+appExtn,
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },                         
        type: 'post',
        success: function(data){
            if(data == 0){
		   closeWorksheet();
	   }else{
	       $('#worksheet_report').html(data);
	   }
        }
     });
}

function updateSettings() {
	$("#worksheet_report").html("Uploading, Please wait... <img src='"+APP_URL+"core/images/loading.svg' width='16px' height=''>");
    var logo = $('#logo').prop('files')[0];   
	var address = $("#address").val();
    var phone = $("#phone").val();
    var email = $("#email").val();
	var hours = $('#hours').val();
	var shortAbout = $('#shortAbout').val();
	var twitter = $('#twitter').val();
	var facebook = $('#facebook').val();
	var instagram = $('#instagram').val();
	var android = $('#android').val();
	var ios = $('#ios').val();
    var form_data = new FormData();                  
    form_data.append('logo', logo);     
    form_data.append('address', address);      
    form_data.append('phone', phone);     
    form_data.append('email', email);     
    form_data.append('hours', hours);     
    form_data.append('shortAbout', shortAbout);     
    form_data.append('twitter', twitter);     
    form_data.append('facebook', facebook);     
    form_data.append('instagram', instagram);    
    form_data.append('android', android);    
    form_data.append('ios', ios);                           
    $.ajax({
        url: appFile+'admin'+appExtn,
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },                         
        type: 'post',
        success: function(data){
            if(data == 0){
		   closeWorksheet();
	   }else{
	       $('#worksheet_report').html(data);
	   }
        }
     });
}

function addFAQ()
  {
	   var FAQtitle =  $("#title").val();
	   var FAQshortDesc =  $("#shortDesc").val();
	   var FAQfullDesc =  $("#fullDesc").val();
	   var ele = document.getElementsByName('FAQCategory');
            for(i = 0; i < ele.length; i++) { 
                if(ele[i].checked) 
       var FAQcategory = ele[i].value;
			}
 var form_data = new FormData();         
    form_data.append('FAQtitle', FAQtitle);  
    form_data.append('FAQshortDesc', FAQshortDesc);  
    form_data.append('FAQfullDesc', FAQfullDesc);   
    form_data.append('FAQcategory', FAQcategory);                            
    $.ajax({
        url: appFile+'admin'+appExtn,
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },                         
        type: 'post',
        success: function(data){
            if(data == 0){
		   closeWorksheet();
	   }else{
	       $('#worksheet_report').html(data);
	   }
        }
     });
		
  }   
  
function updateFAQ()
  {
	   var FAQtitle =  $("#title").val();
	   var FAQshortDesc =  $("#shortDesc").val();
	   var FAQfullDesc =  $("#fullDesc").val();
	   var qid =  $("#qid").val();
$.ajax({
   url: appFile+'admin'+appExtn,
   method:"POST",
   data:{FAQtitle:FAQtitle,FAQshortDesc:FAQshortDesc,FAQfullDesc:FAQfullDesc,qid:qid},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
	   if(data == 0){
		   closeWorksheet();
	   }else{
	       $('#worksheet_report').html(data);
	   }
   }
});
		
  }
  
function removeFAQ()
  {
	   var dqid =  $("#qid").val();
$.ajax({
   url: appFile+'admin'+appExtn,
   method:"POST",
   data:{dqid:dqid},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
	   if(data == 0){
		   closeWorksheet();
	   }else{
	       $('#worksheet_report').html(data);
	   }
   }
});
		
  }
  
function updatePanel()
  {
	   var updatePanel = document.getElementById("updatePanel");
	   var deletePanel = document.getElementById("deletePanel");
	   if(updatePanel.style.display === "block"){
		   deletePanel.style.display = "none";
		   updatePanel.style.display = "none";
	   }else if(updatePanel.style.display === "none"){
		   deletePanel.style.display = "none";
		   updatePanel.style.display = "block";
	   }
		
  }

function deletePanel()
  {
	   var updatePanel = document.getElementById("updatePanel");
	   var deletePanel = document.getElementById("deletePanel");
	   if(deletePanel.style.display === "block"){
		   updatePanel.style.display = "none";
		   deletePanel.style.display = "none";
	   }else if(deletePanel.style.display === "none"){
		   updatePanel.style.display = "none";
		   deletePanel.style.display = "block";
	   }
		
  }

function approveReqPanel()
  {
	   var approveReqPanel = document.getElementById("approveReqPanel");
	   var declineReqPanel = document.getElementById("declineReqPanel");
	   declineReqPanel.style.display = "none";
	   approveReqPanel.style.display = "block";
		
  }
  
function declineReqPanel()
  {
	   var approveReqPanel = document.getElementById("approveReqPanel");
	   var declineReqPanel = document.getElementById("declineReqPanel");
		   approveReqPanel.style.display = "none";
		   declineReqPanel.style.display = "block";
		
  }

function approveReq(approvereqId){
	$("#updatePanel").html("Working, Please wait... <img src='"+APP_URL+"core/images/loading.svg' width='16px' height=''>");
$.ajax({
   url: appFile+'admin'+appExtn,
   method:"POST",
   data:{approvereqId:approvereqId},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
	   if(data == 0){
		   closeWorksheet();
	   }else{
	       $('#updatePanel').html(data);
	   }
   }
  });
}

function approveReqDoc(PropName, propId) {
	$("#err"+propId+"").html('Uploading, Please wait...');
    var file_data = $('#'+PropName+'').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('ApprovalFiles', file_data);     
    form_data.append('ApprovalFilesId', propId);                            
    $.ajax({
        url: appFile+'admin'+appExtn,
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },                         
        type: 'post',
        success: function(data){
            if(data == 0){
				$("#err"+propId+"").html('');
				closeWorksheet();
			}else{
				$("#err"+propId+"").html(data);
			}
        }
     });
}

function declineReq(declineReqId){
	$("#updatePanel").html("Working, Please wait... <img src='"+APP_URL+"core/images/loading.svg' width='16px' height=''>");
$.ajax({
   url: appFile+'admin'+appExtn,
   method:"POST",
   data:{declineReqId:declineReqId},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
	   if(data == 0){
		   closeWorksheet();
	   }else{
	       $('#updatePanel').html(data);
	   }
   }
  });
}

function deleteReq(deleteReqId){
	$("#deletePanel").html("Working, Please wait... <img src='"+APP_URL+"core/images/loading.svg' width='16px' height=''>");
$.ajax({
   url: appFile+'admin'+appExtn,
   method:"POST",
   data:{deleteReqId:deleteReqId},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
	   if(data == 0){
		   closeWorksheet();
	   }else{
	       $('#updatePanel').html(data);
	   }
   }
  });
}
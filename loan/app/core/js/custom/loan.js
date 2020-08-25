function loanProducts(productPanel, viewMode)
  {
   $("#"+productPanel+"").html("<img id='loading-image' class='ajaxpic' src='"+APP_URL+"core/images/loading.svg' width='16px' height=''>");
   $.ajax({
   url: appFile+'loan'+appExtn,
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
function loanHistory(loanHistory)
  {
   $("#loanHistory").html("<img id='loading-image' class='ajaxpic' src='"+APP_URL+"core/images/loading.svg' width='16px' height=''>");
   $.ajax({
   url: appFile+'loan'+appExtn,
   method:"POST",
   data:{loanHistory:loanHistory},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
    $('#loanHistory').html(data);
   }
  });
}

function submitApplication()
  {
   $("#subAppBtn").html("<img id='loading-image' class='ajaxpic' src='"+APP_URL+"core/images/loading.svg' width='16px' height=''>");
   var amount =$("#amount").val();
   var loanProdSelect =$("#loanProdSelect").val();
   var loanTerm =$("#loanTerm").val();
   var loanPurpose =$("#loanPurpose").val();
   var Additionalnote =$("#Additionalnote").val();
   $.ajax({
   url: appFile+'loan'+appExtn,
   method:"POST",
   data:{amount:amount,loanProdSelect:loanProdSelect,loanTerm:loanTerm,loanPurpose:loanPurpose,Additionalnote:Additionalnote},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
	   if(data == 0){
		  window.location.href = APP_URL;
	   }else{
		   $('#appErr').html(data);
	   }
   }
  });
}

function loadFiles(filesAppId)
  {
   $("#files"+filesAppId+"").html("<img id='loading-image' class='ajaxpic' src='"+APP_URL+"core/images/loading.svg' width='16px' height=''>");
 var form_data = new FormData();         
    form_data.append('filesAppId', filesAppId);                          
    $.ajax({
        url: appFile+'loan'+appExtn,
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
			$("#files"+filesAppId+"").html(data);
			}
     });
}


function setProdCat(value)
{
   document.getElementById("loanProdSelect").value = value;
   $("#loanProdSelectPaper").html('Selected: <button class="btn btn-sm btn-outline-default px-2 mr-2 mb-2 active" type="button">'+value+'</button>');
}


function loadLoanView(value)
{
   loanViewId = document.getElementById(""+value+"");
   loanViewId.style.display = 'block';
}
function hideLoanView(value)
{
   loanViewId = document.getElementById(""+value+"");
   loanViewId.style.display = 'none';
}


function uploadFiles(PropName, propId) {
	$("#err"+propId+"").html('Uploading, Please wait...');
    var file_data = $('#'+PropName+'').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('uploadFiles', file_data);     
    form_data.append('uploadFilesId', propId);                            
    $.ajax({
        url: appFile+'loan'+appExtn,
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
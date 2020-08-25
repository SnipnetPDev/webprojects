function runReqCheck(runReqCheckuID)
  {
$.ajax({
   url: appFile+'admin'+appExtn,
   method:"POST",
   data:{runReqCheckuID:runReqCheckuID},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
	   $('#worksheet_report').html(data);
   }
});	
  }
  
function handReq(stat, handRequID, trigger)
  {
$.ajax({
   url: appFile+'admin'+appExtn,
   method:"POST",
   data:{stat:stat,handRequID:handRequID,trigger:trigger},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
   if(data == 'pass'){
		   closeWorksheet();
	   }else{
	       $('#worksheet_report').html(data);
	   }
   }
});
  }
  
  
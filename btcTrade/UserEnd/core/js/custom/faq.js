function popularFAQ()
  {
var popularFAQ = 'all';
$("#FAQpanel").html("<center><br/><br/><br/><br/><br/><br/><img id='loading-image' class='ajaxpic' src='"+APP_URL+"core/images/loading.svg' width='60px' height=''><br/><br/><br/><br/></center>");
   $.ajax({
   url: appFile+'faq'+appExtn,
   method:"POST",
   data:{popularFAQ:popularFAQ},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
    $('#FAQpanel').html(data);
   }
  });
  }
 
function loadFaqCat(FAQcatID)
  {
$("#FAQpanel").html("<center><br/><br/><br/><br/><br/><br/><img id='loading-image' class='ajaxpic' src='"+APP_URL+"core/images/loading.svg' width='60px' height=''><br/><br/><br/><br/></center>");
   $.ajax({
   url: appFile+'faq'+appExtn,
   method:"POST",
   data:{FAQcatID:FAQcatID},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
    $('#FAQpanel').html(data);
   }
  });
  }
  
function searchFaqCat() {
  var FAQsearch =$("#search-input").val();
  if(FAQsearch == ''){
  var faqdashboard = document.getElementById("faqdashboard");
  var FAQpanel = document.getElementById("FAQpanel");
  var FAQsearchbd = document.getElementById("FAQsearch");
    faqdashboard.style.display = "block";
    FAQpanel.style.display = "block";
    FAQsearchbd.style.display = "none";
  }else{
  var faqdashboard = document.getElementById("faqdashboard");
  var FAQpanel = document.getElementById("FAQpanel");
  var FAQsearchbd = document.getElementById("FAQsearch");
    faqdashboard.style.display = "none";
    FAQpanel.style.display = "none";
    FAQsearchbd.style.display = "block";
   $.ajax({
   url: appFile+'faq'+appExtn,
   method:"POST",
   data:{FAQsearch:FAQsearch},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
   success:function(data)
   {
    $('#FAQsearch').html(data);
   }
  });
  }
}
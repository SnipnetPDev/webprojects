/**
 * Created by ANICET ERIC KOUAME on 05/03/2017.
 * change due to function change of displying base64 instead by MARCO GOETZE 10 April 2017
 */
//function to format bites bit.ly/19yoIPO


function imgBase64(imageInput, returnImgView, errorProperty, dbComand) {
    beforeSubmit(imageInput, returnImgView, errorProperty, dbComand);
    $("#"+errorProperty+"").focus(function() {
        // Select all on focus; 
        // Source:  https://stackoverflow.com/questions/5797539/jquery-select-all-text-from-a-textarea
        var $this = $(this);
        $this.select();
        // Work around Chrome's little problem
        $this.mouseup(function() {
            // Prevent further mouseup intervention
            $this.unbind("mouseup");
            return false;
        });
    });      
};




//function to check file size before uploading.
function beforeSubmit(imageInput, returnImgView, errorProperty, dbComand) {

    $('#'+returnImgView+'').html("<img id='loading-image' class='ajaxpic' src='"+APP_URL+"core/images/loading.svg' >");


    //check whether browser fully supports all File API
    if (window.File && window.FileReader && window.FileList && window.Blob) {

        if (!$('#'+imageInput+'').val()) //check empty input filed
        {
            $("#"+errorProperty+"").html("<font style='color:red;'>A valid Jpg, Png, Jpeg is required</font>");
            return false
        }

        var fsize = $('#'+imageInput+'')[0].files[0].size; //get file size
        var ftype = $('#'+imageInput+'')[0].files[0].type; // get file type

        //allow only valid image file types
        switch (ftype) {
            case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/pjpeg':
            break;
            default:
                $("#"+errorProperty+"").html("<font style='color:red;'><b>" + ftype + "</b>  Unsupported file type! </font>");
                return false
        }

        //Allowed file size is less than 1 MB (1048576)
        if (fsize > 1048576) {
            $("#"+errorProperty+"").html("<font style='color:red;'><b>" + bytesToSize(fsize) + "</b> Too big Image file! <br />Please reduce the size of your photo using an image editor.</font>");
            return false
        }


        encodeImageFileAsURL(ftype, imageInput, returnImgView, errorProperty, dbComand);
    }
    else {
        //Output error to older unsupported browsers that doesn't support HTML5 File API
        $("#"+errorProperty+"").html("<font style='color:red;'>Please upgrade your browser, because your current browser lacks some new features we need!</font>!");
        return false;
    }
}
function encodeImageFileAsURL(ftype, imageInput, returnImgView, errorProperty, dbComand){



    var fileUpload = $('#'+imageInput+'').get(0);
    var file = fileUpload.files;


    // alert(file);
    if (file.length > 0)
    {
        var fileToLoad = file[0];

        var fileReader = new FileReader();

        fileReader.onload = function(fileLoadedEvent) {
            var srcData = fileLoadedEvent.target.result; // <--- data: base64

            // alert(srcData);
            upload(srcData,ftype,imageInput,returnImgView,errorProperty,dbComand);
        };
        fileReader.readAsDataURL(fileToLoad);
    }
}

function upload(base64Image,ftype,imageInput,returnImgView,errorProperty,dbComand){


    // AJAX Code To Submit Form.
    $.ajax({
        type: "POST",
        url: appFile+'upload'+appExtn,
        data: {"img": base64Image, "ex": ftype},
		beforeSend : function(req) {
        req.setRequestHeader('Authorization', token);
        },
        cache: false,
        success: function(result){

            console.log(result);
            if(result){
                var image = $("<img>", {
                    "src": result
                });
                $("#"+returnImgView+"").empty();
                $("#"+returnImgView+"").append(image);
                $("#"+errorProperty+"").empty();
				window[""+dbComand+""](result);
             
            }else{
                $("#"+returnImgView+"").empty();
                $("#"+errorProperty+"").empty();
                $("#"+errorProperty+"").html("<font style='color:red;'>Error: failed to upload image!</font>");
            }

        },
        error: function (r) {
            console.log("ERROR");
            console.log(r);

            $("#"+returnImgView+"").empty();
            $("#"+errorProperty+"").empty();
            $("#"+errorProperty+"").html("<font style='color:red;'>Error: failed to upload image!</font>");

        }
    });
}



function bytesToSize(bytes) {
    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    if (bytes == 0) return '0 Bytes';
    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}

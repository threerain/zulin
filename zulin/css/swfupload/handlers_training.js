/* Demo Note:  This demo uses a FileProgress class that handles the UI for displaying the file name and percent complete.
The FileProgress class is not part of SWFUpload.
*/


/* **********************
   Event Handlers
   These are my custom event handlers to make my
   web application behave the way I went when SWFUpload
   completes different tasks.  These aren't part of the SWFUpload
   package.  They are part of my application.  Without these none
   of the actions SWFUpload makes will show up in my application.
   ********************** */
function fileQueued(file) {
	try {
		//alert("fileQueued");
		//alert(project.questionid);
		//return ;
		//var progress = new FileProgress(file, this.customSettings.progressTarget);
		//progress.setStatus("Pending...");
		//progress.toggleCancel(true, this);



		//$("#progress_upload").html(file.name);


	} catch (ex) {
		this.debug(ex);
	}

}

function fileQueueError(file, errorCode, message) {
	try {
		
		if (errorCode === SWFUpload.QUEUE_ERROR.QUEUE_LIMIT_EXCEEDED) {
			//alert("You have attempted to queue too many files.\n" + (message === 0 ? "You have reached the upload limit." : "You may select " + (message > 1 ? "up to " + message + " files." : "one file.")));
			alert("文件数量超出限制");
			return;
		}

		switch (errorCode) {
            case SWFUpload.QUEUE_ERROR.FILE_EXCEEDS_SIZE_LIMIT:

                alert("文件太大了，超出上传限制");
                this.debug("Error Code: File too big, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
                break;

            case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE:
                alert("不能上传零字节的文件");
                this.debug("Error Code: Zero byte file, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
                break;
            case SWFUpload.QUEUE_ERROR.INVALID_FILETYPE:
                alert("文件类型不符");
                this.debug("Error Code: Invalid File Type, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
                break;
            default:
                if (file !== null) {
                    //progress.setStatus("Unhandled Error");
                }
                this.debug("Error Code: " + errorCode + ", File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
                break;
		}
	} catch (ex) {
        this.debug(ex);
    }
}

function fileDialogComplete(numFilesSelected, numFilesQueued) {
	try {
		if (numFilesSelected > 0) {
			//document.getElementById(this.customSettings.cancelButtonId).disabled = false;

            //显示进度条
            $(".upload_progress").show();
            $(".progress").html("");

		}

		/* I want auto start the upload and I can do that here */
		this.startUpload();
	} catch (ex)  {
        this.debug(ex);
	}
}

function uploadStart(file) {
	try {
		//alert("uploadStart"+file.name);
		this.addPostParam("fn", file.name);
        //console.log(file.name);
		$(".upload_progress .localname").html(file.name);
	}
	catch (ex) {}
	
	return true;
}

function uploadProgress(file, bytesLoaded, bytesTotal) {
	try {
		var percent = Math.ceil((bytesLoaded / bytesTotal) * 100);

		if(percent==100)
		{
			$(".upload_progress .progress").html(percent+"% 上传完成").css("width",4*percent+"px");
		}
		else
		{
			$(" .upload_progress .progress").html(percent+"%").css("width",4*percent+"px");
		}	

		
		//alert("111");
		
	} catch (ex) {
		this.debug(ex);
	}
}

function uploadSuccess(file, serverData) {
    //alert("222");
	try {
        //alert(serverData);
		var retdata = eval("("+serverData+")");
		if(retdata.code==1)
		{
			$(".upload_progress .progress").html("100% 附件保存成功");
            $("input[name=uploadfile]").val(retdata.data.file_name);
		}
		else
		{


		}

	} catch (ex) {
		this.debug(ex);
	}
}

function uploadError(file, errorCode, message) {
	try {
		switch (errorCode) {
		case SWFUpload.UPLOAD_ERROR.HTTP_ERROR:
			
			this.debug("Error Code: HTTP Error, File name: " + file.name + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_FAILED:
			
			this.debug("Error Code: Upload Failed, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.IO_ERROR:
			
			this.debug("Error Code: IO Error, File name: " + file.name + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.SECURITY_ERROR:
			
			this.debug("Error Code: Security Error, File name: " + file.name + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_LIMIT_EXCEEDED:
			
			this.debug("Error Code: Upload Limit Exceeded, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.FILE_VALIDATION_FAILED:
			
			this.debug("Error Code: File Validation Failed, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.FILE_CANCELLED:
			// If there aren't any files left (they were all cancelled) disable the cancel button
			if (this.getStats().files_queued === 0) {
				document.getElementById(this.customSettings.cancelButtonId).disabled = true;
			}
			
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_STOPPED:
			
			break;
		default:
			
			this.debug("Error Code: " + errorCode + ", File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		}
	} catch (ex) {
        this.debug(ex);
    }
}

function uploadComplete(file) {
    //alert("333");
	if (this.getStats().files_queued === 0) {
		//document.getElementById(this.customSettings.cancelButtonId).disabled = true;
	}
}

// This event comes from the Queue Plugin
function queueComplete(numFilesUploaded) {
   /// alert("444");
	//var status = document.getElementById("divStatus");
	//status.innerHTML = numFilesUploaded + " file" + (numFilesUploaded === 1 ? "" : "s") + " uploaded.";
}

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

	} catch (ex) {
		this.debug(ex);
	}

}

function fileQueueError(file, errorCode, message) {
	try {
		//alert(errorCode+":"+message);
		if (errorCode === SWFUpload.QUEUE_ERROR.QUEUE_LIMIT_EXCEEDED) {
			//alert("You have attempted to queue too many files.\n" + (message === 0 ? "You have reached the upload limit." : "You may select " + (message > 1 ? "up to " + message + " files." : "one file.")));
			alert("图片数量超出限制");
			return;
		}

		switch (errorCode) {
		case SWFUpload.QUEUE_ERROR.FILE_EXCEEDS_SIZE_LIMIT:
			alert("文件太大了，最大只能上传1M大小的图片");
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
		//alert("filedialog complete");
		//alert(numFilesSelected+":"+numFilesQueued);
		
		
		//alert(this.getStats().files_queued);
		//console.log(this.getStats());
		var isuploaded=false;
		var icount=0;
		$(".plan_right_pic ul li").each(function(){
			var imgobj=$(this).children("img");
			if(imgobj.attr("src")!="ui/images/no_pic.gif" && imgobj.attr("src")!="ui/images/ajaxloader.gif")
			{
				icount=icount+1;
			}
		    });
		//alert(icount);
		if(icount==4)
		{
			alert("本页最多只能上传4张图片");
			return;
		}
		
		
		//return;
		if (numFilesSelected > 0) {
			document.getElementById(this.customSettings.cancelButtonId).disabled = false;
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
		this.addPostParam("questionid", project.questionid);
		this.addPostParam("projectid",project.projectid);
		
		
		$(".plan_right_pic ul li").each(function(){
			    var imgobj=$(this).children("img");
			    //alert()
			    //console.log(imgobj.attr("src"));
			    if(imgobj.attr("src")=="ui/images/no_pic.gif")
			    {
				    imgobj.attr("src","ui/images/ajaxloader.gif");
				    return false;
			    }				
			});
		//alert("dddddddddddddd");

	}
	catch (ex) {}
	
	return true;
}

function uploadProgress(file, bytesLoaded, bytesTotal) {
	try {
		var percent = Math.ceil((bytesLoaded / bytesTotal) * 100);

		//var progress = new FileProgress(file, this.customSettings.progressTarget);
		//progress.setProgress(percent);
		//progress.setStatus("Uploading...");
	} catch (ex) {
		this.debug(ex);
	}
}

function uploadSuccess(file, serverData) {
	try {
		//alert(serverData);
		var retdata = eval("("+serverData+")");
		if(retdata.status>0)
		{
			$(".plan_right_pic ul li").each(function(){
			
				var thisobj=this;
			    var imgobj=$(this).children("img");
			    var bobj=$(this).children("b");
			    //alert()
			    //console.log(imgobj.attr("src"));
			    if(imgobj.attr("src")=="ui/images/no_pic.gif" || imgobj.attr("src")=="ui/images/ajaxloader.gif")
			    {
				    imgobj.attr("src","uploads/bp/small/"+retdata.filename);
				    
				    bobj.show().unbind().bind("click",function(){
					if(confirm("确定要删除该图片吗？"))
					{
					   doDeletePhoto(retdata.status,thisobj); 
					}					
					});
				    
				    return false;
			    }
			});
    
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
	if (this.getStats().files_queued === 0) {
		document.getElementById(this.customSettings.cancelButtonId).disabled = true;
	}
}

// This event comes from the Queue Plugin
function queueComplete(numFilesUploaded) {
	//var status = document.getElementById("divStatus");
	//status.innerHTML = numFilesUploaded + " file" + (numFilesUploaded === 1 ? "" : "s") + " uploaded.";
}

<?php

class UploadController extends Controller
{

	public function actionAvatar()
	{
		// echo "string";
		// die();
		//$controller = $this->getController();
        $type = "temp";
        //$rand_path=$this->get_rand_string() . "/" . $this->get_rand_string() . "/" . $this->get_rand_string()."/";
        //文件保存目录路径        
        // $save_path = "/home/web/p2/img/". $rand_path;//"assets/temp/";//Yii::app()->params[$type]['savepath'];
        // $save_url  = "http://182.92.66.151/img/".$rand_path;//Yii::app()->params[$type]['saveurl'];  

        $save_path = "data/avatar/".date('ym').'/';//"assets/temp/";//Yii::app()->params[$type]['savepath'];
        $save_url  = "/data/avatar/".date('ym').'/';//Yii::app()->params[$type]['saveurl'];  
        $ext_arr   = array('gif', 'jpg', 'jpeg', 'png', 'bmp','dwg');//Yii::app()->params[$type]['filetype']; 
        $max_size  = 1000000;//Yii::app()->params[$type]['maxsize'];  

        $error = "";  
        $file_url = "";       
        
        $file_field = "filename";
        //PHP上传失败
        if (!empty($_FILES[$file_field]['error'])) {
                switch($_FILES[$file_field]['error']){
                        case '1':
                                $error = '超过php.ini允许的大小。';
                                break;
                        case '2':
                                $error = '超过表单允许的大小。';
                                break;
                        case '3':
                                $error = '图片只有部分被上传。';
                                break;
                        case '4':
                                $error = '请选择图片。';
                                break;
                        case '6':
                                $error = '找不到临时目录。';
                                break;
                        case '7':
                                $error = '写文件到硬盘出错。';
                                break;
                        case '8':
                                $error = 'File upload stopped by extension。';
                                break;
                        case '999':
                        default:
                                $error = '未知错误。';
                }
                
        }
        
        
        //有上传文件时
        $new_file_name="";
        if (empty($_FILES) === false) {

            if (!file_exists($save_path)) {
                    mkdir($save_path,0755,true);
            }
            
            //原文件名
            $file_name = $_FILES[$file_field]['name'];
            //服务器上临时文件名
            $tmp_name = $_FILES[$file_field]['tmp_name'];
            //文件大小
            $file_size = $_FILES[$file_field]['size'];
            //检查文件名
            if (!$file_name) {
                    $error = "请选择文件。";
            }
            //检查目录
            if (@is_dir($save_path) === false) {
                    $error = "上传目录不存在。";
            }

            //检查目录写权限
            if (@is_writable($save_path) === false) {
                    $error = "上传目录没有写权限。";
            }
            //检查是否已上传
            if (@is_uploaded_file($tmp_name) === false) {
                    $error = "上传失败。";
            }
            //检查文件大小
            if ($file_size > $max_size) {
                    $error = "上传文件大小超过限制。";
            }

            //获得文件扩展名
            $temp_arr = explode(".", $file_name);
            $file_ext = array_pop($temp_arr);
            $file_ext = trim($file_ext);
            $file_ext = strtolower($file_ext);

            if (in_array($file_ext, $ext_arr) === false) {
                    $error = "上传文件扩展名是不允许的扩展名。\n只允许" . implode(",", $ext_arr) . "格式。";
            }

            //新文件名
            $_nowdate = date("YmdHis");
            $rnd = rand(10000, 99999);
            //$new_file_name = date("YmdHis") . '_' . $rnd . '.' . $file_ext;
            $new_file_name = $_nowdate . '_' . $rnd . '.' . $file_ext;
            //移动文件
            $file_path = $save_path . $new_file_name;
            if (move_uploaded_file($tmp_name, $file_path) === false) {
                    //alert("上传文件失败。");
            }

            $file_url = $save_url . $new_file_name;
        }


        $out = array(                         
                     'code'=>0,
                     'message'=>'',
                     'data'=>null,
                     );

        if($error){
            $out['message'] = $error;
        }
        else{
            $out['code'] = 1;
            $out['data'] = array(
                "file_url"  => $file_url,
                "old_file_name"  => $file_name,
                "file_name" => $new_file_name,
            );
        }

        echo $this->decodeUnicode(json_encode($out));
	}

    

	protected function decodeUnicode($str)
    {
        return preg_replace_callback('/\\\\u([0-9a-f]{4})/i',
            create_function(
                '$matches',
                'return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");'
            ),
            $str);
    }

    function get_rand_string($pw_length = 2)
    {
        $randpwd = '';
        for ($i = 0; $i < $pw_length; $i++)
        {
            $randpwd .= chr(mt_rand(97, 122));
        }
        return $randpwd;
    }

	
}

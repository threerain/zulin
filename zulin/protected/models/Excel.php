<?php 

	class Excel{     
	    private $limit = 10000;
	         
	    public function download($data, $fileName)
	    {
	        $fileName = $this->_charset($fileName);
	        header("Content-Type: application/vnd.ms-excel; charset=gbk");
	        header("Content-Disposition: inline; filename=\"" . $fileName . ".xls\"");
	        echo "<?xml version=\"1.0\" encoding=\"gbk\"?>\n
	            <Workbook xmlns=\"urn:schemas-microsoft-com:office:spreadsheet\"
	            xmlns:x=\"urn:schemas-microsoft-com:office:excel\"
	            xmlns:ss=\"urn:schemas-microsoft-com:office:spreadsheet\"
	            xmlns:html=\"http://www.w3.org/TR/REC-html40\">";        
	        echo "\n<Worksheet ss:Name=\"" . $fileName . "\">\n<Table>\n";
	        $guard = 0;        
	        foreach($data as $v)
	        {
	            $guard++;           
	            if($guard==$this->limit)
	            {
	                ob_flush();
	                flush();
	                $guard = 0;
	            }            
	            echo $this->_addRow($this->_charset($v));
	        }        
	        echo "</Table>\n</Worksheet>\n</Workbook>";
	    } 
	        
	    private function _addRow($row)
	    {
	        $cells = "";        
	        foreach ($row as $k => $v){
	            $cells .= "<Cell><Data ss:Type=\"String\">" . $v . "</Data></Cell>\n";
	        }        
	        return "<Row>\n" . $cells . "</Row>\n";
	    }
	         
	    private function _charset($data)
	    {       
	        if(!$data){            
	            return false;
	        }        
	        if(is_array($data)){           
	             foreach($data as $k=>$v){
	                $data[$k] = $this->_charset($v);
	            }            
	            return $data;
	        }        
	        return iconv('utf-8', 'gbk', $data);
	    }

	 	public  function uploadexcel()
	    {

	        if (! empty ( $_FILES ['file_excel'] ['name'] ))
	        {
	            $tmp_file = $_FILES ['file_excel'] ['tmp_name'];
	            $file_types = explode ( ".", $_FILES ['file_excel'] ['name'] );
	            $file_type = $file_types [count ( $file_types ) - 1];
	             /*判别是不是.xls文件，判别是不是excel文件*/

	             if (strtolower ( $file_type ) != "xls" && strtolower ($file_type ) != "xlsx")              
	            {
	                $this->OutputJson(0,'不是Excel文件，重新上传',null);
	            }
	            /*设置上传路径*/
	             $save_path = "data/avatar/".date('ym').'/';
	            /*以时间来命名上传的文件*/
	             $str = date ( 'Ymdhis' ); 
	             $file_name = $str . "." . $file_type;
	            /*是否上传成功*/
	            if (! copy ( $tmp_file, $save_path . $file_name )) 
	            {
	                $this->OutputJson(0,'上传失败',null);
	            }
	            $res = $this->read($save_path.$file_name,'',$file_type);
	            return $res;
	        }else{
            	return false;
	        }
	    }
	    
	    /**
	     * 读取excel输出数组
	     * @param  [str] $filename [文件路径+文件名]
	     * @param  string $encode   [description]
	     * @return [array]           [description]
	     */
	    public function read($filename,$encode='utf-8',$file_type)
	    {

	        if( $file_type =='xlsx' )
			{
			 	$objReader = PHPExcel_IOFactory::createReader('Excel2007');
			}
			else
			{
	        	$objReader = PHPExcel_IOFactory::createReader('Excel5');
			}
	        $objReader->setReadDataOnly(true);
	        $objPHPExcel = $objReader->load($filename);
	        $objWorksheet = $objPHPExcel->getActiveSheet();
	        $highestRow = $objWorksheet->getHighestRow(); 
	        $highestColumn = $objWorksheet->getHighestColumn();
	        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); 
	        $excelData = array();
	        for ($row = 1; $row <= $highestRow; $row++) {
	            for ($col = 0; $col < $highestColumnIndex; $col++) { 
	                $excelData[$row][] =(string)$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
	            }
	        }
	        return $excelData;
	    }  
	     
	}





 ?>
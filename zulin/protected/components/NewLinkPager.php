<?php
/*
重新定义了这几个标签
*/
class NewLinkPager extends CLinkPager{
    
    
    /**
    * @isTotal boolean ，if show the totalrecord button, Default is true.
    */
    public $isTotal = true;
    
    public function init()
    {
        $this->firstPageLabel = '首页';
        $this->prevPageLabel  = '上一页';
        $this->nextPageLabel  = '下一页';
        $this->lastPageLabel  = '末页';

        $this->htmlOptions['class']="";//pagination";
        $this->firstPageCssClass="previous";//"paginate_button previous";
        $this->lastPageCssClass="next";//"paginate_button next";
        $this->previousPageCssClass="previous";
        $this->nextPageCssClass="next";
        $this->selectedPageCssClass="active";
        $this->hiddenPageCssClass="disabled";
        parent::init();            
    }
    
    
    public function run()
    {
        $buttons = $this->createPageButtons();
        if (empty($buttons))
                return;
        
        /*
        添加 总记录数
        */
        if($this->isTotal){
            $buttons[]="<li class=itemcount style='line-height:38px'>共:".$this->getItemCount()."条</li>";
        }
        

        //添加每页显示多少条数
        $arrPagesize = array(10,20,50,100);
        $strPagesize = "";
        foreach ($arrPagesize as $key => $value) {
            # code...
            $selected = "";
            if(isset($_GET['pagesize'])){
                if($_GET['pagesize']==$value){
                     $selected = " selected";
                }
            }
            $strPagesize .= "<a href='".$this->_createPagesizeUrl($value)."' class='".$selected."'>".$value."</a>";
        }
        //$this->_createPagesizeUrl(310);

       // $buttons[]="<li class=pagesize>每页 $strPagesize 条</li>";
        //$buttons[]='<li class="ss">'.CHtml::link('20',$this->createPageUrl(0)).'</li>';

        echo CHtml::tag('ul', $this->htmlOptions, implode("\n", $buttons));
    }

    private function _createPagesizeUrl($pagesize){

        $current_url=$this->createPageUrl($this->getCurrentPage());     
        $arrGet = $_GET;
        $querystring = "/";
        $bExist = false;
        foreach ($arrGet as $key => $value) {            
            if(strtolower($key)=="pagesize"){
                $bExist = true;
                $arrGet[$key] = $pagesize;
                break;
            }
        }

        if($bExist){

            $_arr = explode("/", $current_url);
            $i=0;
            foreach ($_arr as $key => $value) {  
                $i++;
                if(strtolower($value)=="pagesize"){
                    
                    break;
                }
               
            }

            $_arr[$i++]=$pagesize;
            $current_url = implode("/", $_arr);
        }
        else{
            $current_url .= "/pagesize/".$pagesize;
        }
        
        return $current_url;
    }
}
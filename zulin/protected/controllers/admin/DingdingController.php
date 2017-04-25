<?php

class DingdingController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    // public $layout='//layouts/backgroundcenter2';
    public $PAGE_LEVEL_STYLES = null ;
    public $PAGE_LEVEL_PLUGINS=null;
    public $PAGE_LEVEL_SCRIPTS=null;

    public $title='收款人确认';
    public $layout='//layouts/background_right';
    public $islogin=false;

    /**
     * Lists all models.
     */

    
    /**
     * 销售确认列表
     */
    public function actionindex()
    {
        $this->render('index',array(
            
        ));
    }
    
}

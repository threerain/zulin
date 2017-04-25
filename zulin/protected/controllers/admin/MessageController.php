<?php

class MessageController extends BackgroundBaseController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	// public $layout='//layouts/backgroundcenter2';
    public $PAGE_LEVEL_STYLES = null ;
    public $PAGE_LEVEL_PLUGINS=null;
    public $PAGE_LEVEL_SCRIPTS=null;

	public $title='短信列表';

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $keyword =Yii::app()->request->getParam("keyword");

		$pagesize=10;
		if(!empty($keyword)){
			$admin=AdminUser::model()->findAll("nickname like '%".$keyword."%'");
			$admin_id="";
			foreach ($admin as $key => $value) {
			    if ($key==0){
			        $admin_id.="'".$value->id."'";
			    }
			    else{
			        $admin_id.=","."'".$value->id."'";
			    }

			}
		}
		$condition = "1=1";
        if (isset($admin_id)){
        	$condition .=" and admin_uid in ($admin_id)";
        }
        $criteria=new CDbCriteria;

        $criteria->order='t.ctime DESC';
        $criteria->condition=$condition;
        $count = Message::model()->count($criteria);

        $pager=new CPagination($count);
        $pager->pageSize=$pagesize;
        $pager->applyLimit($criteria);

        $list =Message::model()->findAll($criteria);

        $this->render("index",array(
            'list'=>$list,
            'pages'=>$pager,
            'keyword'=>$keyword,
        ));

		// echo "string";
		// $this->render("index");
	}

    
}

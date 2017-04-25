
<?php

/*
渠道公司维护
*/

class ChannelController extends BackgroundBaseController
{
    //const PAGE_SIZE = 20;
    //protected function beforeRender($view)
    //{
        //Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/ui/js/admin/faxingorder.js",CClientScript::POS_END );  
    //    return true;
    //}

    public function actionIndex(){
        $keyword=Yii::app()->request->getParam("keyword");
        $pagesize=10;

        $criteria=new CDbCriteria;
        if($keyword){
            $criteria->addCondition("t.name like '%$keyword%' ");
        }
        $criteria->addCondition("t.deleted=0");
        $criteria->order="t.ctime desc";
        $count=CmsChannel::model()->count($criteria);
        $pager=new CPagination($count);
        $pager->pageSize=$pagesize;
        $pager->applyLimit($criteria);
        
        $list = CmsChannel::model()->findAll($criteria);

        $this->render('index',array(
			'list'=>$list,
            'pages'=>$pager,
            'keyword'=>$keyword,
		));
    }  

    public function actionCreate(){  
        $referer=$_SERVER['HTTP_REFERER'];
        $this->render("create",array(
            'referer'=>$referer,
        ));
    }

    public function actionCreateSave(){  
        $referer=$_SERVER['HTTP_REFERER'];

        $name =Yii::app()->request->getParam("name");

        $model =CmsChannel::model()->find("t.name='$name' && deleted=0");
        if($model){
            $this->OutputJson(0,"公司已存在",null);
        }

        $model =new CmsChannel();
        $model->id=Guid::create_guid();
        $model->name=$name;
        $model->creater_id=Yii::app()->session['admin_uid'];
        $model->deleted=0;
        $model->ctime=time();

        if(!$model->save()){
            $this->OutputJson(0,json_encode($model->errors,JSON_UNESCAPED_UNICODE),null);
        }
        $this->OutputJson(301,'',"/admin/channel");
    }

    public function actionEdit(){
        $referer=$_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");

        $model=CmsChannel::model()->find("t.id='$id'");
        
        $this->render('edit',array(
			'model'=>$model,
            'referer'=>$referer,
		));

    }  

    public function actionEditSave(){  
        $referer =Yii::app()->request->getParam("referer");
        $id =Yii::app()->request->getParam("id");
        $name =Yii::app()->request->getParam("name");;
        $data =CmsChannel::model()->find("t.name='$name' and deleted=0 and id<>'$id'");
        if($data){
            $this->OutputJson(0,"渠道公司名已存在",null);
        }
        $model=CmsChannel::model()->find("t.id='$id'");
        if($model){
            $model->name = $name;

            if(!$model->save()){
                $this->OutputJson(0,json_encode($model->errors,JSON_UNESCAPED_UNICODE),null);
            }
        }
		$this->OutputJson(301,'',$referer);
    } 

    public function actionDelete(){
		$referer=$_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");

        $model=CmsChannel::model()->find("t.id='$id'");
        $model->deleted=1;
        if(!$model->save()){
            $this->OutputJson(0,json_encode($model->errors,JSON_UNESCAPED_UNICODE),null);
        }

        if(Yii::app()->request->isAjaxRequest){
            $this->OutputJson(301,'',$_SERVER['HTTP_REFERER']);
        }
        else{
            $this->redirect($_SERVER['HTTP_REFERER']);
        }
    }  

    public function actionAjaxlist()
    {
        $data=null;
        $criteria=new CDbCriteria;
        $keyword =Yii::app()->request->getParam("q");
        if ($keyword){
            $criteria->condition="1=1 and t.deleted=0 and t.name like '%$keyword%'";
        }
        $count = CmsChannel::model()->count($criteria);
        $pager=new CPagination($count);
        $pager->pageSize=10;//$pagesize;
        $pager->applyLimit($criteria);
        $list =CmsChannel::model()->findAll($criteria);
        foreach ($list as $key => $user) {
            $_data["id"]=$user->id;
            $_data["title"]=$user->name;
            $data["movies"][]=$_data;
        }
        header('Content-Type:application/json;charset=utf-8');
        echo json_encode($data,JSON_UNESCAPED_UNICODE);

    }
    public function actionAjaxitem()
    {
        $id =Yii::app()->request->getParam("id");
        $criteria=new CDbCriteria;
        $item =CmsChannel::model()->find("id='$id'");
        $_data["id"]=$item->id;
        $_data["title"]=$item->name;
        $data=$_data;

        header('Content-Type:application/json;charset=utf-8');
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        
        die();
    }
}
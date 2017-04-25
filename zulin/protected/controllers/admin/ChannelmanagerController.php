
<?php

/*
渠道公司人员维护
*/

class ChannelmanagerController extends BackgroundBaseController
{
    //const PAGE_SIZE = 20;
    //protected function beforeRender($view)
    //{
        //Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/ui/js/admin/faxingorder.js",CClientScript::POS_END );  
    //    return true;
    //}

    public function actionIndex(){
        $keyword=Yii::app()->request->getParam("keyword");
        $keyword_company=Yii::app()->request->getParam("keyword_company");
        $pagesize=10;

        $criteria=new CDbCriteria;
        if($keyword){
            $criteria->addCondition("t.name like '%$keyword%' and deleted = 0 ");
        }
        if($keyword_company){
            //由公司名字查出自身的ID
            $channel = CmsChannel::model()->find("t.name like '%$keyword_company%' and deleted = 0");
            $channel_id = $channel->id;
            $criteria->addCondition("t.channel_id='$channel_id'");
        }
        $criteria->addCondition("t.deleted=0");
        $criteria->order="t.ctime desc";
        $count=CmsChannelManager::model()->count($criteria);
        $pager=new CPagination($count);
        $pager->pageSize=$pagesize;
        $pager->applyLimit($criteria);
        
        $list = CmsChannelManager::model()->findAll($criteria);

        $this->render('index',array(
			'list'=>$list,
            'pages'=>$pager,
            'keyword'=>$keyword,
            'keyword_company'=>$keyword_company,
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

        $channel_id =Yii::app()->request->getParam("channel_id");

        $name =Yii::app()->request->getParam("name");
        $phone =Yii::app()->request->getParam("phone");

        $model =CmsChannelManager::model()->find("t.channel_id='$channel_id' && t.name='$name' && deleted=0");
        if($model){
            $this->OutputJson(0,"人员已存在",null);
        }

        $model =new CmsChannelManager();
        $model->id=Guid::create_guid();
        $model->channel_id=$channel_id;

        $model->name=$name;
        $model->phone=$phone;
        $model->creater_id=Yii::app()->session['admin_uid'];
        $model->deleted=0;
        $model->ctime=time();

        if(!$model->save()){
            $this->OutputJson(0,json_encode($model->errors,JSON_UNESCAPED_UNICODE),null);
        }
        $this->OutputJson(301,'',"/admin/channelmanager");
    }

    public function actionEdit(){
        $referer=$_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");

        $model=CmsChannelManager::model()->find("t.id='$id'");
        
        $this->render('edit',array(
			'model'=>$model,
            'referer'=>$referer,
		));

    }  

    public function actionEditSave(){  
        $referer =Yii::app()->request->getParam("referer");
        $id =Yii::app()->request->getParam("id");
        $channel_id =Yii::app()->request->getParam("channel_id");
        $name = Yii::app()->request->getParam("name");
        $data = CmsChannelManager::model()->find("t.channel_id = '$channel_id' and t.name='$name' and t.deleted=0 and id<>'$id'");
        if($data){ 
            $this->OutputJson(0,"该渠道公司中的姓名已存在",null);
        }
        $model=CmsChannelManager::model()->find("t.id='$id'");
        if($model){
            $model->channel_id =$channel_id;

            $model->name =$name;
            $model->phone =Yii::app()->request->getParam("phone");

            if(!$model->save()){
                $this->OutputJson(0,json_encode($model->errors,JSON_UNESCAPED_UNICODE),null);
            }
        }
		$this->OutputJson(301,'',$referer);
    } 

    public function actionDelete(){
		$referer=$_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");

        $model=CmsChannelManager::model()->find("t.id='$id'");
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
        $channel_id =Yii::app()->request->getParam("channel_id");

        if ($keyword){
            $criteria->condition="1=1 and t.deleted=0 and t.name like '%$keyword%' and channel_id = '$channel_id'";
        }
        $count = CmsChannelManager::model()->count($criteria);
        $pager=new CPagination($count);
        $pager->pageSize=10;//$pagesize;
        $pager->applyLimit($criteria);
        $list =CmsChannelManager::model()->findAll($criteria);
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
        $item =CmsChannelManager::model()->find("id='$id'");

        $_data["id"]=$item->id;
        $_data["title"]=$item->name;
        $data=$_data;

        header('Content-Type:application/json;charset=utf-8');
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        
        die();
    }
}
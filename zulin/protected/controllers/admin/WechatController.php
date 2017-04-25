<?php

class WechatController extends BackgroundBaseController
{
    public $PAGE_LEVEL_STYLES = null ;
    public $PAGE_LEVEL_PLUGINS=null;
    public $PAGE_LEVEL_SCRIPTS=null;
	public function actionIndex()
	{
        $keyword =Yii::app()->request->getParam("keyword");
		$pagesize=10;
        $criteria=new CDbCriteria;
        if ($keyword){
        	$criteria->condition="1=1 and (t.account like ('%".$keyword."%') or t.nickname like ('%".$keyword."%'))";
        }else
        {
        	$criteria->condition="1=1";
        }

        $criteria->order='t.ctime DESC';
        $count = Validation::model()->count($criteria);
        $pager=new CPagination($count);
        $pager->pageSize=$pagesize;
        $pager->applyLimit($criteria);

        $list =Validation::model()->findAll($criteria);

        $this->render("index",array(
            'list'=>$list,
            'pages'=>$pager,
            'keyword'=>$keyword,
        ));
	}

    public function actionEdit(){
        $id =Yii::app()->request->getParam("id");
        $openid = Yii::app()->request->getParam("openid");
        $status =Yii::app()->request->getParam("status");
        $valid = Validation::model()->find("id = $id");
        $valid->status = $status;
        $wechatuser = WechatUser::model()->find("openid = '$openid'");
        if($wechatuser!=null) {
          $wechatuser->status = $status;
          if(!$wechatuser->save()){
              $this->OutputJson(0,json_encode($wechatuser->errors,JSON_UNESCAPED_UNICODE),null);
            }
        }

        if(!$valid->save()){
            $this->OutputJson(0,json_encode($thread_model->errors,JSON_UNESCAPED_UNICODE),null);
        }else{
            $this->redirect($_SERVER['HTTP_REFERER']);
        }
    }

}

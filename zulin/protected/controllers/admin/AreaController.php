
<?php

/*
商圈维护
*/

class AreaController extends BackgroundBaseController
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
        $count=BaseArea::model()->count($criteria);
        $pager=new CPagination($count);
        $pager->pageSize=$pagesize;
        $pager->applyLimit($criteria);
        
        $list = BaseArea::model()->findAll($criteria);

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

        $district_id =Yii::app()->request->getParam("district_id");

        $name =Yii::app()->request->getParam("name");

        $memo =Yii::app()->request->getParam("memo");

        $model =BaseArea::model()->find("t.name='$name' && deleted=0");
        if($model){
            $this->OutputJson(0,"商圈已存在",null);
        }

        $model =new BaseArea();
        $model->id=Guid::create_guid();
        $model->district_id=$district_id;

        $model->name=$name;

        $model->memo=$memo;

        $model->creater_id=Yii::app()->session['admin_uid'];
        $model->deleted=0;
        $model->ctime=time();

        if(!$model->save()){
            $this->OutputJson(0,$model->errors,null);
        }
        $this->OutputJson(301,'',"/admin/area");
    }

    public function actionEdit(){
        $referer=$_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");

        $model=BaseArea::model()->find("t.id='$id'");
        
        $this->render('edit',array(
			'model'=>$model,
            'referer'=>$referer,
		));

    }  

    public function actionEditSave(){  
        $referer =Yii::app()->request->getParam("referer");
        $id =Yii::app()->request->getParam("id");
        $district_id =Yii::app()->request->getParam("district_id");

        $name = Yii::app()->request->getParam("name");

        $memo = Yii::app()->request->getParam("memo");
        $data = BaseArea::model()->find(" t.name='$name' && district_id='$district_id' && deleted=0 && t.id<>'$id'");
        if ($data){
            $this->OutputJson(0,"该行政区中的商圈名已存在",null);
        }
        $model=BaseArea::model()->find("t.id='$id'");
        if($model){
            $model->district_id=$district_id;
            $model->name=$name;
            $model->memo=$memo;
            if(!$model->save()){
                $this->OutputJson(0,$model->errors,null);
            }
        }
		$this->OutputJson(301,'',$referer);
    } 

    public function actionDelete(){
		$referer=$_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");

        $model=BaseArea::model()->find("t.id='$id'");
        $model->deleted=1;

        if(!$model->save()){
            $this->OutputJson(0,$model->errors,null);
        }

        if(Yii::app()->request->isAjaxRequest){
            $this->OutputJson(301,'',$_SERVER['HTTP_REFERER']);
        }
        else{
            $this->redirect($_SERVER['HTTP_REFERER']);
        }
    }  
}
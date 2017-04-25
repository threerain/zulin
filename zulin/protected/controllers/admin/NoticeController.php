<?php

class NoticeController extends BackgroundBaseController
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    // public $layout='//layouts/backgroundcenter2';

    public $title='公告管理';

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $keyword =Yii::app()->request->getParam("keyword");

        $pagesize=10;

        $criteria=new CDbCriteria;
        if($keyword){
            $criteria->addCondition("name like ('%".$keyword."%') ");
        }



        if ($keyword){
            $criteria->condition="1=1 and t.deleted=0 and (t.title like ('%".$keyword."%') or t.content like ('%".$keyword."%'))";
        }
        else
        {
            $criteria->condition="1=1 and t.deleted=0";
        }
        $criteria->addCondition("t.deleted=0");
        $criteria->order='t.ctime DESC';
        $count = CmsNotice::model()->count($criteria);

        $pager=new CPagination($count);
        $pager->pageSize=$pagesize;
        $pager->applyLimit($criteria);

        $list =CmsNotice::model()->findAll($criteria);

        $this->render("index",array(
            'list'=>$list,
            'pages'=>$pager,
            'keyword'=>$keyword,
        ));

        // echo "string";
        // $this->render("index");
    }

    public function actionAdd()
    {
        $referer= $_SERVER['HTTP_REFERER'];

        $this->render("add",array(
            'referer'=>$referer,
        ));
    }

    public function actionAddSave()
    {
        $referer= $_SERVER['HTTP_REFERER'];

        $title =Yii::app()->request->getParam("title");
        $type =Yii::app()->request->getParam("type");
        $content =Yii::app()->request->getParam("content");
        $creater_id =Yii::app()->session['admin_uid'];
        $department_id = AdminUser::model()->find("id = '$creater_id'"); 
        $model =new CmsNotice();
        $model->id=Guid::create_guid();
        $model->title=$title;
        $model->content=$content;
        $model->type=$type;
        $model->department_id=$department_id->department_id;
        $model->ctime=time();
        $model->creater_id=Yii::app()->session['admin_uid'];
        $model->deleted=0;


        if (!$model->save()){
            if(Yii::app()->request->isAjaxRequest){
                $this->OutputJson(0,$model->errors,null);
            }

        }
        
        
        //消息提醒开始
            $news_title = '公告('.$model->title.')';
            CmsNews::user_news($model->id,2,'1101_09',$news_title);
        //消息结束
        $this->redirect("/admin/notice");
    }

    public function actionEdit()
    {
        $referer= $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");

        $model=CmsNotice::model()->find(" t.id='$id'");

        $this->render("edit",array(
            'model'=>$model,
            'referer'=>$referer,
        ));
    }

    public function actionEditSave()
    {
        $id =Yii::app()->request->getParam("id");
        $referer =Yii::app()->request->getParam("referer");
        $title =Yii::app()->request->getParam("title");
        $content =Yii::app()->request->getParam("content");

        // $buding_id =Yii::app()->request->getParam("buding_id");
        // $house_no =Yii::app()->request->getParam("house_no");
        // $creater_id =Yii::app()->request->getParam("creater_id");


        $model =CmsNotice::model()->find(" t.id='$id'");
        if ($model){
            $model->title=$title;
            $model->content=$content;

            if (!$model->save()){
                if(Yii::app()->request->isAjaxRequest){
                    $this->OutputJson(0,$model->errors,null);
                }
            }
        }
        //写入消息
        //消息提醒开始
            $news_title = '公告('.$model->title.')';
            CmsNews::user_news($model->id,2,'1101_09',$news_title);
        //消息结束
       
        $this->redirect('index');
        
    }

    public function actionDetail()
    {
        $referer= $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");
        $news_content_id =Yii::app()->request->getParam("news_content_id");
        $news_type =Yii::app()->request->getParam("news_type");
        $news_id =Yii::app()->request->getParam("news_id");
        if(!empty($news_content_id) && !empty($news_type) && !empty($news_id)){
            $id = $news_content_id;
            // 消息提醒
            $usernews = UserNews::model()->find("1=1 and id= '$news_id' and user_news_id = '{$_SESSION['admin_uid']}'");
            if(empty($usernews)){
                $this->redirect('/admin/home');
            }
        }
        $model=CmsNotice::model()->find(" t.id='$id'");

        if(!empty($news_type) && !empty($news_content_id) && !empty($news_id)){
            $modelnewss = UserNews::model()->find("id='$news_id' and user_news_id='{$_SESSION['admin_uid']}'");
            $modelnewss->status = 1;
            $modelnewss->save();
            if(empty($model)){
                $alert_error = 12;
                $this->redirect("/admin/usernews?alert_error=".$alert_error);
            }
        }

        $this->render("detail",array(
            'model'=>$model,
            'referer'=>$referer,
        ));
    }


    public function actionDelete()
    {
        $referer= $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");

        $model =CmsNotice::model()->find(" t.id='$id'");
        $model->deleted=1;
        if (!$model->save()){
            $this->result(0,$model->errors,null);
        }

        CmsNews::userDel($id,2);


        $this->redirect($referer);
    }
}

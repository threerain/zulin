<?php

class ConfirmController extends BackgroundBaseController
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

    /**
     * Lists all models.
     */

    
    /**
     * 销售确认列表
     */
    public function actionConfirmList()
    {
        $news_type =Yii::app()->request->getParam("news_type");
        $news_content_id =Yii::app()->request->getParam("news_content_id");
        $news_id =Yii::app()->request->getParam("news_id");
        $pagesize=10;
        $criteria=new CDbCriteria;
      
        $criteria->condition =" 1=1  and type = 1  and deleted = 0";
        //款项认领  消息提醒
        if(!empty($news_type) && !empty($news_content_id) && !empty($news_id)){
            $usernews = UserNews::model()->find("1=1 and id= '$news_id' and user_news_id = '{$_SESSION['admin_uid']}'");
            if(!empty($usernews)){
                $criteria->condition.= " and id ='$news_content_id' ";
            }else{
                $this->redirect('/admin/home');
            }
        }

        $criteria->order='t.ctime DESC';
        $count = FinReceivables::model()->count($criteria);
        $pager=new CPagination($count);
        $pager->pageSize=$pagesize;
        $pager->applyLimit($criteria);

        $list =FinReceivables::model()->findAll($criteria);
        if(!empty($news_type) && !empty($news_content_id) && !empty($news_id)){
            $modelnewss = UserNews::model()->find("id='$news_id' and user_news_id='{$_SESSION['admin_uid']}'");
            $modelnewss->status = 1;
            $modelnewss->save();
            if(empty($list)){
                $alert_error = 9;
                $criteria->condition.= " and id ='$news_content_id' ";
                $this->redirect("/admin/usernews?alert_error=".$alert_error.'&news_type='.$news_type);
            }
        }
        $this->render("confirmlist",array(
            'list'=>$list,
            'pages'=>$pager,
            'news_type'=>$news_type,
            'news_content_id'=>$news_content_id,
        ));
    }
    /**
     * 去确认收款人
     */
    public function actionConfirm()
    {   

        $id =Yii::app()->request->getParam("id");
        $model = FinReceivables::model()->find("id='$id' and deleted = 0");
        if(empty($model)){
           $this->redirect('confirmlist');
        }
        $this->render('confirm',array(
            'model'=> $model,
        ));
    }
    /**
     * 收款人确认
     */
    public function actionDoConfirm()
    {
        $referer = $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");//
        $tenant_name =Yii::app()->request->getParam("tenant_name");//租户姓名
        $cycle_end =strtotime(Yii::app()->request->getParam("cycle_end"));//周期结束时间
        $cycle_start =strtotime(Yii::app()->request->getParam("cycle_start"));//周期开始时间
        $confirm_id = $_SESSION['admin_uid'];//客服确认人id
        $property_id =Yii::app()->request->getParam("room_number")[0];//车源id
        //合同id
        $Property = new Property();
        $contract = $Property::SaleContract($property_id);
        if(empty($contract)){
             $this->OutputJson(0,"该合同不存在",null);
        }
        //付款截图
        $pay_photo =Yii::app()->request->getParam("pay_photo");

        $model = FinReceivables::model()->find("id='$id' and deleted = 0");
        $model->tenant_name=$tenant_name;
        $model->confirm_id=$confirm_id;
        $model->cycle_end=$cycle_end;
        $model->cycle_start=$cycle_start;
        $model->contract_id=$contract['id'];
        $model->type=2;
        $model->confirm_time=time();

        //出车清单图片存储
        if($pay_photo != ',' &&  !empty($pay_photo)){
            $pay_photo = explode(",",$pay_photo);
            array_shift($pay_photo);
            foreach($pay_photo as $k => $v){
                $pay_photo = new FinPayPhoto;
                $pay_photo->id = Guid::create_guid();
                $pay_photo->fin_id = $id;
                $pay_photo->url = $v;
                $pay_photo->ctime = time()+$k;
                $pay_photo->deleted = 0;
                if(!$pay_photo->save()){
                    $this->OutputJson(0,json_encode($pay_photo->errors,JSON_UNESCAPED_UNICODE),null);
                }
            }
        }


        if (!$model->save()){
            $this->redirect($referer);
        }else{
            //消息推送表
            $news_title = '款项已被认领('.$model->payee.' '.$model->payee_bank.'收款'.$model->payee_money/100 .'元)';
            CmsNews::user_news($model->id,10,'1101_02',$news_title);
        }
        $this->OutputJson(301,'',"/admin/Confirm/confirmlist");
    }
    /**
     * 收款人确认
     */
    public function actionDoMessage()
    {
        $referer = $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");//
        $model = FinReceivables::model()->find("id='$id' and deleted = 0");
        //短信提醒 ［幼狮空间］幼狮空间提醒您： 招商银行彭亮账户入帐333.00元待认领，付款人信息［李三，中国银行，账号2344 3234 2344 423］>>请带截图与客服结算部认领此款项
        $content = '【幼狮空间】幼狮空间提醒您： '.$model->payee_bank.$model->payee.'账户入帐'.$model->payee_money/100 .'元待认领，付款人信息［'.$model->payment_name.'，'.$model->payment_bank.'，账号'.$model->payment_number.'］>>请带截图与客服结算部认领此款项';
        $message = new Message();
        $status = $message->sendmsg('1201_01',$content);
        if($status){
            $this->OutputJson(0,"发送短信成功",null);
        }else{
            $this->OutputJson(0,"发送短信失败",null);
        }
        
    }
   
}

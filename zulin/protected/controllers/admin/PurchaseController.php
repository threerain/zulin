<?php

class PurchaseController extends BackgroundBaseController
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    // public $layout='//layouts/backgroundcenter2';

    public $title='管理员管理';

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $keyword =Yii::app()->request->getParam("keyword");

        $pagesize=10;

        $criteria=new CDbCriteria;
        if($keyword){
            $criteria->condition="estate_id like ('%".$keyword."%') or buding_id like ('".$keyword."')or house_no like ('".$keyword."') or creater_id like ('".$keyword."')";
        }
        // if ($keyword){
        //     $criteria->condition="1=1 and t.deleted=0 and (t.account like ('%".$keyword."%') or t.nickname like ('%".$keyword."%'))";
        // }
        // else
        // {
        //     $criteria->condition="1=1 and t.deleted=0";
        // }

        $criteria->order='t.ctime DESC';
        $count = CmsPurchaseContract::model()->count($criteria);

        $pager=new CPagination($count);
        $pager->pageSize=$pagesize;
        $pager->applyLimit($criteria);

        $list =CmsPurchaseContract::model()->findAll($criteria);

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
        // 表单取值
        $referer= $_SERVER['HTTP_REFERER'];

        // 合同id
        $id =Yii::app()->request->getParam("id");
        // 车主
        $owner =Yii::app()->request->getParam("owner");
        // 收款人
        $payee =Yii::app()->request->getParam("payee");
        // 联系电话
        $phone =Yii::app()->request->getParam("phone");   
        // 联系方式 1=车主,2=代理人
        $contact_information_type =Yii::app()->request->getParam("contact_information_type");
        // 开户行
        $bank =Yii::app()->request->getParam("bank");
        // 银行账号
        $bank_account =Yii::app()->request->getParam("bank_account");
        // 租期开始时间
        $lease_term_start =Yii::app()->request->getParam("lease_term_start");
        // 租期结束时间
        $lease_term_end =Yii::app()->request->getParam("lease_term_end");




        // 押金
        $deposit =Yii::app()->request->getParam("deposit");
        // 押金备注
        $deposit_memo =Yii::app()->request->getParam("deposit_memo");
        // 押金几个月
        $deposit_month =Yii::app()->request->getParam("deposit_month");
        // 付租金几个月
        $pay_month =Yii::app()->request->getParam("pay_month");
        // 租金
        $monthly_rent =Yii::app()->request->getParam("monthly_rent");
        // 提前几天付款
        $advance_days =Yii::app()->request->getParam("advance_days");
         // 佣金金额
        $commission =Yii::app()->request->getParam("commission");
         // 业务员ID
        $salesman_id =Yii::app()->request->getParam("salesman_id");
         // 片区负责人ID
        $manager_id =Yii::app()->request->getParam("manager_id");
         // 签约日
        $signing_date =Yii::app()->request->getParam("signing_date");
         // 创建人
        $create_user_id =Yii::app()->request->getParam("create_user_id");

        // 全权委托资产管理合同
        $avatar  =Yii::app()->request->getParam("avatar");
        // 不动产授权委托书
        $avatar1 =Yii::app()->request->getParam("avatar1");
        // 房产证复印件
        $avatar2 =Yii::app()->request->getParam("avatar2");
        // 车主授权代理人委托书
        $avatar3 =Yii::app()->request->getParam("avatar3");
        // 委托人身份证复印件
        $avatar4 =Yii::app()->request->getParam("avatar4");

        // $model =CmsPurchaseContract::model()->find(" t.account='$account'");
        // if ($model){
        //     $this->OutputJson(0,"账号已存在",null);
        // }

        // 数据库分表存入

        // 创建模型
        $model=new CmsPurchaseContract();

        $model2=new CmsPurchasePayable();

        $model3=new CmsPurchasePayment();

        $model4=new CmsPurchasePaymentVoucher();

        $model5=new CmsPurchaseProperty();
        
        




        // cms_purchase_contract表存入
        // id
        $model->id=Guid::create_guid();
        // 车主
        $model->owner=$owner;
        // 收款人
        $model->payee=$payee;
        // 联系电话
        $model->phone=$phone;
        // 联系方式 1=车主,2=代理人
        $model->contact_information_type=$contact_information_type;
        // 开户行
        $model->bank=$bank;
        // 银行账号
        $model->bank_account=$bank_account;
        // 租期开始时间
        $model->lease_term_start=$lease_term_start;
        // 租期结束时间
        $model->lease_term_end=$lease_term_end;
        // 押金
        $model->deposit=$deposit;
        // 押金备注
        $model->deposit_memo=$deposit_memo;
        // 押金几个月
        $model->deposit_month=$deposit_month;
        // 付押金几个月
        $model->pay_month=$pay_month;
        // 租金
        $model->monthly_rent=$monthly_rent;
        // 提前几天付款
        $model->advance_days=$advance_days;
        // 佣金金额
        $model->commission=$commission;
        // 业务员ID
        $model->salesman_id=$salesman_id;
        // 片区负责人ID
        $model->manager_id=$manager_id;
        // 签约日
        $model->signing_date=$signing_date;
        // 创建人
        $model->create_user_id=$create_user_id;
        // 创建时间
        $model->ctime=time();

        if (!$model->save()){
            if(Yii::app()->request->isAjaxRequest){

                $this->OutputJson(0,$model->errors,null);
            }

        }

        if(Yii::app()->request->isAjaxRequest){
            $this->OutputJson(301,'',"/admin/purchase");
        }
        else{
            $controller->redirect($referer);
        }






        // cms_purchase_payable表存入

        // id
        $model2->id=Guid::create_guid();
        // 合同id
        $model2->contract_id=$model->id;
        // // 付款顺序
        // $model2->the_order=
        // // 文字标识如第一年第二年等
        // $model2->title=
        // 付款时段开始时间
        $model2->start_time=$lease_term_start;
        // 付款时段结束时间
        $model2->end_time=$lease_term_end;
        // 月租金
        $model2->monthly_rent=$monthly_rent;
        // // 每平米每天价格
        // $model2->price_per_meter=
        // // 删除标记 0=初始 1=删除
        // $model2->deleted=
        // 创建时间
        $model2->ctime=time();


         if (!$model2->save()){
            if(Yii::app()->request->isAjaxRequest){

                $this->OutputJson(0,$model->errors,null);
            }

        }

        if(Yii::app()->request->isAjaxRequest){
            $this->OutputJson(301,'',"/admin/purchase");
        }
        else{
            $controller->redirect($referer);
        }


        // cms_purchase_payment表存入

        // id
        $model3->id=Guid::create_guid();
        // 合同id
        $model3->contract_id=$model->id;
        // 付款时段开始时间
        $model3->start_time=$lease_term_start;
        // 付款时段结束时间
        $model3->end_time=$lease_term_end;
        // 付款类型 1=押金 2=房租 3=免租期
        // $model3->type=
        // // amount
        // $model3->amount=
        // // 付款日期
        // $model3->payment_date=
        // // 备注
        // $model3->memo=

        if (!$model3->save()){
            if(Yii::app()->request->isAjaxRequest){

                $this->OutputJson(0,$model->errors,null);
            }

        }

        if(Yii::app()->request->isAjaxRequest){
            $this->OutputJson(301,'',"/admin/purchase");
        }
        else{
            $controller->redirect($referer);
        }


        // cms_purchase_payment_voucher表存入



        // id
        $model4->id=Guid::create_guid();
        // 合同id
        $model4->contract_id=$model->id;
        // // 类型 1=图片 2=word文件 3=excel文件
        // $model4->type=
        // // 文件路径
        // $model4->url=
        // // 删除标记 0=初始 1=删除
        // $model4->deleted=
        // 创建时间
        $model4->ctime=time();
        
        if (!$model4->save()){
            if(Yii::app()->request->isAjaxRequest){

                $this->OutputJson(0,$model->errors,null);
            }

        }

        if(Yii::app()->request->isAjaxRequest){
            $this->OutputJson(301,'',"/admin/purchase");
        }
        else{
            $controller->redirect($referer);
        }





        // cms_purchase_property表存入
      

        // id
        $model5->id=Guid::create_guid();
        // 合同id
        $model5->contract_id=$model->id;
        // // 车源ID
        // $model5->property_id=
        // // 删除标识 0=初始 1=删除
        // $model4->deleted=
        // 创建时间
        $model4->ctime=time();

        if (!$model5->save()){
            if(Yii::app()->request->isAjaxRequest){

                $this->OutputJson(0,$model->errors,null);
            }

        }

        if(Yii::app()->request->isAjaxRequest){
            $this->OutputJson(301,'',"/admin/purchase");
        }
        else{
            $controller->redirect($referer);
        }




        // var_dump($model);
        // var_dump($model2);
        // var_dump($model3);
        // var_dump($model4);
        // var_dump($model5);


      
        
        // 数据存入     
        // $model->save();
        // $model2->save();
        // $model3->save();
        // $model4->save();
        // $model5->save();


        // $this->redirect('index');

       
       


        // if (!$model->save()){
        //     if(Yii::app()->request->isAjaxRequest){

        //         $this->OutputJson(0,$model->errors,null);
        //     }

        // }

        // if(Yii::app()->request->isAjaxRequest){
        //     $this->OutputJson(301,'',"/admin/purchase");
        // }
        // else{
        //     $controller->redirect($referer);
        // }

        // $this->redirect($referer);
    }

    public function actionShow()
    {
        $referer= $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");

        $model =CmsPurchaseContract::model()->find(" t.id='$id'");
        $model2 =CmsPurchasePayable::model()->find("t.contract_id='$id'");
        $this->render("show",array(
            'model'=>$model,
            'model2'=>$model2,
            'referer'=>$referer,
        ));
    }

    // public function actionEdit()
    // {
    //     $referer= $_SERVER['HTTP_REFERER'];
    //     $id =Yii::app()->request->getParam("id");

    //     $model =CmsPurchaseContract::model()->find(" t.id='$id'");

    //     $this->render("propertyEdit",array(
    //         'model'=>$model,
    //         'referer'=>$referer,
    //     ));
    // }

    // public function actionEditSave()
    // {
    //     $id =Yii::app()->request->getParam("id");
        
    //     $referer =Yii::app()->request->getParam("referer");
    //     $estate_id =Yii::app()->request->getParam("estate_id");

    //     $buding_id =Yii::app()->request->getParam("buding_id");
    //     $house_no =Yii::app()->request->getParam("house_no");
    //     $creater_id =Yii::app()->request->getParam("creater_id");


    //     $model =CmsPurchaseContract::model()->find(" t.id='$id'");
    //     if ($model){
           

    //         $model->estate_id=$estate_id;
    //         $model->buding_id=$buding_id;
    //         $model->house_no=$house_no;
    //         $model->creater_id=$creater_id;


    //         // if ($password){
    //         //     $model->password=md5($password);
    //         // }
    //         // $model->nickname=$nickname;
    //         // if ($avatar){
    //         //     $model->avatar=$avatar;
    //         // }

    //         if (!$model->save()){
    //             if(Yii::app()->request->isAjaxRequest){
    //                 $this->OutputJson(0,$model->errors,null);
    //             }
    //         }
    //     }

    //     if(Yii::app()->request->isAjaxRequest){
    //         $this->OutputJson(301,"",$referer);
    //     }
    //     else{
    //         $this->redirect($referer);
    //     }
    // }

    // public function actionDelete()
    // {
    //     $referer= $_SERVER['HTTP_REFERER'];
    //     $id =Yii::app()->request->getParam("id");

    //     $model =CmsPurchaseContract::model()->find(" t.id='$id'");

    //     if (!$model->delete()){
    //         $this->result(0,$model->errors,null);
    //     }



    //     if(Yii::app()->request->isAjaxRequest){
    //         $this->OutputJson(301,$referer);
    //     }
    //     else{
    //         $this->redirect($referer);
    //     }
    // }
}

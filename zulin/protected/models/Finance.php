<?php

/**
 * 涉及到财务参与的money都走这个控制器
 */
class Property
{
    /**
     * 添加
     * 整体要开启事务
     * $utype  为业务类型
     * $property_id  车源id
     * $contract_id  合同id
     */
    public static function Finance($utype,$property_id,$contract_id){
        $admin_uid =$_SESSION['admin_uid'];//申请人
        $utype =$utype;//业务类型
        $payee =Yii::app()->request->getParam("payee");//收款人姓名
        $payee_phone =Yii::app()->request->getParam("payee_phone");//收款人电话
        $pay_way =Yii::app()->request->getParam("pay_way");//支付方式  现金为1 微信为2 支付宝为3 银联为4
        $rmb =Yii::app()->request->getParam("rmb");//付款金额 单位元
        $number =Yii::app()->request->getParam("number");//账号(微信账号/支付宝账号/银行卡账号)
        $number_name =Yii::app()->request->getParam("number_name");//开户行姓名(微信账号开户行/支付宝账号开户行/银行卡账号开户行)
        //审批未在这个表
        $modelfinance = new Finance;
        //判断是否收齐合同款

        //判断结束
        $modelfinance->id = Guid::create_guid();
        $modelfinance->admin_uid = $admin_uid;
        $modelfinance->utype = $utype;
        $modelfinance->payee = $payee;
        $modelfinance->payee_phone = $payee_phone;
        $modelfinance->property_id = $property_id;
        $modelfinance->contract_id = $contract_id;
        $modelfinance->pay_way = $pay_way;
        $modelfinance->rmb = $rmb;
        $modelfinance->number = $number;
        $modelfinance->number_name = $number_name;
      
        
        $modelfinance->type = 0;
        $modelfinance->ctime = time();
        $modelfinance->deleted = 0;
        if (!$modelfinance->save()){
            if(Yii::app()->request->isAjaxRequest){
                $this->OutputJson(0,$modelHydropower->errors,null);
            }
        }
        return $modelfinance->id;
        
    }
    /**
     * 修改
     * 整体要开启事务
     * $id  要修改的申请单据id
     * $property_id  车源id
     * $contract_id  合同id
     */未做完
    public static function Finance($id,$property_id,$contract_id){
        //判断是否已经通过一审
        $admin_uid =$_SESSION['admin_uid'];//申请人
        $payee =Yii::app()->request->getParam("payee");//收款人姓名
        $payee_phone =Yii::app()->request->getParam("payee_phone");//收款人电话
        $pay_way =Yii::app()->request->getParam("pay_way");//支付方式  现金为1 微信为2 支付宝为3 银联为4
        $rmb =Yii::app()->request->getParam("rmb");//付款金额 单位元
        $number =Yii::app()->request->getParam("number");//账号(微信账号/支付宝账号/银行卡账号)
        $number_name =Yii::app()->request->getParam("number_name");//开户行姓名(微信账号开户行/支付宝账号开户行/银行卡账号开户行)

        $modelfinance = Finance::model()->find("id ='$id'");

        $modelfinance->admin_uid = $admin_uid;
        $modelfinance->payee = $payee;
        $modelfinance->payee_phone = $payee_phone;
        $modelfinance->property_id = $property_id;
        $modelfinance->contract_id = $contract_id;
        $modelfinance->pay_way = $pay_way;
        $modelfinance->rmb = $rmb;
        $modelfinance->number = $number;
        $modelfinance->number_name = $number_name;
      
        
        $modelfinance->ctime = time();
        $modelfinance->deleted = 0;
        if (!$modelfinance->save()){
            if(Yii::app()->request->isAjaxRequest){
                $this->OutputJson(0,$modelHydropower->errors,null);
            }
        }
        //判断是否已参与审批 如果参与审批把所有的审批清除

        return $modelfinance->id;
        
    }
    
}

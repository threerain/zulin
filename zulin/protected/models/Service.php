<?php

/**
 * 客服模块
 */
class Service
{
    /**
     * 特殊费用方法
     */
    public static function Special($ser_contract_id)
    {
        $house_no =Yii::app()->request->getParam("house_no");//车源id
        $type =Yii::app()->request->getParam("type");//缴费类型
        $details =Yii::app()->request->getParam("details");//费用详情
        $amount =Yii::app()->request->getParam("amount");//费用金额
        $show_order =1;
        
        foreach ($house_no as $k => $v) {
            $modelSpecial = new SerSpecialCost;
            $modelSpecial->id = Guid::create_guid();
            $modelSpecial->ser_contract_id = $ser_contract_id;//收房交房列表的id
            $modelSpecial->house_no = $v;
            $modelSpecial->type = $type[$k];
            $modelSpecial->details = $details[$k];
            $modelSpecial->amount = $amount[$k]*100;
            $modelSpecial->show_order = $show_order;
            $modelSpecial->ctime = time();
            $modelSpecial->deleted = 0;
            $show_order++;
            if (!$modelSpecial->save()){
                if(Yii::app()->request->isAjaxRequest){
                    $this->OutputJson(0,$modelSpecial->errors,null);
                }
            }
        }
    }
    /**
     *水电费用方法
     */
    public static function Hydropower($ser_contract_id)
    {
        $hydropower_type =Yii::app()->request->getParam("hydropower_type");
        $electricity_fees =Yii::app()->request->getParam("electricity_fees");
        $electricity_unit =Yii::app()->request->getParam("electricity_unit");
        $hot_water =Yii::app()->request->getParam("hot_water");
        $hot_unit =Yii::app()->request->getParam("hot_unit");
        $middle_water =Yii::app()->request->getParam("middle_water");
        $middle_unit =Yii::app()->request->getParam("middle_unit");
        $cold_water =Yii::app()->request->getParam("cold_water");
        $cold_unit =Yii::app()->request->getParam("cold_unit");
        $gas_meter =Yii::app()->request->getParam("gas_meter");
        $gas_unit =Yii::app()->request->getParam("gas_unit");

        $show_orders =1;
        foreach ($electricity_fees as $k => $v) {
            $modelHydropower = new SerHydropower;
            $modelHydropower->id = Guid::create_guid();
            $modelHydropower->ser_contract_id = $ser_contract_id;//收房交房列表的id
            if(!empty($hydropower_type)){
                $modelHydropower->hydropower_type = $hydropower_type[$k];
            }
            $modelHydropower->electricity_fees = $v*100;
            $modelHydropower->electricity_unit = $electricity_unit[$k];
            $modelHydropower->hot_water = $hot_water[$k]*100;
            $modelHydropower->hot_unit = $hot_unit[$k];
            $modelHydropower->middle_water = $middle_water[$k]*100;
            $modelHydropower->middle_unit = $middle_unit[$k];
            $modelHydropower->cold_water = $cold_water[$k]*100;
            $modelHydropower->cold_unit = $cold_unit[$k];
            $modelHydropower->gas_meter = $gas_meter[$k]*100;
            $modelHydropower->gas_unit = $gas_unit[$k];
           
            $modelHydropower->show_order = $show_orders;
            $modelHydropower->ctime = time();
            $modelHydropower->deleted = 0;
            $show_orders++;
            if (!$modelHydropower->save()){
                if(Yii::app()->request->isAjaxRequest){
                    $this->OutputJson(0,$modelHydropower->errors,null);
                }
            }
            
        }
    }

    /**
     *隐患记录
     */
    public static function Hidden($sell_id)
    {
        $hydropower_type =Yii::app()->request->getParam("house_no_hidden");//隐患的编号
        $hidden =Yii::app()->request->getParam("hidden");//报修的隐患
        $hidden_infor =Yii::app()->request->getParam("hidden_infor");//隐患详情
        $property_photo =Yii::app()->request->getParam("property_photo");//隐患图片
       
        $service_type =Yii::app()->request->getParam("service_type");//维修方
        $hidden_cost =Yii::app()->request->getParam("hidden_cost");//预计隐患花费
        $bear_type =Yii::app()->request->getParam("bear_type");//费用承担方
        $criter_id =$_SESSION['admin_uid'];//外勤人员
        $hope_end_time =Yii::app()->request->getParam("hope_end_time");//预计修好时间
        if($hope_end_time){
            $hope_end_time =strtotime($hope_end_time);
        }
        foreach ($hydropower_type as $k => $v) {
            if(!empty($hidden[$k])){
                $modelhidden = new SerAfterSales;
                $modelhidden->id = Guid::create_guid();
                $contra = Property::SaleContractAll($v);
                $modelhidden->contract_id = $contra;//合同id
                $modelhidden->ser_contract_id = $sell_id;//合同id
                $modelhidden->property_id = $v;
                $modelhidden->criter_id = $criter_id;
                $modelhidden->repair_type = 2;
                $modelhidden->repair_user_type = 2;
                $modelhidden->evolve_type = str_replace([1,2,3],[5,1,8],$service_type[$k]);
                $modelhidden->hidden = $hidden[$k];
                $modelhidden->hidden_infor = $hidden_infor[$k];
                $modelhidden->hidden_cost = $hidden_cost[$k]*100;
                $modelhidden->service_type = $service_type[$k];
                if($service_type[$k] == 1 || $service_type[$k] == 3){
                    $modelhidden->hope_end_time= $hope_end_time;

                }
                $modelhidden->bear_type = $bear_type[$k];
                $modelhidden->urs_user_id = $_SESSION['admin_uid'];
               
                $modelhidden->ctime = time()+$k;
                $modelhidden->deleted = 0;
                if (!$modelhidden->save()){
                    if(Yii::app()->request->isAjaxRequest){
                        $this->OutputJson(0,"错误",null);
                    }
                }
                if($property_photo[$k] != ',' && !empty($property_photo[$k])){
                    // $property_photos = explode(",",$property_photo[$k]);
                    // array_shift($property_photos);
                    //隐患图片
                    // foreach($property_photos as $key => $value){
                        $ser_hidden_photo = new SerHiddenPhoto; 
                        $ser_hidden_photo->id = Guid::create_guid();
                        $ser_hidden_photo->after_id = $modelhidden->id;
                        $ser_hidden_photo->url = $property_photo[$k];
                        $ser_hidden_photo->ctime = time()+$key;
                        $ser_hidden_photo->deleted = 0;
                        if(!$ser_hidden_photo->save()){
                            $this->OutputJson(0,json_encode($ser_hidden_photo->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    // }
                }
            }
        }

    }
}

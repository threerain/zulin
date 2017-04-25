<?php

class PropertyController extends Controller
{
    public $layout="//layouts/phonelogin.php";

    public function actionEstate(){
        $estate_name=Yii::app()->request->getParam("estate");

        $estate = BaseEstate::model()->findAll("name like '%".$estate_name."%' and deleted=0 limit 5");

        if($estate){
          foreach ($estate as $key => $value) {
            $arr[$key]['estate_id']=$value->id;
            $arr[$key]['name']=$value->name;
          }          
        }
        
        header('Content-Type:application/json;charset=utf-8');
        echo json_encode($arr,JSON_UNESCAPED_UNICODE);

    }
    public function actionBuilding(){
        $building_name=Yii::app()->request->getParam("building");
        $estate_id=Yii::app()->request->getParam("estate_id");

        $building = BaseBuilding::model()->findAll("name like '%".$building_name."%' and estate_id = '$estate_id' and deleted=0 limit 5");

        if($building){
          foreach ($building as $key => $value) {
            $arr[$key]['building_id']=$value->id;
            $arr[$key]['name']=$value->name;
          }          
        }
        
        header('Content-Type:application/json;charset=utf-8');
        echo json_encode($arr,JSON_UNESCAPED_UNICODE);

    }
    public function actionHouse_no(){
        $house_no=Yii::app()->request->getParam("house_no");
        $estate_id=Yii::app()->request->getParam("estate_id");
        $building_id=Yii::app()->request->getParam("building_id");

        $house_no = CmsProperty::model()->findAll("house_no like '$house_no%' and estate_id = '$estate_id' and building_id = '$building_id'  and deleted=0 ");

        if($house_no){
          foreach ($house_no as $key => $value) {
            $arr[$key]['house_no']=$value->id;
            $arr[$key]['name']=$value->house_no;
          }          
        }

        header('Content-Type:application/json;charset=utf-8');
        echo json_encode($arr,JSON_UNESCAPED_UNICODE);

    }

    public function actionArea(){
        $property_id=Yii::app()->request->getParam("property_id");

        $area = CmsPurchaseProperty::model()->find(array(
            'condition'=>"property_id = '$property_id'",
            'select'=>'house_area',
            ));

        echo json_encode((float)$area->house_area,JSON_UNESCAPED_UNICODE);

    }
    

}

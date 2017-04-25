<?php

/**
 	根据车源ID来查出对应的品牌，系列，编号
 	allinfo	根据合同ID来查出对应的品牌，系列，编号,月租金
 	车源类型 1=轿车 2=客车 3=SUV 4=商务
 */
class Property
{
    public static function status($property_id){
        $CmsProperty = CmsProperty::model()->find("id = '$property_id'");
        //根据车源ID去合同车源关联表查出是否已经出租
        $model=[];
        $CmsPurchaseProperty =  CmsPurchaseProperty::model()->findAll("property_id = '$CmsProperty->id' and deleted='0' and type=1");
        foreach ($CmsPurchaseProperty as $key => $value) {
          $time = time();
        	$model[] = CmsPurchaseContract::model()->find("id = '$value->contract_id' and type = 1 and lease_term_start<='$time' and lease_term_end>='$time' and status='0' and deleted='0'");
        }
        $status = '未租';
        foreach ($model as $k => $v) {
	        if($v!=null){
	           $status = '已租';
	        }
        }
        //查出多个合同ID，需要出售合同的，如果有出售合同，则代表已经出售，否则为未租
        return $status;
    }
    public static function property_id($contract_id){
        //已知收购合同ID，查出车源ID
        $CmsPurchaseProperty = CmsPurchaseProperty::model()->findAll("contract_id = $contract_id and deleted='0'");
        $property_id = [];
        foreach ($CmsPurchaseProperty as $key => $value) {
          $a=CmsProperty::model()->find("split_partent_id='$value->property_id' and deleted='0'");
          if($a){
            $data=CmsProperty::model()->findAll("split_partent_id='$value->property_id' and deleted='0'");
            foreach($data as $v){
              $property_id[] = $v->id;
            }
          }else{
            $property_id[] = $value->property_id;
          } 
        }
        return $property_id;
    }
	public static function allinfo ($contract_id){
		if($contract_id){
			$data = CmsPurchaseProperty::model()->findAll(array(
				'select'=>array('property_id,monthly_rent_room'),
				'condition'=>"contract_id = '$contract_id' order by property_id",
			));
			$loupan = [];

			foreach ($data as $key => $value) {

					$property = CmsProperty::model()->find(array(
						'select'=>array('estate_id,building_id,house_no,room_type,area'),
						'condition'=>"id = '$value->property_id' ",
					));
					$building_name = BaseBuilding::model()->find(array(
						'select'=>array('name'),
						'condition'=>"id = '$property->building_id'",
					));
					$estate_name = BaseEstate::model()->find(array(
						'select'=>array('name'),
						'condition'=>"id = '$property->estate_id'",
					));
					$loupan[$key]['building_name'] = $building_name->name;
					$loupan[$key]['estate_name']   = $estate_name->name;
					$loupan[$key]['house_no']      = $property->house_no;
					$loupan[$key]['building_id']   = $property->building_id;
					$loupan[$key]['room_type']     = $property->room_type;
					$loupan[$key]['estate_id']     = $property->estate_id;
					$loupan[$key]['area']          = $property->area;
					$loupan[$key]['property_id']   = $value->property_id;
					$loupan[$key]['monthly_rent_room'] = $value->monthly_rent_room;
			}

		}

		return $loupan;

	}
  public static function area($property_id){
    if($property_id){
      $area = CmsProperty::model()->find(array(
        'select'=>array('area_id'),
        'condition'=>"id = '$property_id'",
      ));
      $area_name = BaseArea::model()->find(array(
        'select'=>array('name'),
        'condition'=>"id = '$area->area_id'",
      ));
    }
    return $area_name->name;
  }

	public static function estate($property_id){
		if($property_id){
			$estate = CmsProperty::model()->find(array(
				'select'=>array('estate_id'),
				'condition'=>"id = '$property_id'",
			));
			$estate_name = BaseEstate::model()->find(array(
				'select'=>array('name'),
				'condition'=>"id = '$estate->estate_id'",
			));
		}
		return $estate_name->name;
	}
	public static function building($property_id){
		if($property_id){
			$building_id = CmsProperty::model()->find(array(
				'select'=>array('building_id'),
				'condition'=>"id = '$property_id'",
			));
			$building_name = BaseBuilding::model()->find(array(
				'select'=>array('name'),
				'condition'=>"id = '$building_id->building_id'",
			));
		}
		return $building_name->name;
	}
	public static function house_no($property_id){
		if($property_id){
			$house_no = CmsProperty::model()->find(array(
				'select'=>array('house_no'),
				'condition'=>"id = '$property_id'",
			));
		}
		return $house_no->house_no;
	}
	public static function SaleContract($property_id){
    	$purchaseproperty = CmsPurchaseProperty::model()->findAll("deleted = 0 and property_id = '$property_id' ");
	    $time = time();
        foreach ($purchaseproperty as $v) {
           $contracts =  CmsPurchaseContract::model()->find("id = '$v->contract_id' and type = 1 and status=0 and deleted='0'");
           if(!empty($contracts)){
                $contract = $contracts;
       			return $contract;
           }
        }
    }
    //出车佣金合同
    public static function OutSaleContract($property_id){
        $purchaseproperty = CmsPurchaseProperty::model()->findAll("deleted = 0 and property_id = '$property_id' ");
        $time = time();
          $contract = '';
          foreach ($purchaseproperty as $v) {
             $contracts =  CmsPurchaseContract::model()->find("id = '$v->contract_id' and type = 1 and lease_term_start<='$time' and lease_term_end>='$time' and deleted='0'");
             if(!empty($contracts)){
                  $contract = $contracts;
             }
             if(!isset($contract)){
                $contract = '';
             }
          }
          return $contract;
      }
      //查询全部合同
      public static function SaleContractAll($property_id){
          $purchaseproperty = CmsPurchaseProperty::model()->findAll("deleted = 0 and property_id = '$property_id' ");
          $contract ='';
            foreach ($purchaseproperty as $v) {
               $contracts =  CmsPurchaseContract::model()->find("id = '$v->contract_id'   and deleted='0'");
               if(!empty($contracts)){
                    $contract .= ','.$contracts->id;
               }
            }
            $contract = ltrim($contract,',');
            return $contract;
        }
    public static function PurchaseContract($property_id){
    	$purchaseproperty = CmsPurchaseProperty::model()->findAll("deleted = 0 and property_id = '$property_id' ");
      $time = time();
      foreach ($purchaseproperty as $v) {
        $c=CmsPurchaseContract::model()->find("id = '$v->contract_id' and type='0' and deleted='0' and status in(0,9,-1)");
        if(!empty($c)){
            $contract = $c;
            return $contract;
        }
      }
    }
    //查询是否有收房合同
    public static function PurchaseContractAll($property_id){
    	$purchaseproperty = CmsPurchaseProperty::model()->findAll("deleted = 0 and property_id = '$property_id' ");
	    $time = time();
        foreach ($purchaseproperty as $v) {
           $contracts =  CmsPurchaseContract::model()->find("id = '$v->contract_id' and type = 0 and deleted='0'");
           if(!empty($contracts)){
                $contract = $contracts;
        		return $contract;
           }
        }
    }
    /**
     * 由出车合同中的车源ID查找收房合同
     * @param [type] $property_id [description]
     */
    public static function PurchaseContractNow($property_id){
      //根据车源ID查出收购合同，如果查不到，说明被拆分
      $purchasecontract = CmsPurchaseProperty::model()->find("deleted = 0 and property_id = '$property_id' and status in(0,-1) and type=0");
      if(!$purchasecontract){
        $property = CmsProperty::model()->find("id = '$property_id'");
        $parent_property = Cmsproperty::model()->find("id = '$property->split_partent_id'");
        $purchasecontract = CmsPurchaseProperty::model()->find("deleted = 0 and property_id = '$parent_property->id' and status in(0,-1) and type=0");
      }
      $contract =  CmsPurchaseContract::model()->find("id = '$purchasecontract->contract_id'  and deleted='0' and type=0");

      return $contract;
    }
}

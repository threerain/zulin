<?php

	class Contract{

	     /**
	      * 根据收房合同ID获取出车合同ID
	      * @return [type] [description]
	      */
	    public static function salecontract($purchasecontract_id)
	    {
	    	$contract_arr = [];
	    	//1.输入为收购合同的ID，查出车源ID
	    	$property = CmsPurchaseProperty::model()->findAll("contract_id ='$purchasecontract_id' and status =0");


	    	//2.得到车源（有可能是多个车源ＩＤ）先根据车源ID直接查询
	    	if($property){
		    	foreach ($property as $key => $value) {
		    		//一个车源ID必定只对应一个出车合同，查出出车合同ID
		    		$salecontract = CmsPurchaseProperty::model()->find("property_id = '$value->property_id' and status =0 and type=1");

		    		if($salecontract){
		    			$contract_arr[] = $salecontract;
		    		}else{//如果不能直接查询出来则为两种情况： 1.车源已经被拆分，所以需要使用被拆分后的车源ＩＤ来查询 。2.未出售。
			    		//１.第一种假设 ：车源被拆分。需要由此车源ＩＤ去查询被拆分后的车源ID

			    		$split_property = Cmsproperty::model()->findAll("split_partent_id = '$value->property_id' and deleted=0");

			    		if($split_property){
				    		//1.1查询出所有的被拆分后的新车源id，然后由新ID去查询所有的出售合同
				    		foreach ($split_property as $k => $v) {
				    			$salecontract = CmsPurchaseProperty::model()->find("property_id = '$v->id' and status =0");
			    				$contract_arr[] = $salecontract;

				    		}

			    		}else{

		    			//2.说明房子确实未被出售
			    			return null;
			    		}


		    		}

		    	}
		    	return $contract_arr;
	    	}else{
	    		return null;
	    	}


	    }

	    public static function purchasecontract($salecontract_id)
	    {

			$contract_arr = [];
	    	//1.输入为收购合同的ID，查出车源ID
	    	$property = CmsPurchaseProperty::model()->findAll("contract_id ='$salecontract_id' and status in (0,-1) ");


	    	//2.得到车源（有可能是多个车源ＩＤ）先根据车源ID直接查询
	    	if($property){
		    	foreach ($property as $key => $value) {
		    		//一个车源ID必定只对应一个收房合同，查出收房合同ID
		    		$purchasecontract = CmsPurchaseProperty::model()->find("property_id = '$value->property_id' and status in (0,-1) and type=0");

		    		if($purchasecontract){
		    			$contract_arr[] = $purchasecontract;
		    		}else{//如果不能直接查询出来则为两种情况： 1.车源已经被拆分，所以需要使用被拆分后的车源ＩＤ来查询
			    		//１.第一种假设 ：车源被拆分。需要由此车源ＩＤ去查询被拆分后的车源ID

			    		$split_property = Cmsproperty::model()->findAll("id = '$value->property_id' and deleted=0");

			    		if($split_property){
				    		//1.1查询出所有的被拆分后的新车源id，然后由新ID去查询所有的出售合同
				    		foreach ($split_property as $k => $v) {
				    			$purchasecontract = CmsPurchaseProperty::model()->find("property_id = '$v->split_partent_id' and status in (0,-1) and type=0 ");
			    				$contract_arr[] = $purchasecontract;

				    		}

			    		}else{

			    			return false;
			    		}


		    		}

		    	}
		    	return $contract_arr;
	    	}else{
	    		return false;
	    	}

	    }


	}





 ?>

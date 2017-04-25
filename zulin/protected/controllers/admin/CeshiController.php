<?php

class CeshiController extends BackgroundBaseController
{
    private $limits = 10000;

    public $title='幼狮车源管理';

    
     public function actionIndex()
    {
        echo 111;
    }
    public function actionSell()
    {
        
        $excel =Yii::app()->request->getParam("excel");
        set_time_limit(0);
        $time=time();
        $list=CmsPurchaseContract::model()->findAll("type='0' and status='0' and lease_term_start_real<='$time' and lease_term_end>='$time' and deleted='0'");//

            // 序号 商圈  组团  类别  产品类型=立项 项目名称/品牌 系列  编号 建筑面积/㎡  收房签约日 收房免租期  收购单价=收房月租*12/365/建筑面积   出车单价=出车月租金*12/365/建筑面积   产品收房日=客服实际收房日 前租户房租截止日  出车签约日=出车合同签约日 出车起租日=租期或免租期第一天 空置天数  出车次数  备注  序号  前租户房租截止日  租户起租日 前租户搬离日  待售  分租房间  幼狮与车主续约 与车主续约前租期  租户与幼狮续约 现租户搬走日  前租户名称
        $arrproperty=CmsProperty::model()->arr();
        $number = 0;
        $arrs = [];
        $transaction1 = Yii::app()->db->beginTransaction(); //开启事务
        try {
            foreach ($list as $key => $value) {
                $res=CmsPurchaseProperty::model()->findAll("contract_id='$value->id'");
                foreach ($res as $k => $v) {
                    $arr = [];
                    $data=CmsProperty::model()->find("id='$v->property_id'");
                    //商圈
                    $arr['area']=BaseArea::model()->find("id='$data->area_id'")['name'];
                    //组团
                    $arr['estate_group_id'] = BaseEstateGroup::model()->find("id='$data->estate_group_id'")['name'];
                    //产品类型
                    $arr['room_type']  = $arrproperty['room_type']["$data->room_type"];
                    // 类别
                    $estate_type=BaseBuilding::model()->find("id='$data->estate_id'");
                    $arr['estate_type'] = $estate_type->type==1?'A类':'B类';
                    //项目名称
                    $arr['estate']=BaseEstate::model()->find("id='$data->estate_id'")['name'];
                    
                    //系列
                    $arr['building']=BaseBuilding::model()->find("id='$data->building_id'")['name'];
                    //编号
                    $arr['house_no']=$data->house_no;
                    $arrs[]=$arr;
                }

            }
            $transaction1->commit(); //提交事务会真正的执行数据库操作

        } catch (Exception $e){
            echo '操作失败';
            $transaction1->rollback(); //如果操作失败, 数据回滚
        }
        $this->download($arrs, '2017-1-6');
    }

         
    public function download($data, $fileName)
    {
        $fileName = $this->_charset($fileName);
        header("Content-Type: application/vnd.ms-excel; charset=gbk");
        header("Content-Disposition: inline; filename=\"" . $fileName . ".xls\"");
        echo "<?xml version=\"1.0\" encoding=\"gbk\"?>\n
            <Workbook xmlns=\"urn:schemas-microsoft-com:office:spreadsheet\"
            xmlns:x=\"urn:schemas-microsoft-com:office:excel\"
            xmlns:ss=\"urn:schemas-microsoft-com:office:spreadsheet\"
            xmlns:html=\"http://www.w3.org/TR/REC-html40\">";        
        echo "\n<Worksheet ss:Name=\"" . $fileName . "\">\n<Table>\n";
        $guard = 0;        
        foreach($data as $v)
        {
            $guard++;           
            if($guard==$this->limits)
            {
                ob_flush();
                flush();
                $guard = 0;
            }            
            echo $this->_addRow($this->_charset($v));
        }        
        echo "</Table>\n</Worksheet>\n</Workbook>";
    } 
        
    private function _addRow($row)
    {
        $cells = "";        
        foreach ($row as $k => $v){
            $cells .= "<Cell><Data ss:Type=\"String\">" . $v . "</Data></Cell>\n";
        }        
        return "<Row>\n" . $cells . "</Row>\n";
    }
         
    private function _charset($data)
    {       
        if(!$data){            
            return false;
        }        
        if(is_array($data)){           
             foreach($data as $k=>$v){
                $data[$k] = $this->_charset($v);
            }            
            return $data;
        }        
        return iconv('utf-8', 'gbk', $data);
    }
    
}
// 1.出车次数为2，出车签约日没有变（三里屯D1601） 已解决
// 2.收购单价是逐年递增的，到期没有变，显示的是第一年（万通c903） 已解决
// 3.车主有两套房但就签了一个合同，收购单价错误（住邦4-1205/1206） 已解决
// 4.一套房有2个或以上的租户，出车的信息是空的（尚都北塔507） 已解决
// 5 一个车主有好几套房，就签了一个合同 有重复信息  已解决
//6 出车单价都是净租金 没有除去税金  系统上面现在没有
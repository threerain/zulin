 <?php

class PluscommissionController extends BackgroundBaseController
{

    /**
     * 主程序：流程为导入合同id和钱--->{此处数据可以直接为签约人ID}得到签约人(销售)以及其上级--->根据签约人搜索得到当月面积--->通过比例表得出比例--->钱X比例最终得到提成金额
     * @return [array] [
     *                     '签约人ID'=>
     *                     ['合同id'=>URS_XXX],       
     *                     ['提成比例'=>double],       
     *                     ['面积和'=>double],       
     *                     ['车源信息'=>[
     *                                    '项目名称'=>'品牌+系列+编号',
     *                                    '面积'=>'',
     *                      ]]       
     *                     ['money'=>double],       
     *                     ['汇款金额'=>double],       
     *                     ['对应职位'=>tinyint],       
     * 
     * ]
     */
    /**
     * author liyuequn
     * 
     */
    
    public function actionIndex()
    {
        //根据出车合同
        $sign_date1 =$_GET['signing_date1'];
        $sign_date2 =$_GET['signing_date2'];


        $end = strtotime('- 1 year',time());
        $condition = "sign_date > $end";

        if($sign_date1){
            $sign_date1 = strtotime($sign_date1);
            $condition .= " and sign_date >= $sign_date1 ";
        }
        if($sign_date2){
            $sign_date2 = strtotime($sign_date2);
            $condition .= " and sign_date <=$sign_date2 ";
        }
        if($_GET['type']){
            $type = $_GET['type'];
        }elseif($_POST['type']){
            $type = $_POST['type'];
        }else{
            $type=0;
        }
        $condition .=" and type = $type ";
        if($_GET['signer']){
            $signer = AdminUser::model()->find("nickname like '%$_GET[signer]%' and deleted=0");

            $condition .= " and signer = '$signer->id' " ;
        }
        $criteria=new CDbCriteria;
        $criteria->condition = $condition;
        $criteria->order = "t.ctime desc";
        $criteria->select = "id,signer,yongyou_id,sign_date,contract_id";
        $count=CmsContractSigner::model()->count($criteria);
        $pager=new CPagination($count);
        $pager->pageSize=$pagesize;
        $pager->applyLimit($criteria);
        $list = CmsContractSigner::model()->findAll($criteria);

        $this->render('index',array(
            'list'=>$list,
            'pages'=>$pager,
            'type'=>$type,
            'signer'=>$signer->nickname,
            'sign_date2'=>$_GET['signing_date2'],
            'sign_date1'=>$_GET['signing_date1'],

        ));
    }


    /**
     * 判断是出车还是收房的页面进行分离
     * 
     * @return [type] [description]
     */
    public function actionJudge()
    {
        //接受type
        if($_POST['type']==1){
            $this->getfromexcel();
        }else{
            $this->getfromexcelsg();
        }

    }
    /**
     * 管佣呀~~~
     * @return [type] [description]
     */
    public function actionGuanyong()
    {
        //从cms_plus提取出经理们，然后累加面积，计算管佣
        if($_GET['start_time']){

        }
        if($_GET['end_time']){
            
        }

        if($_GET['guanyong']){
            $guanyong = AdminUser::model()->find("nickname like '%$_GET[guanyong]%' and deleted=0");
            $condition .= "guanyong = '$guanyong->id' and type=1" ;
        }

        $criteria=new CDbCriteria;
        $criteria->condition = $condition;
        $criteria->order = 'guanyong';
        $count=CmsPlus::model()->count($criteria);
        $pager=new CPagination($count);
        $pager->pageSize=100;
        $pager->applyLimit($criteria);
        $list = CmsPlus::model()->findAll($criteria);
        $list2 = CmsPlus::model()->findAll("type=1");

        foreach ($list2 as $key => $value) {
            $newarr[$value->guanyong] = AdminUser::model()->find("id='$value->guanyong' and deleted=0")->nickname;
        }
        $total = 0;
        if($_GET['guanyong']){
            //知道管佣经理是谁，找出其对应的签约人
            foreach ($list as $key => $value) {
                $guanyong_area[$value->signer] = $value->area;
            } 
            $total_area = array_sum($guanyong_area);  

            //去提成表里查询提成比例
            $scale = Scale::model()->find("area_start <$total_area and $total_area <area_end and type2=1 and level =2");
            foreach ($list as $key => $value) {
                $guanyong_plus+=$value->amount*$scale/1000*$value->area_scale;
            }       
        }


        $this->render('guanyong',array(
            'list'=>$list,
            'pages'=>$pager,
            'guanyong'=>$_GET['guanyong'],
            'signerlist'=>$newarr,
            'total_area'=>$total_area,
            'guanyong_plus'=>$guanyong_plus,
            'type'=>$_GET['type'],

        ));
        
    }

    /**
     * 从excel导出数据
     * @return [type] [description]
     */
    public function getfromexcelsg()
    {
        $obj = new Excel();
        $res= $obj ->uploadexcel();
        if($res){
            //从打款的金额表中提取出对应的财务编号
            foreach ($res as $key => $value) {
                if($key>1&&$value[2]>0){
                    $cms=null;
                    //1.由财务编号，找到收房合同，然后找到车源，然后找到出车合同
                    $cms = CmsPurchaseContract::model()->find("yongyou_id = '$value[0]' and type=0");
                    $contract_arr[$cms->id] = $value[2];         
                    
                    if(!$cms){
                    //此时找不到收房合同iD那么一定是出车的时候合并或者拆分了。
                        $sales = CmsPurchaseContract::model()->find("yongyou_id = '$value[0]'");

                        $cms = Contract::purchasecontract($sales->id);

                        if($cms){
                            foreach ($cms as $k => $v) {
                                $contract_arr[$v->id] = $value[2];         
                            }                            
                        }
                    }
                }
            }
            $this->getplus($contract_arr);
            $this->redirect('/admin/pluscommission/plusindex');          
        }
    }
    /**
     * 从excel导出数据
     * @return [type] [description]
     */
    public function getfromexcel()
    {

        $obj = new Excel();
        $res= $obj ->uploadexcel();
        if($res){
            //从打款的金额表中提取出对应的财务编号
            foreach ($res as $key => $value) {
                if($key>1&&$value[2]>0){
                    $cms=null;
                    //1.由财务编号，找到收房合同，然后找到车源，然后找到出车合同
                    $tmp = trim($value[0]);
                    $cms = CmsPurchaseContract::model()->find("yongyou_id = '$tmp'");
                    if($cms->type==1){
                        $contract_arr[$cms->id]=$value[2]; 
                    }else{
                    //2.由合同编号找寻对应的合同ID
                        $sale = $this->getsalecontract($cms->id);
                        $contract_arr[$sale] = $value[2]; 
                    }

                }

            }
            $this->getplus($contract_arr);
            
            $this->redirect('/admin/pluscommission/plusindex/type/1');    

        }
    }



    //存进数据库后取出，按人进行统计
    public function actionPlusIndex()
    {   
        if($_GET['signer']){
            $signer = AdminUser::model()->find("nickname like '%$_GET[signer]%' and deleted=0");
            $condition .= "signer = '$signer->id'" ;
        }
        if($_GET['type']){
            if($_GET['signer']){
                $condition .= " and type = '$_GET[type]'" ;
            }else{

                $condition .= "type = '$_GET[type]'" ;
            }
            $list2 = CmsPlus::model()->findAll("type =1");
        }else{
            if($_GET['signer']){
                $condition .= " and type = 0" ;
            }else{
                $condition .= "type = 0" ;

            }
            $list2 = CmsPlus::model()->findAll("type =0");
        }
        if(!$list2){
            $list2=['无'];
        }
        $criteria=new CDbCriteria;
        $criteria->condition = $condition;
        $criteria->order = 'signer';
        $count=CmsPlus::model()->count($criteria);
        $pager=new CPagination($count);
        $pager->pageSize=30;
        $pager->applyLimit($criteria);


        $list = CmsPlus::model()->findAll($criteria);


        foreach ($list2 as $key => $value) {
            $newarr[$value->signer] = AdminUser::model()->find("id='$value->signer' and deleted=0")->nickname;
        }
        $total =0;
        foreach ($list as $key => $value) {
            $total += $value->money;
        }

        $this->render('plus',array(
            'list'=>$list,
            'pages'=>$pager,
            'signer'=>$_GET['signer'],
            'signerlist'=>$newarr,
            'total'=>$total,
            'type'=>$_GET['type'],

        ));
    }

    /**
    车源与用友系统项目的对接
     */
    public function actionYongyou()
    {
        //合同与用友项目对应起来
        $contract_id = $_POST['contract_id'];
        $cms = CmsPurchaseContract::model()->find("id = '$contract_id'");
        $cms->yongyou_id = trim($_POST['yongyou_id']);
        if(!$cms->save()){
            echo '1';
        }else{
            echo '2';
        }
    }
    /**
     * 存储签约人
     * @return [type] [description]
     */
    public function actionSigner()
    {
        //清空所有签约人
        $contract_id =$_POST['contract_id'];
        $cms = CmsPurchaseContract::model()->find(array(
            'select'=>'type,yongyou_id',
            'condition'=>"id = '$contract_id'"
        ));
        if($_POST['scale'][0]){
            $ccs =CmsContractSigner::model()->findAll("contract_id = '$contract_id' order by the_order");

            foreach ($ccs as $key => $value) {
                $value->scale = $_POST['scale'][$key];
                if(!$value->save()){
                    $this->OutputJson(0,json_encode($signer->errors,JSON_UNESCAPED_UNICODE),null);
                }
            }
                
        }
        //重新填入
        if($_POST['salesman_id'][0]){
            CmsContractSigner::model()->deleteAll("contract_id = '$contract_id'");
            $order=0;
            foreach($_POST['salesman_id'] as $k=>$value){
                if($value){
                    $signer = new CmsContractSigner;
                    $signer->signer = $value;
                    $signer->contract_id = $contract_id;
                    $signer->type = $cms->type;
                    $signer->yongyou_id = $cms->yongyou_id;
                    $signer->the_order = $order;
                    $signer->sign_date = CmsPurchaseContract::model()->find("id='$contract_id'")->signing_date;
                    $signer->scale = $_POST['scale'][$k];
                    $signer->ctime = time();
                    if(!$signer->save()){
                        $this->OutputJson(0,json_encode($signer->errors,JSON_UNESCAPED_UNICODE),null);
                    }
                    $order++;
                }

            }
        }else{
            $this->redirect($_SERVER['HTTP_REFERER']);
        }
        $this->redirect($_SERVER['HTTP_REFERER']);
    }


    /**
     * 根据合同获取签约人
     * @return [type] [description]
     */
    public function actionGetsigner()
    {
        $contract_id = $_POST['contract_id'];
        $model = CmsContractSigner::model()->findAll("contract_id = '$contract_id' and deleted=0 ");
        foreach ($model as $key => $value) {
            $arr[$value->signer]['name'] = AdminUser::model()->find(array(
                'select'=>'nickname',
                'condition'=>"id = '$value->signer'"
                ))->nickname;
            $arr[$value->signer]['scale']=$value->scale;
            
        }

        echo json_encode($arr);
    }

    /**
     * 根据合同获取签约人
     * @return [type] [description]
     */
    public function getsigner($contract_id)
    {
        $model = CmsContractSigner::model()->findAll("contract_id = '$contract_id' and deleted=0 ");
        foreach ($model as $key => $value) {
            $arr[]=$value->signer;
        }
        return $arr;
    }
    public function getsalecontract($purchasecontract_id)
    {
        $cms = CmsPurchaseProperty::model()->find("contract_id = '$purchasecontract_id'");
        $sale = CmsPurchaseProperty::model()->find("property_id ='$cms->property_id' and status in(0,-1) and deleted=0 and type=1");

        //截止到一年的提成，超过一年的过滤掉
        if($sale){
            $end = strtotime('- 1 year',time());
            $ccs = CmsContractSigner::model()->find("contract_id = '$sale->contract_id' and sign_date > $end ");
            if($ccs){
                return $ccs->contract_id;
            }else{
                return null;
            }
        }else{
            return null;
        }

    }

    /**
     * 输入合同编号和对应的汇款得出提成
     * @param  [type] $contract_arr [description]
     * @return [type]               [description]
     */
    public function getplus($contract_arr)
    {   
        $old = CmsPlus::model()->findAll();

        $old = serialize($old);

        if($_POST['type']==1){
            file_put_contents('data/'.date('y-m-d').'sale'.'.txt', $old);
            CmsPlus::model()->deleteAll("type=1");
        }else{
            file_put_contents('data/'.date('y-m-d').'purchase'.'.txt', $old);
            CmsPlus::model()->deleteAll("type=0");
        }

        $arr=[];
        $grr=[];
        $mianjiarr=[];
        //合同ID=>金额
        // $contract_arr=['URS-XS-KJ-17020020'=>'20000','URS-XS-KJ-17020019'=>'30000'];
        //寻找签约人呀~~~
        foreach ($contract_arr as $key => $value) {
            $signer = $this->getsigner($key);

            $type = CmsPurchaseContract::model()->find(array(
                'select'=>array('type'),
                'condition'=>"id ='$key'",
                ))->type;

            if($type==0){
                if(count($signer)>1){
                    unset($signer[0]);
                }
            }
            if($signer){
                //得到签约人数组(因为签约人可能会是多个人)
                foreach ($signer as $k1 => $v1) {
                    $guanyong = $this->getguanyong($v1);
                    $grr[]= $guanyong->id;
                    $grr = array_unique($grr);

                    //根据签约人去搜索当月出售的面积
                    
                    $area = $this->getArea("$v1",date('Y-m',strtotime('- 1 month',time())).'-1');

                    //获取职位信息
                    // $user = AdminUser::model()->find("id = '$signer'");
                    // $position = $user->position_id;
                    // $level = AdminPosition::model()->find("id = '$position' and deleted=0 ")->level;
                    $level =1;
                    //求出比例
                    $ccs = CmsContractSigner::model()->find("contract_id = '$key' and signer = '$v1'");
                    $scale = $this->getScale($area,$level,$type);
                    //得出提成
                    $money =$ccs->scale*$value*$scale/1000;

                    $arr[$key.$v1]['contract_id'] = $key;
                    $arr[$key.$v1]['amount'] = $value;
                    $arr[$key.$v1]['area'] = $area;
                    $arr[$key.$v1]['scale'] = $scale;
                    $arr[$key.$v1]['money'] = $money;
                    $arr[$key.$v1]['signer'] = $v1;
                    $arr[$key.$v1]['level'] = $level;
                    $arr[$key.$v1]['area_scale'] = $ccs->scale;
                    $arr[$key.$v1]['guanyong'] = $guanyong->id;



                    $plus  = new CmsPlus();
                    $plus ->id = Guid::create_guid();
                    $plus ->contract_id = $key;
                    $plus ->amount = (int)($value*100);
                    $plus ->area = $area;
                    $plus ->scale = $scale;
                    $plus ->money =(int)($money*100);
                    $plus ->signer = $v1;
                    $plus ->level = $level;
                    $plus ->area_scale = $ccs->scale;
                    $plus ->guanyong = $guanyong->id;
                    $plus ->type = $_POST['type'];

                    if(!$plus->save()){
                        $this->OutputJson(0,$plus->errors,null);
                    }

                }                
            }else{
                
            }



        }

    }

    /**
     * 根据签约人，获取他的经理
     * @param  [type] $signer [description]
     * @return [type]         [description]
     */
    public function getguanyong($signer)
    {
        //1.由用户ID查出其所在部门
        $department_id = AdminUser::model()->find("id ='$signer'")->department_id;
        //根据部门查询其同一部门的经理
        $guanyong = AdminUser::model()->find("department_id = '$department_id' and deleted=0 and grade = 1");
        return $guanyong;
    }
    
    /**
     *   
     * 
     * @param  [str] $signer         [签约人ID]
     * @param  [str] $month       [计算哪个月份的面积和]
     * @return [float]              [返回float面积和]
     * 
     */
    public function getArea($signer,$month)
    {   
        //根据签约人，获取当月签单面积
        $month1 = strtotime($month);
        $month2 = strtotime('+1 month',strtotime($month)) ;
        $list = CmsContractSigner::model()->findAll(array(
            'select'=>'id,contract_id',
            'condition'=>"signer='$signer'  and deleted = 0 and sign_date >= $month1 and sign_date <= $month2 ",

            ));
        //根据合同ID查出面积
        $area =0;
        if($list){
            foreach ($list as $key => $value) {
                $property_id = CmsPurchaseProperty::model()->findAll("contract_id = '$value->contract_id'");
                //一个合同的面积和
                foreach ($property_id as $k => $v) {
                    $ccs = CmsContractSigner::model()->find("contract_id = '$v->contract_id' and signer = '$signer'");
                    $area += $v->area*($ccs->scale);//此处填写多人签约时的面积比例
                }
            }

        }
        return $area;
    }
    /**
     * [获取提成比例]
     * @param  [type] $area     [面积]
     * @param  [type] $position [职位]
     * @return [type]           [description]
     */
    public function getScale($area,$position,$type)
    {  
       $type = isset($type)?$type:$type=1;
        //转化职位成提成比例表中的等级
        $position = 1;
        //查出
        $scale = Scale::model()->find("area_start <= $area and area_end >= $area and deleted = 0 and level = $position and type2 =$type");
        return $scale->scale;
    }


   
}

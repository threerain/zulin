<?php

class PositionController extends BackgroundBaseController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	// public $layout='//layouts/backgroundcenter2';
    public $PAGE_LEVEL_STYLES = null ;
    public $PAGE_LEVEL_PLUGINS=null;
    public $PAGE_LEVEL_SCRIPTS=null;

	public $title='职务管理';

	/**
	 * Lists all models.
	 */
    public function actionGetChildDepartment(){

        //接收父类id
        $parent_id =Yii::app()->request->getParam("parent_id");

        //通过父类id找到子部门
        $list = AdminDepartment::model()->findAll(array(
                'select'=>array('id,name'),
                'condition'=>"parent_id = '$parent_id' and deleted = 0",
            ));

        //放进数组里
        $arr = [];
        foreach ($list as $key => $value) {
            $arr[$key]['id'] = $value->id;
            $arr[$key]['name'] = $value->name;
        }

        echo json_encode($arr);

    }
	public function actionIndex()
	{
        $keyword =Yii::app()->request->getParam("keyword");
        $department =Yii::app()->request->getParam("department");

        //1.根据部门名字搜出部门的ID
        $department2 = AdminDepartment::model()->findAll("name like ('%".$department."%')");
        foreach ($department2 as $key => $value) {
            $department_id .= " '$value->id',";
        }
        //去掉最后一个逗号
        $department_id =  substr($department_id,1,-1);

		$pagesize=10;

        $criteria=new CDbCriteria;
        if ($keyword){
        	$criteria->condition="1=1 and t.deleted=0 and (t.name like ('%".$keyword."%') )";
        }
        elseif($department_id){
            $criteria->condition="1=1 and t.deleted=0 and t.department_id in ($department_id)";

        }else{
        	$criteria->condition="1=1 and t.deleted=0";
        }

        $criteria->order='t.ctime DESC';
        $count = AdminPosition::model()->count($criteria);

        $pager=new CPagination($count);
        $pager->pageSize=$pagesize;
        $pager->applyLimit($criteria);

        $list =AdminPosition::model()->findAll($criteria);

        $this->render("index",array(
            'list'=>$list,
            'department'=>$department,
            'pages'=>$pager,
            'keyword'=>$keyword,
        ));

		// echo "string";
		// $this->render("index");
	}

    public function actionlist(){

        $department_id = Yii::app()->request->getParam("department_id");

        $list = AdminPosition::model()->findAll("department_id = '$department_id' and deleted = 0");
        $arr = [];
        foreach ($list as $key => $value) {

           $arr[] =$value->attributes; 
        }
        echo json_encode($arr,JSON_UNESCAPED_UNICODE);
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

        $name =Yii::app()->request->getParam("name");
        
        $department_id =Yii::app()->request->getParam("department_id");
        
        if($department_id[count($department_id)-1]==''){
            $department_id = $department_id[count($department_id)-2];
        }else{
            $department_id = $department_id[count($department_id)-1];
        }

        $model =AdminPosition::model()->find(" t.name='$name' && deleted=0 and '$department_id' = department_id ");
        if ($model){
            $this->OutputJson(0,"职务名已存在",null);
        }

        $model =new AdminPosition();
        $model->id=Guid::create_guid();
        $model->name=$name;
        
        $model->department_id=$department_id;
        $model->create_user_id=Yii::app()->session['admin_uid'];
        $model->deleted=0;
        $model->ctime=time();


        if (!$model->save()){
            if(Yii::app()->request->isAjaxRequest){

                $this->OutputJson(0,$model->errors,null);
            }

        }

        if(Yii::app()->request->isAjaxRequest){
            $this->OutputJson(301,'',"/admin/position");
        }
        else{
            $controller->redirect($referer);
        }

        $this->redirect($referer);
    }

    public function actionEdit()
    {
        $referer= $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");

        $model =AdminPosition::model()->find(" t.id='$id'");

        $this->render("edit",array(
            'model'=>$model,
            'referer'=>$referer,
        ));
    }

    public function actionEditSave()
    {

        $id =Yii::app()->request->getParam("id");
        $referer =Yii::app()->request->getParam("referer");

        $name =Yii::app()->request->getParam("name");
        
        $department_id =Yii::app()->request->getParam("department_id");
        
        if($department_id[count($department_id)-1]==''){
            $department_id = $department_id[count($department_id)-2];
        }else{
            $department_id = $department_id[count($department_id)-1];
        }


        $model =AdminPosition::model()->find(" t.id='$id'");
        if ($model){
            $model->name=$name;
            
            $model->department_id=$department_id;
            if (!$model->save()){
                if(Yii::app()->request->isAjaxRequest){
                    $this->OutputJson(0,$model->errors,null);
                }
            }
        }

        if(Yii::app()->request->isAjaxRequest){
            $this->OutputJson(301,"",$referer);
        }
        else{
            $this->redirect($referer);
        }
    }

    public function actionModul()
    {
        try {
            $referer= $_SERVER['HTTP_REFERER'];
            $id =Yii::app()->request->getParam("id");

            $model =AdminPosition::model()->find(" t.id='$id'");

            $selects=AdminPositionModul::model()->findAll("position_id='$id'");
            $array_select=[];

            foreach ($selects as $key => $select) {
                array_push($array_select, $select->modul_id);
            }

            $str=join(",",$array_select);
            $in_str = "'".str_replace(",","','",$str)."'";
            
            $this->render("modul",array(
                'model'=>$model,
                'referer'=>$referer,
                'array_select'=>$in_str,
            ));
        } catch (Exception $e) {
            var_dump($e);
            die();
        }
    }

    public function actionModulSave()
    {
        $id =Yii::app()->request->getParam("id");  //职位ID
        $modul_ids =Yii::app()->request->getParam("my_multi_select2");

        $referer =Yii::app()->request->getParam("referer");

        //$array_modul_ids = explode(',',$modul_ids); 


        //获取一下这个职位的type类型和name值，查找出在其父亲部门的下所有符合条件的，也都一律改好
        
        //1.查出该职位所在的部门的父级部门
        $position = AdminPosition::model()->find("id = '$id'");
        $department = AdminDepartment::model()->find("id = '$position->department_id'");
        $department_parent_id = $department->parent_id;
        //2.由父级部门找到所有子部门的部门ID，再由部门ID查找到符合名称和type的所有职位，然后进行权限的存储
        $child_department =  AdminDepartment::model()->findAll("parent_id = '$department_parent_id' and  deleted = 0");

        foreach ($child_department as $k => $v) {
            //获取到部门的ID了，根据部门ID获取职位

            $child_position = AdminPosition::model()->findAll("name='$position->name'");
            
            $newarr = [];
            foreach ($child_position as $k1 => $v1) {
                //判断同一名称,是否是同一个父级部门
                $tmp = AdminDepartment::model()->find("id = '$v1->department_id'");

                if($tmp->parent_id!=$department->parent_id){
                    unset($v1);
                }
                if($v1){
                    $newarr[] = $v1;
                }
            }

        }

        foreach ($newarr as $k3 => $v3) {

            $moduls=AdminPositionModul::model()->findAll("position_id='$v3->id'");

            foreach ($moduls as $ke => $modul) {
                if (!$modul->delete()){
                    if(Yii::app()->request->isAjaxRequest){

                        $this->OutputJson(0,$modul->errors,null);
                    }

                }
            }

            if($modul_ids) {

                foreach ($modul_ids as $key => $value) {
                    $modul=new AdminPositionModul();
                    $modul->id=Guid::create_guid();
                    $modul->position_id=$v3->id;
                    $modul->modul_id=$value;
                    $modul->create_user_id=Yii::app()->session['admin_uid'];
                    $modul->deleted=0;
                    $modul->ctime=time();

                    if (!$modul->save()){
                        if(Yii::app()->request->isAjaxRequest){

                            $this->OutputJson(0,$modul->errors,null);
                        }

                    }
                }
            }                    
        }
            
        if(Yii::app()->request->isAjaxRequest){
            $this->OutputJson(301,"",$referer);
        }
        else{
            $this->redirect($referer);
        }
    }
    public function actionDelete()
    {
        $referer= $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");

        $model =AdminPosition::model()->find(" t.id='$id'");
        
        $model->deleted=1;
        if (!$model->save()){
            $this->OutputJson(0,$model->errors,null);
        }

        if(Yii::app()->request->isAjaxRequest){
            $this->OutputJson(301,$referer);
        }
        else{
            $this->redirect($referer);
        }
    }

    public function actionlevel()
    {
        $referer= $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");
        $model =AdminPosition::model()->find(" t.id='$id'");

        $arr['level'] =$model->level;
        $arr['type'] =$model->type;
        echo json_encode($arr);

    }

        /**
     * 设置职位的提成等级
     * @return [type] [description]
     */
    public function actionlevelsave(){
        $position_id = $_POST['position_id'];
        $type        = $_POST['type'];
        $level       = $_POST['level'];
        $position = AdminPosition::model()->find("id = '$position_id'");
        $position->type =$type;
        $position->level =$level;
        if(!$position->save()){

            echo "<script>alert($position->errors)</script>";
            $this->OutputJson(0,json_encode($position->errors,JSON_UNESCAPED_UNICODE),null);
        }else{
            $this->redirect($_SERVER['HTTP_REFERER']);
        }
    }

    // public function actionAjaxlist()
    // {
    //     $data=null;
    //     $criteria=new CDbCriteria;
    //     $keyword =Yii::app()->request->getParam("q");
    //     if ($keyword){
    //         $criteria->condition="1=1 and t.deleted=0 and t.nickname like '%$keyword%'";
    //     }

    //     // else
    //     // {
    //     //     $criteria->condition="1=1 and t.deleted=0";
    //     // }

    //     //$criteria->order='t.ctime DESC';
    //     $count = AdminUser::model()->count($criteria);

    //     // var_dump($criteria);
    //     // die();

    //     $pager=new CPagination($count);
    //     $pager->pageSize=10;//$pagesize;
    //     $pager->applyLimit($criteria);

    //     $list =AdminUser::model()->findAll($criteria);
    //     //$data["total"]=10;

        
    //     foreach ($list as $key => $user) {
    //         $_data["id"]=$user->id;
    //         $_data["title"]=$user->nickname;
    //         $data["movies"][]=$_data;
    //     }
    //     //$data["more"]=false;
    //     header('Content-Type:application/json;charset=utf-8');
    //     echo json_encode($data,JSON_UNESCAPED_UNICODE);
        
    //     die();




    // }

    // public function actionAjaxitem()
    // {
    //     $id =Yii::app()->request->getParam("id");
    //     $criteria=new CDbCriteria;
    //     $item =AdminUser::model()->find("id='$id'");

    //     $_data["id"]=$item->id;
    //     $_data["title"]=$item->nickname;
    //     $data=$_data;

    //     header('Content-Type:application/json;charset=utf-8');
    //     echo json_encode($data,JSON_UNESCAPED_UNICODE);
        
    //     die();
    // }
}

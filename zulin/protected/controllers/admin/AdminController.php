<?php

class AdminController extends BackgroundBaseController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	// public $layout='//layouts/backgroundcenter2';
    public $PAGE_LEVEL_STYLES = null ;
    public $PAGE_LEVEL_PLUGINS=null;
    public $PAGE_LEVEL_SCRIPTS=null;

	public $title='管理员管理';

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $keyword =Yii::app()->request->getParam("keyword");
        $department =Yii::app()->request->getParam("department");
        $department_tmp = Yii::app()->request->getParam("department_id");

         //1.根据部门名字搜出部门的ID
        $department2 = AdminDepartment::model()->findAll("name like ('%".$department."%')");
        foreach ($department2 as $key => $value) {
            $department_id .= " '$value->id',";
        }
        $department_id =  substr($department_id,1,-1);
        if(!$department&&$department_tmp){
            $department_id = "'$department_tmp'";
        }
        
		$pagesize=10;

        $criteria=new CDbCriteria;
        if ($keyword){
        	$criteria->condition="1=1 and t.deleted=0 and (t.account like ('%".$keyword."%') or t.nickname like ('%".$keyword."%'))";
        }
        elseif($department_id){
            $criteria->condition="1=1 and t.deleted=0 and t.department_id in ($department_id)";

        }else
        {
        	$criteria->condition="1=1 and t.deleted=0";
        }

        $criteria->order='t.login_time desc';
        $count = AdminUser::model()->count($criteria);

        $pager=new CPagination($count);
        $pager->pageSize=$pagesize;
        $pager->applyLimit($criteria);

        $list =AdminUser::model()->findAll($criteria);

        $this->render("index",array(
            'list'=>$list,
            'department'=>$department,
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
        $referer= $_SERVER['HTTP_REFERER'];
        $department_id =Yii::app()->request->getParam("department_id");
        if($department_id[count($department_id)-1]==''){
            $department_id = $department_id[count($department_id)-2];
        }else{
            $department_id = $department_id[count($department_id)-1];
        }
        $account = $_POST['account'];
        $model =AdminUser::model()->find(" t.account='$account' && deleted=0");
        if ($model){
            $this->OutputJson(0,"账号已存在",null);
        }

        $model =new AdminUser();
        $model->id=Guid::create_guid();
        if($_POST['password']==$_POST['r_password']){
            unset($_POST['r_password']);
        }else{
            $this->OutputJson(0,"密码不一致",null);
        }
        foreach ($_POST as $key => $value) {
            if($key=='password'){
                $model->$key=md5($_POST['password']); 
            }elseif($key=='birthday'){
                if($value!=''){
                    $model->$key = strtotime($_POST['birthday']);
                }else{
                    $model->$key=null;
                }

            }elseif ($key=='department_id') {
                $model->$key =$department_id;
            }else{
                $model->$key = $value;
            }

        }
        $model->create_user_id=Yii::app()->session['admin_uid'];
        $model->last_login_time=time();
        $model->type=1;
        $model->deleted=0;
        $model->ctime=time();
        if (!$model->save()){
            if(Yii::app()->request->isAjaxRequest){

                $this->OutputJson(0,$model->errors,null);
            }

        }
        if(Yii::app()->request->isAjaxRequest){
            $this->OutputJson(301,'',"/admin/admin");
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

        $model =AdminUser::model()->find(" t.id='$id'");

        $this->render("edit",array(
            'model'=>$model,
            'referer'=>$referer,
        ));
    }

    public function actionEditSave()
    {
        $id =Yii::app()->request->getParam("id");
        $referer =Yii::app()->request->getParam("referer");
        $department_id =Yii::app()->request->getParam("department_id");
        if($department_id[count($department_id)-1]==''){
            $department_id = $department_id[count($department_id)-2];
        }else{
            $department_id = $department_id[count($department_id)-1];
        }

        $model =AdminUser::model()->find(" t.id='$id'");
        if ($model){

            if ($model->type==0){
                $this->OutputJson(0,"系统管理员，不能修改",null);
            }

        if($_POST['password']==$_POST['r_password']){
            unset($_POST['r_password']);
        }else{
            $this->OutputJson(0,"密码不一致",null);
        }    
        foreach ($_POST as $key => $value) {

            if($key!='referer'){
                if($key=='password'){
                    if($value!=''){
                        $model->$key=md5($_POST['password']); 
                    }
                }elseif($key=='birthday'){
                    if($value!=''){
                        $model->$key = strtotime($_POST['birthday']);
                    }else{
                        $model->$key=null;
                    }
                }elseif($key=='department_id')
                {
                    $model->$key = $department_id;
                }else{
                    $model->$key = $value;
                }                
            }
        }
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

    public function actionDelete()
    {
        $referer= $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");

        $model =AdminUser::model()->find(" t.id='$id'");
        if ($model->type==0){
            $this->OutputJson(0,"系统管理员，不能删除",null);
        }
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

    public function actionAjaxlist()
    {
        $data=null;
        $criteria=new CDbCriteria;
        $keyword =Yii::app()->request->getParam("q");
        if ($keyword){
            $criteria->condition="1=1 and t.deleted=0 and t.nickname like '%$keyword%'";
        }

        // else
        // {
        //     $criteria->condition="1=1 and t.deleted=0";
        // }

        //$criteria->order='t.ctime DESC';
        $count = AdminUser::model()->count($criteria);

        // var_dump($criteria);
        // die();

        $pager=new CPagination($count);
        $pager->pageSize=10;//$pagesize;
        $pager->applyLimit($criteria);

        $list =AdminUser::model()->findAll($criteria);
        //$data["total"]=10;

        
        foreach ($list as $key => $user) {
            $_data["id"]=$user->id;
            $_data["title"]=$user->nickname;
            $data["movies"][]=$_data;
        }
        //$data["more"]=false;
        header('Content-Type:application/json;charset=utf-8');
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        
        die();



// {
//     "total": 2,
//     "movies": [
//         {
//             "id": "770672122",
//             "title": "Toy Story 3",
//             "year": 2010,
//             "mpaa_rating": "G",
//             "runtime": 103,
//             "critics_consensus": "Deftly blending comedy, adventure, and honest emotion, Toy Story 3 is a rare second sequel that really works.",
//             "release_dates": {
//                 "theater": "2010-06-18",
//                 "dvd": "2010-11-02"
//             },
//             "ratings": {
//                 "critics_rating": "Certified Fresh",
//                 "critics_score": 99,
//                 "audience_rating": "Upright",
//                 "audience_score": 9119
//             },
//             "synopsis": "Pixar returns to their first success with Toy Story 3. The movie begins with Andy leaving for college and donating his beloved toys -- including Woody (Tom Hanks) and Buzz (Tim Allen) -- to a daycare. While the crew meets new friends, including Ken (Michael Keaton), they soon grow to hate their new surroundings and plan an escape. The film was directed by Lee Unkrich from a script co-authored by Little Miss Sunshine scribe Michael Arndt. ~ Perry Seibert, Rovi",
//             "posters": {
//                 "thumbnail": "http://content6.flixster.com/movie/11/13/43/11134356_tmb.jpg",
//                 "profile": "http://content6.flixster.com/movie/11/13/43/11134356_tmb.jpg",
//                 "detailed": "http://content6.flixster.com/movie/11/13/43/11134356_tmb.jpg",
//                 "original": "http://content6.flixster.com/movie/11/13/43/11134356_tmb.jpg"
//             },
//             "abridged_cast": [
//                 {
//                     "name": "Tom Hanks",
//                     "characters": [
//                         "Woody"
//                     ]
//                 },
//                 {
//                     "name": "Tim Allen",
//                     "characters": [
//                         "Buzz Lightyear"
//                     ]
//                 },
//                 {
//                     "name": "Joan Cusack",
//                     "characters": [
//                         "Jessie the Cowgirl"
//                     ]
//                 },
//                 {
//                     "name": "Don Rickles",
//                     "characters": [
//                         "Mr. Potato Head"
//                     ]
//                 },
//                 {
//                     "name": "Wallace Shawn",
//                     "characters": [
//                         "Rex"
//                     ]
//                 }
//             ],
//             "alternate_ids": {
//                 "imdb": "0435761"
//             },
//             "links": {
//                 "self": "http://api.rottentomatoes.com/api/public/v1.0/movies/770672122.json",
//                 "alternate": "http://www.rottentomatoes.com/m/toy_story_3/",
//                 "cast": "http://api.rottentomatoes.com/api/public/v1.0/movies/770672122/cast.json",
//                 "clips": "http://api.rottentomatoes.com/api/public/v1.0/movies/770672122/clips.json",
//                 "reviews": "http://api.rottentomatoes.com/api/public/v1.0/movies/770672122/reviews.json",
//                 "similar": "http://api.rottentomatoes.com/api/public/v1.0/movies/770672122/similar.json"
//             }
//         }
//     ],
//     "links": {
//         "self": "http://api.rottentomatoes.com/api/public/v1.0/movies.json?q=Toy+Story+3&page_limit=1&page=1",
//         "next": "http://api.rottentomatoes.com/api/public/v1.0/movies.json?q=Toy+Story+3&page_limit=1&page=2"
//     },
//     "link_template": "http://api.rottentomatoes.com/api/public/v1.0/movies.json?q={search-term}&page_limit={results-per-page}&page={page-number}"
// }
    }

    public function actionAjaxitem()
    {
        $id =Yii::app()->request->getParam("id");
        $criteria=new CDbCriteria;
        $item =AdminUser::model()->find("id='$id'");

        $_data["id"]=$item->id;
        $_data["title"]=$item->nickname;
        $data=$_data;

        header('Content-Type:application/json;charset=utf-8');
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        
        die();
    }
}

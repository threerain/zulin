<?php

class DepartmentController extends BackgroundBaseController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	// public $layout='//layouts/backgroundcenter2';
    public $PAGE_LEVEL_STYLES = null ;
    public $PAGE_LEVEL_PLUGINS=null;
    public $PAGE_LEVEL_SCRIPTS=null;

	public $title='部门管理';

	/**
	 * Lists all models.
	 */
    public function actionTest(){
        //先查出外层一条是否含有子集，如果有子集，则对子集进行遍历，然后查出每一个下面是否含有子集，如果含有子集，则继续遍历得出每一个子集下面是否含有子集
    
      //先查出最外层的部门
        $data = AdminDepartment::model()->findAll("level=0 and deleted=0");
        $bigarr = [];
        foreach ($data as $key => $value) {
            # code...
            $arr[$key]['name'] = $value->name;
            $arr[$key]['code'] = $value->id;
            $arr[$key]['icon'] = 'icon-th';
            $arr[$key]['parentCode'] = $value->parent_id;
            $arr[$key]['child'] = $this->get_child($value->id);

        }
        echo json_encode($arr);

        //定义一个大数组
        //判断部门下面是否还有子部门，如果有获取出id,name

    }
    public function get_child($id){

        $data = AdminDepartment::model()->findAll("deleted=0 and parent_id ='$id' ");
        if($data){
            foreach ($data as $key => $value) {
                $res = AdminDepartment::model()->findAll("deleted=0 and parent_id ='$value->id' ");
               
                $arr[$key]['name'] = $value->name;
                $arr[$key]['code'] = $value->id;
                $arr[$key]['icon'] = 'icon-minus-sign';
                $arr[$key]['parentCode'] = $value->parent_id;
                if($res){
                    $arr[$key]['child'] = $this->get_child($value->id);
                }else{
                    $arr[$key]['icon'] = '';
                    $arr[$key]['child'] =[];
                    continue;
                }
            }
            return $arr;                
        }else{
            return [];
        }
    }
	public function actionIndex()
	{
        $keyword =Yii::app()->request->getParam("keyword");

		$pagesize=10;

        $criteria=new CDbCriteria;
        if ($keyword){
        	$criteria->condition="1=1 and t.deleted=0 and level=0 and (t.title name ('%".$keyword."%') )";
        }
        else
        {
        	$criteria->condition="1=1 and t.deleted=0 and level=0";
        }

        $criteria->order='t.ctime DESC';
        $count = AdminDepartment::model()->count($criteria);

        // $pager=new CPagination($count);
        // $pager->pageSize=$pagesize;
        // $pager->applyLimit($criteria);

        $list =AdminDepartment::model()->findAll($criteria);


        $this->render("index",array(
            'list'=>$list,
            //'pages'=>$pager,
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

        $name =Yii::app()->request->getParam("name");

        $model =AdminDepartment::model()->find(" t.name='$name' && deleted=0 && level=0 ");
        if ($model){
            $this->OutputJson(0,"部门已存在",null);
        }

        $model =new AdminDepartment();
        $model->id=Guid::create_guid();
        $model->name=$name;
        $model->parent_id=0;
        $model->level=0;
        $model->create_user_id=Yii::app()->session['admin_uid'];
        $model->order_by=0;
        $model->deleted=0;
        $model->ctime=time();


        if (!$model->save()){
            if(Yii::app()->request->isAjaxRequest){

                $this->OutputJson(0,$model->errors,null);
            }

            $this->OutputJson(0,$model->errors,null);

        }

        if(Yii::app()->request->isAjaxRequest){
            $this->OutputJson(301,'',"/admin/department");
        }
        else{
            $this->redirect("/admin/department");
        }

        $this->redirect("/admin/department");
    }

    public function actionEdit()
    {
        $referer= $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");

        $model =AdminDepartment::model()->find(" t.id='$id'");

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

        $model =AdminDepartment::model()->find(" t.name='$name' && deleted=0 && level=0 && id<>'$id'");
        if ($model){
            $this->OutputJson(0,"部门已存在",null);
        }

        $model =AdminDepartment::model()->find(" t.id='$id'");
        if ($model){
            $model->name=$name;
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

    public function actionSub()
    {
        $referer= $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id"); //部门名

        //$model =AdminDepartment::model()->find(" t.id='$id'");

        $this->render("sub",array(
            'id'=>$id,
            'referer'=>$referer,
        ));
    }

    public function actionSubSave()
    {
        $id =Yii::app()->request->getParam("id");
        $referer =Yii::app()->request->getParam("referer");

        $name =Yii::app()->request->getParam("name");

        $parent=AdminDepartment::model()->find(" id='$id'");


        $model =AdminDepartment::model()->find(" t.name='$name' && deleted=0 && level=$parent->level ");
        if ($model){
            $this->OutputJson(0,"部门已存在",null);
        }

        $model =new AdminDepartment();
        $model->id=Guid::create_guid();
        $model->name=$name;
        $model->parent_id=$parent->id;
        $model->level=$parent->level+1;
        $model->create_user_id=Yii::app()->session['admin_uid'];
        $model->order_by=0;
        $model->deleted=0;
        $model->ctime=time();

        if (!$model->save()){
            if(Yii::app()->request->isAjaxRequest){

                $this->OutputJson(0,$model->errors,null);
            }

            $this->OutputJson(0,$model->errors,null);

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

        $model =AdminDepartment::model()->find(" t.id='$id'");
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

//     public function actionAjaxlist()
//     {
//         $data=null;
//         $criteria=new CDbCriteria;
//         $keyword =Yii::app()->request->getParam("q");
//         if ($keyword){
//             $criteria->condition="1=1 and t.deleted=0 and t.nickname like '%$keyword%'";
//         }

//         // else
//         // {
//         //     $criteria->condition="1=1 and t.deleted=0";
//         // }

//         //$criteria->order='t.ctime DESC';
//         $count = AdminUser::model()->count($criteria);

//         // var_dump($criteria);
//         // die();

//         $pager=new CPagination($count);
//         $pager->pageSize=10;//$pagesize;
//         $pager->applyLimit($criteria);

//         $list =AdminUser::model()->findAll($criteria);
//         //$data["total"]=10;

        
//         foreach ($list as $key => $user) {
//             $_data["id"]=$user->id;
//             $_data["title"]=$user->nickname;
//             $data["movies"][]=$_data;
//         }
//         //$data["more"]=false;
//         header('Content-Type:application/json;charset=utf-8');
//         echo json_encode($data,JSON_UNESCAPED_UNICODE);
        
//         die();



// // {
// //     "total": 2,
// //     "movies": [
// //         {
// //             "id": "770672122",
// //             "title": "Toy Story 3",
// //             "year": 2010,
// //             "mpaa_rating": "G",
// //             "runtime": 103,
// //             "critics_consensus": "Deftly blending comedy, adventure, and honest emotion, Toy Story 3 is a rare second sequel that really works.",
// //             "release_dates": {
// //                 "theater": "2010-06-18",
// //                 "dvd": "2010-11-02"
// //             },
// //             "ratings": {
// //                 "critics_rating": "Certified Fresh",
// //                 "critics_score": 99,
// //                 "audience_rating": "Upright",
// //                 "audience_score": 9119
// //             },
// //             "synopsis": "Pixar returns to their first success with Toy Story 3. The movie begins with Andy leaving for college and donating his beloved toys -- including Woody (Tom Hanks) and Buzz (Tim Allen) -- to a daycare. While the crew meets new friends, including Ken (Michael Keaton), they soon grow to hate their new surroundings and plan an escape. The film was directed by Lee Unkrich from a script co-authored by Little Miss Sunshine scribe Michael Arndt. ~ Perry Seibert, Rovi",
// //             "posters": {
// //                 "thumbnail": "http://content6.flixster.com/movie/11/13/43/11134356_tmb.jpg",
// //                 "profile": "http://content6.flixster.com/movie/11/13/43/11134356_tmb.jpg",
// //                 "detailed": "http://content6.flixster.com/movie/11/13/43/11134356_tmb.jpg",
// //                 "original": "http://content6.flixster.com/movie/11/13/43/11134356_tmb.jpg"
// //             },
// //             "abridged_cast": [
// //                 {
// //                     "name": "Tom Hanks",
// //                     "characters": [
// //                         "Woody"
// //                     ]
// //                 },
// //                 {
// //                     "name": "Tim Allen",
// //                     "characters": [
// //                         "Buzz Lightyear"
// //                     ]
// //                 },
// //                 {
// //                     "name": "Joan Cusack",
// //                     "characters": [
// //                         "Jessie the Cowgirl"
// //                     ]
// //                 },
// //                 {
// //                     "name": "Don Rickles",
// //                     "characters": [
// //                         "Mr. Potato Head"
// //                     ]
// //                 },
// //                 {
// //                     "name": "Wallace Shawn",
// //                     "characters": [
// //                         "Rex"
// //                     ]
// //                 }
// //             ],
// //             "alternate_ids": {
// //                 "imdb": "0435761"
// //             },
// //             "links": {
// //                 "self": "http://api.rottentomatoes.com/api/public/v1.0/movies/770672122.json",
// //                 "alternate": "http://www.rottentomatoes.com/m/toy_story_3/",
// //                 "cast": "http://api.rottentomatoes.com/api/public/v1.0/movies/770672122/cast.json",
// //                 "clips": "http://api.rottentomatoes.com/api/public/v1.0/movies/770672122/clips.json",
// //                 "reviews": "http://api.rottentomatoes.com/api/public/v1.0/movies/770672122/reviews.json",
// //                 "similar": "http://api.rottentomatoes.com/api/public/v1.0/movies/770672122/similar.json"
// //             }
// //         }
// //     ],
// //     "links": {
// //         "self": "http://api.rottentomatoes.com/api/public/v1.0/movies.json?q=Toy+Story+3&page_limit=1&page=1",
// //         "next": "http://api.rottentomatoes.com/api/public/v1.0/movies.json?q=Toy+Story+3&page_limit=1&page=2"
// //     },
// //     "link_template": "http://api.rottentomatoes.com/api/public/v1.0/movies.json?q={search-term}&page_limit={results-per-page}&page={page-number}"
// // }
//     }

//     public function actionAjaxitem()
//     {
//         $id =Yii::app()->request->getParam("id");
//         $criteria=new CDbCriteria;
//         $item =AdminUser::model()->find("id='$id'");

//         $_data["id"]=$item->id;
//         $_data["title"]=$item->nickname;
//         $data=$_data;

//         header('Content-Type:application/json;charset=utf-8');
//         echo json_encode($data,JSON_UNESCAPED_UNICODE);
        
//         die();
//     }
}

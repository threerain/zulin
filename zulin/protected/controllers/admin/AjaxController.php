<?php

class AjaxController extends BackgroundBaseController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */

    public function actionGetchannelmanager()
    {
        $channel_id =Yii::app()->request->getParam("id");
        $contract_id=Yii::app()->request->getParam("cid");

        $criteria=new CDbCriteria;
        $criteria->addCondition("t.channel_id ='$channel_id'");
        $criteria->addCondition("deleted=0");

        $manager=null;
        if ($contract_id){
            $model =CmsPurchaseContract::model()->find("id='".$contract_id."'");
            if ($model && $model->channel_manager_id){
                $manager =CmsChannelManager::model()->find("id='".$model->channel_manager_id."'");
            }
        }

        $criteria->order='t.name';

        $list =CmsChannelManager::model()->findAll($criteria);
        //$data["total"]=10;

        foreach ($list as $key => $user) {
            $_data["id"]=$user->id;
            $_data["title"]=$user->name;
            if ($manager && $user->id==$manager->id){
                $_data["select"]="select";
            }
            else{
                $_data["select"]="";
            }
            $data[]=$_data;
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

    public function actionGetchannelmanager2()
    {
        $channel_id =Yii::app()->request->getParam("id");
        $contract_id=Yii::app()->request->getParam("cid");

        $criteria=new CDbCriteria;
        $criteria->addCondition("t.channel_id ='$channel_id'");
        $criteria->addCondition("deleted=0");

        $manager=null;
        if ($contract_id){
            $model =CmsPurchaseContract::model()->find("id='".$contract_id."'");
            if ($model && $model->channel_manager_id){
                $manager =CmsChannelManager::model()->find("id='".$model->channel_manager_id2."'");
            }
        }

        $criteria->order='t.name';

        $list =CmsChannelManager::model()->findAll($criteria);
        //$data["total"]=10;

        foreach ($list as $key => $user) {
            $_data["id"]=$user->id;
            $_data["title"]=$user->name;
            if ($manager && $user->id==$manager->id){
                $_data["select"]="select";
            }
            else{
                $_data["select"]="";
            }
            $data[]=$_data;
        }
        //$data["more"]=false;
        header('Content-Type:application/json;charset=utf-8');
        echo json_encode($data,JSON_UNESCAPED_UNICODE);

        die();
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

    /*
    编号规则
    */
    public function actionGetHouseRule()
    {
        $building_id =Yii::app()->request->getParam("id");
        $criteria=new CDbCriteria;
        $criteria->addCondition("t.id ='$building_id'");
        $criteria->addCondition("deleted=0");

        $list = BaseBuilding::model()->find($criteria);
        foreach (explode("或",$list->room_number_rule) as $key => $value) {
            $room_types = str_replace([1,2,3,4],['轿车','客车','SUV','商务'],$list->room_type);
            $type = str_replace([1,2,3],['A1','A2','A3'],$list->type);
            $_data["type"]=$type;
            $_data["room_type"]=$list->room_type;
            $_data["room_types"]=$room_types;
            $_data["title"]=$value;
            $data[]=$_data;
        }
        header('Content-Type:application/json;charset=utf-8');
        echo json_encode($data,JSON_UNESCAPED_UNICODE);

        die();
    }
    /*
    行政区ID获取商圈列表
    */
    public function actionGetArea()
    {
        $district_id =Yii::app()->request->getParam("id");
        $select_id=Yii::app()->request->getParam("select_id");

        $criteria=new CDbCriteria;
        $criteria->addCondition("t.district_id ='$district_id'");
        $criteria->addCondition("deleted=0");
        $criteria->order='t.name';

        $list =BaseArea::model()->findAll($criteria);
        $data=[];
        foreach ($list as $key => $area) {
            $_data["id"]=$area->id;
            $_data["title"]=$area->name;
            if ($select_id && $area->id==$select_id){
                $_data["select"]="select";
            }
            else{
                $_data["select"]="";
            }
            $data[]=$_data;
        }

        header('Content-Type:application/json;charset=utf-8');
        echo json_encode($data,JSON_UNESCAPED_UNICODE);

        die();
    }

    /*
    商圈ID获取组团列表
    */
    public function actionGetGroup()
    {
        $area_id =Yii::app()->request->getParam("id");
        $select_id=Yii::app()->request->getParam("select_id");
        $criteria=new CDbCriteria;
        $criteria->addCondition("t.area_id ='$area_id'");
        $criteria->addCondition("deleted=0");
        $criteria->order='t.name';

        $list =BaseEstateGroup::model()->findAll($criteria);
        $data=[];
        foreach ($list as $key => $group) {
            $_data["id"]=$group->id;
            $_data["title"]=$group->name;
            if ($select_id && $group->id==$select_id){
                $_data["select"]="select";
            }
            else{
                $_data["select"]="";
            }
            $data[]=$_data;
        }

        header('Content-Type:application/json;charset=utf-8');
        echo json_encode($data,JSON_UNESCAPED_UNICODE);

        die();
    }

    /*
    组团ID获取品牌列表
    */
    public function actionGetEstate()
    {
        $estate_group_id =Yii::app()->request->getParam("id");
        $select_id=Yii::app()->request->getParam("select_id");

        $criteria=new CDbCriteria;
        $criteria->addCondition("t.estate_group_id ='$estate_group_id'");
        $criteria->addCondition("deleted=0");
        $criteria->order='t.name';

        $list =BaseEstate::model()->findAll($criteria);
        $data=[];
        foreach ($list as $key => $estate) {
            $_data["id"]=$estate->id;
            $_data["title"]=$estate->name;
            if ($select_id && $estate->id==$select_id){
                $_data["select"]="select";
            }
            else{
                $_data["select"]="";
            }
            $data[]=$_data;
        }

        header('Content-Type:application/json;charset=utf-8');
        echo json_encode($data,JSON_UNESCAPED_UNICODE);

        die();
    }

    /*
    品牌ID获取系列列表
    */
    public function actionGetBuilding()
    {
        $estate_id =Yii::app()->request->getParam("id");
        $select_id=Yii::app()->request->getParam("select_id");

        $criteria=new CDbCriteria;
        $criteria->addCondition("t.estate_id ='$estate_id'");
        $criteria->addCondition("deleted=0");
        $criteria->order='t.name';

        $list =BaseBuilding::model()->findAll($criteria);
        $data=[];
        foreach ($list as $key => $building) {
            $_data["id"]=$building->id;
            $_data["title"]=$building->name;
            if ($select_id && $building->id==$select_id){
                $_data["select"]="select";
            }
            else{
                $_data["select"]="";
            }
            $data[]=$_data;
        }

        header('Content-Type:application/json;charset=utf-8');
        echo json_encode($data,JSON_UNESCAPED_UNICODE);

        die();
    }
}

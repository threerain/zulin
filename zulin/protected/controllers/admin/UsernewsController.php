<?php

class UsernewsController extends BackgroundBaseController
{
    public $PAGE_LEVEL_STYLES = null ;
    public $PAGE_LEVEL_PLUGINS=null;
    public $PAGE_LEVEL_SCRIPTS=null;

    public $title='最新消息';

    public function actionIndex()
    {
        $uid = Yii::app()->session['admin_uid'];
        $news =Yii::app()->request->getParam("news");//消息 1=已读 2=未读 
        $news_type =Yii::app()->request->getParam("news_type");//消息类型
        $alert_error =Yii::app()->request->getParam("alert_error");//
        $keyword_signing_date1 =Yii::app()->request->getParam("keyword_signing_date1");//
        $keyword_signing_date2 =Yii::app()->request->getParam("keyword_signing_date2");//

        $pagesize=10;
        $condition = "1=1 and user_news_id = '$uid'";

  
        $modelnews = UserNews::model()->findall("  status=0  and user_news_id= '{$_SESSION['admin_uid']}'");
        foreach ($modelnews as $key => $value) {
            $value->status = 3;
            $value->save();
        }
      


        //开始时间
        if(!empty($keyword_signing_date1)){
            $keyword_signing_start = strtotime($keyword_signing_date1);
            $condition .= " and ctime >= '$keyword_signing_start' ";
        }
        //结束时间
        if(!empty($keyword_signing_date2)){
            $keyword_signing_end = strtotime($keyword_signing_date2);
            $condition .= " and ctime <= '$keyword_signing_end' ";
        }

        //消息条件 全部
        if(empty($news)){
            $condition .= " and status != 2";
        }
        //已读
        if($news == 1){
            $condition .= " and status = 1";
        }
        //未读
        if($news==2){
            $condition .= " and (status = 0 or status =3) ";
        }
        //消息类型
        if(!empty($news_type)){
            $condition .= " and news_type = '$news_type' ";
        }
        // var_dump($condition);die;
        
        
        $criteria=new CDbCriteria;
        $criteria->condition= $condition;
        $criteria->order='t.ctime DESC';
        $count = UserNews::model()->count($criteria);
        $pager=new CPagination($count);
        $pager->pageSize=$pagesize;
        $pager->applyLimit($criteria);
        $list =UserNews::model()->findAll($criteria);//需要列表
        // var_dump($list);die;
        // $list[0]['url'] = 11;
        // $unread_news =UserNews::model()->count("1=1 and uid = '$uid' and status = 0");//全部未读的消息条数
        // $all_news =UserNews::model()->count("1=1 and uid = '$uid' and status != 2 ");//全部消息条数
        // 消息类型多人消息提醒    2=公告 3=收购合同状态发生改变  4=添加收购合同 5=出车合同状态改变
        //  6=添加出车合同状态  7=添加销控 8= 移除销控  9=财务发布收款人是谁  10 = 已找到收款人是谁
        $arr= [
                '公告'=>['1101_09',2,'/admin/usernews?news_type=2','/admin/notice/detail?news_type=2'],
                '款项认领'=>['1101_01',9,'/admin/usernews?news_type=9','/admin/confirm/confirmlist?news_type=9'],
                '款项已被认领'=>['1101_02',10,'/admin/usernews?news_type=10','/admin/finance?news_type=10'],
                '收购合同新增'=>['1101_04',4,'/admin/usernews?news_type=4','/admin/purchasecontract?news_type=4'],
                '收购合同状态改变'=>['1101_03',3,'/admin/usernews?news_type=3','/admin/purchasecontract?news_type=3'],
                '出车合同新增'=>['1101_06',6,'/admin/usernews?news_type=6','/admin/salecontract?news_type=6'],
                '出车合同状态改变'=>['1101_05',5,'/admin/usernews?news_type=5','/admin/salecontract?news_type=5'],
                '销控新增'=>['1101_07',7,'/admin/usernews?news_type=7','/admin/salescontrol?news_type=7'],
                '销控移除'=>['1101_08',8,'/admin/usernews?news_type=8','/admin/ursproperty?news_type=8'],
            ];
        $news_list = [];
        if(AdminPositionModul::show_menu($uid,"消息提醒")){
            foreach ($arr as $key => $value) {
                if(AdminPositionModul::has_modul($value[0])) {

                    $news_list[$key]['unread'] =UserNews::model()->count("1=1 and user_news_id = '$uid' and news_type= '$value[1]' and (status = 0 or status = 3)");//全部未读的消息条数
                    $news_list[$key]['news'] =UserNews::model()->count("1=1 and user_news_id = '$uid' and news_type= '$value[1]' and status = 0 ");//不曾接触过的消息
                    $news_list[$key]['url'] =$value[2];//
                    $news_list[$key]['news_type'] = $value[1];//
                }
            }
        }
        $news_type_name = '';
        foreach ($arr as $key => $value) {
            if($news_type == $value[1]){
                $news_type_name = $key;
            }
        }
        // var_dump($arr);die;
        $this->render("index",array(
            'list'=>$list,//所有消息
            'news_list'=>$news_list,//所有类型的消息条数
            'news_type'=>$news_type,//消息类型
            'news_type_name'=>$news_type_name,//消息类型名字
            'news'=>$news,//传过来的消息 全部 未读
            'arr'=>$arr,//传过来的消息 全部 未读
            'alert_error'=>$alert_error,//
            'keyword_signing_date1'=>$keyword_signing_date1,
            'keyword_signing_date2'=>$keyword_signing_date2,
            'pages'=>$pager,
            
        ));
    }

    /**
     * 删除
     */
    public function actionDel(){
    	$referer= $_SERVER['HTTP_REFERER'];
        $ids =Yii::app()->request->getParam("ids");
        if(empty($ids)){
            $alert_error = 1;
            $this->redirect("/admin/usernews?alert_error=".$alert_error);
        }
        foreach ($ids as $key => $value) {
            $model = UserNews::model()->find("id='$value'");
            $model->status  = 2;
            if($model->save()){
                if(Yii::app()->request->isAjaxRequest){
                    $this->OutputJson(0,$model->errors,null);
                }
            }
        }
        $referer= str_replace(['alert_error'],['a'],$referer);
        $this->redirect($referer);
    }
    /**
     * 标记已读
     */
    public function actionSign(){
    	$referer= $_SERVER['HTTP_REFERER'];
        $ids =Yii::app()->request->getParam("ids");
        if(empty($ids)){
            $alert_error = 11;
            $this->redirect("/admin/usernews?alert_error=".$alert_error);
        }
        foreach ($ids as $key => $value) {
            $model = UserNews::model()->find("id='$value'");
            $model->status  = 1;
            if($model->save()){
                if(Yii::app()->request->isAjaxRequest){
                    $this->OutputJson(0,$model->errors,null);
                }
            }
        }
        $referer= str_replace(['alert_error'],['a'],$referer);
        $this->redirect($referer);
    }
}
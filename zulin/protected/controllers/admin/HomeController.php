<?php

class HomeController extends BackgroundBaseController
{
  	/**
  	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
  	 * using two-column layout. See 'protected/views/layouts/column2.php'.
  	 */
  	// public $layout='//layouts/backgroundcenter2';

  	public $title='首页';


  	/**
  	 * Lists all models.
  	 */
  	public function actionIndex()
  	{
  	    
      	$property = UrsSalesControl::model()->findAll(' deleted=0 order by t.ctime desc limit 30');

        $notice   = CmsNotice::model()->findAll('deleted = 0 and type =1  order by t.ctime desc limit 6'); 

        $yewu   = CmsNotice::model()->findAll('deleted = 0 and type =2  order by t.ctime desc limit 6'); 

        $warm   = CmsNotice::model()->find('deleted = 0 and type =3 order by t.ctime desc'); 

      	$this->render('index',array(
          'property'=>$property,
          'notice'=>$notice,
          'warm'=>$warm,
      		'yewu'=>$yewu,
      		));
  	}
    public function actionCheck()
    {
    		if (empty($_POST['time'])){
    		    exit();
    		}
        //多人可以操作的消息类型
        // $type = [0,1,2,3];
        //单人操作的消息类型
        // $usertype = [0,1,2,3,4,5,6,7,8,9,10];
        //单人操作消息提醒 若得到数据则马上返回数据给客服端，并结束本次请求 
        // foreach ($type as $key => $value) {
        //     $news['news'][$key]  = CmsNews::model()->count("news_type = '$value' and deleted = '0' ");
        //     if ( $news['news'][$key] > 0) {
        //         $modular = 1;
        //     }
        // } 

        //个人消息
        // foreach ($usertype as $key => $value) {
            // $news['usernews'][$key] = UserNews::model()->count("1=1 and user_news_id = '{$_SESSION['admin_uid']}' and status = '0'");
            $news = UserNews::model()->count("1=1 and user_news_id = '{$_SESSION['admin_uid']}' and status = '0'");
            // if ( $news['usernews'][$key] > 0) {
                // $modular = 1;
            // }
        // }
        echo json_encode($news);
        exit();
  	}
}
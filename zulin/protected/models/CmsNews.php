<?php

/**
 * This is the model class for table "cms_news".
 *
 * The followings are the available columns in table 'cms_news':
 * @property string $id
 * @property string $action_user_id
 * @property integer $news_type
 * @property string $news_content
 * @property integer $ctime
 * @property integer $deleted
 */
class CmsNews extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cms_news';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'required'),
			array('news_type, ctime, deleted', 'numerical', 'integerOnly'=>true),
			array('id, action_user_id, news_content', 'length', 'max'=>36),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, action_user_id, news_type, news_content, ctime, deleted', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'action_user_id' => '操作人ID',
			'news_type' => '消息类型 6= 收款人是谁',
			'news_content' => '消息内容',
			'ctime' => '创建时间',
			'deleted' => 'Deleted',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('action_user_id',$this->action_user_id,true);
		$criteria->compare('news_type',$this->news_type);
		$criteria->compare('news_content',$this->news_content,true);
		$criteria->compare('ctime',$this->ctime);
		$criteria->compare('deleted',$this->deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CmsNews the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	/**
	 * 多人操作的消息提醒添加
	 * $model_id  消息内容id
	 * $news_type 消息类型
	 */
	public static function news($model_id,$news_type)
	{


		//消息推送表
        $news = new CmsNews();
        $news->id = Guid::create_guid();
        $news->action_user_id = Yii::app()->session['admin_uid'];
        $news->news_type = $news_type;
        $news->ctime = time();
        $news->deleted = 0;
        $news->news_content = $model_id;
        if (!$news->save()){
            $this->result(0,$news->errors,null);
        }
	}
	/**
	 * 多人操作的消息提醒确认
	 * $id  消息内容id
	 */
	public static function newsConfirm($id)
    {
        CmsNews::model()->updateAll(array('deleted'=>'1'),'news_content=:pid;deleted = :del',array(':pid'=>$id,':del'=>0));
    }
    /**
	 * 多人操作的消息提醒删除
	 * $id  消息内容id
	 */
	public static function newsDel($id)
    {
        CmsNews::model()->updateAll(array('deleted'=>'2'),'news_content=:pid',array(':pid'=>$id));//删除
    }
	/**
	 * 单人操作的消息提醒添加
	 * 当$modul_id 权限id
	 * $model_id  消息内容id
	 * $news_type 消息类型
	 */
	public static function user_news($model_id,$news_type,$modul_id,$news_title)
	{
		//职务
		$AdminPositionModul =  AdminPositionModul::model()->findAll("modul_id = '$modul_id' and deleted = 0 ");
		if($AdminPositionModul){
		    $position_ids = '';
		    foreach ($AdminPositionModul as $key => $value) {
		        if ($key==0){
		            $position_ids.="'".$value->position_id."'";
		        }
		        else{
		            $position_ids.=","."'".$value->position_id."'";
		        }
		    }
		    $position_id_news = "deleted = 0 and  position_id in ($position_ids) ";
		}else{
		    $position_id_news = "deleted = 0 and  position_id in ('') ";
		}
		$user_news = AdminUser::model()->findAll("$position_id_news");
		$user_news_arr = [];
		foreach ($user_news as $key => $value) {
		    $user_news_arr[] = $value['id'];
		}
        //判断是什么类型的消息
        if(is_array($user_news_arr)){
        	foreach ($user_news_arr as $key => $value) {
				//消息推送表
		        $news = new UserNews();
		        $news->id = Guid::create_guid();
		        $news->action_user_id = Yii::app()->session['admin_uid'];
		        $news->news_type = $news_type;
		        $news->ctime = time();
		        $news->status = 0;
		        $news->news_content_id = $model_id;
		        $news->news_title = $news_title;
        	 	$news->user_news_id = $value;
		        if (!$news->save()){
		            $this->result(0,$news->errors,null);
		        }
        	} 
        }

	}
	/**
	 * 单人操作的消息提醒修改
	 * 当$modul_id 权限id
	 * $model_id  消息内容id
	 * $news_type 消息类型
	 */
	public static function user_news_edit($model_id,$news_type,$modul_id)
	{
        UserNews::model()->updateAll(array('status'=>'2'),'news_content_id = :pid;news_type = :news_type',array(':pid'=>$model_id,':news_type'=>$news_type));//删除
		//职务
		$AdminPositionModul =  AdminPositionModul::model()->findAll("modul_id = '$modul_id' and deleted = 0 ");
		if($AdminPositionModul){
		    $position_ids = '';
		    foreach ($AdminPositionModul as $key => $value) {
		        if ($key==0){
		            $position_ids.="'".$value->position_id."'";
		        }
		        else{
		            $position_ids.=","."'".$value->position_id."'";
		        }
		    }
		    $position_id_news = "deleted = 0 and  position_id in ($position_ids) ";
		}else{
		    $position_id_news = "deleted = 0 and  position_id in ('') ";
		}
		$user_news = AdminUser::model()->findAll("$position_id_news");
		$user_news_arr = [];
		foreach ($user_news as $key => $value) {
		    $user_news_arr[] = $value['id'];
		}

        //判断是什么类型的消息
        if(is_array($user_news_arr)){
        	foreach ($user_news_arr as $key => $value) {
				//消息推送表
		        $news = new UserNews();
		        $news->id = Guid::create_guid();
		        $news->action_user_id = Yii::app()->session['admin_uid'];
		        $news->news_type = $news_type;
		        $news->ctime = time();
		        $news->status = 0;
		        $news->news_content_id = $model_id;
        	 	$news->user_news_id = $value;
		        if (!$news->save()){
		            $this->result(0,$news->errors,null);
		        }
        	} 
        }
       
	}
	/**
	 * 单人操作的消息提醒确认
	 * $id  消息内容id
	 */
	public static function userConfirm($id,$news_type)
	{
		$user_news_id = Yii::app()->session['admin_uid'];
		UserNews::model()->updateAll(array('status'=>'1'),'news_content_id=:pid;status = :del;user_news_id = :news;news_type =:news_type',array(':pid'=>$id,':news_type'=>$news_type,':del'=>0,':news'=>$user_news_id));
	}
	/**
	 * 单人操作的消息提醒删除
	 * $id  消息内容id
	 * 是删除了单个人的消息提醒或者多人
	 */
	public static function userDel($id,$news_type)
    {
        UserNews::model()->updateAll(array('status'=>'2'),'news_content_id = :pid;news_type = :news_type',array(':pid'=>$id,':news_type'=>$news_type));//删除
        
    }

}

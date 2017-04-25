<?php

/**
 * This is the model class for table "message".
 *
 * The followings are the available columns in table 'message':
 * @property string $id
 * @property string $admin_uid
 * @property string $phone
 * @property string $content
 * @property integer $status
 * @property integer $ctime
 * @property integer $deleted
 */
class Message extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'message';
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
			array('status, ctime, deleted', 'numerical', 'integerOnly'=>true),
			array('id, admin_uid', 'length', 'max'=>36),
			array('phone', 'length', 'max'=>11),
			array('content', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, admin_uid, phone, content, status, ctime, deleted', 'safe', 'on'=>'search'),
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
			'admin_uid' => 'Admin Uid',
			'phone' => 'Phone',
			'content' => 'Content',
			'status' => 'Status',
			'ctime' => 'Ctime',
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
		$criteria->compare('admin_uid',$this->admin_uid,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('status',$this->status);
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
	 * @return Message the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * 发送短信
	 * $modul_id  权限id
	 * $content 内容
	 * 
	 */
	public  function sendmsg($modul_id,$content){
		// $phone = '13312120560';
		// $regRandomNum = $this->createRandomNum();
		$arr = $this->sendphone($modul_id);
		if($arr['aa'] == 1){
			$url = 'http://smsapi.c123.cn/OpenPlatform/OpenApi';           //接口地址
			$ac = '1001@501184600001';		                             //用户账号
			$authkey = 'F034DD13F25419E7086B2047D3E501AA';		         //认证密钥
			$cgid = '52';                                                 //通道组编号
			$c = $content.'。';		 //内容
			$m = $arr['phone'];	                                         //号码
			$csid = '';                //签名编号 ,可以为空时，使用系统默认的编号
			$t = '';                    //发送时间,可以为空表示立即发送,

			// 即时发送
			$status = $this->sendsms($url,$ac,$authkey,$cgid,$arr,$c,$csid,$t);
			return $status;

		}
	}
	public  function sendphone($modul_id){
		$position = AdminPositionModul::model()->findAll("modul_id = '$modul_id' and deleted = 0");
		foreach ($position as $key => $value) {
			$admin = AdminUser::model()->findAll("position_id = '{$value['position_id']}' and deleted = 0");
			foreach ($admin as $k => $v) {
				if($key == 0 && $k == 0){
					$phone .= $v['phone'];
				}else{
					$phone .= ','.$v['phone'];
				}
				if(!empty($v['phone'])){
					$aa = 1;
				}
				$admin_uid[] = $v['id'];

			}
		}
		$arr = ['admin_uid'=>$admin_uid,'phone'=>$phone,'aa'=>$aa];
		return $arr;
	}

	public function sendsms($url,$ac,$authkey,$cgid,$arr,$c,$csid,$t){
		$data = array(
			'action'=>'sendOnce',                                //发送类型 ，可以有sendOnce短信发送，sendBatch一对一发送，sendParam	动态参数短信接口
			'ac'=>$ac,					                         //用户账号
			'authkey'=>$authkey,	                             //认证密钥
			'cgid'=>$cgid,                                       //通道组编号
			'm'=>$arr['phone'],		                                     //号码,多个号码用逗号隔开
			'c'=>$c,
			// 'c'=>iconv('gbk','utf-8',$c),		                 //如果页面是gbk编码，则转成utf-8编码，如果是页面是utf-8编码，则不需要转码
			'csid'=>$csid,                                       //签名编号 ，可以为空，为空时使用系统默认的签名编号
			't'=>$t                                              //定时发送，为空时表示立即发送
			);
		$re = $this->postsms($url,$data);	                     //POST方式提交
		// $re = simplexml_load_string(utf8_encode($xml));
		preg_match_all('/result="(.*?)"/',$re,$res);

		if(trim($res[1][0]) == '1' ) { 
			foreach ($arr['admin_uid'] as $key => $value) {
				$message = new Message();
				$message->id = Guid::create_guid();
				$message ->admin_uid = $value;
				$message ->phone = AdminUser::model()->find("id = '$value'")['phone'];
				$message ->content = $c;
				$message ->status = 1;
				$message ->ctime = time();
				$message ->deleted = 0;
				$message->save();
			}
			return  true;
		}else{
			foreach ($arr['admin_id'] as $key => $value) {
				$message = new Message();
				$message->id = Guid::create_guid();
				$message ->admin_uid = $value;
				$message ->phone = AdminUser::model()->find("id = '$value'")['phone'];
				$message ->content = $c;
				$message ->status = trim($re['result']);
				$message ->ctime = time();
				$message ->deleted = 0;
				$message->save();
			}
			return false;
			//发送失败的返回值
			/*switch(trim($re['result'])){
				case 0: echo "帐户格式不正确(正确的格式为:员工编号@企业编号)";break; 
				case -1: echo "服务器拒绝(速度过快、限时或绑定IP不对等)如遇速度过快可延时再发";break;
				case -2: echo "密钥不正确";break;
				case -3: echo "密钥已锁定";break;
				case -4: echo "参数不正确(内容和号码不能为空，手机号码数过多，发送时间错误等)";break;
				case -5: echo "无此帐户";break;
				case -6: echo "帐户已锁定或已过期";break;
				case -7: echo "帐户未开启接口发送";break;
				case -8: echo "不可使用该通道组";break;
				case -9: echo "帐户余额不足";break;
				case -10: echo "内部错误";break;
				case -11: echo "扣费失败";break;
				default:break;
			}*/
		}
	}


	public function postsms($url,$data=''){
		$row = parse_url($url);
		// var_dump($row);die;
		$host = $row['host'];
		$port = isset($row['port']) ? $row['port']:80;
		$file = $row['path'];
		$post = "";
		while (list($k,$v) = each($data)){
			$post .= rawurlencode($k)."=".rawurlencode($v)."&";	//转URL标准码
		}
		$post = substr( $post , 0 , -1 );
		$len = strlen($post);
		$fp = @fsockopen( $host ,$port, $errno, $errstr, 10);
		if (!$fp) {
			return "$errstr ($errno)\n";
		} else {
			$receive = '';
			$out = "POST $file HTTP/1.0\r\n";
			$out .= "Host: $host\r\n";
			$out .= "Content-type: application/x-www-form-urlencoded\r\n";
			$out .= "Connection: Close\r\n";
			$out .= "Content-Length: $len\r\n\r\n";
			$out .= $post;		
			fwrite($fp, $out);
			while (!feof($fp)) {
				$receive .= fgets($fp, 128);
			}
			fclose($fp);
			$receive = explode("\r\n\r\n",$receive);
			unset($receive[0]);
			return implode("",$receive);
		}
	}
}

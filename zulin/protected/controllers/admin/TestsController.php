<?php



class TestsController extends BackgroundBaseController
{
    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        // echo 111;die;
        // var_dump($this);die;
        $pagesize =1000;
        // $keyword_ctime3 = strtotime('2016-12-5');
        // $keyword_ctime3s = strtotime('2017-1-5');
        $condition='';
        // $condition .= "ctime >= '$keyword_ctime3' ";
        // $condition .= " and ctime < '$keyword_ctime3s' ";
        // $condition .= " and actual_date != '' ";
        $condition .= "1=1 and deleted = 0 ";
        $criteriass=new CDbCriteria;
        $criteriass->condition= $condition;
        $criteriass->order='t.ctime DESC';
        $count = SerSellContract::model()->count($criteriass);
        // $count = SerPurContract::model()->count($criteriass);

        $pager=new CPagination($count);
        $pager->pageSize=$pagesize;
        $pager->applyLimit($criteriass);
        //最终信息
        $model =SerSellContract::model()->findAll($criteriass);
        // $model =SerPurContract::model()->findAll($criteriass);
        // foreach ($model as $key => $value) {
        //     $list[$key][] = date('Y-m-d',$value['ctime']);
        // }
        $list['a'][]= '生成列表时间';
        $list['a'][] = '来源';
        $list['a'][] = '实际交房/收房日期';
        foreach ($model as $key => $value) {
            if($value['source'] == 1){
                $list[$key][] = date('Y-m-d',$value['ctime']);
                $list[$key][] = '租户';
            }else{
                $list[$key][] = date('Y-m-d',$value['ctime']);
                $list[$key][] = '车主';
            }
            if($value['actual_date']){
                $list[$key][] = date('Y-m-d',$value['actual_date']);
            }
        }
        $excel = new Excel();
        $excel->download($list, '交房');
     
    }

}
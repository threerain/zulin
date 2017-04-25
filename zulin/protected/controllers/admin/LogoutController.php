<?php

class LogoutController extends Controller
{
    public function actionIndex(){
        unset(Yii::app()->session['admin_uid']);
        unset(Yii::app()->session['admin_uname']);
        // unset(Yii::app()->session['admin_perms']);
        // unset(Yii::app()->session['admin_truename']);
        // unset(Yii::app()->session['admin_avatar']);

        $this->redirect('/admin/index');
    }
}
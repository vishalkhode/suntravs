<?php

class AdminController extends Controller {

    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform below mentioned actions
                'actions' => array('logout','index','destination','ch_destinationstatus','ch_destination_sorder','ch_destination_sorder'),
                'users' => array('@'),
            ),
            array('allow', // allow all  user to perform below mentioned actions
                'actions' => array('login'),
                'users' => array('*'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionLogin() {
        $this->layout = 'login';
        $model = new TblUser;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['submit'])) {
            $username = $_REQUEST['Username'];
            $password = md5($_REQUEST['Password']);
            $model = TblUser::model()->findByAttributes(array('username' => $username, 'password' => $password));
            if ($model != "") {
//                session start here passing session variables id,name
                Yii::app()->user->id = $model->id;
                Yii::app()->user->name = $model->username;
                Yii::app()->session['full_name'] = $model->first_name.' '.$model->last_name;
                $this->redirect(Yii::app()->request->baseUrl . '/admin/index');
            }
        }

        $this->render('/admin/login', array('model' => $model));
    }

    
    public function getstatuschanged($data){
        
    $returndata='';
    if($data->status== "active"){
       $returndata .= '<a class="destination_status_active" href="'.Yii::app()->baseUrl . '/admin/ch_destinationstatus?id='. $data->id . '" onclick="return confirm(\'Are You Sure?\')"> <span style= "font-size:20px; color:green; " class="glyphicon glyphicon-ok-sign"> </span> </a>';
       
       
       }else{
           
       $returndata .= '<a class="destination_status_inactive" href="'.Yii::app()->baseUrl . '/admin/ch_destinationstatus?id='. $data->id . '" onclick="return confirm(\'Are You Sure?\')" > <span style= "font-size:20px; color:red; " class="glyphicon glyphicon-info-sign"> </span> </a>';
}
        
    return $returndata;
    }
    
    public function actionCh_destinationstatus($id){
        
        $model = TblDestination::model()->findByPk($id);
        $model->status = ($model->status == 'active') ? 'inactive' : 'active';
        if ($model->update()) {
            $this->redirect(Yii::app()->request->baseUrl . '/admin/destination');
        }
        
        
    }
    
     public function getDestination_SortOrder($data) {
        $string = '<div><a href="' . $this->createUrl('/admin/ch_destination_sorder?id=' . $data->id . '&sort=up&sort_order=' . $data->sort_order) . '" class="ch_sort_order" title="Sort Up" id="' . $data->id . '" sort="up"><span class="glyphicon glyphicon-chevron-up"></span></a>'
                . '<a href="' . $this->createUrl('/admin/ch_destination_sorder?id=' . $data->id . '&sort=down&sort_order=' . $data->sort_order) . '" class="ch_sort_order" title="Sort Down" id="' . $data->id . '" sort="down"><span class="glyphicon glyphicon-chevron-down"></span></a>';
        $string .= CHtml::activeNumberField($data, 'sort_order', array('max' => 1000, 'class' => 'ed_sort_order', 'style' => 'display: none', 'edit_sort_id' => $data->id));
        $string .= '</div>';
        return $string;
    }
    
    public function actionCh_destination_sorder() {
        $pk = $_REQUEST['id'];
        $sort = $_REQUEST['sort'];
        $sort_order = $_REQUEST['sort_order'];
        $criteria = New CDbCriteria;
        if ($sort == 'up') {
            $criteria->condition = 'sort_order < ' . $sort_order;
            $criteria->order = 'sort_order desc';
        } else {
            $criteria->condition = 'sort_order > ' . $sort_order;
            $criteria->order = 'sort_order';
        }
        $criteria->limit = 1;
        $aboveBelowShowcaseModel = TblDestination::model()->find($criteria);
        if (count($aboveBelowShowcaseModel)) {
            $model = TblDestination::model()->findByPk($pk);
            $model->sort_order = $aboveBelowShowcaseModel->sort_order;
            $aboveBelowShowcaseModel->sort_order = $model->sort_order;
            if ($model->save(false)) {
                TblDestination::model()->updateByPk($aboveBelowShowcaseModel->id, array('sort_order' => $sort_order));
            }
        }
        $this->redirect($this->createUrl('/admin/destination'));
    }

    public function actionLogout() {

        Yii::app()->user->logout();
        unset(Yii::app()->session['userid']);

        Yii::app()->session->destroy();

        $this->redirect(Yii::app()->homeUrl);
    }
    
    public function actionDestination() {
        
        //$model= new TblDestination;
        $model = TblDestination::model()->findAll();
        
        $this->render('destination_list',array('model'=> $model));
    }

public function actionIndex() {

    
    
    $this->render('/admin/index');
    
    }
    
    
    
    
    }

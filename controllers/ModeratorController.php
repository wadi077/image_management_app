<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\ImageUpload;
use yii\web\UploadedFile;
use yii\helpers\Url;
use yii\helpers\Html;

class ModeratorController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	if(Yii::$app->user->isGuest){
            \Yii::$app->getResponse()->redirect(\Yii::$app->getUser()->loginUrl);
        }
    	
    	if(Yii::$app->user->identity['type'])
        {
            return $this->redirect(['uploader/index']);
        }

        $model = User::find()->where(['type' => 1])->all();
        
        $users = array();
        
        foreach ($model as $user)
        {
            $userNew = array();

            $pCount = count(ImageUpload::find()->where(['user_id' => $user->id])->andWhere(['status' => 0])->all());
            $aCount = count(ImageUpload::find()->where(['user_id' => $user->id])->andWhere(['status' => 1])->all());
            $rCount = count(ImageUpload::find()->where(['user_id' => $user->id])->andWhere(['status' => 2])->all());

            $userNew['id'] = $user->id;
            $userNew['username'] = $user->username;
            $userNew['pCount'] = $pCount;
            $userNew['aCount'] = $aCount;
            $userNew['rCount'] = $rCount;
            array_push($users, $userNew);
        }

        return $this->render('index', ['users' => $users]);
    }


    public function actionManage($id, $username)
    {
        if(Yii::$app->user->isGuest){
            \Yii::$app->getResponse()->redirect(\Yii::$app->getUser()->loginUrl);
        }
        
        if(Yii::$app->user->identity['type'])
        {
            return $this->redirect(['uploader/index']);
        }

        $model = ImageUpload::find()->where(['user_id' => $id])->all();

        $content1 = '';$count1 =0;
        $content2 = '';$count2 =0;
        $content3 = '';$count3 =0;
        foreach ($model as $img){
            if($img->status == 0)
            {
                $content1 .= '<div class="imgContainer" style="display: inline-block"><div><img src="uploads/thumbs/'.$img->name.'" style="min-width:110px;min-height:180px;width:110px;height:180px;border: 1px solid #ddd;border-radius: 4px;padding: 5px;width: 150px;margin-right:10px;margin-bottom:10px"></div><div class="imgButton" style="text-align:center">
    <span>'.Html::a('Approve', ['approve', 'id' =>$img->id, 'userid' => $id, 'username' => $username], ['class' => 'label label-success']) .'</span> | 
    <span>'.Html::a('Reject', ['reject', 'id' =>$img->id, 'userid' => $id, 'username' => $username], ['class' => 'label label-danger']) .'</span></div></div>
  ';
                $count1++;
            }else if($img->status == 1){
                $content2 .= '<img src="uploads/thumbs/'.$img->name.'" style="min-width:110px;min-height:180px;width:110px;height:180px;border: 1px solid #ddd;border-radius: 4px;padding: 5px;width: 150px;margin-right:10px;margin-bottom:10px">';
                $count2++;
            }else if($img->status){
                $content3 .= '<img src="uploads/thumbs/'.$img->name.'" style="min-width:110px;min-height:180px;width:110px;height:180px;border: 1px solid #ddd;border-radius: 4px;padding: 5px;width: 150px;margin-right:10px;margin-bottom:10px">';
                $count3++;
            }
            
        }

        return $this->render('manage', ['pImg' => $content1, 'pCount' => $count1, 'aImg' => $content2, 'aCount' => $count2, 'rImg' => $content3, 'rCount' => $count3, 'username' => $username]);
    }

    public function actionApprove($id, $userid, $username)
    {
        $imgUpdate = ImageUpload::findOne($id);
        $imgUpdate->status = 1;

        if($imgUpdate->save())
        {
            Yii::$app->getSession()->setFlash('message', 'Image Approved Successfuly');
            return $this->redirect(['manage', 'id' => $userid, 'username' => $username]);
        }else{
            Yii::$app->getSession()->setFlash('message', 'Failed to Approve Image, Please Try Again.');
            return $this->redirect(['manage', 'id' => $userid, 'username' => $username]);
        }
    }

    public function actionReject($id, $userid, $username)
    {
        $imgUpdate = ImageUpload::findOne($id);
        $imgUpdate->status = 2;

        if($imgUpdate->save())
        {
            Yii::$app->getSession()->setFlash('message', 'Image Rejected Successfuly');
            return $this->redirect(['manage', 'id' => $userid, 'username' => $username]);
        }else{
            Yii::$app->getSession()->setFlash('message', 'Failed to Reject Image, Please Try Again.');
            return $this->redirect(['manage', 'id' => $userid, 'username' => $username]);
        }
    }

}

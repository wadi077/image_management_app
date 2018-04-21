<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\ImageUpload;
use yii\web\UploadedFile;

class UploaderController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	if(Yii::$app->user->isGuest){
            \Yii::$app->getResponse()->redirect(\Yii::$app->getUser()->loginUrl);
        }

    	if(!Yii::$app->user->identity['type'])
        {
            return $this->redirect(['moderator/index']);
        }

        $model = ImageUpload::find()->where(['user_id' => Yii::$app->user->identity['id']])->all();

		$content1 = '';$count1 =0;
		$content2 = '';$count2 =0;
		$content3 = '';$count3 =0;
        foreach ($model as $img){
        	if($img->status == 0)
        	{
        		$content1 .= '<img src="uploads/thumbs/'.$img->name.'" style="min-width:110px;min-height:180px;width:110px;height:180px;border: 1px solid #ddd;border-radius: 4px;padding: 5px;width: 150px;margin-right:10px;margin-bottom:10px">';
        		$count1++;
        	}else if($img->status == 1){
        		$content2 .= '<img src="uploads/thumbs/'.$img->name.'" style="min-width:110px;min-height:180px;width:110px;height:180px;border: 1px solid #ddd;border-radius: 4px;padding: 5px;width: 150px;margin-right:10px;margin-bottom:10px">';
        		$count2++;
        	}else if($img->status){
        		$content3 .= '<img src="uploads/thumbs/'.$img->name.'" style="min-width:110px;min-height:180px;width:110px;height:180px;border: 1px solid #ddd;border-radius: 4px;padding: 5px;width: 150px;margin-right:10px;margin-bottom:10px">';
        		$count3++;
        	}
        	
        }

        return $this->render('index', ['pImg' => $content1, 'pCount' => $count1, 'aImg' => $content2, 'aCount' => $count2, 'rImg' => $content3, 'rCount' => $count3]);
    }

    public function actionUpload()
    {
        $model = new ImageUpload();

        if($model->load(Yii::$app->request->post())){

        	$model->name = UploadedFile::getInstance($model, 'name');
        	$model->user_id = Yii::$app->user->identity['id'];
        	$model->status = 0;

        	$hashName = $model->upload();

        	if($hashName !== false)
        	{
        		$model->name = $hashName;
        		$model->save();
        		Yii::$app->getSession()->setFlash('message', 'Image Uploaded Successfuly.');
        		return $this->redirect(['index']);
        	}else
        	{
        		Yii::$app->getSession()->setFlash('message', 'Failed Uploaded Image, Please Try Again.');
        	}
        }
       
        return $this->render('upload', ['model' => $model]);
    }

}

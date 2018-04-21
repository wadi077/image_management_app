<?php

use kartik\tabs\TabsX;
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */

$content1 = 'No Pending Image Found';
if($pImg != ''){
    $content1 = $pImg;
}
$content2 = 'No Approved Image Found'; 
if($aImg != ''){
    $content2 = $aImg;
}
$content3 = 'No Rejected Image Found';
if($rImg != ''){
    $content3 = $rImg;
}
 
$items = [
    [
        'label'=>'<i class="glyphicon glyphicon-dashboard"></i> Pending ('.$pCount.')',
        'content'=>$content1,
        'active'=>true
    ],
    [
        'label'=>'<i class="glyphicon glyphicon-ok"></i> Approved ('.$aCount.')',
        'content'=>$content2
    ],
    [
        'label'=>'<i class="glyphicon glyphicon-remove"></i> Rejected ('.$rCount.')',
        'content'=>$content3
    ],
];


$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <h1>Manage (<?=$username;?>) User Content</h1><br>
        </div>
        <div class='row'>
            <?php if(Yii::$app->session->hasFlash('message')):?>
                <div class="alert alert-dismissible alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo Yii::$app->session->getFlash('message');?>
                </div>
                
            <?php endIf;?>
        </div>
        <div class="row">
            <?= Html::a('Go Back', ['index'], ['class' => 'btn btn-primary']);?>
        </div>
        <div class="row">
            <br><br>
            <?php
                // Ajax Tabs Above
                echo TabsX::widget([
                    'items'=>$items,
                    'position'=>TabsX::POS_ABOVE,
                    'encodeLabels'=>false
                ]);
            ?>
        </div>

    </div>
</div>
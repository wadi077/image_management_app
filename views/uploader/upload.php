<?php

//use yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\UploadedFile;
//use ReflectionException;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';

?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Upload New Image</h1>
    </div>
    <div class="body-content">
    	<div class='row'>
    		<?php if(Yii::$app->session->hasFlash('message')):?>
    			<div class="alert alert-dismissible alert-danger">
    				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  					<?php echo Yii::$app->session->getFlash('message');?>
				</div>
				
			<?php endIf;?>
    	</div>
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
            <div class="row">
                <div class='form-group'>
                    <div class='col-lg-6'>
                        <?= $form->field($model, 'name')->fileInput() ?>
                    </div>
                    <?php
                        echo $model->name;
                        if($model->name){
                            echo "string";
                        }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class='form-group'>
                    <div class='col-lg-1'>
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                    </div>
                    <div class='col-lg-1'>
                        <?= Html::a('Back', ['index'], ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

<?php

use kartik\tabs\TabsX;
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Moderator';
?>
<div class="site-index">
    <div class="jumbotron">
        <h1>Moderator Content</h1>
    </div>
    <div class="body-content">
        <br>
        <div class="row">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">User Name</th>
                  <th scope="col">Pending Image</th>
                  <th scope="col">Approved Image</th>
                  <th scope="col">Rejected Image</th>
                  <th scope="col">Manage User</th>
                </tr>
              </thead>
              <tbody>
                <?php if(count($users) > 0): ?>
                    <?php foreach ($users as $user): ?>
                        <tr class="table-active" style='cursor: pointer;'>
                          <td><?php echo $user['username']; ?></td>
                          <td><?php echo $user['pCount']; ?></td>
                          <td><?php echo $user['aCount']; ?></td>
                          <td><?php echo $user['rCount']; ?></td>
                          <td>
                              <span><?= Html::a('Manage', ['manage', 'id' =>$user['id'], 'username' => $user['username']], ['class' => 'btn btn-primary btn-sm']) ?></span>
                          </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else:?>
                <tr class="table-active">
                    <td>No Data Found.</td>
                </tr>
                <?php endif;?>
              </tbody>
            </table> 
        </div>

    </div>
</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Proposal */

$this->title = 'Создать заявку';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proposal-create">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <h4><?=$custom_message; ?></h4>
        
</div>

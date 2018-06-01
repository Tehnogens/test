<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Proposals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proposal-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'thema',
            ['attribute' => 'text', 
                'value' => function($data){ 
                    return \yii\helpers\StringHelper::truncate($data->text, 50);
                },
                    
            ],
            'client_name',
            'email:email',
            //'file_name',
            //'created_at',
            ['attribute' => 'Статус', 
                'format' => 'html',
                'filter' => '-',
                'value' => function($model){ 
                                if($model->status == 0){return '<span class="text-red">Не прочитано</span>'; } 
                                else if($model->status == 1){return '<span class="text-green">Прочитано</span>';} }
             ],

            [
                'class' => 'yii\grid\ActionColumn',                
                'headerOptions' => ['width' => '80'],
                'template' => '{view} ',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

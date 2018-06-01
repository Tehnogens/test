<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Proposal */

$this->title = $model->email;
$this->params['breadcrumbs'][] = ['label' => 'Proposals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proposal-view">


    <p>
        <?= Html::a('Прочитать', ['update', 'id' => $model->id], [
            'class' => 'btn btn-primary',
            'data' => [
                'confirm' => 'Прочитать сообщение?',
                'method' => 'post',
            ],
            ]) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'thema',
            'text:ntext',
            'client_name',
            'email:email',
            
            [
                'label' => 'Картинка',
                'format' => 'raw',
                'value' => function($data){
                    return Html::a(Html::img('../../../frontend/web/upload/'.$data->file_name,[
                        'alt'=>'картинка',
                        'style' => 'width:100px;'
                    ]), '../../../frontend/web/upload/'.$data->file_name, ['target' => '_blank']);
                },
            ],            
            [
                'attribute'=>'created_at',
                'format' =>  ['date', 'Y-m-d в H:i'], 
                'headerOptions' => ['width' => '200'],
            ],
            ['attribute' => 'Статус', 
                'format' => 'html',
                'filter' => '-',
                'value' => function($model){ 
                                if($model->status == 0){return '<span class="text-red">Не прочитано</span>'; } 
                                else if($model->status == 1){return '<span class="text-green">Прочитано</span>';} }
             ],
        ],
    ]) ?>

</div>

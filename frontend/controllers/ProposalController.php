<?php

namespace frontend\controllers;

use Yii;
use common\models\Proposal;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ProposalController implements the CRUD actions for Proposal model.
 */
class ProposalController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
                'access' => [
                'class' => AccessControl::className(),
                'rules' => [                    
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['@'],                        
                    ],
                ],
                
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    

    /**
     * Creates a new Proposal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Proposal();
        $custom_message = '';
        if ($model->load(Yii::$app->request->post()) ) {
            
            $proposal = $model->getProposalByEmail();
            if($proposal->created_at + 86400 > strtotime('now')){
                $custom_message = 'Вы можете оставить заявку только раз в сутки';                
            }
            else{
                if( $model->save(false)) { 
                    $custom_message = 'Ваша заявка отправлена';
                }             
            }
        }

        return $this->render('create', [
            'model' => $model,
            'custom_message' => $custom_message,
        ]);
    }

    
    /**
     * Finds the Proposal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Proposal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Proposal::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

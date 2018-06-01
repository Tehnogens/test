<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "proposal".
 *
 * @property int $id
 * @property string $thema
 * @property string $text
 * @property string $client_name
 * @property string $email
 * @property string $file_name
 * @property int $created_at
 * @property int $status
 */
class Proposal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    
    public $file;
    /*public $file_name;
    public $created_at;
    public $status;*/


    public static function tableName()
    {
        return 'proposal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
                
            [['thema', 'text'], 'required'],
            [['text'], 'string'],
            [['file'], 'image', 'skipOnEmpty' => false, 'extensions' => 'jpg, gif, png'],            
        ];
    }
    
    
    public function beforeSave($insert) 
    { 
        $img = \yii\web\UploadedFile::getInstance($this, 'file'); 
        if( $img ){
            $img_name          = strtotime('now') . '_' . Yii::$app->getSecurity()->generateRandomString(15) . '.' . $img->extension;
            $this->file        = $img;                        
            $this->file_name   = $img_name;            
            $this->email       = Yii::$app->user->identity->email;      
            $this->created_at  = strtotime('now');
            $this->client_name = Yii::$app->user->identity->username;
                                    
            $img->saveAs('upload/' . $img_name);                      
        }        
        return parent::beforeSave($insert);
    }
    public function afterSave($insert, $changedAttributes) {
        
        
        
        parent::afterSave($insert, $changedAttributes);
    }
    public function getProposalByEmail()
    {
        if (($model = $this->find()
                ->where(['email' => Yii::$app->user->identity->email])
                ->orderBy(['id' => SORT_DESC])
                ->one()) !== null) {
            return $model;
        }
    }
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom(['info@domainname.com' => 'Новая заявка'])
            ->setSubject($this->thema)
            ->setTextBody($this->text)
            ->attach('upload/'.$this->file_name)
            ->send();
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'thema' => 'Тема',
            'text' => 'Текст сообщения',
            'client_name' => 'Ваше имя',
            'email' => 'Ваш email',
            'file_name' => 'Имя файла',
            'created_at' => 'Created At',
            'status' => 'Status',
            'file'     => 'Файл',
        ];
    }
}

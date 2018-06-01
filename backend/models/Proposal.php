<?php

namespace backend\models;

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
            [['thema', 'text', 'client_name', 'email', 'file_name', 'created_at'], 'required'],
            [['text'], 'string'],
            [['created_at', 'status'], 'integer'],
            [['thema', 'client_name', 'email'], 'string', 'max' => 255],
            [['file_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'thema' => 'Тема',
            'text' => 'Текст',
            'client_name' => 'Имя пользователя',
            'email' => 'Email',
            'file_name' => 'Имя файла',
            'created_at' => 'Создан',
            'status' => 'Status',
        ];
    }
}

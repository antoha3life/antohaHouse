<?php

namespace app\forms;

use Yii;
use yii\base\Model;

/**
 * Contact form.
 */
class ContactForm extends Model
{
    public $name;

    public $email;

    public $subject;

    public $body;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'subject', 'body'], 'required'],
            ['email', 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name'    => Yii::t(ROUTE, 'Your name'),
            'email'   => Yii::t(ROUTE, 'Your email'),
            'subject' => Yii::t(ROUTE, 'Subject'),
            'body'    => Yii::t(ROUTE, 'Body'),
        ];
    }

    /**
     * Sends an email to the specified email address.
     * @param string $email
     * @return bool
     */
    public function contact($email)
    {
        if ($this->validate()) {
            Yii::$app
                ->mailer
                ->compose()
                ->setTo($email)
                ->setFrom([$this->email => $this->name])
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->send();
            return true;
        }
        return false;
    }
}

<?php
namespace backend\services;

use backend\models\QinlianRegister;

class QinlianRegisterService extends QinlianRegister{

    public function getCount()
    {
        $QinlianRegister = new QinlianRegister();
        $count = (new \yii\db\Query())
            ->from($QinlianRegister::tableName())
            ->count();
        return $count;
    }
}

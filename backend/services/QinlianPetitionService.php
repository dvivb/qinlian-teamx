<?php
namespace backend\services;

use backend\models\QinlianPetition;

class QinlianPetitionService extends QinlianPetition{

    public function getCount()
    {
        $QinlianPetition = new QinlianPetition();
        $count = (new \yii\db\Query())
            ->from($QinlianPetition::tableName())
            ->count();
        return $count;
    }

   
}

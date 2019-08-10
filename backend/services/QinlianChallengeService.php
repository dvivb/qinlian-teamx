<?php
namespace backend\services;

use backend\models\QinlianChallenge;

class QinlianChallengeService extends QinlianChallenge{

    public function getCount()
    {
        $QinlianChallenge = new QinlianChallenge();
        $count = (new \yii\db\Query())
            ->from($QinlianChallenge::tableName())
            ->count();
        return $count;
    }
}

<?php
namespace backend\services;

use backend\models\QinlianThread;

class QinlianThreadService extends QinlianThread{

    public function getCount()
    {
        $QinlianThread = new QinlianThread();
        $count = (new \yii\db\Query())
            ->from($QinlianThread::tableName())
            ->count();
        return $count;
    }
}

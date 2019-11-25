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

    public function getStat($condition = null)
    {
        $params = [];
        $sql = "SELECT superiors_assigned,
        DATE_FORMAT(create_date, '%Y-%m' ) as yearmonth,
        count(id) as count_total
        FROM qinlian_thread
        WHERE 1=1";

        if (!empty($condition["is_nuit"])) {
            $sql .= " and is_nuit = :is_nuit";
            $params[":is_nuit"] = $condition["is_nuit"];
        }

        if (!empty($condition["is_supervises_object"])) {
            $sql .= " and is_supervises_object = :is_supervises_object";
            $params[":is_supervises_object"] = $condition["is_supervises_object"];
        }

        if (!empty($condition["disciplinary_offence"])) {
            $sql .= " and disciplinary_offence = :disciplinary_offence";
            $params[":disciplinary_offence"] = $condition["disciplinary_offence"];
        }


        if (!empty($condition["superiors_assigned"])) {
            $sql .= " and superiors_assigned = :superiors_assigned";
            $params[":superiors_assigned"] = $condition["superiors_assigned"];
        }

        if (!empty($condition["acceptance_time"])) {
            $sql .= " and acceptance_time = :acceptance_time";
            $params[":acceptance_time"] = $condition["acceptance_time"];
        }

//        if (!empty($condition["start_time"]) && !empty($condition["end_time"])) {
//            $sql .= " and create_date between :start_time and :end_time";
//            $params[":start_time"]  = $condition["start_time"] . '-01';
//            $params[":end_time"]    = $condition["end_time"] . '-01';
//        }
        $sql .= " and superiors_assigned is not null";

        $group_sql = $sql;
        $group_sql .= " group by superiors_assigned order by superiors_assigned";

        $category_sql = $sql;
        $category_sql .= " group by yearmonth order by yearmonth";

        $all_data_sql = $sql;
        $all_data_sql .= " group by superiors_assigned,yearmonth order by superiors_assigned";

        $query['group'] = \Yii::$app->db->createCommand($group_sql)
            ->bindValues($params)
            ->queryAll();

        $query['category'] = \Yii::$app->db->createCommand($category_sql)
            ->bindValues($params)
            ->queryAll();

        $query['all_data'] = \Yii::$app->db->createCommand($all_data_sql)
            ->bindValues($params)
            ->queryAll();

//        echo $query->getRawSql();die;
        return $query;
    }
}

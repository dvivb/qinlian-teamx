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

    public function getStat($condition = null)
    {
        $params = [];
        $sql = "SELECT progress_case,
        DATE_FORMAT(create_date, '%Y-%m' ) as yearmonth,
        count(id) as count_total
        FROM qinlian_challenge
        WHERE 1=1";

        if (!empty($condition["clue_level"])) {
            $sql .= " and clue_level = :clue_level";
            $params[":clue_level"] = $condition["clue_level"];
        }

        if (!empty($condition["clue_category"])) {
            $sql .= " and clue_category = :clue_category";
            $params[":clue_category"] = $condition["clue_category"];
        }

        if (!empty($condition["progress_case"])) {
            $sql .= " and progress_case = :progress_case";
            $params[":progress_case"] = $condition["progress_case"];
        }


        if (!empty($condition["duty_job"])) {
            $sql .= " and duty_job = :duty_job";
            $params[":duty_job"] = $condition["duty_job"];
        }

        if (!empty($condition["incoming_time"])) {
            $sql .= " and incoming_time = :incoming_time";
            $params[":incoming_time"] = $condition["incoming_time"];
        }

        if (!empty($condition["start_time"]) && !empty($condition["end_time"])) {
            $sql .= " and create_date between :start_time and :end_time";
            $params[":start_time"]  = $condition["start_time"] . '-01';
            $params[":end_time"]    = $condition["end_time"] . '-01';
        }
        $sql .= " and progress_case is not null";

        $group_sql = $sql;
        $group_sql .= " group by progress_case order by progress_case";

        $category_sql = $sql;
        $category_sql .= " group by yearmonth order by yearmonth";

        $all_data_sql = $sql;
        $all_data_sql .= " group by progress_case,yearmonth order by progress_case";

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

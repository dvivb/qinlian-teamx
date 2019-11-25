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

    public function getStat($condition = null)
    {
        $params = [];
        $sql = "SELECT host_department,
        DATE_FORMAT(create_date, '%Y-%m' ) as yearmonth,
        count(id) as count_total
        FROM qinlian_petition
        WHERE 1=1";

        if (!empty($condition["political_appearance"])) {
            $sql .= " and political_appearance = :political_appearance";
            $params[":political_appearance"] = $condition["political_appearance"];
        }

        if (!empty($condition["duty_job"])) {
            $sql .= " and duty_job = :duty_job";
            $params[":duty_job"] = $condition["duty_job"];
        }

        if (!empty($condition["rank_job"])) {
            $sql .= " and rank_job = :rank_job";
            $params[":rank_job"] = $condition["rank_job"];
        }

        if (!empty($condition["host_department"])) {
            $sql .= " and host_department = :host_department";
            $params[":host_department"] = $condition["host_department"];
        }

        if (!empty($condition["start_time"]) && !empty($condition["end_time"])) {
            $sql .= " and create_date between :start_time and :end_time";
            $params[":start_time"]  = $condition["start_time"] . '-01';
            $params[":end_time"]    = $condition["end_time"] . '-01';
        }
        $sql .= " and host_department is not null";

        $group_sql = $sql;
        $group_sql .= " group by host_department order by host_department";

        $category_sql = $sql;
        $category_sql .= " group by yearmonth order by yearmonth";

        $all_data_sql = $sql;
        $all_data_sql .= " group by host_department,yearmonth order by host_department";

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

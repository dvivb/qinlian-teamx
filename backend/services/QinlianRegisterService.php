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

    public function getStat($condition = null)
    {
        $params = [];
        $sql = "SELECT department_charge,
        DATE_FORMAT(create_date, '%Y-%m' ) as yearmonth,
        count(id) as count_total
        FROM qinlian_register
        WHERE 1=1";

        if (!empty($condition["is_discipline_transfer"])) {
            $sql .= " and is_discipline_transfer = :is_discipline_transfer";
            $params[":is_discipline_transfer"] = $condition["is_discipline_transfer"];
        }

        if (!empty($condition["is_supervises_object"])) {
            $sql .= " and is_supervises_object = :is_supervises_object";
            $params[":is_supervises_object"] = $condition["is_supervises_object"];
        }

        if (!empty($condition["disciplinary_offence"])) {
            $sql .= " and disciplinary_offence = :disciplinary_offence";
            $params[":disciplinary_offence"] = $condition["disciplinary_offence"];
        }

        if (!empty($condition["department_charge"])) {
            $sql .= " and department_charge = :department_charge";
            $params[":department_charge"] = $condition["department_charge"];
        }

        if (!empty($condition["duty_job"])) {
            $sql .= " and duty_job = :duty_job";
            $params[":duty_job"] = $condition["duty_job"];
        }

        if (!empty($condition["academic"])) {
            $sql .= " and academic = :academic";
            $params[":academic"] = $condition["academic"];
        }

        if (!empty($condition["start_time"]) && !empty($condition["end_time"])) {
            $sql .= " and create_date between :start_time and :end_time";
            $params[":start_time"]  = $condition["start_time"] . '-01';
            $params[":end_time"]    = $condition["end_time"] . '-01';
        }
        $sql .= " and department_charge is not null";

        $group_sql = $sql;
        $group_sql .= " group by department_charge order by department_charge";

        $category_sql = $sql;
        $category_sql .= " group by yearmonth order by yearmonth";

        $all_data_sql = $sql;
        $all_data_sql .= " group by department_charge,yearmonth order by department_charge";

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

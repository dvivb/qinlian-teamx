<?php

namespace console\controllers;

use Yii;

class SurveyController extends \yii\console\Controller
{
    /**
     * @param $sql
     * @return mixed
     */
    private static function _query($sql)
    {
        return Yii::$app->db_survey->createCommand($sql)->queryAll();
    }

    /**
     * @desc    Select Fillblank batchInsert  soldier_record
     * @param $id
     */
    public function actionFillblank($id="ff808081638c49950163f4589c9d033f")
    {
        $sql = "SELECT
                    an_f.belong_answer_id,
                    an_f.answer,
                    q.id,
                    q.qu_title
                FROM t_an_fillblank AS an_f
                LEFT JOIN t_question AS q ON q.id = an_f.qu_id
                WHERE an_f.visibility = 1 AND q.answer_input_row = 1 AND an_f.belong_id = '$id'";
        $req = self::_query($sql);

        $var = '';
        foreach ($req as $key=>$value){
            if($value["belong_answer_id"]){
                $var[$value["belong_answer_id"]][] = $value["answer"];
            }
        }

        $data = "";
        foreach ($var as $value){
            $data[] = $value;
        }

        $field = ['name', 'moblie', 'address', 'birthday', 'idcard', 'report_time'];
        $sql = Yii::$app->db->createCommand()->batchInsert('soldier_record', $field, $data)
            ->getRawSql();
//            ->execute();

        $sql .= " ON DUPLICATE KEY UPDATE name = VALUES(name)";
        $query = Yii::$app->db->createCommand($sql)->query();

        echo ":) Successful";
    }
}

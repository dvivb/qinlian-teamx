<?php
namespace backend\services;

use backend\models\SoldierRecord;

class SoldierRecordService extends SoldierRecord{

   public static function getCount()
   {
//       $sql = "SELECT
//                COUNT(id) AS count_all,
//                SUM(IF(sex =1 , 1, 0)) AS sex_1,
//                SUM(IF(sex =2 , 1, 0)) AS sex_2,
//                SUM(IF(train_status =0 , 1, 0)) AS train_status_0,
//                SUM(IF(train_status =1 , 1, 0)) AS train_status_1,
//                SUM(IF(train_status =2 , 1, 0)) AS train_status_2,
//                SUM(IF(job_status =0 , 1, 0)) AS job_status_0,
//                SUM(IF(job_status =1 , 1, 0)) AS job_status_1,
//                SUM(IF(check_status =0 , 1, 0)) AS check_status_0,
//                SUM(IF(check_status =1 , 1, 0)) AS check_status_1,
//                SUM(IF(create_date = DATE(NOW()) , 1, 0)) AS new_count
//                FROM soldier_record";

       $sql = "SELECT 
                COUNT(id) AS 总数,
                SUM(IF(sex =1 , 1, 0)) AS 男,
                SUM(IF(sex =2 , 1, 0)) AS 女,
                SUM(IF(train_status =0 , 1, 0)) AS 待培训,
                SUM(IF(train_status =1 , 1, 0)) AS 培训中,
                SUM(IF(train_status =2 , 1, 0)) AS 已培训,
                SUM(IF(job_status =0 , 1, 0)) AS 待就业,
                SUM(IF(job_status =1 , 1, 0)) AS 已就业,
                SUM(IF(check_status =0 , 1, 0)) AS 未审核,
                SUM(IF(check_status =1 , 1, 0)) AS 已审核,
                SUM(IF(DATE(create_date) = DATE(NOW()) , 1, 0)) AS 今日报到
                FROM soldier_record";
       $post = \Yii::$app->db->createCommand($sql)
           ->queryOne();
       return $post;
   }
}

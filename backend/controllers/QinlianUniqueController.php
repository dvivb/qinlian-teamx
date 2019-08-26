<?php

namespace backend\controllers;

use backend\models\QinlianChallenge;
use backend\models\QinlianRegister;
use backend\models\QinlianThread;
use Yii;
use yii\data\Pagination;
use backend\models\QinlianPetition;

/**
 * Class QinlianUniqueController
 * @package backend\controllers
 */
class QinlianUniqueController extends BaseController
{
	public $layout = "lte_main";
    public $enableCsrfValidation = false;

    /**
     * Lists all QinlianPetition models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = QinlianPetition::find();
        $ChallengeQuery = QinlianChallenge::find();
        $ThreadQuery = QinlianThread::find();
        $RegisterQuery = QinlianRegister::find();

         $querys = Yii::$app->request->get('query');
        if(empty($querys)== false && count($querys) > 0){
            $condition = "";
            $ChallengeCondition = "";
            $ThreadCondition = "";
            $RegisterCondition = "";
            $parame = array();
            foreach($querys as $key=>$value){
                $value = trim($value);
                if(empty($value) == false){
                    $parame[":{$key}"]= '%'.$value.'%';
                    if(empty($condition) == true){

                        if ($key == 'name') {
                            $condition = " name_reported LIKE :{$key} ";
                        }elseif ($key == 'case_keyword'){
                            $condition = " main_issues LIKE :{$key} ";
                        }else{
                            $condition = " {$key} LIKE :{$key} ";
                        }
                    } else{
                        if ($key == 'name') {
                            $condition = $condition . " AND name_reported LIKE :{$key} ";
                        }elseif ($key == 'case_keyword'){
                            $condition = $condition . " AND main_issues LIKE :{$key} ";
                        }else{
                            $condition = $condition . " AND {$key} LIKE :{$key} ";
                        }
                    }

                    if(empty($ChallengeCondition) == true){
                        if ($key == 'name') {
                            $ChallengeCondition = " respondent_unit LIKE :{$key} ";
                        }elseif ($key == 'case_keyword'){
                            $ChallengeCondition = " main_issues LIKE :{$key} ";
                        }else{
                            $ChallengeCondition = " {$key} LIKE :{$key} ";
                        }
                    } else{
                        if ($key == 'name') {
                            $ChallengeCondition = $ChallengeCondition . " AND respondent_unit LIKE :{$key} ";
                        }elseif ($key == 'case_keyword'){
                            $ChallengeCondition = $ChallengeCondition . " AND main_issues LIKE :{$key} ";
                        }else{
                            $ChallengeCondition = $ChallengeCondition . " AND {$key} LIKE :{$key} ";
                        }
                    }

                    if(empty($ThreadCondition) == true){
                        if ($key == 'name') {
                            $ThreadCondition = " person_reflected LIKE :{$key} ";
                        }elseif ($key == 'case_keyword'){
                            $ThreadCondition = " main_problem_clues LIKE :{$key} ";
                        }else{
                            $ThreadCondition = " {$key} LIKE :{$key} ";
                        }
                    } else{
                        if ($key == 'name') {
                            $ThreadCondition = $ThreadCondition . " AND person_reflected LIKE :{$key} ";
                        }elseif ($key == 'case_keyword'){
                            $ThreadCondition = $ThreadCondition . " AND main_problem_clues LIKE :{$key} ";
                        }else{
                            $ThreadCondition = $ThreadCondition . " AND {$key} LIKE :{$key} ";
                        }
                    }

                    if(empty($RegisterCondition) == true){
                        if ($key == 'name') {
                            $RegisterCondition = " person_investigated LIKE :{$key} ";
                        }elseif ($key == 'case_keyword'){
                            $RegisterCondition = " brief_case_report LIKE :{$key} ";
                        }else{
                            $RegisterCondition = " {$key} LIKE :{$key} ";
                        }
                    } else{
                        if ($key == 'name') {
                            $RegisterCondition = $RegisterCondition . " AND person_investigated LIKE :{$key} ";
                        }elseif ($key == 'case_keyword'){
                            $RegisterCondition = $RegisterCondition . " AND brief_case_report LIKE :{$key} ";
                        }else{
                            $RegisterCondition = $RegisterCondition . " AND {$key} LIKE :{$key} ";
                        }
                    }
                }
            }
            if(count($parame) > 0){
                $query = $query->where($condition, $parame);
                $ChallengeQuery = $ChallengeQuery->where($ChallengeCondition, $parame);
                $ThreadQuery = $ThreadQuery->where($ThreadCondition, $parame);
                $RegisterQuery = $RegisterQuery->where($RegisterCondition, $parame);
            }
        }

        $pagination = new Pagination([
            'totalCount' =>$query->count(), 
            'pageSize' => '5',
            'pageParam'=>'page', 
            'pageSizeParam'=>'per-page']
        );

        $ChallengePagination = new Pagination([
            'totalCount' =>$ChallengeQuery->count(),
            'pageSize' => '5',
            'pageParam'=>'page',
            'pageSizeParam'=>'per-page']
        );

        $ThreadPagination = new Pagination([
            'totalCount' =>$ThreadQuery->count(),
            'pageSize' => '5',
            'pageParam'=>'page',
            'pageSizeParam'=>'per-page']
        );

        $RegisterPagination = new Pagination([
            'totalCount' =>$RegisterQuery->count(),
            'pageSize' => '5',
            'pageParam'=>'page',
            'pageSizeParam'=>'per-page']
        );
        
        $orderby = Yii::$app->request->get('orderby', '');
        if(empty($orderby) == false){
            $query = $query->orderBy($orderby);
        }
        
        
        $models = $query
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();

        $ChallengeModels = $ChallengeQuery
            ->offset($ChallengePagination->offset)
            ->limit($ChallengePagination->limit)
            ->all();

        $ThreadModels = $ThreadQuery
            ->offset($ThreadPagination->offset)
            ->limit($ThreadPagination->limit)
            ->all();

        $RegisterModels = $RegisterQuery
            ->offset($RegisterPagination->offset)
            ->limit($RegisterPagination->limit)
            ->all();

        return $this->render('index', [
            'models'=>$models,
            'pages'=>$pagination,
            'query'=>$querys,
            'ChallengeModels'=>$ChallengeModels,
            'ChallengePages'=>$ChallengePagination,
            'ThreadModels'=>$ThreadModels,
            'ThreadPages'=>$ThreadPagination,
            'RegisterModels'=>$RegisterModels,
            'RegisterPages'=>$RegisterPagination,
        ]);

    }

}

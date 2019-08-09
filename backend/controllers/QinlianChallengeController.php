<?php

namespace backend\controllers;

use Yii;
use yii\data\Pagination;
use backend\models\QinlianChallenge;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

/**
 * QinlianChallengeController implements the CRUD actions for QinlianChallenge model.
 */
class QinlianChallengeController extends BaseController
{
	public $layout = "lte_main";
    public $enableCsrfValidation = false;

    /**
     * Lists all QinlianChallenge models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = QinlianChallenge::find();
         $querys = Yii::$app->request->get('query');
        if(empty($querys)== false && count($querys) > 0){
            $condition = "";
            $parame = array();
            foreach($querys as $key=>$value){
                $value = trim($value);
                if(empty($value) == false){
                    $parame[":{$key}"]=$value;
                    if(empty($condition) == true){
                        $condition = " {$key}=:{$key} ";
                    }
                    else{
                        $condition = $condition . " AND {$key}=:{$key} ";
                    }
                }
            }
            if(count($parame) > 0){
                $query = $query->where($condition, $parame);
            }
        }

        $pagination = new Pagination([
            'totalCount' =>$query->count(), 
            'pageSize' => '10', 
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
        return $this->render('index', [
            'models'=>$models,
            'pages'=>$pagination,
            'query'=>$querys,
        ]);
    }

    /**
     * Displays a single QinlianChallenge model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $data = $model->getAttributes();
        
        
        return $this->asJson($data);

    }

    /**
     * Creates a new QinlianChallenge model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new QinlianChallenge();
        if ($model->load(Yii::$app->request->post())) {
        
              if(empty($model->incoming_time) == true){
                  $model->incoming_time = 'CURRENT_TIMESTAMP';
              }
              if(empty($model->create_date) == true){
                  $model->create_date = 'CURRENT_TIMESTAMP';
              }
              $model->create_date = date('Y-m-d H:i:s');
        
            if($model->validate() == true && $model->save()){
                $msg = array('errno'=>0, 'msg'=>'保存成功');
                return $this->asJson($msg);
            }
            else{
                $msg = array('errno'=>2, 'data'=>$model->getErrors());
                return $this->asJson($msg);
            }
        } else {
            $msg = array('errno'=>2, 'msg'=>'数据出错');
            return $this->asJson($msg);
        }
    }

    /**
     * Updates an existing QinlianChallenge model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $id = Yii::$app->request->post('id');
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
        
             if(empty($model->incoming_time) == true){
                 $model->incoming_time = 'CURRENT_TIMESTAMP';
             }
             if(empty($model->create_date) == true){
                 $model->create_date = 'CURRENT_TIMESTAMP';
             }
        
        
            if($model->validate() == true && $model->save()){
                $msg = array('errno'=>0, 'msg'=>'保存成功');
                return $this->asJson($msg);
            }
            else{
                $msg = array('errno'=>2, 'data'=>$model->getErrors());
                return $this->asJson($msg);
            }
        } else {
            $msg = array('errno'=>2, 'msg'=>'数据出错');
            return $this->asJson($msg);
        }
    
    }

    /**
     * Deletes an existing QinlianChallenge model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete(array $ids)
    {
        if(count($ids) > 0){
            $c = QinlianChallenge::deleteAll(['in', 'id', $ids]);
            return $this->asJson(array('errno'=>0, 'data'=>$c, 'msg'=>json_encode($ids)));
        }
        else{
            return $this->asJson(array('errno'=>2, 'msg'=>''));
        }
    }

	
	 

    /**
     * Finds the QinlianChallenge model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return QinlianChallenge the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = QinlianChallenge::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Statistics all models.
     * @return mixed
     */
    public function actionStatistics()
    {
////        $data = $_POST;
////        var_dump($data);die;
//
//        $query = QinlianChallenge::find();
//        $querys = Yii::$app->request->get('query');
//        if(count($querys) > 0){
//            $condition = "";
//            $parame = array();
//            foreach($querys as $key=>$value){
//                $value = trim($value);
//                if(empty($value) == false){
//                    $parame[":{$key}"]=$value;
//                    if(empty($condition) == true){
//                        $condition = " {$key}=:{$key} ";
//                    }
//                    else{
//                        $condition = $condition . " AND {$key}=:{$key} ";
//                    }
//                }
//            }
//            if(count($parame) > 0){
//                $query = $query->where($condition, $parame);
//            }
//        }
//
//        $pagination = new Pagination([
//                'totalCount' =>$query->count(),
//                'pageSize' => '10',
//                'pageParam'=>'page',
//                'pageSizeParam'=>'per-page']
//        );
//
//        $orderby = Yii::$app->request->get('orderby', '');
//        if(empty($orderby) == false){
//            $query = $query->orderBy($orderby);
//        }
//
//        $models = $query
//            ->offset($pagination->offset)
//            ->limit($pagination->limit)
//            ->all();
//        return $this->render('statistics', [
//            'models'=>$models,
//            'pages'=>$pagination,
//            'query'=>$querys,
//        ]);

        if (Yii::$app->request->get()){

            $data = Yii::$app->request->get();
            return $this->render('statistics', [
//                'models'=>$models,
//                'pages'=>$pagination,
//                'query'=>$querys,
                'data'=>$data,
            ]);
        }else{
            return $this->render('statistics', []);
        }

//        $data = Yii::$app->request->post();
//        return $this->asJson($data);

//        $model = new QinlianChallenge();
//        if ($model->load(Yii::$app->request->post())) {
//
//            if(empty($model->incoming_time) == true){
//                $model->incoming_time = 'CURRENT_TIMESTAMP';
//            }
//            if(empty($model->create_date) == true){
//                $model->create_date = 'CURRENT_TIMESTAMP';
//            }
//            $model->create_date = date('Y-m-d H:i:s');
//
//            if($model->validate() == true && $model->save()){
//                $msg = array('errno'=>0, 'msg'=>'保存成功');
//                return $this->asJson($msg);
//            }
//            else{
//                $msg = array('errno'=>2, 'data'=>$model->getErrors());
//                return $this->asJson($msg);
//            }
//        } else {
//            $msg = array('errno'=>2, 'msg'=>'数据出错');
//            return $this->asJson($msg);
//        }
    }

    public function actionImport()
    {
        if (Yii::$app->request->isPost && isset($_FILES['importExcelFile']['tmp_name'])) {
            $inputFileName = $_FILES['importExcelFile']['tmp_name'];
            $spreadsheet = IOFactory::load($inputFileName);
            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
//            var_dump($sheetData);die;

            foreach($sheetData as $key => $value) {
                if ($key>1){
//                    var_dump($value);die;
                    $data[] = [
                        'id' =>  $value['A'],
                        'number' =>  $value['B'],
                        'incoming_time' =>  $value['C'],
                        'clue_level' =>  $value['D'],
                        'clue_category' =>  $value['E'],

                        'clue_source' =>  $value['F'],
                        'letter_number' =>  $value['G'],
                        'signature' =>  $value['H'],
                        'leader_instructions' =>  $value['I'],
                        'respondent_unit' =>  $value['J'],

                        'duty_job' =>  $value['K'],
                        'rank_job' =>  $value['L'],
                        'main_issues' =>  $value['M'],
                        'related_unit' =>  $value['N'],
                        'heavy_cases' =>  $value['O'],

                        'date_receipt' =>  $value['P'],
                        'transfer_organ' =>  $value['Q'],
                        'results' =>  $value['R'],
                        'supervisory_leadership' =>  $value['S'],
                        'host_department' =>  $value['T'],

                        'progress_case' =>  $value['U'],
                        'investigation_disposal' =>  $value['V'],
                        'remarks' =>  $value['W'],
                        'number_disposals' =>  $value['X'],
                        'organizations_number' =>  $value['Y'],

                        'first_form' =>  $value['X'],
                        'second_form' =>  $value['AA'],
                        'third_form' =>  $value['AB'],
                        'fourth_form' =>  $value['AC'],
                        'approval_time' =>  $value['AD'],

                        'approval_status' =>  $value['AE'],
                    ];

                }
            }
//var_dump($data);die;
            if (isset($data)) {
                $transaction = Yii::$app->getDb()->beginTransaction();
                try {
                    $model = new QinlianChallenge();
                    Yii::$app->db->createCommand()
                        ->batchInsert($model::tableName(),[
                            'id',
                            'number',
                            'incoming_time',
                            'clue_level',
                            'clue_category',
                            'clue_source',
                            'letter_number',
                            'signature',
                            'leader_instructions',
                            'respondent_unit',
                            'duty_job',
                            'rank_job',
                            'main_issues',
                            'related_unit',
                            'heavy_cases',
                            'date_receipt',
                            'transfer_organ',
                            'results',
                            'supervisory_leadership',
                            'host_department',
                            'progress_case',
                            'investigation_disposal',
                            'remarks',
                            'number_disposals',
                            'organizations_number',
                            'first_form',

                            'second_form',
                            'third_form',
                            'fourth_form',
                            'approval_time',
                            'approval_status',
                        ],
                            $data)
                        ->execute();
                } catch (Exception $e) {
                    $transaction->rollBack();
                    $msg = array('errno'=>2, 'data'=>$e->getMessage());
                    return $this->render('index', $msg);
                }
            }

        } else {
            $msg = array('errno'=>2, 'msg'=>'文件上传失败或没有找到');
            return $this->render('index', $msg);
        }

        $transaction->commit();
        $msg = array('errno'=>0, 'msg'=>'保存成功');
        return $this->asJson($msg);
    }

    public function actionExport()
    {
        $query = QinlianChallenge::find();
        $data = $query
            ->all();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getActiveSheet()->setCellValue('A1', '序号');
        $spreadsheet->getActiveSheet()->setCellValue('B1', '来件时间');
        $spreadsheet->getActiveSheet()->setCellValue('C1', '线索级别');
        $spreadsheet->getActiveSheet()->setCellValue('D1', '线索类别');
        $spreadsheet->getActiveSheet()->setCellValue('E1', '线索来源');

        $spreadsheet->getActiveSheet()->setCellValue('F1', '信件编号');
        $spreadsheet->getActiveSheet()->setCellValue('G1', '署名情况');
        $spreadsheet->getActiveSheet()->setCellValue('H1', '领导批示');
        $spreadsheet->getActiveSheet()->setCellValue('I1', '被反映人（单位）');
        $spreadsheet->getActiveSheet()->setCellValue('J1', '职务');

        $spreadsheet->getActiveSheet()->setCellValue('K1', '职级');
        $spreadsheet->getActiveSheet()->setCellValue('L1', '反映的主要问题');
        $spreadsheet->getActiveSheet()->setCellValue('M1', '涉及单位');
        $spreadsheet->getActiveSheet()->setCellValue('N1', '重件情况');
        $spreadsheet->getActiveSheet()->setCellValue('O1', '接到日期');

        $spreadsheet->getActiveSheet()->setCellValue('P1', '处置方式');
        $spreadsheet->getActiveSheet()->setCellValue('Q1', '要结果情况');
        $spreadsheet->getActiveSheet()->setCellValue('R1', '督办领导');
        $spreadsheet->getActiveSheet()->setCellValue('S1', '办理科室');
        $spreadsheet->getActiveSheet()->setCellValue('T1', '案件进度');

        $spreadsheet->getActiveSheet()->setCellValue('U1', '查处情况');
        $spreadsheet->getActiveSheet()->setCellValue('V1', '备注');
        $spreadsheet->getActiveSheet()->setCellValue('W1', '处分人数');
        $spreadsheet->getActiveSheet()->setCellValue('X1', '问题属性');
        $spreadsheet->getActiveSheet()->setCellValue('Y1', '第一种形态');

        $spreadsheet->getActiveSheet()->setCellValue('Z1', '第二种形态');
        $spreadsheet->getActiveSheet()->setCellValue('AA1', '第三种形态');
        $spreadsheet->getActiveSheet()->setCellValue('AB1', '第四种形态');
        $spreadsheet->getActiveSheet()->setCellValue('AC1', '审批时间');
        $spreadsheet->getActiveSheet()->setCellValue('AD1', '审批状态');

        $spreadsheet->getActiveSheet()->setCellValue('AE1', '删除状态');
        $spreadsheet->getActiveSheet()->setCellValue('AF1', '创建时间');
        $spreadsheet->getActiveSheet()->setCellValue('AG1', '更新时间');

        // $spreadsheet->getDefaultStyle()->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(16);

        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(16);

        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(16);

        $spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('R')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('S')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('T')->setWidth(16);

        $spreadsheet->getActiveSheet()->getColumnDimension('U')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('V')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('W')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('X')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('Y')->setWidth(16);

        $spreadsheet->getActiveSheet()->getColumnDimension('X')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('AA')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('AB')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('AC')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('AD')->setWidth(16);

        $spreadsheet->getActiveSheet()->getColumnDimension('AE')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('AF')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('AG')->setWidth(12);

        $i = 2;
        foreach($data as $key=>$val){

            $spreadsheet->getActiveSheet()->setCellValue('A' . $i, $val['number']);
            $spreadsheet->getActiveSheet()->setCellValue('B' . $i, $val['incoming_time']);
            $spreadsheet->getActiveSheet()->setCellValue('C' . $i, $val['clue_level']);
            $spreadsheet->getActiveSheet()->setCellValue('D' . $i, $val['clue_category']);
            $spreadsheet->getActiveSheet()->setCellValue('E' . $i, $val['clue_source']);

            $spreadsheet->getActiveSheet()->setCellValue('F' . $i, $val['letter_number']);
            $spreadsheet->getActiveSheet()->setCellValue('G' . $i, $val['signature']);
            $spreadsheet->getActiveSheet()->setCellValue('H' . $i, $val['leader_instructions']);
            $spreadsheet->getActiveSheet()->setCellValue('I' . $i, $val['respondent_unit']);
            $spreadsheet->getActiveSheet()->setCellValue('J' . $i, $val['duty_job']);

            $spreadsheet->getActiveSheet()->setCellValue('K' . $i, $val['rank_job']);
            $spreadsheet->getActiveSheet()->setCellValue('L' . $i, $val['main_issues']);
            $spreadsheet->getActiveSheet()->setCellValue('M' . $i, $val['related_unit']);
            $spreadsheet->getActiveSheet()->setCellValue('N' . $i, $val['heavy_cases']);
            $spreadsheet->getActiveSheet()->setCellValue('O' . $i, $val['date_receipt']);

            $spreadsheet->getActiveSheet()->setCellValue('P' . $i, $val['transfer_organ']);
            $spreadsheet->getActiveSheet()->setCellValue('Q' . $i, $val['results']);
            $spreadsheet->getActiveSheet()->setCellValue('R' . $i, $val['supervisory_leadership']);
            $spreadsheet->getActiveSheet()->setCellValue('S' . $i, $val['host_department']);
            $spreadsheet->getActiveSheet()->setCellValue('T' . $i, $val['progress_case']);

            $spreadsheet->getActiveSheet()->setCellValue('U' . $i, $val['investigation_disposal']);
            $spreadsheet->getActiveSheet()->setCellValue('V' . $i, $val['remarks']);
            $spreadsheet->getActiveSheet()->setCellValue('W' . $i, $val['number_disposals']);
            $spreadsheet->getActiveSheet()->setCellValue('X' . $i, $val['organizations_number']);
            $spreadsheet->getActiveSheet()->setCellValue('Y' . $i, $val['first_form']);

            $spreadsheet->getActiveSheet()->setCellValue('X' . $i, $val['second_form']);
            $spreadsheet->getActiveSheet()->setCellValue('AA' . $i, $val['third_form']);
            $spreadsheet->getActiveSheet()->setCellValue('AB' . $i, $val['fourth_form']);
            $spreadsheet->getActiveSheet()->setCellValue('AC' . $i, $val['approval_time']);
            $spreadsheet->getActiveSheet()->setCellValue('AD' . $i, $val['approval_status']);

            $spreadsheet->getActiveSheet()->setCellValue('AE' . $i, $val['del_status']);
            $spreadsheet->getActiveSheet()->setCellValue('AF' . $i, $val['create_date']);
            $spreadsheet->getActiveSheet()->setCellValue('AG' . $i, $val['update_time']);

            $i++;
        }

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.'案管问题 -'.date("Y年m月j日").'.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

//    public function actionImport()
//    {
//        if (Yii::$app->request->isPost && isset($_FILES['importExcelFile']['tmp_name'])) {
//            $inputFileName = $_FILES['importExcelFile']['tmp_name'];
//            $spreadsheet = IOFactory::load($inputFileName);
//            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
////            var_dump($sheetData);die;
//
//            foreach($sheetData as $key => $value) {
//                if ($key>1){
////                    var_dump($value);die;
//                    $data[] = [
//                        'name' =>  $value['A'],
//                        'sex' =>  $value['B'],
//                        'nation' =>  $value['C'],
//                        'age' =>  $value['D'],
//                        'politics_status' =>  $value['E'],
//
//                        'join_party_date' =>  $value['F'],
//                        'organization_name' =>  $value['G'],
//                        'duty' =>  $value['H'],
//                        'rank' =>  $value['I'],
//                        'is_monitor' =>  $value['J'],
//
//                        'is_official' =>  $value['K'],
//                        'clue_code' =>  $value['L'],
//                        'clue_people_code' =>  $value['M'],
//                        'clue_accept_time' =>  $value['N'],
//                        'clue_manage_office' =>  $value['O'],
//
//                        'clue_source' =>  $value['P'],
//                        'clue_violations_type' =>  $value['Q'],
//                        'clue_outlawed_type' =>  $value['R'],
//                        'clue_disposition_method' =>  $value['S'],
//                        'clue_summary' =>  $value['T'],
//
//                        'clue_protokaryon_report' =>  $value['U'],
//                        'case_code' =>  $value['V'],
//                        'case_people_code' =>  $value['W'],
//                        'case_register_time' =>  $value['X'],
//                        'case_register_office' =>  $value['Y'],
//
//                        'case_summary' =>  $value['X'],
//                        'case_register_report' =>  $value['AA'],
//                        'case_register_decision' =>  $value['AB'],
//                        'case_review_report' =>  $value['AC'],
//                        'settle_accept_time' =>  $value['AD'],
//
//                        'settle_accept_report' =>  $value['AE'],
//                        'settle_conclude_time' =>  $value['AF'],
//                        'settle_finish_time' =>  $value['AG'],
//                        'settle_party_disposal' =>  $value['AH'],
//                        'settle_political_disposal' =>  $value['AI'],
//
//                        'settle_disposal_decision' =>  $value['AJ'],
//                        'settle_judiciary_time' =>  $value['AK'],
//                        'settle_prosecutor_time' =>  $value['AL'],
//                        'settle_prosecutor_details' =>  $value['AM'],
//                        'del_status' =>  $value['AN'],
//                    ];
//
//                }
//            }
////var_dump($data);die;
//            if (isset($data)) {
//                $transaction = Yii::$app->getDb()->beginTransaction();
//                try {
//                    $model = new QinlianChallenge();
//                    Yii::$app->db->createCommand()
//                        ->batchInsert($model::tableName(),[
//                            'name',
//                            'sex',
//                            'nation',
//                            'age',
//                            'politics_status',
//                            'join_party_date',
//                            'organization_name',
//                            'duty',
//                            'rank',
//                            'is_monitor',
//                            'is_official',
//                            'clue_code',
//                            'clue_people_code',
//                            'clue_accept_time',
//                            'clue_manage_office',
//                            'clue_source',
//                            'clue_violations_type',
//                            'clue_outlawed_type',
//                            'clue_disposition_method',
//                            'clue_summary',
//                            'clue_protokaryon_report',
//                            'case_code',
//                            'case_people_code',
//                            'case_register_time',
//                            'case_register_office',
//                            'case_summary',
//
//                            'case_register_report',
//                            'case_register_decision',
//                            'case_review_report',
//                            'settle_accept_time',
//                            'settle_accept_report',
//                            'settle_conclude_time',
//                            'settle_finish_time',
//                            'settle_party_disposal',
//                            'settle_political_disposal',
//                            'settle_disposal_decision',
//                            'settle_judiciary_time',
//                            'settle_prosecutor_time',
//                            'settle_prosecutor_details',
//                            'del_status',
//                        ],
//                            $data)
//                        ->execute();
//                } catch (Exception $e) {
//                    $transaction->rollBack();
//                    $msg = array('errno'=>2, 'data'=>$e->getMessage());
//                    return $this->render('index', $msg);
//                }
//            }
//
//        } else {
//            $msg = array('errno'=>2, 'msg'=>'文件上传失败或没有找到');
//            return $this->render('index', $msg);
//        }
//
//        $transaction->commit();
//        $msg = array('errno'=>0, 'msg'=>'保存成功');
////                    return json_encode($msg);
//        $this->redirect('/index.php?r=complaint-record/index', '200');
//    }
//
//    public function actionExport()
//    {
//        $query = QinlianChallenge::find();
//        $data = $query
//            ->all();
//
//        $spreadsheet = new Spreadsheet();
//
//        $spreadsheet->getActiveSheet()->setCellValue('A1', '姓名');
//        $spreadsheet->getActiveSheet()->setCellValue('B1', '性别');
//        $spreadsheet->getActiveSheet()->setCellValue('C1', '民族');
//        $spreadsheet->getActiveSheet()->setCellValue('D1', '年龄');
//        $spreadsheet->getActiveSheet()->setCellValue('E1', '政治面貌');
//
//        $spreadsheet->getActiveSheet()->setCellValue('F1', '入党时间');
//        $spreadsheet->getActiveSheet()->setCellValue('G1', '单位');
//        $spreadsheet->getActiveSheet()->setCellValue('H1', '职务');
//        $spreadsheet->getActiveSheet()->setCellValue('I1', '职级');
//        $spreadsheet->getActiveSheet()->setCellValue('J1', '是否监察对象');
//
//        $spreadsheet->getActiveSheet()->setCellValue('K1', '是否公务员');
//        $spreadsheet->getActiveSheet()->setCellValue('L1', '线索编码');
//        $spreadsheet->getActiveSheet()->setCellValue('M1', '线索人员编码');
//        $spreadsheet->getActiveSheet()->setCellValue('N1', '受理时间');
//        $spreadsheet->getActiveSheet()->setCellValue('O1', '办理机关');
//
//        $spreadsheet->getActiveSheet()->setCellValue('P1', '线索来源');
//        $spreadsheet->getActiveSheet()->setCellValue('Q1', '违纪类型');
//        $spreadsheet->getActiveSheet()->setCellValue('R1', '违法类型');
//        $spreadsheet->getActiveSheet()->setCellValue('S1', '处置方式');
//        $spreadsheet->getActiveSheet()->setCellValue('T1', '线索摘要');
//
//        $spreadsheet->getActiveSheet()->setCellValue('U1', '初核报告');
//        $spreadsheet->getActiveSheet()->setCellValue('V1', '案件编码');
//        $spreadsheet->getActiveSheet()->setCellValue('W1', '案件人员编码');
//        $spreadsheet->getActiveSheet()->setCellValue('X1', '立案时间');
//        $spreadsheet->getActiveSheet()->setCellValue('Y1', '立案机关');
//
//        $spreadsheet->getActiveSheet()->setCellValue('Z1', '简要案情');
//        $spreadsheet->getActiveSheet()->setCellValue('AA1', '立案报告');
//        $spreadsheet->getActiveSheet()->setCellValue('AB1', '立案决定书');
//        $spreadsheet->getActiveSheet()->setCellValue('AC1', '审查报告');
//        $spreadsheet->getActiveSheet()->setCellValue('AD1', '审理受理时间');
//
//        $spreadsheet->getActiveSheet()->setCellValue('AE1', '审理报告');
//        $spreadsheet->getActiveSheet()->setCellValue('AF1', '审结时间');
//        $spreadsheet->getActiveSheet()->setCellValue('AG1', '结案时间');
//        $spreadsheet->getActiveSheet()->setCellValue('AH1', '党纪处分');
//        $spreadsheet->getActiveSheet()->setCellValue('AI1', '政纪处分');
//
//        $spreadsheet->getActiveSheet()->setCellValue('AJ1', '处分决定');
//        $spreadsheet->getActiveSheet()->setCellValue('AK1', '移送司法时间');
//        $spreadsheet->getActiveSheet()->setCellValue('AL1', '公检法受理时间');
//        $spreadsheet->getActiveSheet()->setCellValue('AM1', '公检法处理内容');
//        $spreadsheet->getActiveSheet()->setCellValue('AN1', '删除状态');
//
//        $spreadsheet->getActiveSheet()->setCellValue('AO1', '创建时间');
//        $spreadsheet->getActiveSheet()->setCellValue('AP1', '更新时间');
//
//        // $spreadsheet->getDefaultStyle()->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(30);
//        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(12);
//        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(16);
//        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(16);
//        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(16);
//
//        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(30);
//        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(12);
//        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(16);
//        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(16);
//        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(16);
//
//        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(30);
//        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(12);
//        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(16);
//        $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(16);
//        $spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(16);
//
//        $spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(30);
//        $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setWidth(12);
//        $spreadsheet->getActiveSheet()->getColumnDimension('R')->setWidth(16);
//        $spreadsheet->getActiveSheet()->getColumnDimension('S')->setWidth(16);
//        $spreadsheet->getActiveSheet()->getColumnDimension('T')->setWidth(16);
//
//        $spreadsheet->getActiveSheet()->getColumnDimension('U')->setWidth(16);
//        $spreadsheet->getActiveSheet()->getColumnDimension('V')->setWidth(16);
//        $spreadsheet->getActiveSheet()->getColumnDimension('W')->setWidth(16);
//        $spreadsheet->getActiveSheet()->getColumnDimension('X')->setWidth(16);
//        $spreadsheet->getActiveSheet()->getColumnDimension('Y')->setWidth(16);
//
//        $spreadsheet->getActiveSheet()->getColumnDimension('X')->setWidth(16);
//        $spreadsheet->getActiveSheet()->getColumnDimension('AA')->setWidth(16);
//        $spreadsheet->getActiveSheet()->getColumnDimension('AB')->setWidth(16);
//        $spreadsheet->getActiveSheet()->getColumnDimension('AC')->setWidth(16);
//        $spreadsheet->getActiveSheet()->getColumnDimension('AD')->setWidth(16);
//
//        $spreadsheet->getActiveSheet()->getColumnDimension('AE')->setWidth(16);
//        $spreadsheet->getActiveSheet()->getColumnDimension('AF')->setWidth(30);
//        $spreadsheet->getActiveSheet()->getColumnDimension('AG')->setWidth(12);
//        $spreadsheet->getActiveSheet()->getColumnDimension('AH')->setWidth(16);
//        $spreadsheet->getActiveSheet()->getColumnDimension('AI')->setWidth(16);
//
//        $spreadsheet->getActiveSheet()->getColumnDimension('AJ')->setWidth(16);
//        $spreadsheet->getActiveSheet()->getColumnDimension('AK')->setWidth(30);
//        $spreadsheet->getActiveSheet()->getColumnDimension('AL')->setWidth(12);
//        $spreadsheet->getActiveSheet()->getColumnDimension('AM')->setWidth(16);
//        $spreadsheet->getActiveSheet()->getColumnDimension('AN')->setWidth(16);
//        $spreadsheet->getActiveSheet()->getColumnDimension('AO')->setWidth(16);
//
//        $spreadsheet->getActiveSheet()->getColumnDimension('AP')->setWidth(30);
//
//        $i = 2;
//        foreach($data as $key=>$val){
//
//            $spreadsheet->getActiveSheet()->setCellValue('A' . $i, $val['name']);
//            $spreadsheet->getActiveSheet()->setCellValue('B' . $i, $val['sex']);
//            $spreadsheet->getActiveSheet()->setCellValue('C' . $i, $val['nation']);
//            $spreadsheet->getActiveSheet()->setCellValue('D' . $i, $val['age']);
//            $spreadsheet->getActiveSheet()->setCellValue('E' . $i, $val['politics_status']);
//
//            $spreadsheet->getActiveSheet()->setCellValue('F' . $i, $val['join_party_date']);
//            $spreadsheet->getActiveSheet()->setCellValue('G' . $i, $val['organization_name']);
//            $spreadsheet->getActiveSheet()->setCellValue('H' . $i, $val['duty']);
//            $spreadsheet->getActiveSheet()->setCellValue('I' . $i, $val['rank']);
//            $spreadsheet->getActiveSheet()->setCellValue('J' . $i, $val['is_monitor']);
//
//            $spreadsheet->getActiveSheet()->setCellValue('K' . $i, $val['is_official']);
//            $spreadsheet->getActiveSheet()->setCellValue('L' . $i, $val['clue_code']);
//            $spreadsheet->getActiveSheet()->setCellValue('M' . $i, $val['clue_people_code']);
//            $spreadsheet->getActiveSheet()->setCellValue('N' . $i, $val['clue_accept_time']);
//            $spreadsheet->getActiveSheet()->setCellValue('O' . $i, $val['clue_manage_office']);
//
//            $spreadsheet->getActiveSheet()->setCellValue('P' . $i, $val['clue_source']);
//            $spreadsheet->getActiveSheet()->setCellValue('Q' . $i, $val['clue_violations_type']);
//            $spreadsheet->getActiveSheet()->setCellValue('R' . $i, $val['clue_outlawed_type']);
//            $spreadsheet->getActiveSheet()->setCellValue('S' . $i, $val['clue_disposition_method']);
//            $spreadsheet->getActiveSheet()->setCellValue('T' . $i, $val['clue_summary']);
//
//            $spreadsheet->getActiveSheet()->setCellValue('U' . $i, $val['clue_protokaryon_report']);
//            $spreadsheet->getActiveSheet()->setCellValue('V' . $i, $val['case_code']);
//            $spreadsheet->getActiveSheet()->setCellValue('W' . $i, $val['case_people_code']);
//            $spreadsheet->getActiveSheet()->setCellValue('X' . $i, $val['case_register_time']);
//            $spreadsheet->getActiveSheet()->setCellValue('Y' . $i, $val['case_register_office']);
//
//            $spreadsheet->getActiveSheet()->setCellValue('X' . $i, $val['case_summary']);
//            $spreadsheet->getActiveSheet()->setCellValue('AA' . $i, $val['case_register_report']);
//            $spreadsheet->getActiveSheet()->setCellValue('AB' . $i, $val['case_register_decision']);
//            $spreadsheet->getActiveSheet()->setCellValue('AC' . $i, $val['case_review_report']);
//            $spreadsheet->getActiveSheet()->setCellValue('AD' . $i, $val['settle_accept_time']);
//
//            $spreadsheet->getActiveSheet()->setCellValue('AE' . $i, $val['settle_accept_report']);
//            $spreadsheet->getActiveSheet()->setCellValue('AF' . $i, $val['settle_conclude_time']);
//            $spreadsheet->getActiveSheet()->setCellValue('AG' . $i, $val['settle_finish_time']);
//            $spreadsheet->getActiveSheet()->setCellValue('AH' . $i, $val['settle_party_disposal']);
//            $spreadsheet->getActiveSheet()->setCellValue('AI' . $i, $val['settle_political_disposal']);
//
//            $spreadsheet->getActiveSheet()->setCellValue('AJ' . $i, $val['settle_disposal_decision']);
//            $spreadsheet->getActiveSheet()->setCellValue('AK' . $i, $val['settle_judiciary_time']);
//            $spreadsheet->getActiveSheet()->setCellValue('AL' . $i, $val['settle_prosecutor_time']);
//            $spreadsheet->getActiveSheet()->setCellValue('AM' . $i, $val['settle_prosecutor_details']);
//            $spreadsheet->getActiveSheet()->setCellValue('AN' . $i, $val['del_status']);
//
//            $spreadsheet->getActiveSheet()->setCellValue('AO' . $i, $val['create_date']);
//            $spreadsheet->getActiveSheet()->setCellValue('AP' . $i, $val['update_time']);
//
//            $i++;
//        }
//
//        // Redirect output to a client’s web browser (Xlsx)
//        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//        header('Content-Disposition: attachment;filename="'.'案管问题线索-'.date("Y年m月j日").'.xlsx"');
//        header('Cache-Control: max-age=0');
//        // If you're serving to IE 9, then the following may be needed
//        header('Cache-Control: max-age=1');
//
//        // If you're serving to IE over SSL, then the following may be needed
//        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
//        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
//        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
//        header('Pragma: public'); // HTTP/1.0
//
//        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
//        $writer->save('php://output');
//        exit;
//    }
}

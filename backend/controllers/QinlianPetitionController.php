<?php

namespace backend\controllers;

use Yii;
use yii\data\Pagination;
use backend\models\QinlianPetition;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

/**
 * QinlianPetitionController implements the CRUD actions for QinlianPetition model.
 */
class QinlianPetitionController extends BaseController
{
	public $layout = "lte_main";

    /**
     * Lists all QinlianPetition models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = QinlianPetition::find();
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
     * Displays a single QinlianPetition model.
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
     * Creates a new QinlianPetition model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new QinlianPetition();
        if ($model->load(Yii::$app->request->post())) {
        
              if(empty($model->receipt_time) == true){
                  $model->receipt_time = 'CURRENT_TIMESTAMP';
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
     * Updates an existing QinlianPetition model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $id = Yii::$app->request->post('id');
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
        
             if(empty($model->receipt_time) == true){
                 $model->receipt_time = 'CURRENT_TIMESTAMP';
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
     * Deletes an existing QinlianPetition model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete(array $ids)
    {
        if(count($ids) > 0){
            $c = QinlianPetition::deleteAll(['in', 'id', $ids]);
            return $this->asJson(array('errno'=>0, 'data'=>$c, 'msg'=>json_encode($ids)));
        }
        else{
            return $this->asJson(array('errno'=>2, 'msg'=>''));
        }
    }

	
	 

    /**
     * Finds the QinlianPetition model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return QinlianPetition the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = QinlianPetition::findOne($id)) !== null) {
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
        $query = QinlianPetition::find();
        $querys = Yii::$app->request->get('query');
        if(count($querys) > 0){
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
        return $this->render('statistics', [
            'models'=>$models,
            'pages'=>$pagination,
            'query'=>$querys,
        ]);
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
                    $model = new QinlianPetition();
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
//                    return json_encode($msg);
        $this->redirect('/index.php?r=qinlian-petition/index', '200');
    }

    public function actionExport()
    {
        $query = QinlianPetition::find();
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
        header('Content-Disposition: attachment;filename="'.'信访信息-'.date("Y年m月j日").'.xlsx"');
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
}

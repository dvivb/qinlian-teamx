<?php

namespace backend\controllers;

use Yii;
use yii\data\Pagination;
use backend\models\QinlianThread;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

/**
 * QinlianThreadController implements the CRUD actions for QinlianThread model.
 */
class QinlianThreadController extends BaseController
{
	public $layout = "lte_main";
    public $enableCsrfValidation = false;

    /**
     * Lists all QinlianThread models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = QinlianThread::find();
         $querys = Yii::$app->request->get('query');
        if(empty($querys)== false && count($querys) > 0){
            $condition = "";
            $parame = array();
            foreach($querys as $key=>$value){
                $value = trim($value);
                if(empty($value) == false){
                    $parame[":{$key}"]= '%'.$value.'%';
                    if(empty($condition) == true){//
                        $condition = " {$key} LIKE :{$key} ";
                    }
                    else{
                        $condition = $condition . " AND {$key} LIKE :{$key} ";
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
     * Displays a single QinlianThread model.
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
     * Creates a new QinlianThread model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new QinlianThread();
        if ($model->load(Yii::$app->request->post())) {
        
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
     * Updates an existing QinlianThread model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $id = Yii::$app->request->post('id');
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
        
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
     * Deletes an existing QinlianThread model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete(array $ids)
    {
        if(count($ids) > 0){
            $c = QinlianThread::deleteAll(['in', 'id', $ids]);
            return $this->asJson(array('errno'=>0, 'data'=>$c, 'msg'=>json_encode($ids)));
        }
        else{
            return $this->asJson(array('errno'=>2, 'msg'=>''));
        }
    }

	
	 

    /**
     * Finds the QinlianThread model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return QinlianThread the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = QinlianThread::findOne($id)) !== null) {
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
        $query = QinlianThread::find();
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
                if ($key>3){
//                    var_dump($value);die;
                    if(!empty( $value['A'])){
                        $data[] = [
                            'is_nuit' =>  $value['A'],
                            'nuit_name' =>  $value['B'],
                            'nuit_code' =>  $value['C'],
                            'statistical_identification' =>  $value['D'],
                            'clue_code' =>  $value['E'],
                            'personnel_code' =>  $value['F'],
                            'person_reflected' =>  $value['G'],
                            'duty_job' =>  $value['H'],
                            'is_supervises_object' =>  $value['I'],
                            'rank_job' =>  $value['J'],
                            'recovers_economic_loss' =>  $value['K'],
                            'collects_amount' =>  $value['L'],
                            'handling_organ' =>  $value['M'],
                            'main_problem_clues' =>  $value['N'],
                            'remarks' =>  $value['O'],
                            'nation' =>  $value['P'],
                            'date_birth' =>  $value['Q'],
                            'cpc' =>  $value['R'],
                            'cppcc' =>  $value['S'],
                            'disposal_report' =>  $value['T'],
                            'time_joining_party' =>  $value['U'],
                            'authority_management' =>  $value['V'],
                            'acceptance_time' =>  $value['W'],
                            'approval_time_one' =>  $value['X'],
                            'statistical_time_one' =>  $value['Y'],
                            'one_level_first' =>  $value['Z'],

                            'one_level_second' =>  $value['AA'],
                            'approval_time_two' =>  $value['AB'],
                            'statistical_time_two' =>  $value['AC'],
                            'two_level_first' =>  $value['AD'],
                            'two_level_second' =>  $value['AE'],
                            'approval_time_three' =>  $value['AF'],
                            'statistical_time_three' =>  $value['AG'],
                            'three_level_first' =>  $value['AH'],
                            'three_level_second' =>  $value['AI'],
                            'cases_source' =>  $value['AJ'],
                            'disciplinary_offence' =>  $value['AK'],
                            'is_checking_me' =>  $value['AL'],
                            'is_party' =>  $value['AM'],
                            'secondary_class_objects' =>  $value['AN'],
                            'is_supervisory_objects' =>  $value['AO'],
                            'no_secondary_class_objects' =>  $value['AP'],
                            'official_offences' =>  $value['AQ'],
                            'other_offences' =>  $value['AR'],
                            'organization_measure_time' =>  $value['AS'],
                            'superiors_assigned' =>  $value['AT'],
                            'department_charge' =>  $value['AU'],
                            'del_status' =>  $value['AV'],
                            'create_date' =>  $value['AW'],
                            'update_time' =>  $value['AX'],
                        ];
                    }
                }
            }
//var_dump($data);die;
            if (isset($data)) {
                $transaction = Yii::$app->getDb()->beginTransaction();
                try {
                    $model = new QinlianThread();
                    Yii::$app->db->createCommand()
                        ->batchInsert($model::tableName(),[
                            'is_nuit',
                            'nuit_name',
                            'nuit_code',
                            'statistical_identification',
                            'clue_code',
                            'personnel_code',
                            'person_reflected',
                            'duty_job',
                            'is_supervises_object',
                            'rank_job',
                            'recovers_economic_loss',
                            'collects_amount',
                            'handling_organ',
                            'main_problem_clues',
                            'remarks',
                            'nation',
                            'date_birth',
                            'cpc',
                            'cppcc',
                            'disposal_report',
                            'time_joining_party',
                            'authority_management',
                            'acceptance_time',
                            'approval_time_one',
                            'statistical_time_one',
                            'one_level_first',

                            'one_level_second',
                            'approval_time_two',
                            'statistical_time_two',
                            'two_level_first',
                            'two_level_second',
                            'approval_time_three',
                            'statistical_time_three',
                            'three_level_first',
                            'three_level_second',
                            'cases_source',
                            'disciplinary_offence',
                            'is_checking_me',
                            'is_party',
                            'secondary_class_objects',
                            'is_supervisory_objects',
                            'no_secondary_class_objects',
                            'official_offences',
                            'other_offences',
                            'organization_measure_time',
                            'superiors_assigned',
                            'department_charge',
                            'del_status',
                            'create_date',
                            'update_time',

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
        $query = QinlianThread::find();
        $data = $query
            ->all();

        $spreadsheet = new Spreadsheet();
        $spreadsheet->getActiveSheet()->mergeCells('A1:AX2')->setCellValue('A1', date('Y'). '案管线索导出数据');
        $spreadsheet->getActiveSheet()->setCellValue('A3', '是否单位');
        $spreadsheet->getActiveSheet()->setCellValue('B3', '填报单位名称');
        $spreadsheet->getActiveSheet()->setCellValue('C3', '填报单位代码');
        $spreadsheet->getActiveSheet()->setCellValue('D3', '统计标识');
        $spreadsheet->getActiveSheet()->setCellValue('E3', '线索编码');
        $spreadsheet->getActiveSheet()->setCellValue('F3', '人员编码');
        $spreadsheet->getActiveSheet()->setCellValue('G3', '被反映人');
        $spreadsheet->getActiveSheet()->setCellValue('H3', '工作单位及职务');
        $spreadsheet->getActiveSheet()->setCellValue('I3', '是否国家监察对象');
        $spreadsheet->getActiveSheet()->setCellValue('J3', '职级');
        $spreadsheet->getActiveSheet()->setCellValue('K3', '挽回经济损失');
        $spreadsheet->getActiveSheet()->setCellValue('L3', '收缴涉案金额（0');
        $spreadsheet->getActiveSheet()->setCellValue('M3', '办理机关');
        $spreadsheet->getActiveSheet()->setCellValue('N3', '主要问题线索');
        $spreadsheet->getActiveSheet()->setCellValue('O3', '备注');
        $spreadsheet->getActiveSheet()->setCellValue('P3', '民族');
        $spreadsheet->getActiveSheet()->setCellValue('Q3', '出生年月');
        $spreadsheet->getActiveSheet()->setCellValue('R3', '人大代表');
        $spreadsheet->getActiveSheet()->setCellValue('S3', '政协委员');
        $spreadsheet->getActiveSheet()->setCellValue('T3', '处置情况报告');
        $spreadsheet->getActiveSheet()->setCellValue('U3', '入党时间');
        $spreadsheet->getActiveSheet()->setCellValue('V3', '干部管理权限');
        $spreadsheet->getActiveSheet()->setCellValue('W3', '受理时间');
        $spreadsheet->getActiveSheet()->setCellValue('X3', '处置方式1批准时间');
        $spreadsheet->getActiveSheet()->setCellValue('Y3', '处置方式1统计时间');
        $spreadsheet->getActiveSheet()->setCellValue('Z3', '处置方式1一级');

        $spreadsheet->getActiveSheet()->setCellValue('AA3', '处置方式1二级');
        $spreadsheet->getActiveSheet()->setCellValue('AB3', '处置方式2批准时间');
        $spreadsheet->getActiveSheet()->setCellValue('AC3', '处置方式2统计时间');
        $spreadsheet->getActiveSheet()->setCellValue('AD3', '处置方式2一级');
        $spreadsheet->getActiveSheet()->setCellValue('AE3', '处置方式2二级');
        $spreadsheet->getActiveSheet()->setCellValue('AF3', '处置方式3批准时间');
        $spreadsheet->getActiveSheet()->setCellValue('AG3', '处置方式3统计时间');
        $spreadsheet->getActiveSheet()->setCellValue('AH3', '处置方式3一级');
        $spreadsheet->getActiveSheet()->setCellValue('AI3', '处置方式3二级');
        $spreadsheet->getActiveSheet()->setCellValue('AJ3', '案件来源');
        $spreadsheet->getActiveSheet()->setCellValue('AK3', '违纪行为');
        $spreadsheet->getActiveSheet()->setCellValue('AL3', '是否与本人核实');
        $spreadsheet->getActiveSheet()->setCellValue('AM3', '是否党员');
        $spreadsheet->getActiveSheet()->setCellValue('AN3', '监察对象二级分类');
        $spreadsheet->getActiveSheet()->setCellValue('AO3', '是否非党员非监察对象');
        $spreadsheet->getActiveSheet()->setCellValue('AP3', '非党员非监察对象二级分类（万元）');
        $spreadsheet->getActiveSheet()->setCellValue('AQ3', '职务犯罪行为（万元）');
        $spreadsheet->getActiveSheet()->setCellValue('AR3', '其他违犯罪行为');
        $spreadsheet->getActiveSheet()->setCellValue('AS3', '组织措施统计时间');
        $spreadsheet->getActiveSheet()->setCellValue('AT3', '上级交办');
        $spreadsheet->getActiveSheet()->setCellValue('AU3', '分管科室');
        $spreadsheet->getActiveSheet()->setCellValue('AV3', '删除状态');
        $spreadsheet->getActiveSheet()->setCellValue('AW3', '创建时间');
        $spreadsheet->getActiveSheet()->setCellValue('AX3', '更新时间');


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
        $spreadsheet->getActiveSheet()->getColumnDimension('Z')->setWidth(16);

        $spreadsheet->getActiveSheet()->getColumnDimension('AA')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('AB')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('AC')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('AD')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('AE')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('AF')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('AG')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('AH')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('AI')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('AJ')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('AK')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('AL')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('AM')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('AN')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('AO')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('AP')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('AQ')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('AR')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('AS')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('AT')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('AU')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('AV')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('AW')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('AX')->setWidth(16);

        $i = 4;
        foreach($data as $key=>$val){

            $spreadsheet->getActiveSheet()->setCellValue('A' . $i, $val['is_nuit']);
            $spreadsheet->getActiveSheet()->setCellValue('B' . $i, $val['nuit_name']);
            $spreadsheet->getActiveSheet()->setCellValue('C' . $i, $val['nuit_code']);
            $spreadsheet->getActiveSheet()->setCellValue('D' . $i, $val['statistical_identification']);
            $spreadsheet->getActiveSheet()->setCellValue('E' . $i, $val['clue_code']);
            $spreadsheet->getActiveSheet()->setCellValue('F' . $i, $val['personnel_code']);
            $spreadsheet->getActiveSheet()->setCellValue('G' . $i, $val['person_reflected']);
            $spreadsheet->getActiveSheet()->setCellValue('H' . $i, $val['duty_job']);
            $spreadsheet->getActiveSheet()->setCellValue('I' . $i, $val['is_supervises_object']);
            $spreadsheet->getActiveSheet()->setCellValue('J' . $i, $val['rank_job']);
            $spreadsheet->getActiveSheet()->setCellValue('K' . $i, $val['recovers_economic_loss']);
            $spreadsheet->getActiveSheet()->setCellValue('L' . $i, $val['collects_amount']);
            $spreadsheet->getActiveSheet()->setCellValue('M' . $i, $val['handling_organ']);
            $spreadsheet->getActiveSheet()->setCellValue('N' . $i, $val['main_problem_clues']);
            $spreadsheet->getActiveSheet()->setCellValue('O' . $i, $val['remarks']);
            $spreadsheet->getActiveSheet()->setCellValue('P' . $i, $val['nation']);
            $spreadsheet->getActiveSheet()->setCellValue('Q' . $i, $val['date_birth']);
            $spreadsheet->getActiveSheet()->setCellValue('R' . $i, $val['cpc']);
            $spreadsheet->getActiveSheet()->setCellValue('S' . $i, $val['cppcc']);
            $spreadsheet->getActiveSheet()->setCellValue('T' . $i, $val['disposal_report']);
            $spreadsheet->getActiveSheet()->setCellValue('U' . $i, $val['time_joining_party']);
            $spreadsheet->getActiveSheet()->setCellValue('V' . $i, $val['authority_management']);
            $spreadsheet->getActiveSheet()->setCellValue('W' . $i, $val['acceptance_time']);
            $spreadsheet->getActiveSheet()->setCellValue('X' . $i, $val['approval_time_one']);
            $spreadsheet->getActiveSheet()->setCellValue('Y' . $i, $val['statistical_time_one']);
            $spreadsheet->getActiveSheet()->setCellValue('X' . $i, $val['one_level_first']);

            $spreadsheet->getActiveSheet()->setCellValue('AA' . $i, $val['one_level_second']);
            $spreadsheet->getActiveSheet()->setCellValue('AB' . $i, $val['approval_time_two']);
            $spreadsheet->getActiveSheet()->setCellValue('AC' . $i, $val['statistical_time_two']);
            $spreadsheet->getActiveSheet()->setCellValue('AD' . $i, $val['two_level_first']);
            $spreadsheet->getActiveSheet()->setCellValue('AE' . $i, $val['two_level_second']);
            $spreadsheet->getActiveSheet()->setCellValue('AF' . $i, $val['approval_time_three']);
            $spreadsheet->getActiveSheet()->setCellValue('AG' . $i, $val['statistical_time_three']);
            $spreadsheet->getActiveSheet()->setCellValue('AH' . $i, $val['three_level_first']);
            $spreadsheet->getActiveSheet()->setCellValue('AI' . $i, $val['three_level_second']);
            $spreadsheet->getActiveSheet()->setCellValue('AJ' . $i, $val['cases_source']);
            $spreadsheet->getActiveSheet()->setCellValue('AK' . $i, $val['disciplinary_offence']);
            $spreadsheet->getActiveSheet()->setCellValue('AL' . $i, $val['is_checking_me']);
            $spreadsheet->getActiveSheet()->setCellValue('AM' . $i, $val['is_party']);
            $spreadsheet->getActiveSheet()->setCellValue('AN' . $i, $val['secondary_class_objects']);
            $spreadsheet->getActiveSheet()->setCellValue('AO' . $i, $val['is_supervisory_objects']);
            $spreadsheet->getActiveSheet()->setCellValue('AP' . $i, $val['no_secondary_class_objects']);
            $spreadsheet->getActiveSheet()->setCellValue('AQ' . $i, $val['official_offences']);
            $spreadsheet->getActiveSheet()->setCellValue('AR' . $i, $val['other_offences']);
            $spreadsheet->getActiveSheet()->setCellValue('AS' . $i, $val['organization_measure_time']);
            $spreadsheet->getActiveSheet()->setCellValue('AT' . $i, $val['superiors_assigned']);
            $spreadsheet->getActiveSheet()->setCellValue('AU' . $i, $val['department_charge']);
            $spreadsheet->getActiveSheet()->setCellValue('AV' . $i, $val['del_status']);
            $spreadsheet->getActiveSheet()->setCellValue('AW' . $i, $val['create_date']);
            $spreadsheet->getActiveSheet()->setCellValue('AX' . $i, $val['update_time']);

            $i++;
        }

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.'案管线索-'.date("Y年m月j日").'.xlsx"');
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

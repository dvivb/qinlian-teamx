<?php

namespace backend\controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Yii;
use yii\data\Pagination;
use backend\models\CaseRecord;
use yii\web\NotFoundHttpException;

/**
 * CaseRecordController implements the CRUD actions for CaseRecord model.
 */
class CaseRecordController extends BaseController
{
	public $layout = "lte_main";

    /**
     * Lists all CaseRecord models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = CaseRecord::find();
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
        return $this->render('index', [
            'models'=>$models,
            'pages'=>$pagination,
            'query'=>$querys,
        ]);
    }

    /**
     * Displays a single CaseRecord model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        echo json_encode($model->getAttributes());

    }

    /**
     * Creates a new CaseRecord model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CaseRecord();
        if ($model->load(Yii::$app->request->post())) {
        
              if(empty($model->create_date) == true){
                  $model->create_date = 'CURRENT_TIMESTAMP';
              }
              $model->create_date = date('Y-m-d H:i:s');
        
            if($model->validate() == true && $model->save()){
                $msg = array('errno'=>0, 'msg'=>'保存成功');
                echo json_encode($msg);
            }
            else{
                $msg = array('errno'=>2, 'data'=>$model->getErrors());
                echo json_encode($msg);
            }
        } else {
            $msg = array('errno'=>2, 'msg'=>'数据出错');
            echo json_encode($msg);
        }
    }

    /**
     * Updates an existing CaseRecord model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
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
                echo json_encode($msg);
            }
            else{
                $msg = array('errno'=>2, 'data'=>$model->getErrors());
                echo json_encode($msg);
            }
        } else {
            $msg = array('errno'=>2, 'msg'=>'数据出错');
            echo json_encode($msg);
        }
    
    }

    /**
     * Deletes an existing CaseRecord model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete(array $ids)
    {
        if(count($ids) > 0){
            $c = CaseRecord::deleteAll(['in', 'id', $ids]);
            echo json_encode(array('errno'=>0, 'data'=>$c, 'msg'=>json_encode($ids)));
        }
        else{
            echo json_encode(array('errno'=>2, 'msg'=>''));
        }
    
  
    }

    /**
     * Finds the CaseRecord model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return CaseRecord the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CaseRecord::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Statistics all CaseRecord models.
     * @return mixed
     */
    public function actionStatistics()
    {
        $query = CaseRecord::find();
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

    /**
     * Import all CaseRecord models.
     * @return mixed
     */
    public function actionImports()
    {
        $query = CaseRecord::find();
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
        $inputFileName = '/data/x/teamx/qinlian/qinlian.io/backend/runtime/temp/CaseExport.xlsx';
//        $helper->log('Loading file ' . pathinfo($inputFileName, PATHINFO_BASENAME) . ' using IOFactory to identify the format');
        $spreadsheet = IOFactory::load($inputFileName);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        echo '<pre>';
        print_r($sheetData);die;
    }

    public function actionExport()
    {
        $query = CaseRecord::find();
        $data = $query
            ->all();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getActiveSheet()->setCellValue('A1', '姓名');
        $spreadsheet->getActiveSheet()->setCellValue('B1', '性别');
        $spreadsheet->getActiveSheet()->setCellValue('C1', '民族');
        $spreadsheet->getActiveSheet()->setCellValue('D1', '年龄');
        $spreadsheet->getActiveSheet()->setCellValue('E1', '政治面貌');

        $spreadsheet->getActiveSheet()->setCellValue('F1', '入党时间');
        $spreadsheet->getActiveSheet()->setCellValue('G1', '单位');
        $spreadsheet->getActiveSheet()->setCellValue('H1', '职务');
        $spreadsheet->getActiveSheet()->setCellValue('I1', '职级');
        $spreadsheet->getActiveSheet()->setCellValue('J1', '是否监察对象');

        $spreadsheet->getActiveSheet()->setCellValue('K1', '是否公务员');
        $spreadsheet->getActiveSheet()->setCellValue('L1', '线索编码');
        $spreadsheet->getActiveSheet()->setCellValue('M1', '线索人员编码');
        $spreadsheet->getActiveSheet()->setCellValue('N1', '受理时间');
        $spreadsheet->getActiveSheet()->setCellValue('O1', '办理机关');

        $spreadsheet->getActiveSheet()->setCellValue('P1', '线索来源');
        $spreadsheet->getActiveSheet()->setCellValue('Q1', '违纪类型');
        $spreadsheet->getActiveSheet()->setCellValue('R1', '违法类型');
        $spreadsheet->getActiveSheet()->setCellValue('S1', '处置方式');
        $spreadsheet->getActiveSheet()->setCellValue('T1', '线索摘要');

        $spreadsheet->getActiveSheet()->setCellValue('U1', '初核报告');
        $spreadsheet->getActiveSheet()->setCellValue('V1', '案件编码');
        $spreadsheet->getActiveSheet()->setCellValue('W1', '案件人员编码');
        $spreadsheet->getActiveSheet()->setCellValue('X1', '立案时间');
        $spreadsheet->getActiveSheet()->setCellValue('Y1', '立案机关');

        $spreadsheet->getActiveSheet()->setCellValue('Z1', '简要案情');
        $spreadsheet->getActiveSheet()->setCellValue('AA1', '立案报告');
        $spreadsheet->getActiveSheet()->setCellValue('AB1', '立案决定书');
        $spreadsheet->getActiveSheet()->setCellValue('AC1', '审查报告');
        $spreadsheet->getActiveSheet()->setCellValue('AD1', '审理受理时间');

        $spreadsheet->getActiveSheet()->setCellValue('AE1', '审理报告');
        $spreadsheet->getActiveSheet()->setCellValue('AF1', '审结时间');
        $spreadsheet->getActiveSheet()->setCellValue('AG1', '结案时间');
        $spreadsheet->getActiveSheet()->setCellValue('AH1', '党纪处分');
        $spreadsheet->getActiveSheet()->setCellValue('AI1', '政纪处分');

        $spreadsheet->getActiveSheet()->setCellValue('AJ1', '处分决定');
        $spreadsheet->getActiveSheet()->setCellValue('AK1', '移送司法时间');
        $spreadsheet->getActiveSheet()->setCellValue('AL1', '公检法受理时间');
        $spreadsheet->getActiveSheet()->setCellValue('AM1', '公检法处理内容');
        $spreadsheet->getActiveSheet()->setCellValue('AN1', '删除状态');

        $spreadsheet->getActiveSheet()->setCellValue('AO1', '创建时间');
        $spreadsheet->getActiveSheet()->setCellValue('AP1', '更新时间');

        $spreadsheet->getDefaultStyle()->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
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
        $spreadsheet->getActiveSheet()->getColumnDimension('AH')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('AI')->setWidth(16);

        $spreadsheet->getActiveSheet()->getColumnDimension('AJ')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('AK')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('AL')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('AM')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('AN')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('AO')->setWidth(16);

        $spreadsheet->getActiveSheet()->getColumnDimension('AP')->setWidth(30);

        $i = 2;
        foreach($data as $key=>$val){

            $spreadsheet->getActiveSheet()->setCellValue('A' . $i, $val['name']);
            $spreadsheet->getActiveSheet()->setCellValue('B' . $i, $val['sex']);
            $spreadsheet->getActiveSheet()->setCellValue('C' . $i, $val['nation']);
            $spreadsheet->getActiveSheet()->setCellValue('D' . $i, $val['age']);
            $spreadsheet->getActiveSheet()->setCellValue('E' . $i, $val['politics_status']);

            $spreadsheet->getActiveSheet()->setCellValue('F' . $i, $val['join_party_date']);
            $spreadsheet->getActiveSheet()->setCellValue('G' . $i, $val['organization_name']);
            $spreadsheet->getActiveSheet()->setCellValue('H' . $i, $val['duty']);
            $spreadsheet->getActiveSheet()->setCellValue('I' . $i, $val['rank']);
            $spreadsheet->getActiveSheet()->setCellValue('J' . $i, $val['is_monitor']);

            $spreadsheet->getActiveSheet()->setCellValue('K' . $i, $val['is_official']);
            $spreadsheet->getActiveSheet()->setCellValue('L' . $i, $val['clue_code']);
            $spreadsheet->getActiveSheet()->setCellValue('M' . $i, $val['clue_people_code']);
            $spreadsheet->getActiveSheet()->setCellValue('N' . $i, $val['clue_accept_time']);
            $spreadsheet->getActiveSheet()->setCellValue('O' . $i, $val['clue_manage_office']);

            $spreadsheet->getActiveSheet()->setCellValue('P' . $i, $val['clue_source']);
            $spreadsheet->getActiveSheet()->setCellValue('Q' . $i, $val['clue_violations_type']);
            $spreadsheet->getActiveSheet()->setCellValue('R' . $i, $val['clue_outlawed_type']);
            $spreadsheet->getActiveSheet()->setCellValue('S' . $i, $val['clue_disposition_method']);
            $spreadsheet->getActiveSheet()->setCellValue('T' . $i, $val['clue_summary']);

            $spreadsheet->getActiveSheet()->setCellValue('U' . $i, $val['clue_protokaryon_report']);
            $spreadsheet->getActiveSheet()->setCellValue('V' . $i, $val['case_code']);
            $spreadsheet->getActiveSheet()->setCellValue('W' . $i, $val['case_people_code']);
            $spreadsheet->getActiveSheet()->setCellValue('X' . $i, $val['case_register_time']);
            $spreadsheet->getActiveSheet()->setCellValue('Y' . $i, $val['case_register_office']);

            $spreadsheet->getActiveSheet()->setCellValue('X' . $i, $val['case_summary']);
            $spreadsheet->getActiveSheet()->setCellValue('AA' . $i, $val['case_register_report']);
            $spreadsheet->getActiveSheet()->setCellValue('AB' . $i, $val['case_register_decision']);
            $spreadsheet->getActiveSheet()->setCellValue('AC' . $i, $val['case_review_report']);
            $spreadsheet->getActiveSheet()->setCellValue('AD' . $i, $val['settle_accept_time']);

            $spreadsheet->getActiveSheet()->setCellValue('AE' . $i, $val['settle_accept_report']);
            $spreadsheet->getActiveSheet()->setCellValue('AF' . $i, $val['settle_conclude_time']);
            $spreadsheet->getActiveSheet()->setCellValue('AG' . $i, $val['settle_finish_time']);
            $spreadsheet->getActiveSheet()->setCellValue('AH' . $i, $val['settle_party_disposal']);
            $spreadsheet->getActiveSheet()->setCellValue('AI' . $i, $val['settle_political_disposal']);

            $spreadsheet->getActiveSheet()->setCellValue('AJ' . $i, $val['settle_disposal_decision']);
            $spreadsheet->getActiveSheet()->setCellValue('AK' . $i, $val['settle_judiciary_time']);
            $spreadsheet->getActiveSheet()->setCellValue('AL' . $i, $val['settle_prosecutor_time']);
            $spreadsheet->getActiveSheet()->setCellValue('AM' . $i, $val['settle_prosecutor_details']);
            $spreadsheet->getActiveSheet()->setCellValue('AN' . $i, $val['del_status']);

            $spreadsheet->getActiveSheet()->setCellValue('AO' . $i, $val['create_date']);
            $spreadsheet->getActiveSheet()->setCellValue('AP' . $i, $val['update_time']);

            $i++;
        }

        // Redirect output to a client’s web browser (Xlsx)
//        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//        header('Content-Disposition: attachment;filename="01simple.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
//        $writer->save('php://output');

        $writer->save('/data/x/teamx/qinlian/qinlian.io/backend/runtime/temp/CaseExport.xlsx');
        exit;
    }

}

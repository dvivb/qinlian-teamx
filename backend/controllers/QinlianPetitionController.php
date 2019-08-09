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
    public $enableCsrfValidation = false;

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
                        'receipt_time' =>  $value['C'],
                        'turn_number' =>  $value['D'],
                        'transfer_organ' =>  $value['E'],

                        'name_report' =>  $value['F'],
                        'name_reported' =>  $value['G'],
                        'political_appearance' =>  $value['H'],
                        'unit_job' =>  $value['I'],
                        'duty_job' =>  $value['J'],

                        'rank_job' =>  $value['K'],
                        'main_issues' =>  $value['L'],
                        'issues_properties' =>  $value['M'],
                        'petition_office_opinion' =>  $value['N'],
                        'superior_guidance_opinion' =>  $value['O'],

                        'lu_clerk_opinion' =>  $value['P'],
                        'major_leadership_approval_opinion' =>  $value['Q'],
                        'charge_leadership_approval_opinion' =>  $value['R'],
                        'host_department' =>  $value['S'],
                        'handle_results' =>  $value['T'],

                        'heavy_letter' =>  $value['U'],
                        'unit_responsibility' =>  $value['V'],
                        'approval_time' =>  $value['W'],
                        'approval_status' =>  $value['X'],
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
                            'receipt_time',
                            'turn_number',
                            'transfer_organ',
                            'name_report',
                            'name_reported',
                            'political_appearance',
                            'unit_job',
                            'duty_job',
                            'rank_job',
                            'main_issues',
                            'issues_properties',
                            'petition_office_opinion',
                            'superior_guidance_opinion',
                            'lu_clerk_opinion',
                            'major_leadership_approval_opinion',
                            'charge_leadership_approval_opinion',
                            'host_department',
                            'handle_results',
                            'heavy_letter',
                            'unit_responsibility',
                            'approval_time',
                            'approval_status',],
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
        $query = QinlianPetition::find();
        $data = $query
            ->all();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getActiveSheet()->setCellValue('A1', '编号');
        $spreadsheet->getActiveSheet()->setCellValue('B1', '收件时间');
        $spreadsheet->getActiveSheet()->setCellValue('C1', '转来编号');
        $spreadsheet->getActiveSheet()->setCellValue('D1', '转来机关');
        $spreadsheet->getActiveSheet()->setCellValue('E1', '举报人姓名');

        $spreadsheet->getActiveSheet()->setCellValue('F1', '被检举人姓名');
        $spreadsheet->getActiveSheet()->setCellValue('G1', '政治面貌');
        $spreadsheet->getActiveSheet()->setCellValue('H1', '单位');
        $spreadsheet->getActiveSheet()->setCellValue('I1', '职务（0（单位）');
        $spreadsheet->getActiveSheet()->setCellValue('J1', '职务（职级');

        $spreadsheet->getActiveSheet()->setCellValue('K1', '反映的主要问题');
        $spreadsheet->getActiveSheet()->setCellValue('L1', '问题属性');
        $spreadsheet->getActiveSheet()->setCellValue('M1', '信访室意见');
        $spreadsheet->getActiveSheet()->setCellValue('N1', '上级领导意见');
        $spreadsheet->getActiveSheet()->setCellValue('O1', '路书记批示意见');

        $spreadsheet->getActiveSheet()->setCellValue('P1', '主要领导审批意见');
        $spreadsheet->getActiveSheet()->setCellValue('Q1', '分管领导审批意见');
        $spreadsheet->getActiveSheet()->setCellValue('R1', '承办科室');
        $spreadsheet->getActiveSheet()->setCellValue('S1', '办理结果');
        $spreadsheet->getActiveSheet()->setCellValue('T1', '重信');

        $spreadsheet->getActiveSheet()->setCellValue('U1', '责任单位');
        $spreadsheet->getActiveSheet()->setCellValue('V1', '审批时间');
        $spreadsheet->getActiveSheet()->setCellValue('W1', '审批状态');
        $spreadsheet->getActiveSheet()->setCellValue('X1', '删除状态');
        $spreadsheet->getActiveSheet()->setCellValue('Y1', '创建时间');

        $spreadsheet->getActiveSheet()->setCellValue('Z1', '更新时间');


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


        $i = 2;
        foreach($data as $key=>$val){

            $spreadsheet->getActiveSheet()->setCellValue('A' . $i, $val['number']);
            $spreadsheet->getActiveSheet()->setCellValue('B' . $i, $val['receipt_time']);
            $spreadsheet->getActiveSheet()->setCellValue('C' . $i, $val['turn_number']);
            $spreadsheet->getActiveSheet()->setCellValue('D' . $i, $val['transfer_organ']);
            $spreadsheet->getActiveSheet()->setCellValue('E' . $i, $val['name_report']);

            $spreadsheet->getActiveSheet()->setCellValue('F' . $i, $val['name_reported']);
            $spreadsheet->getActiveSheet()->setCellValue('G' . $i, $val['political_appearance']);
            $spreadsheet->getActiveSheet()->setCellValue('H' . $i, $val['unit_job']);
            $spreadsheet->getActiveSheet()->setCellValue('I' . $i, $val['duty_job']);
            $spreadsheet->getActiveSheet()->setCellValue('J' . $i, $val['rank_job']);

            $spreadsheet->getActiveSheet()->setCellValue('K' . $i, $val['main_issues']);
            $spreadsheet->getActiveSheet()->setCellValue('L' . $i, $val['issues_properties']);
            $spreadsheet->getActiveSheet()->setCellValue('M' . $i, $val['petition_office_opinion']);
            $spreadsheet->getActiveSheet()->setCellValue('N' . $i, $val['superior_guidance_opinion']);
            $spreadsheet->getActiveSheet()->setCellValue('O' . $i, $val['lu_clerk_opinion']);

            $spreadsheet->getActiveSheet()->setCellValue('P' . $i, $val['major_leadership_approval_opinion']);
            $spreadsheet->getActiveSheet()->setCellValue('Q' . $i, $val['charge_leadership_approval_opinion']);
            $spreadsheet->getActiveSheet()->setCellValue('R' . $i, $val['host_department']);
            $spreadsheet->getActiveSheet()->setCellValue('S' . $i, $val['handle_results']);
            $spreadsheet->getActiveSheet()->setCellValue('T' . $i, $val['heavy_letter']);

            $spreadsheet->getActiveSheet()->setCellValue('U' . $i, $val['unit_responsibility']);
            $spreadsheet->getActiveSheet()->setCellValue('V' . $i, $val['approval_time']);
            $spreadsheet->getActiveSheet()->setCellValue('W' . $i, $val['approval_status']);
            $spreadsheet->getActiveSheet()->setCellValue('X' . $i, $val['del_status']);
            $spreadsheet->getActiveSheet()->setCellValue('Y' . $i, $val['create_date']);
            $spreadsheet->getActiveSheet()->setCellValue('Z' . $i, $val['update_time']);


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

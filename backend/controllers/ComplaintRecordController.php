<?php

namespace backend\controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Yii;
use yii\data\Pagination;
use backend\models\ComplaintRecord;
use yii\web\NotFoundHttpException;


/**
 * ComplaintRecordController implements the CRUD actions for ComplaintRecord model.
 */
class ComplaintRecordController extends BaseController
{
	public $layout = "lte_main";

    /**
     * Lists all ComplaintRecord models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = ComplaintRecord::find();
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
     * Displays a single ComplaintRecord model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        echo json_encode($model->getAttributes());

    }

    /**
     * Creates a new ComplaintRecord model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ComplaintRecord();
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
     * Updates an existing ComplaintRecord model.
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
     * Deletes an existing ComplaintRecord model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete(array $ids)
    {
        if(count($ids) > 0){
            $c = ComplaintRecord::deleteAll(['in', 'id', $ids]);
            echo json_encode(array('errno'=>0, 'data'=>$c, 'msg'=>json_encode($ids)));
        }
        else{
            echo json_encode(array('errno'=>2, 'msg'=>''));
        }
    
  
    }

    /**
     * Finds the ComplaintRecord model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ComplaintRecord the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ComplaintRecord::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Lists all ComplaintRecord models.
     * @return mixed
     */
    public function actionStatistics()
    {
        $query = ComplaintRecord::find();
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
        $inputFileName = '/data/x/teamx/qinlian/qinlian.io/backend/runtime/temp/ComplaintExport.xlsx';
//        $helper->log('Loading file ' . pathinfo($inputFileName, PATHINFO_BASENAME) . ' using IOFactory to identify the format');
        $spreadsheet = IOFactory::load($inputFileName);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        echo '<pre>';
        print_r($sheetData);die;
    }
    
    public function actionImport()
    {
        var_dump($_POST);die;
        //这里同样还是试用$_FILES来接受文件
        if (Yii::$app->request->isPost && isset($_FILES['importFile']['tmp_name'])) {
            // $objectphpExcle =new \moonland\phpexcel\Excel;//这里是我Excle的位置
             $objectphpExcle =new Spreadsheet;//这里是我Excle的位置
            try{
                $datas = $objectphpExcle->import($_FILES['importFile']['tmp_name']);
            } catch (\Exception $e) {
                return $this->ajaxResponse($e->getMessage(), 'error');
            }
               //处理的你的数据
                return $this->ajaxResponse($re, "ok"); 
        }
        return $this->ajaxResponse("文件上传失败或没有找到", "notFound");
   
    }


    public function actionExport()
    {
        $query = ComplaintRecord::find();
        $data = $query
//            ->offset($pagination->offset)
//            ->limit($pagination->limit)
            ->all();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getActiveSheet()->setCellValue('A1', '举报人姓名');
        $spreadsheet->getActiveSheet()->setCellValue('B1', '地址');
        $spreadsheet->getActiveSheet()->setCellValue('C1', '联系电话');
        $spreadsheet->getActiveSheet()->setCellValue('D1', '身份证号码');
        $spreadsheet->getActiveSheet()->setCellValue('E1', '被举报人姓名');

        $spreadsheet->getActiveSheet()->setCellValue('F1', '单位');
        $spreadsheet->getActiveSheet()->setCellValue('G1', '政治面貌');
        $spreadsheet->getActiveSheet()->setCellValue('H1', '职务');
        $spreadsheet->getActiveSheet()->setCellValue('I1', '职级');
        $spreadsheet->getActiveSheet()->setCellValue('J1', '反映的主要问题');

        $spreadsheet->getActiveSheet()->setCellValue('K1', '问题属地');
        $spreadsheet->getActiveSheet()->setCellValue('L1', '问题性质');
        $spreadsheet->getActiveSheet()->setCellValue('M1', '关键字');
        $spreadsheet->getActiveSheet()->setCellValue('N1', '领导批示时间');
        $spreadsheet->getActiveSheet()->setCellValue('O1', '批示状态');

        $spreadsheet->getActiveSheet()->setCellValue('P1', '批示意见');
        $spreadsheet->getActiveSheet()->setCellValue('Q1', '承办单位');
        $spreadsheet->getActiveSheet()->setCellValue('R1', '信访件转出时间');
        $spreadsheet->getActiveSheet()->setCellValue('S1', '删除状态');
        $spreadsheet->getActiveSheet()->setCellValue('T1', '创建时间');

        $spreadsheet->getActiveSheet()->setCellValue('U1', '更新时间');

//        $spreadsheet->getDefaultStyle()->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//        $spreadsheet->getDefaultStyle()->getAlignment()->setHorizontal(\Spreadsheet_Style_Alignment::HORIZONTAL_CENTER);
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

        $i = 2;
        foreach($data as $key=>$val){

            $spreadsheet->getActiveSheet()->setCellValue('A' . $i, $val['report_name']);
            $spreadsheet->getActiveSheet()->setCellValue('B' . $i, $val['report_address']);
            $spreadsheet->getActiveSheet()->setCellValue('C' . $i, $val['report_moblie']);
            $spreadsheet->getActiveSheet()->setCellValue('D' . $i, $val['report_idcard']);
            $spreadsheet->getActiveSheet()->setCellValue('E' . $i, $val['reported_name']);

            $spreadsheet->getActiveSheet()->setCellValue('F' . $i, $val['reported_organization_name']);
            $spreadsheet->getActiveSheet()->setCellValue('G' . $i, $val['reported_politics_status']);
            $spreadsheet->getActiveSheet()->setCellValue('H' . $i, $val['reported_duty']);
            $spreadsheet->getActiveSheet()->setCellValue('I' . $i, $val['reported_rank']);
            $spreadsheet->getActiveSheet()->setCellValue('J' . $i, $val['reported_question']);

            $spreadsheet->getActiveSheet()->setCellValue('K' . $i, $val['reported_location']);
            $spreadsheet->getActiveSheet()->setCellValue('L' . $i, $val['reported_property']);
            $spreadsheet->getActiveSheet()->setCellValue('M' . $i, $val['reported_keyword']);
            $spreadsheet->getActiveSheet()->setCellValue('N' . $i, $val['flow_instructions_time']);
            $spreadsheet->getActiveSheet()->setCellValue('O' . $i, $val['flow_instructions_status']);

            $spreadsheet->getActiveSheet()->setCellValue('P' . $i, $val['flow_instructions_opinion']);
            $spreadsheet->getActiveSheet()->setCellValue('Q' . $i, $val['reported_organizer']);
            $spreadsheet->getActiveSheet()->setCellValue('R' . $i, $val['flow_transferred_out_time']);
            $spreadsheet->getActiveSheet()->setCellValue('S' . $i, $val['del_status']);
            $spreadsheet->getActiveSheet()->setCellValue('T' . $i, $val['create_date']);

            $spreadsheet->getActiveSheet()->setCellValue('U' . $i, $val['update_time']);

            $i++;
        }

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition:attachment;filename="'.'信访档案-'.date("Y年m月j日").'.xls"');
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

        // $writer->save('/data/x/teamx/qinlian/qinlian.io/backend/runtime/temp/ComplaintExport.xlsx');
        exit;
    }
}

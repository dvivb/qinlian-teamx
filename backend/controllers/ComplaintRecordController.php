<?php

namespace backend\controllers;

use Yii;
use yii\data\Pagination;
use backend\models\ComplaintRecord;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use PHPExcel;


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
    public function actionImport()
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
    public function actionExport()
    {
        $query = ComplaintRecord::find();
        $data = $query
//            ->offset($pagination->offset)
//            ->limit($pagination->limit)
            ->all();

        $phpexcel = new \PHPExcel();

        $phpexcel->getActiveSheet()->setCellValue('A1', '举报人姓名');
        $phpexcel->getActiveSheet()->setCellValue('B1', '地址');
        $phpexcel->getActiveSheet()->setCellValue('C1', '联系电话');
        $phpexcel->getActiveSheet()->setCellValue('D1', '身份证号码');
        $phpexcel->getActiveSheet()->setCellValue('E1', '被举报人姓名');

        $phpexcel->getActiveSheet()->setCellValue('F1', '单位');
        $phpexcel->getActiveSheet()->setCellValue('G1', '政治面貌');
        $phpexcel->getActiveSheet()->setCellValue('H1', '职务');
        $phpexcel->getActiveSheet()->setCellValue('I1', '职级');
        $phpexcel->getActiveSheet()->setCellValue('J1', '反映的主要问题');

        $phpexcel->getActiveSheet()->setCellValue('K1', '问题属地');
        $phpexcel->getActiveSheet()->setCellValue('L1', '问题性质');
        $phpexcel->getActiveSheet()->setCellValue('M1', '关键字');
        $phpexcel->getActiveSheet()->setCellValue('N1', '领导批示时间');
        $phpexcel->getActiveSheet()->setCellValue('O1', '批示状态');

        $phpexcel->getActiveSheet()->setCellValue('P1', '批示意见');
        $phpexcel->getActiveSheet()->setCellValue('Q1', '承办单位');
        $phpexcel->getActiveSheet()->setCellValue('R1', '信访件转出时间');
        $phpexcel->getActiveSheet()->setCellValue('S1', '删除状态');
        $phpexcel->getActiveSheet()->setCellValue('T1', '创建时间');

        $phpexcel->getActiveSheet()->setCellValue('U1', '更新时间');

        $phpexcel->getDefaultStyle()->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpexcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
        $phpexcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
        $phpexcel->getActiveSheet()->getColumnDimension('C')->setWidth(16);
        $phpexcel->getActiveSheet()->getColumnDimension('D')->setWidth(16);
        $phpexcel->getActiveSheet()->getColumnDimension('E')->setWidth(16);

        $phpexcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
        $phpexcel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
        $phpexcel->getActiveSheet()->getColumnDimension('H')->setWidth(16);
        $phpexcel->getActiveSheet()->getColumnDimension('I')->setWidth(16);
        $phpexcel->getActiveSheet()->getColumnDimension('J')->setWidth(16);

        $phpexcel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
        $phpexcel->getActiveSheet()->getColumnDimension('L')->setWidth(12);
        $phpexcel->getActiveSheet()->getColumnDimension('M')->setWidth(16);
        $phpexcel->getActiveSheet()->getColumnDimension('N')->setWidth(16);
        $phpexcel->getActiveSheet()->getColumnDimension('O')->setWidth(16);

        $phpexcel->getActiveSheet()->getColumnDimension('P')->setWidth(30);
        $phpexcel->getActiveSheet()->getColumnDimension('Q')->setWidth(12);
        $phpexcel->getActiveSheet()->getColumnDimension('R')->setWidth(16);
        $phpexcel->getActiveSheet()->getColumnDimension('S')->setWidth(16);
        $phpexcel->getActiveSheet()->getColumnDimension('T')->setWidth(16);

        $phpexcel->getActiveSheet()->getColumnDimension('U')->setWidth(16);

        $i = 2;
        foreach($data as $key=>$val){

            $phpexcel->getActiveSheet()->setCellValue('A' . $i, $val['report_name']);
            $phpexcel->getActiveSheet()->setCellValue('B' . $i, $val['report_address']);
            $phpexcel->getActiveSheet()->setCellValue('C' . $i, $val['report_moblie']);
            $phpexcel->getActiveSheet()->setCellValue('D' . $i, $val['report_idcard']);
            $phpexcel->getActiveSheet()->setCellValue('E' . $i, $val['reported_name']);

            $phpexcel->getActiveSheet()->setCellValue('F' . $i, $val['reported_organization_name']);
            $phpexcel->getActiveSheet()->setCellValue('G' . $i, $val['reported_politics_status']);
            $phpexcel->getActiveSheet()->setCellValue('H' . $i, $val['reported_duty']);
            $phpexcel->getActiveSheet()->setCellValue('I' . $i, $val['reported_rank']);
            $phpexcel->getActiveSheet()->setCellValue('J' . $i, $val['reported_question']);

            $phpexcel->getActiveSheet()->setCellValue('K' . $i, $val['reported_location']);
            $phpexcel->getActiveSheet()->setCellValue('L' . $i, $val['reported_property']);
            $phpexcel->getActiveSheet()->setCellValue('M' . $i, $val['reported_keyword']);
            $phpexcel->getActiveSheet()->setCellValue('N' . $i, $val['flow_instructions_time']);
            $phpexcel->getActiveSheet()->setCellValue('O' . $i, $val['flow_instructions_status']);

            $phpexcel->getActiveSheet()->setCellValue('P' . $i, $val['flow_instructions_opinion']);
            $phpexcel->getActiveSheet()->setCellValue('Q' . $i, $val['reported_organizer']);
            $phpexcel->getActiveSheet()->setCellValue('R' . $i, $val['flow_transferred_out_time']);
            $phpexcel->getActiveSheet()->setCellValue('S' . $i, $val['del_status']);
            $phpexcel->getActiveSheet()->setCellValue('T' . $i, $val['create_date']);

            $phpexcel->getActiveSheet()->setCellValue('U' . $i, $val['update_time']);

            $i++;
        }

//        ob_end_clean();
//        header('Content-Type: application/vnd.ms-excel');
//        header('Content-Disposition: attachment;filename="' . $fileName . '.xlsx"');
//        header('Cache-Control: max-age=0');
//        $objWriter = \PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
//        $objWriter->save('php://output');

        ob_end_clean();
        ob_start();

        header('Content-Type : application/vnd.ms-excel');
        header('Content-Disposition:attachment;filename="'.'信访档案-'.date("Y年m月j日").'.xls"');
        $objWriter = \PHPExcel_IOFactory::createWriter($phpexcel,'Excel5');
        $objWriter->save('php://output');
    }
}

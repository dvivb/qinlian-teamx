<?php

namespace backend\controllers;

use Yii;
use yii\data\Pagination;
use backend\models\CaseRecord;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use PHPExcel;

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
        $query = CaseRecord::find();
        $data = $query
//            ->offset($pagination->offset)
//            ->limit($pagination->limit)
            ->all();

        $phpexcel = new \PHPExcel();

        $phpexcel->getActiveSheet()->setCellValue('A1', '姓名');
        $phpexcel->getActiveSheet()->setCellValue('B1', '性别');
        $phpexcel->getActiveSheet()->setCellValue('C1', '民族');
        $phpexcel->getActiveSheet()->setCellValue('D1', '年龄');
        $phpexcel->getActiveSheet()->setCellValue('E1', '政治面貌');

        $phpexcel->getActiveSheet()->setCellValue('F1', '入党时间');
        $phpexcel->getActiveSheet()->setCellValue('G1', '单位');
        $phpexcel->getActiveSheet()->setCellValue('H1', '职务');
        $phpexcel->getActiveSheet()->setCellValue('I1', '职级');
        $phpexcel->getActiveSheet()->setCellValue('J1', '是否监察对象');

        $phpexcel->getActiveSheet()->setCellValue('K1', '是否公务员');
        $phpexcel->getActiveSheet()->setCellValue('L1', '线索编码');
        $phpexcel->getActiveSheet()->setCellValue('M1', '线索人员编码');
        $phpexcel->getActiveSheet()->setCellValue('N1', '受理时间');
        $phpexcel->getActiveSheet()->setCellValue('O1', '办理机关');

        $phpexcel->getActiveSheet()->setCellValue('P1', '线索来源');
        $phpexcel->getActiveSheet()->setCellValue('Q1', '违纪类型');
        $phpexcel->getActiveSheet()->setCellValue('R1', '违法类型');
        $phpexcel->getActiveSheet()->setCellValue('S1', '处置方式');
        $phpexcel->getActiveSheet()->setCellValue('T1', '线索摘要');

        $phpexcel->getActiveSheet()->setCellValue('U1', '初核报告');
        $phpexcel->getActiveSheet()->setCellValue('V1', '案件编码');
        $phpexcel->getActiveSheet()->setCellValue('W1', '案件人员编码');
        $phpexcel->getActiveSheet()->setCellValue('X1', '立案时间');
        $phpexcel->getActiveSheet()->setCellValue('Y1', '立案机关');

        $phpexcel->getActiveSheet()->setCellValue('Z1', '简要案情');
        $phpexcel->getActiveSheet()->setCellValue('AA1', '立案报告');
        $phpexcel->getActiveSheet()->setCellValue('AB1', '立案决定书');
        $phpexcel->getActiveSheet()->setCellValue('AC1', '审查报告');
        $phpexcel->getActiveSheet()->setCellValue('AD1', '审理受理时间');

        $phpexcel->getActiveSheet()->setCellValue('AE1', '审理报告');
        $phpexcel->getActiveSheet()->setCellValue('AF1', '审结时间');
        $phpexcel->getActiveSheet()->setCellValue('AG1', '结案时间');
        $phpexcel->getActiveSheet()->setCellValue('AH1', '党纪处分');
        $phpexcel->getActiveSheet()->setCellValue('AI1', '政纪处分');

        $phpexcel->getActiveSheet()->setCellValue('AJ1', '处分决定');
        $phpexcel->getActiveSheet()->setCellValue('AK1', '移送司法时间');
        $phpexcel->getActiveSheet()->setCellValue('AL1', '公检法受理时间');
        $phpexcel->getActiveSheet()->setCellValue('AM1', '公检法处理内容');
        $phpexcel->getActiveSheet()->setCellValue('AN1', '删除状态');

        $phpexcel->getActiveSheet()->setCellValue('AO1', '创建时间');
        $phpexcel->getActiveSheet()->setCellValue('AP1', '更新时间');

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
        $phpexcel->getActiveSheet()->getColumnDimension('V')->setWidth(16);
        $phpexcel->getActiveSheet()->getColumnDimension('W')->setWidth(16);
        $phpexcel->getActiveSheet()->getColumnDimension('X')->setWidth(16);
        $phpexcel->getActiveSheet()->getColumnDimension('Y')->setWidth(16);

        $phpexcel->getActiveSheet()->getColumnDimension('X')->setWidth(16);
        $phpexcel->getActiveSheet()->getColumnDimension('AA')->setWidth(16);
        $phpexcel->getActiveSheet()->getColumnDimension('AB')->setWidth(16);
        $phpexcel->getActiveSheet()->getColumnDimension('AC')->setWidth(16);
        $phpexcel->getActiveSheet()->getColumnDimension('AD')->setWidth(16);

        $phpexcel->getActiveSheet()->getColumnDimension('AE')->setWidth(16);
        $phpexcel->getActiveSheet()->getColumnDimension('AF')->setWidth(30);
        $phpexcel->getActiveSheet()->getColumnDimension('AG')->setWidth(12);
        $phpexcel->getActiveSheet()->getColumnDimension('AH')->setWidth(16);
        $phpexcel->getActiveSheet()->getColumnDimension('AI')->setWidth(16);

        $phpexcel->getActiveSheet()->getColumnDimension('AJ')->setWidth(16);
        $phpexcel->getActiveSheet()->getColumnDimension('AK')->setWidth(30);
        $phpexcel->getActiveSheet()->getColumnDimension('AL')->setWidth(12);
        $phpexcel->getActiveSheet()->getColumnDimension('AM')->setWidth(16);
        $phpexcel->getActiveSheet()->getColumnDimension('AN')->setWidth(16);
        $phpexcel->getActiveSheet()->getColumnDimension('AO')->setWidth(16);

        $phpexcel->getActiveSheet()->getColumnDimension('AP')->setWidth(30);

        $i = 2;
        foreach($data as $key=>$val){

            $phpexcel->getActiveSheet()->setCellValue('A' . $i, $val['name']);
            $phpexcel->getActiveSheet()->setCellValue('B' . $i, $val['sex']);
            $phpexcel->getActiveSheet()->setCellValue('C' . $i, $val['nation']);
            $phpexcel->getActiveSheet()->setCellValue('D' . $i, $val['age']);
            $phpexcel->getActiveSheet()->setCellValue('E' . $i, $val['politics_status']);

            $phpexcel->getActiveSheet()->setCellValue('F' . $i, $val['join_party_date']);
            $phpexcel->getActiveSheet()->setCellValue('G' . $i, $val['organization_name']);
            $phpexcel->getActiveSheet()->setCellValue('H' . $i, $val['duty']);
            $phpexcel->getActiveSheet()->setCellValue('I' . $i, $val['rank']);
            $phpexcel->getActiveSheet()->setCellValue('J' . $i, $val['is_monitor']);

            $phpexcel->getActiveSheet()->setCellValue('K' . $i, $val['is_official']);
            $phpexcel->getActiveSheet()->setCellValue('L' . $i, $val['clue_code']);
            $phpexcel->getActiveSheet()->setCellValue('M' . $i, $val['clue_people_code']);
            $phpexcel->getActiveSheet()->setCellValue('N' . $i, $val['clue_accept_time']);
            $phpexcel->getActiveSheet()->setCellValue('O' . $i, $val['clue_manage_office']);

            $phpexcel->getActiveSheet()->setCellValue('P' . $i, $val['clue_source']);
            $phpexcel->getActiveSheet()->setCellValue('Q' . $i, $val['clue_violations_type']);
            $phpexcel->getActiveSheet()->setCellValue('R' . $i, $val['clue_outlawed_type']);
            $phpexcel->getActiveSheet()->setCellValue('S' . $i, $val['clue_disposition_method']);
            $phpexcel->getActiveSheet()->setCellValue('T' . $i, $val['clue_summary']);

            $phpexcel->getActiveSheet()->setCellValue('U' . $i, $val['clue_protokaryon_report']);
            $phpexcel->getActiveSheet()->setCellValue('V' . $i, $val['case_code']);
            $phpexcel->getActiveSheet()->setCellValue('W' . $i, $val['case_people_code']);
            $phpexcel->getActiveSheet()->setCellValue('X' . $i, $val['case_register_time']);
            $phpexcel->getActiveSheet()->setCellValue('Y' . $i, $val['case_register_office']);

            $phpexcel->getActiveSheet()->setCellValue('X' . $i, $val['case_summary']);
            $phpexcel->getActiveSheet()->setCellValue('AA' . $i, $val['case_register_report']);
            $phpexcel->getActiveSheet()->setCellValue('AB' . $i, $val['case_register_decision']);
            $phpexcel->getActiveSheet()->setCellValue('AC' . $i, $val['case_review_report']);
            $phpexcel->getActiveSheet()->setCellValue('AD' . $i, $val['settle_accept_time']);

            $phpexcel->getActiveSheet()->setCellValue('AE' . $i, $val['settle_accept_report']);
            $phpexcel->getActiveSheet()->setCellValue('AF' . $i, $val['settle_conclude_time']);
            $phpexcel->getActiveSheet()->setCellValue('AG' . $i, $val['settle_finish_time']);
            $phpexcel->getActiveSheet()->setCellValue('AH' . $i, $val['settle_party_disposal']);
            $phpexcel->getActiveSheet()->setCellValue('AI' . $i, $val['settle_political_disposal']);

            $phpexcel->getActiveSheet()->setCellValue('AJ' . $i, $val['settle_disposal_decision']);
            $phpexcel->getActiveSheet()->setCellValue('AK' . $i, $val['settle_judiciary_time']);
            $phpexcel->getActiveSheet()->setCellValue('AL' . $i, $val['settle_prosecutor_time']);
            $phpexcel->getActiveSheet()->setCellValue('AM' . $i, $val['settle_prosecutor_details']);
            $phpexcel->getActiveSheet()->setCellValue('AN' . $i, $val['del_status']);

            $phpexcel->getActiveSheet()->setCellValue('AO' . $i, $val['create_date']);
            $phpexcel->getActiveSheet()->setCellValue('AP' . $i, $val['update_time']);

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
var_dump($phpexcel);echo 1;die;
        header('Content-Type : application/vnd.ms-excel');
        header('Content-Disposition:attachment;filename="'.'案件信息-'.date("Y年m月j日").'.xls"');
        $objWriter = \PHPExcel_IOFactory::createWriter($phpexcel,'Excel5');
        $objWriter->save('php://output');
    }


}

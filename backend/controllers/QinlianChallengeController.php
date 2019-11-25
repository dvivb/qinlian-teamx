<?php

namespace backend\controllers;

use backend\services\QinlianChallengeService;
use Yii;
use yii\data\Pagination;
use backend\models\QinlianChallenge;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
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

        $departments = $this->getDepartment();
        return $this->render('index', [
            'models'=>$models,
            'pages'=>$pagination,
            'query'=>$querys,
            'departments'=>$departments,
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
        $query = Yii::$app->request->post();
//        var_dump($query);die;
        $ps = new QinlianChallengeService();
        $req = $ps->getStat($query);
        $group = ArrayHelper::getColumn($req['group'],'progress_case');
        $category = ArrayHelper::getColumn($req['category'],'yearmonth');
        $all_data = ArrayHelper::map($req['all_data'],'yearmonth', 'count_total', 'progress_case');
        $data['name'] = $group;
        $data['category'] = $category;
        $data['all_data'] = $all_data;

        $category_def = [];
        foreach ($data['category'] as $key => $val){
            $category_def[$val] = 0;
        }

        $new_all_data = [];
        foreach ($data['all_data'] as $key =>$val){
            $new_val = $category_def;
            foreach ($val as $k => $v){
                $new_val[$k] =  $v;
            }
            $new_all_data[$key] = $new_val;
        }

        $series_bar = [];
        $series_line = [];
        foreach ($new_all_data as $key => $val){
            $serie['name'] = $key;
            $serie['type'] = 'bar';
            $serie['data'] =  array_values($val);
            $series_bar[] = $serie;
            $serie['type'] = 'line';
            $series_line[] = $serie;
        }

        $data['series_bar'] = $series_bar;
        $data['series_line'] = $series_line;

        $data['all_data'] = $new_all_data;
//        return json_encode($data,true);
        return $this->render('statistics', [
            'data' => $data,
            'query' => $query,
            'departments'=> $this->getDepartment(),
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
                    if(!empty( $value['A'])){
                        $data[] = [
    //                        'id' =>  $value['A'],
                            'number' =>  $value['A'],
                            'incoming_time' =>  $value['B'],
                            'clue_level' =>  $value['C'],
                            'clue_category' =>  $value['D'],

                            'clue_source' =>  $value['E'],
                            'letter_number' =>  $value['F'],
                            'signature' =>  $value['G'],
                            'leader_instructions' =>  $value['H'],
                            'respondent_unit' =>  $value['I'],

                            'duty_job' =>  $value['J'],
                            'rank_job' =>  $value['K'],
                            'main_issues' =>  $value['L'],
                            'related_unit' =>  $value['M'],
                            'heavy_cases' =>  $value['N'],

                            'date_receipt' =>  $value['O'],
                            'transfer_organ' =>  $value['P'],
                            'results' =>  $value['Q'],
                            'supervisory_leadership' =>  $value['R'],
                            'host_department' =>  $value['S'],

                            'progress_case' =>  $value['T'],
                            'investigation_disposal' =>  $value['U'],
                            'remarks' =>  $value['V'],
                            'number_disposals' =>  $value['W'],
                            'organizations_number' =>  $value['X'],

                            'first_form' =>  $value['Y'],
                            'second_form' =>  $value['Z'],
                            'third_form' =>  $value['AA'],
                            'fourth_form' =>  $value['AB'],

                            'is_thread_disposal' =>  empty($value['AC']) ? '' : $value['AC'],
                            'disposal_method' =>  empty($value['AD']) ? '' : $value['AD'],
                            'volume_number' =>  empty($value['AE']) ? '' : $value['AE'],
                            'id_card' =>  empty($value['AF']) ? '' : $value['AF'],
                            'disposal_year' =>  empty($value['AG']) ? '' : $value['AG'],
                        ];
                    }
                }
            }
//var_dump($data);die;
            if (isset($data)) {
                $transaction = Yii::$app->getDb()->beginTransaction();
                try {
                    $model = new QinlianChallenge();
                    Yii::$app->db->createCommand()
                        ->batchInsert($model::tableName(),[
//                            'id',
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

                            'is_thread_disposal',
                            'disposal_method',
                            'volume_number',
                            'id_card',
                            'disposal_year'
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
        $spreadsheet->getActiveSheet()->mergeCells('A1:AG2')->setCellValue('A1', date('Y'). '案管问题导出数据');
        $spreadsheet->getActiveSheet()->setCellValue('A3', '序号');
        $spreadsheet->getActiveSheet()->setCellValue('B3', '来件时间');
        $spreadsheet->getActiveSheet()->setCellValue('C3', '线索级别');
        $spreadsheet->getActiveSheet()->setCellValue('D3', '线索类别');
        $spreadsheet->getActiveSheet()->setCellValue('E3', '线索来源');

        $spreadsheet->getActiveSheet()->setCellValue('F3', '信件编号');
        $spreadsheet->getActiveSheet()->setCellValue('G3', '署名情况');
        $spreadsheet->getActiveSheet()->setCellValue('H3', '领导批示');
        $spreadsheet->getActiveSheet()->setCellValue('I3', '被反映人（单位）');
        $spreadsheet->getActiveSheet()->setCellValue('J3', '职务');

        $spreadsheet->getActiveSheet()->setCellValue('K3', '职级');
        $spreadsheet->getActiveSheet()->setCellValue('L3', '反映的主要问题');
        $spreadsheet->getActiveSheet()->setCellValue('M3', '涉及单位');
        $spreadsheet->getActiveSheet()->setCellValue('N3', '重件情况');
        $spreadsheet->getActiveSheet()->setCellValue('O3', '接到日期');

        $spreadsheet->getActiveSheet()->setCellValue('P3', '处置方式');
        $spreadsheet->getActiveSheet()->setCellValue('Q3', '要结果情况');
        $spreadsheet->getActiveSheet()->setCellValue('R3', '督办领导');
        $spreadsheet->getActiveSheet()->setCellValue('S3', '办理科室');
        $spreadsheet->getActiveSheet()->setCellValue('T3', '案件进度');

        $spreadsheet->getActiveSheet()->setCellValue('U3', '查处情况');
        $spreadsheet->getActiveSheet()->setCellValue('V3', '备注');
        $spreadsheet->getActiveSheet()->setCellValue('W3', '处分人数');
        $spreadsheet->getActiveSheet()->setCellValue('X3', '问题属性');
        $spreadsheet->getActiveSheet()->setCellValue('Y3', '第一种形态');

        $spreadsheet->getActiveSheet()->setCellValue('Z3', '第二种形态');
        $spreadsheet->getActiveSheet()->setCellValue('AA3', '第三种形态');
        $spreadsheet->getActiveSheet()->setCellValue('AB3', '第四种形态');


        $spreadsheet->getActiveSheet()->setCellValue('AC3', '作为线索处置');
        $spreadsheet->getActiveSheet()->setCellValue('AD3', '处置方式');
        $spreadsheet->getActiveSheet()->setCellValue('AE3', '卷本数');
        $spreadsheet->getActiveSheet()->setCellValue('AF3', '身份证号');
        $spreadsheet->getActiveSheet()->setCellValue('AG3', '处置年份');



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
        $spreadsheet->getActiveSheet()->getColumnDimension('AF')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('AG')->setWidth(16);


        $i = 4;
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

            $spreadsheet->getActiveSheet()->setCellValue('AC' . $i, $val['is_thread_disposal']);
            $spreadsheet->getActiveSheet()->setCellValue('AD' . $i, $val['disposal_method']);
            $spreadsheet->getActiveSheet()->setCellValue('AE' . $i, $val['volume_number']);
            $spreadsheet->getActiveSheet()->setCellValue('AF' . $i, $val['id_card']);
            $spreadsheet->getActiveSheet()->setCellValue('AG' . $i, $val['disposal_year']);

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

    /**
     * Displays a single QinlianChallenge model.
     * @param integer $id
     * @return mixed
     */
    public function actionPrint($id)
    {
        $model = $this->findModel($id);
        return $this->render('print', [
            'model'=>$model,
        ]);
    }

    /**
     * Displays a single QinlianChallenge model.
     * @param integer $id
     * @return mixed
     */
    public function actionPrintb($id)
    {
        $model = $this->findModel($id);
        return $this->render('printb', [
            'model'=>$model,
        ]);
    }
}

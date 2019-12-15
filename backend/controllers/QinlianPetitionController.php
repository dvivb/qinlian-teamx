<?php

namespace backend\controllers;

use backend\models\QinlianAnnex;
use backend\models\QinlianUplaod;
use backend\models\UploadForm;
use backend\services\QinlianPetitionService;
use Faker\Provider\Uuid;
use Yii;
use yii\data\Pagination;
use backend\models\QinlianPetition;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use yii\web\UploadedFile;

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


    public function actionStatistics()
    {
        $query = Yii::$app->request->post();
        $ps = new QinlianPetitionService();
        $req = $ps->getStat($query);
        $group = ArrayHelper::getColumn($req['group'],'host_department');
        $category = ArrayHelper::getColumn($req['category'],'yearmonth');
        $all_data = ArrayHelper::map($req['all_data'],'yearmonth', 'count_total', 'host_department');

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
                if ($key>2){
//                    var_dump($value);die;
                    if(!empty( $value['A'])){
                        $data[] = [
    //                        'id' =>  $value['A'],
                            'number' =>  $value['A'],
                            'receipt_time' =>  $value['B'],
                            'turn_number' =>  $value['C'],
                            'transfer_organ' =>  $value['D'],

                            'name_report' =>  $value['E'],
                            'name_reported' =>  $value['F'],
                            'political_appearance' =>  $value['G'],
                            'unit_job' =>  $value['H'],
                            'duty_job' =>  $value['I'],

                            'rank_job' =>  $value['J'],
                            'main_issues' =>  $value['K'],
                            'issues_properties' =>  $value['L'],
                            'petition_office_opinion' =>  $value['M'],
                            'superior_guidance_opinion' =>  $value['N'],

                            'lu_clerk_opinion' =>  $value['O'],
                            'major_leadership_approval_opinion' =>  $value['P'],
                            'charge_leadership_approval_opinion' =>  $value['Q'],
                            'host_department' =>  $value['R'],
                            'handle_results' =>  $value['S'],

                            'heavy_letter' =>  $value['T'],
                            'unit_responsibility' =>  $value['U'],
    //                        'approval_time' =>  $value['W'],
    //                        'approval_status' =>  $value['X'],
//
                            'is_thread_disposal' =>  empty($value['AB']) ? '' : $value['AB'],
                            'disposal_method' =>  empty($value['AA']) ? '' : $value['AA'],
                            'volume_number' =>  empty($value['AC']) ? '' : $value['AC'],
                            'id_card' =>  empty($value['AD']) ? '' : $value['AD'],
                            'disposal_year' =>  empty($value['AE']) ? '' : $value['AE'],

                        ];
                    }
                }
            }
//var_dump($data);die;
            if (isset($data)) {
                $transaction = Yii::$app->getDb()->beginTransaction();
                try {
                    $model = new QinlianPetition();
                    Yii::$app->db->createCommand()
                        ->batchInsert($model::tableName(),[
//                            'id',
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
//                            'approval_time',
//                            'approval_status',

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
        $query = QinlianPetition::find();
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
        $data = $query->limit(1000)->all();

        $spreadsheet = new Spreadsheet();
        $spreadsheet->getActiveSheet()->mergeCells('A1:Z1')->setCellValue('A1', date('Y'). '信访信息导出数据');
        $spreadsheet->getActiveSheet()->setCellValue('A2', '编号');
        $spreadsheet->getActiveSheet()->setCellValue('B2', '收件时间');
        $spreadsheet->getActiveSheet()->setCellValue('C2', '转来编号');
        $spreadsheet->getActiveSheet()->setCellValue('D2', '转来机关');
        $spreadsheet->getActiveSheet()->setCellValue('E2', '举报人姓名');

        $spreadsheet->getActiveSheet()->setCellValue('F2', '被检举人姓名');
        $spreadsheet->getActiveSheet()->setCellValue('G2', '政治面貌');
        $spreadsheet->getActiveSheet()->setCellValue('H2', '单位');
        $spreadsheet->getActiveSheet()->setCellValue('I2', '职务');
        $spreadsheet->getActiveSheet()->setCellValue('J2', '职级');

        $spreadsheet->getActiveSheet()->setCellValue('K2', '反映的主要问题');
        $spreadsheet->getActiveSheet()->setCellValue('L2', '问题属性');
        $spreadsheet->getActiveSheet()->setCellValue('M2', '信访室意见');
        $spreadsheet->getActiveSheet()->setCellValue('N2', '上级领导意见');
        $spreadsheet->getActiveSheet()->setCellValue('O2', '路书记批示意见');

        $spreadsheet->getActiveSheet()->setCellValue('P2', '主要领导审批意见');
        $spreadsheet->getActiveSheet()->setCellValue('Q2', '分管领导审批意见');
        $spreadsheet->getActiveSheet()->setCellValue('R2', '承办科室');
        $spreadsheet->getActiveSheet()->setCellValue('S2', '办理结果');
        $spreadsheet->getActiveSheet()->setCellValue('T2', '重信');

        $spreadsheet->getActiveSheet()->setCellValue('U2', '责任单位');
        $spreadsheet->getActiveSheet()->setCellValue('V2', '审批时间');
        $spreadsheet->getActiveSheet()->setCellValue('W2', '审批状态');
        $spreadsheet->getActiveSheet()->setCellValue('X2', '删除状态');
        $spreadsheet->getActiveSheet()->setCellValue('Y2', '创建时间');

        $spreadsheet->getActiveSheet()->setCellValue('Z2', '更新时间');

        $spreadsheet->getActiveSheet()->setCellValue('AA2', '作为线索处置');
        $spreadsheet->getActiveSheet()->setCellValue('AB2', '处置方式');
        $spreadsheet->getActiveSheet()->setCellValue('AC2', '卷本数');
        $spreadsheet->getActiveSheet()->setCellValue('AD2', '身份证号');
        $spreadsheet->getActiveSheet()->setCellValue('AE2', '处置年份');


//         $spreadsheet->getDefaultStyle()->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
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


        $i = 3;
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

            $spreadsheet->getActiveSheet()->setCellValue('AA' . $i, $val['is_thread_disposal']);
            $spreadsheet->getActiveSheet()->setCellValue('AB' . $i, $val['disposal_method']);
            $spreadsheet->getActiveSheet()->setCellValue('AC' . $i, $val['volume_number']);
            $spreadsheet->getActiveSheet()->setCellValue('AD' . $i, $val['id_card']);
            $spreadsheet->getActiveSheet()->setCellValue('AE' . $i, $val['disposal_year']);


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


    /**
     * Displays a single QinlianPetition model.
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
     * Displays a single QinlianPetition model.
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

    /**
     * Displays a single QinlianPetition model.
     * @param integer $id
     * @return mixed
     */
    public function actionPrintc($id)
    {
        $model = $this->findModel($id);
        return $this->render('printc', [
            'model'=>$model,
        ]);
    }


    public function actionAnnex($table_id, $type, $number)
    {
        $query = QinlianAnnex::find();
        $querys = Yii::$app->request->get('query');

        $parame = array();

        $condition['table_id'] = $table_id;
        $condition['type'] = $type;
        $query = $query->where($condition, $parame);

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

        $querys['number'] = $number;
        $querys['type'] = $type;
        $querys['table_id'] = $table_id;
        return $this->render('annex', [
            'models'=>$models,
            'pages'=>$pagination,
            'query'=>$querys,
        ]);
    }

    /**
     * Creates a new QinlianPetition model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAnnexCreate()
    {
        $model = new QinlianAnnex();
       if (!$model->load(Yii::$app->request->post())) {

            $param = Yii::$app->request->post();

            $model->number = $param['number'];
            $model->type = $param['type'];
            $model->table_id = $param['table_id'];
            $model->code = time();
            $model->catalog = $param['catalog'];

            $code = time();
            $model->page = $code;

            if(empty($model->code) == true){
                $model->code = 'CURRENT_TIMESTAMP';
            }
            if(empty($model->update_time) == true){
                $model->update_time = 'CURRENT_TIMESTAMP';
            }
            if(empty($model->create_date) == true){
                $model->create_date = 'CURRENT_TIMESTAMP';
            }
            $model->update_time = date('Y-m-d H:i:s');
            $model->create_date = date('Y-m-d H:i:s');

            if($model->validate() == true && $model->save()){

                $UploadedFile = new UploadedFile();
                $files = $UploadedFile::getInstancesByName('url');
                $this->uplaodInstal($model->id, '1', $files, $code);

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
    public function actionAnnexDelete($id)
    {
        if(count($id) > 0){
            $c = QinlianAnnex::deleteAll(['in', 'id', $id]);
            return $this->asJson(array('errno'=>0, 'data'=>$c, 'msg'=>json_encode($id)));
        }
        else{
            return $this->asJson(array('errno'=>2, 'msg'=>''));
        }
    }

    private function uplaodInstal($table_id, $table_name, $files, $code)
    {
        $model = new QinlianUplaod();
        $model->code = $code;
        $file_path = __DIR__ . '/../web/uplaod/';
        foreach($files as $file) {
            $model->isNewRecord = true;
            $model->table_id    = $table_id;
            $model->table_name  = $table_name;

            $code = Uuid::uuid();
            $file_name = $code . '.'. $file->getExtension();
            if ($file->saveAs($file_path . $file_name)) {
                $model->url = $file_name;
            }
            $model->save() && $model->id = 0;
        }
    }

    public function actionFiles($table_id, $table_name)
    {
        $query = QinlianUplaod::find();
        $querys = Yii::$app->request->get('query');

        $parame = array();

        $condition['table_id'] = $table_id;
        $condition['table_name'] = $table_name;
        $query = $query->where($condition, $parame);

        $pagination = new Pagination([
                'totalCount' =>$query->count(),
                'pageSize' => '10',
                'pageParam'=>'page',
                'pageSizeParam'=>'per-page']
        );

        $orderby = Yii::$app->request->get('orderby', 'id');
        if(empty($orderby) == false){
            $query = $query->orderBy($orderby);
        }


        $models = $query
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        $querys['table_id'] = $table_id;
        $querys['table_name'] = $table_name;
        return $this->render('files', [
            'models'=>$models,
            'pages'=>$pagination,
            'query'=>$querys,
        ]);
    }
}

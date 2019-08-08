<?php

namespace backend\controllers;

use Yii;
use yii\data\Pagination;
use backend\models\QinlianRegister;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

/**
 * QinlianRegisterController implements the CRUD actions for QinlianRegister model.
 */
class QinlianRegisterController extends BaseController
{
	public $layout = "lte_main";

    /**
     * Lists all QinlianRegister models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = QinlianRegister::find();
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
     * Displays a single QinlianRegister model.
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
     * Creates a new QinlianRegister model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new QinlianRegister();
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
     * Updates an existing QinlianRegister model.
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
     * Deletes an existing QinlianRegister model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete(array $ids)
    {
        if(count($ids) > 0){
            $c = QinlianRegister::deleteAll(['in', 'id', $ids]);
            return $this->asJson(array('errno'=>0, 'data'=>$c, 'msg'=>json_encode($ids)));
        }
        else{
            return $this->asJson(array('errno'=>2, 'msg'=>''));
        }
    }

	
	 

    /**
     * Finds the QinlianRegister model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return QinlianRegister the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = QinlianRegister::findOne($id)) !== null) {
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
        $query = QinlianRegister::find();
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
                        'nuit_name' =>  $value['A'],
                        'nuit_code' =>  $value['B'],
                        'is_nuit' =>  $value['C'],
                        'case_code' =>  $value['D'],
                        'personnel_code' =>  $value['E'],
                        'person_investigated' =>  $value['F'],
                        'credentials_type' =>  $value['G'],
                        'credentials_number' =>  $value['H'],
                        'sex' =>  $value['I'],
                        'age' =>  $value['J'],
                        'date_birth' =>  $value['K'],
                        'academic' =>  $value['L'],
                        'nation' =>  $value['M'],
                        'is_supervises_object' =>  $value['N'],
                        'supervises_object_details' =>  $value['O'],
                        'is_party' =>  $value['P'],
                        'party_delegate' =>  $value['Q'],
                        'disposal_report' =>  $value['R'],
                        'time_joining_party' =>  $value['S'],
                        'no_party_objects' =>  $value['T'],
                        'no_party_objects_details' =>  $value['U'],
                        'cpc' =>  $value['V'],
                        'cppcc' =>  $value['W'],
                        'discipline_commission' =>  $value['X'],
                        'party_commission' =>  $value['Y'],
                        'on_job_time' =>  $value['Z'],

                        'head_violating' =>  $value['AA'],
                        'head_details' =>  $value['AB'],
                        'head_details_two' =>  $value['AC'],
                        'rank_job' =>  $value['AD'],
                        'deputy_rank_job' =>  $value['AE'],
                        'duty_job' =>  $value['AF'],
                        'authority_management' =>  $value['AG'],
                        'department_class' =>  $value['AH'],
                        'department_class_one' =>  $value['AI'],
                        'department_classtwo' =>  $value['AJ'],
                        'nature_enterprise' =>  $value['AK'],
                        'nature_enterprise_one' =>  $value['AL'],
                        'category_enterprise_personnel' =>  $value['AM'],
                        'enterprise_post' =>  $value['AN'],
                        'jobbery_lose' =>  $value['AO'],
                        'discipline_amount' =>  $value['AP'],
                        'case_amount' =>  $value['AQ'],
                        'filing_time' =>  $value['AR'],
                        'source_case' =>  $value['AS'],
                        'discipline_organ' =>  $value['AT'],
                        'discipline_organ_time' =>  $value['AU'],
                        'discipline_organ_stats_time' =>  $value['AV'],
                        'supervise_register_organ' =>  $value['AW'],
                        'supervise_register_time' =>  $value['AX'],
                        'supervise_register_statistics_time' =>  $value['AY'],
                        'is_discipline_transfer' =>  $value['AZ'],

                        'other_discipline_method' =>  $value['BA'],
                        'transfer_unit' =>  $value['BB'],
                        'brief_case_report' =>  $value['BC'],
                        'register_report' =>  $value['BD'],
                        'register_decide_book' =>  $value['BE'],
                        'remarks' =>  $value['BF'],
                        'is_violate_stipulate' =>  $value['BG'],
                        'is_accountabilitye' =>  $value['BH'],
                        'end_case_stat_time' =>  $value['BI'],
                        'close_case_time' =>  $value['BJ'],
                        'end_case_time' =>  $value['BK'],
                        'accountability' =>  $value['BL'],
                        'party_discipline' =>  $value['BM'],
                        'party_discipline_stats_time' =>  $value['BN'],
                        'administrative_sanction' =>  $value['BO'],
                        'administrative_sanction_stats_time' =>  $value['BP'],
                        'other_treatments' =>  $value['BQ'],
                        'other_treatments_stats_time' =>  $value['BR'],
                        'transfer_justice_time' =>  $value['BS'],
                        'transfer_justice_stats_time' =>  $value['BT'],
                        'public_inspection_processing' =>  $value['BU'],
                        'public_inspection_processing_detail' =>  $value['BV'],
                        'punishments_number_years' =>  $value['BW'],
                        'punishments_number_month' =>  $value['BX'],
                        'probation_number_years' =>  $value['BY'],
                        'probation_number_month' =>  $value['BZ'],

                        'public_inspection_processing_stats_time' =>  $value['CA'],
                        'retrieve_loss' =>  $value['CB'],
                        'capture_amount' =>  $value['CC'],
                        'first_violations_discipline_time' =>  $value['CD'],
                        'last_violations_discipline_time' =>  $value['CE'],
                        'violation_discipline_happen_time' =>  $value['CF'],
                        'desert_time' =>  $value['CG'],
                        'desert_stats_time' =>  $value['CH'],
                        'hear_accept_time' =>  $value['CI'],
                        'hear_accept_stats_time' =>  $value['CJ'],
                        'hear_office' =>  $value['CK'],
                        'hear_end_time' =>  $value['CL'],
                        'hear_end_stats_time' =>  $value['CM'],
                        'punish_decide' =>  $value['CN'],
                        'police_handle_time' =>  $value['CO'],
                        'judicial_judgment_amount' =>  $value['CP'],
                        'investigation_report' =>  $value['CQ'],
                        'trial_report' =>  $value['CR'],
                        'case_analysis' =>  $value['CS'],
                        'party_watch_limit' =>  $value['CT'],
                        'enterprise_level' =>  $value['CU'],
                        'flight_direction' =>  $value['CV'],
                        'flight_direction_details' =>  $value['CW'],
                        'investigation_suspension_time' =>  $value['CX'],
                        'investigation_suspension_stats_time' =>  $value['CY'],
                        'administrative_sanctions_suspension_time' =>  $value['CZ'],

                        'administrative_sanctions_suspension_stats_time' =>  $value['DA'],
                        'seizure_time' =>  $value['DB'],
                        'seizure_stats_time' =>  $value['DC'],
                        'case_analysis_time' =>  $value['DD'],
                        'disciplinary_offence' =>  $value['DE'],
                        'post_disciplinary_offence' =>  $value['DF'],
                        'other_disciplinary_offence' =>  $value['DG'],
                        'organs_take_measures' =>  $value['DH'],
                        'organs_take_measures_name' =>  $value['DI'],
                        'starting_detention_time' =>  $value['DJ'],
                        'starting_detention_stats_time' =>  $value['DK'],
                        'location_measures_taken' =>  $value['DL'],
                        'location_measures_taken_class' =>  $value['DM'],
                        'lien_approval_situation' =>  $value['DN'],
                        'lien_end_time' =>  $value['DO'],
                        'lien_end_stats_time' =>  $value['DP'],
                        'lien_number_days' =>  $value['DQ'],
                        'is_delay' =>  $value['DR'],
                        'delay_number_days' =>  $value['DS'],
                        'delay_approval_situation' =>  $value['DT'],
                        'organization_measure' =>  $value['DU'],
                        'organization_measure_stats_time' =>  $value['DV'],
                        'amount_transferred_judicial_organs' =>  $value['DW'],
                        'two_rule_start_time' =>  $value['DX'],
                        'two_rule_stats_time' =>  $value['DY'],
                        'two_rule_remove_time' =>  $value['DZ'],

                        'two_rule_remove_stats_time' =>  $value['EA'],
                        'confessional_books' =>  $value['EB'],
                        'department_charge' =>  $value['EC'],
                        'superiors_assigned' =>  $value['ED'],
                        'del_status' =>  $value['EE'],
                        'create_date' =>  $value['EF'],
                        'update_time' =>  $value['EG'],
                    ];

                }
            }
//var_dump($data);die;
            if (isset($data)) {
                $transaction = Yii::$app->getDb()->beginTransaction();
                try {
                    $model = new QinlianRegister();
                    Yii::$app->db->createCommand()
                        ->batchInsert($model::tableName(),[
                            'nuit_name',
                            'nuit_code',
                            'is_nuit',
                            'case_code',
                            'personnel_code',
                            'person_investigated',
                            'credentials_type',
                            'credentials_number',
                            'sex',
                            'age',
                            'date_birth',
                            'academic',
                            'nation',
                            'is_supervises_object',
                            'supervises_object_details',
                            'is_party',
                            'party_delegate',
                            'disposal_report',
                            'time_joining_party',
                            'no_party_objects',
                            'no_party_objects_details',
                            'cpc',
                            'cppcc',
                            'discipline_commission',
                            'party_commission',
                            'on_job_time',

                            'head_violating',
                            'head_details',
                            'head_details_two',
                            'rank_job',
                            'deputy_rank_job',
                            'duty_job',
                            'authority_management',
                            'department_class',
                            'department_class_one',
                            'department_classtwo',
                            'nature_enterprise',
                            'nature_enterprise_one',
                            'category_enterprise_personnel',
                            'enterprise_post',
                            'jobbery_lose',
                            'discipline_amount',
                            'case_amount',
                            'filing_time',
                            'source_case',
                            'discipline_organ',
                            'discipline_organ_time',
                            'discipline_organ_stats_time',
                            'supervise_register_organ',
                            'supervise_register_time',
                            'supervise_register_statistics_time',
                            'is_discipline_transfer',

                            'other_discipline_method',
                            'transfer_unit',
                            'brief_case_report',
                            'register_report',
                            'register_decide_book',
                            'remarks',
                            'is_violate_stipulate',
                            'is_accountabilitye',
                            'end_case_stat_time',
                            'close_case_time',
                            'end_case_time',
                            'accountability',
                            'party_discipline',
                            'party_discipline_stats_time',
                            'administrative_sanction',
                            'administrative_sanction_stats_time',
                            'other_treatments',
                            'other_treatments_stats_time',
                            'transfer_justice_time',
                            'transfer_justice_stats_time',
                            'public_inspection_processing',
                            'public_inspection_processing_detail',
                            'punishments_number_years',
                            'punishments_number_month',
                            'probation_number_years',
                            'probation_number_month',

                            'public_inspection_processing_stats_time',
                            'retrieve_loss',
                            'capture_amount',
                            'first_violations_discipline_time',
                            'last_violations_discipline_time',
                            'violation_discipline_happen_time',
                            'desert_time',
                            'desert_stats_time',
                            'hear_accept_time',
                            'hear_accept_stats_time',
                            'hear_office',
                            'hear_end_time',
                            'hear_end_stats_time',
                            'punish_decide',
                            'police_handle_time',
                            'judicial_judgment_amount',
                            'investigation_report',
                            'trial_report',
                            'case_analysis',
                            'party_watch_limit',
                            'enterprise_level',
                            'flight_direction',
                            'flight_direction_details',
                            'investigation_suspension_time',
                            'investigation_suspension_stats_time',
                            'administrative_sanctions_suspension_time',

                            'administrative_sanctions_suspension_stats_time',
                            'seizure_time',
                            'seizure_stats_time',
                            'case_analysis_time',
                            'disciplinary_offence',
                            'post_disciplinary_offence',
                            'other_disciplinary_offence',
                            'organs_take_measures',
                            'organs_take_measures_name',
                            'starting_detention_time',
                            'starting_detention_stats_time',
                            'location_measures_taken',
                            'location_measures_taken_class',
                            'lien_approval_situation',
                            'lien_end_time',
                            'lien_end_stats_time',
                            'lien_number_days',
                            'is_delay',
                            'delay_number_days',
                            'delay_approval_situation',
                            'organization_measure',
                            'organization_measure_stats_time',
                            'amount_transferred_judicial_organs',
                            'two_rule_start_time',
                            'two_rule_stats_time',
                            'two_rule_remove_time',

                            'two_rule_remove_stats_time',
                            'confessional_books',
                            'department_charge',
                            'superiors_assigned',
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
//                    return json_encode($msg);
        $this->redirect('/index.php?r=complaint-record/index', '200');
    }

    public function actionExport()
    {
        $query = QinlianRegister::find();
        $data = $query
            ->all();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getActiveSheet()->setCellValue('A1', '填报单位名称');
        $spreadsheet->getActiveSheet()->setCellValue('B1', '填报单位代码');
        $spreadsheet->getActiveSheet()->setCellValue('C1', '是否单位或事故');
        $spreadsheet->getActiveSheet()->setCellValue('D1', '案件编码');
        $spreadsheet->getActiveSheet()->setCellValue('E1', '涉案人员编码');
        $spreadsheet->getActiveSheet()->setCellValue('F1', '被调查人');
        $spreadsheet->getActiveSheet()->setCellValue('G1', '证件类型');
        $spreadsheet->getActiveSheet()->setCellValue('H1', '证件号码');
        $spreadsheet->getActiveSheet()->setCellValue('I1', '性别');
        $spreadsheet->getActiveSheet()->setCellValue('J1', '年龄');
        $spreadsheet->getActiveSheet()->setCellValue('K1', '出生年月');
        $spreadsheet->getActiveSheet()->setCellValue('L1', '学历');
        $spreadsheet->getActiveSheet()->setCellValue('M1', '民族');
        $spreadsheet->getActiveSheet()->setCellValue('N1', '是否国家监察对象');
        $spreadsheet->getActiveSheet()->setCellValue('O1', '国家监察对象详情情况');
        $spreadsheet->getActiveSheet()->setCellValue('P1', '是否中共党员');
        $spreadsheet->getActiveSheet()->setCellValue('Q1', '中共党代表');
        $spreadsheet->getActiveSheet()->setCellValue('R1', '处置情况报告');
        $spreadsheet->getActiveSheet()->setCellValue('S1', '入党时间');
        $spreadsheet->getActiveSheet()->setCellValue('T1', '非党员非监察对象');
        $spreadsheet->getActiveSheet()->setCellValue('U1', '非党员非监察对象详情情况');
        $spreadsheet->getActiveSheet()->setCellValue('V1', '人大代表');
        $spreadsheet->getActiveSheet()->setCellValue('W1', '政协委员');
        $spreadsheet->getActiveSheet()->setCellValue('X1', '纪委委员');
        $spreadsheet->getActiveSheet()->setCellValue('Y1', '党委委员');
        $spreadsheet->getActiveSheet()->setCellValue('Z1', '任现职时间');

        $spreadsheet->getActiveSheet()->setCellValue('AA1', '一把手违纪违法');
        $spreadsheet->getActiveSheet()->setCellValue('AB1', '一把手细节');
        $spreadsheet->getActiveSheet()->setCellValue('AC1', '一把手细节2');
        $spreadsheet->getActiveSheet()->setCellValue('AD1', '职级');
        $spreadsheet->getActiveSheet()->setCellValue('AE1', '正副职级');
        $spreadsheet->getActiveSheet()->setCellValue('AF1', '工作单位及职务');
        $spreadsheet->getActiveSheet()->setCellValue('AG1', '干部管理权限');
        $spreadsheet->getActiveSheet()->setCellValue('AH1', '部门分类');
        $spreadsheet->getActiveSheet()->setCellValue('AI1', '部门分类1');
        $spreadsheet->getActiveSheet()->setCellValue('AJ1', '部门分类2');
        $spreadsheet->getActiveSheet()->setCellValue('AK1', '企业性质');
        $spreadsheet->getActiveSheet()->setCellValue('AL1', '企业性质1');
        $spreadsheet->getActiveSheet()->setCellValue('AM1', '企业人员类别');
        $spreadsheet->getActiveSheet()->setCellValue('AN1', '企业岗位');
        $spreadsheet->getActiveSheet()->setCellValue('AO1', '渎职侵权损失');
        $spreadsheet->getActiveSheet()->setCellValue('AP1', '违纪总金额（万元）');
        $spreadsheet->getActiveSheet()->setCellValue('AQ1', '案件总金额（万元）');
        $spreadsheet->getActiveSheet()->setCellValue('AR1', '立案统计时间');
        $spreadsheet->getActiveSheet()->setCellValue('AS1', '案件来源');
        $spreadsheet->getActiveSheet()->setCellValue('AT1', '纪委立案机关');
        $spreadsheet->getActiveSheet()->setCellValue('AU1', '纪委立案时间');
        $spreadsheet->getActiveSheet()->setCellValue('AV1', '纪委立案统计时间');
        $spreadsheet->getActiveSheet()->setCellValue('AW1', '监委立案机关');
        $spreadsheet->getActiveSheet()->setCellValue('AX1', '监委立案时间');
        $spreadsheet->getActiveSheet()->setCellValue('AY1', '监委立案统计时间');
        $spreadsheet->getActiveSheet()->setCellValue('AZ1', '是否其他纪检监察机关立案后移送');

        $spreadsheet->getActiveSheet()->setCellValue('BA1', '其他纪检监察机关立案后移送方式');
        $spreadsheet->getActiveSheet()->setCellValue('BB1', '移送单位');
        $spreadsheet->getActiveSheet()->setCellValue('BC1', '简要案情');
        $spreadsheet->getActiveSheet()->setCellValue('BD1', '立案报告');
        $spreadsheet->getActiveSheet()->setCellValue('BE1', '立案决定书');
        $spreadsheet->getActiveSheet()->setCellValue('BF1', '备注');
        $spreadsheet->getActiveSheet()->setCellValue('BG1', '是否违反中央八项规定精神');
        $spreadsheet->getActiveSheet()->setCellValue('BH1', '是否属于问责');
        $spreadsheet->getActiveSheet()->setCellValue('BI1', '结案统计时间');
        $spreadsheet->getActiveSheet()->setCellValue('BJ1', '销案时间');
        $spreadsheet->getActiveSheet()->setCellValue('BK1', '结案时间');
        $spreadsheet->getActiveSheet()->setCellValue('BL1', '责任追究');
        $spreadsheet->getActiveSheet()->setCellValue('BM1', '党纪处分');
        $spreadsheet->getActiveSheet()->setCellValue('BN1', '党纪处分统计时间');
        $spreadsheet->getActiveSheet()->setCellValue('BO1', '政务处分');
        $spreadsheet->getActiveSheet()->setCellValue('BP1', '政务处分统计时间');
        $spreadsheet->getActiveSheet()->setCellValue('BQ1', '其他处理');
        $spreadsheet->getActiveSheet()->setCellValue('BR1', '其他处理统计时间');
        $spreadsheet->getActiveSheet()->setCellValue('BS1', '移送司法机关时间');
        $spreadsheet->getActiveSheet()->setCellValue('BT1', '移送司法机关统计时间');
        $spreadsheet->getActiveSheet()->setCellValue('BU1', '公检法处理');
        $spreadsheet->getActiveSheet()->setCellValue('BV1', '公检法处理详情情况');
        $spreadsheet->getActiveSheet()->setCellValue('BW1', '主刑年数');
        $spreadsheet->getActiveSheet()->setCellValue('BX1', '主刑月数');
        $spreadsheet->getActiveSheet()->setCellValue('BY1', '缓刑年数');
        $spreadsheet->getActiveSheet()->setCellValue('BZ1', '缓刑月数');

        $spreadsheet->getActiveSheet()->setCellValue('CA1', '公检法处理统计时间');
        $spreadsheet->getActiveSheet()->setCellValue('CB1', '挽回经济损失（万元）');
        $spreadsheet->getActiveSheet()->setCellValue('CC1', '收缴涉案金额（万元）');
        $spreadsheet->getActiveSheet()->setCellValue('CD1', '首次违纪违法时间');
        $spreadsheet->getActiveSheet()->setCellValue('CE1', '末次违纪违法时间');
        $spreadsheet->getActiveSheet()->setCellValue('CF1', '主要违纪问题发生时间');
        $spreadsheet->getActiveSheet()->setCellValue('CG1', '潜逃时间');
        $spreadsheet->getActiveSheet()->setCellValue('CH1', '潜逃统计时间');
        $spreadsheet->getActiveSheet()->setCellValue('CI1', '审理受理时间');
        $spreadsheet->getActiveSheet()->setCellValue('CJ1', '审理受理统计时间');
        $spreadsheet->getActiveSheet()->setCellValue('CK1', '审理机关');
        $spreadsheet->getActiveSheet()->setCellValue('CL1', '审结时间');
        $spreadsheet->getActiveSheet()->setCellValue('CM1', '审结统计时间');
        $spreadsheet->getActiveSheet()->setCellValue('CN1', '处分决定');
        $spreadsheet->getActiveSheet()->setCellValue('CO1', '公检法处理时间');
        $spreadsheet->getActiveSheet()->setCellValue('CP1', '司法判决金额（万元）');
        $spreadsheet->getActiveSheet()->setCellValue('CQ1', '调查报告');
        $spreadsheet->getActiveSheet()->setCellValue('CR1', '审理报告');
        $spreadsheet->getActiveSheet()->setCellValue('CS1', '案件剖析');
        $spreadsheet->getActiveSheet()->setCellValue('CT1', '留党察看年限');
        $spreadsheet->getActiveSheet()->setCellValue('CU1', '企业级别');
        $spreadsheet->getActiveSheet()->setCellValue('CV1', '潜逃去向');
        $spreadsheet->getActiveSheet()->setCellValue('CW1', '潜逃去向细节');
        $spreadsheet->getActiveSheet()->setCellValue('CX1', '调查中止时间');
        $spreadsheet->getActiveSheet()->setCellValue('CY1', '调查中止统计时间');
        $spreadsheet->getActiveSheet()->setCellValue('CZ1', '解除政务处分时间');

        $spreadsheet->getActiveSheet()->setCellValue('DA1', '解除政务处分统计时间');
        $spreadsheet->getActiveSheet()->setCellValue('DB1', '抓获时间');
        $spreadsheet->getActiveSheet()->setCellValue('DC1', '抓获统计时间');
        $spreadsheet->getActiveSheet()->setCellValue('DD1', '案件剖析报告统计时间');
        $spreadsheet->getActiveSheet()->setCellValue('DE1', '违纪行为');
        $spreadsheet->getActiveSheet()->setCellValue('DF1', '职务违法犯罪行为');
        $spreadsheet->getActiveSheet()->setCellValue('DG1', '其他违法犯罪行为');
        $spreadsheet->getActiveSheet()->setCellValue('DH1', '采取措施机关');
        $spreadsheet->getActiveSheet()->setCellValue('DI1', '采取措施机关名称');
        $spreadsheet->getActiveSheet()->setCellValue('DJ1', '留置起始时间');
        $spreadsheet->getActiveSheet()->setCellValue('DK1', '留置起始统计时间');
        $spreadsheet->getActiveSheet()->setCellValue('DL1', '采取措施地点');
        $spreadsheet->getActiveSheet()->setCellValue('DM1', '采取措施地点分类');
        $spreadsheet->getActiveSheet()->setCellValue('DN1', '留置审批情况');
        $spreadsheet->getActiveSheet()->setCellValue('DO1', '留置结束时间');
        $spreadsheet->getActiveSheet()->setCellValue('DP1', '留置结束统计时间');
        $spreadsheet->getActiveSheet()->setCellValue('DQ1', '留置天数');
        $spreadsheet->getActiveSheet()->setCellValue('DR1', '是否延期');
        $spreadsheet->getActiveSheet()->setCellValue('DS1', '延期天数');
        $spreadsheet->getActiveSheet()->setCellValue('DT1', '延期审批情况');
        $spreadsheet->getActiveSheet()->setCellValue('DU1', '组织措施');
        $spreadsheet->getActiveSheet()->setCellValue('DV1', '组织措施统计时间');
        $spreadsheet->getActiveSheet()->setCellValue('DW1', '移送司法机关金额（万元）');
        $spreadsheet->getActiveSheet()->setCellValue('DX1', '两规两指起始时间');
        $spreadsheet->getActiveSheet()->setCellValue('DY1', '两规两指统计时间');
        $spreadsheet->getActiveSheet()->setCellValue('DZ1', '两规两指解除时间');

        $spreadsheet->getActiveSheet()->setCellValue('EA1', '两规两指解除统计时间');
        $spreadsheet->getActiveSheet()->setCellValue('EB1', '忏悔书');
        $spreadsheet->getActiveSheet()->setCellValue('EC1', '分管科室');
        $spreadsheet->getActiveSheet()->setCellValue('ED1', '上级交办');
        $spreadsheet->getActiveSheet()->setCellValue('EE1', '删除状态');
        $spreadsheet->getActiveSheet()->setCellValue('EF1', '创建时间');
        $spreadsheet->getActiveSheet()->setCellValue('EG1', '更新时间');

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
        $spreadsheet->getActiveSheet()->getColumnDimension('AY')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('AZ')->setWidth(16);

        $spreadsheet->getActiveSheet()->getColumnDimension('BA')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('BB')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('BC')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('BD')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('BE')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('BF')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('BG')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('BH')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('BI')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('BJ')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('BK')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('BL')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('BM')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('BN')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('BO')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('BP')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('BQ')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('BR')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('BS')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('BT')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('BU')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('BV')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('BW')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('BX')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('BY')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('BZ')->setWidth(16);

        $spreadsheet->getActiveSheet()->getColumnDimension('CA')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('CB')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('CC')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('CD')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('CE')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('CF')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('CG')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('CH')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('CI')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('CJ')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('CK')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('CL')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('CM')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('CN')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('CO')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('CP')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('CQ')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('CR')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('CS')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('CT')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('CU')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('CV')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('CW')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('CX')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('CY')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('CZ')->setWidth(16);

        $spreadsheet->getActiveSheet()->getColumnDimension('DA')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('DB')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('DC')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('DD')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('DE')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('DF')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('DG')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('DH')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('DI')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('DJ')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('DK')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('DL')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('DM')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('DN')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('DO')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('DP')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('DQ')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('DR')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('DS')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('DT')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('DU')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('DV')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('DW')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('DX')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('DY')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('DZ')->setWidth(16);

        $spreadsheet->getActiveSheet()->getColumnDimension('EA')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('EB')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('EC')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('ED')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('EE')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('EF')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('EG')->setWidth(12);

        $i = 2;
        foreach($data as $key=>$val){

            $spreadsheet->getActiveSheet()->setCellValue('A' . $i, $val['nuit_name']);
            $spreadsheet->getActiveSheet()->setCellValue('B' . $i, $val['nuit_code']);
            $spreadsheet->getActiveSheet()->setCellValue('C' . $i, $val['is_nuit']);
            $spreadsheet->getActiveSheet()->setCellValue('D' . $i, $val['case_code']);
            $spreadsheet->getActiveSheet()->setCellValue('E' . $i, $val['personnel_code']);
            $spreadsheet->getActiveSheet()->setCellValue('F' . $i, $val['person_investigated']);
            $spreadsheet->getActiveSheet()->setCellValue('G' . $i, $val['credentials_type']);
            $spreadsheet->getActiveSheet()->setCellValue('H' . $i, $val['credentials_number']);
            $spreadsheet->getActiveSheet()->setCellValue('I' . $i, $val['sex']);
            $spreadsheet->getActiveSheet()->setCellValue('J' . $i, $val['age']);
            $spreadsheet->getActiveSheet()->setCellValue('K' . $i, $val['date_birth']);
            $spreadsheet->getActiveSheet()->setCellValue('L' . $i, $val['academic']);
            $spreadsheet->getActiveSheet()->setCellValue('M' . $i, $val['nation']);
            $spreadsheet->getActiveSheet()->setCellValue('N' . $i, $val['is_supervises_object']);
            $spreadsheet->getActiveSheet()->setCellValue('O' . $i, $val['supervises_object_details']);
            $spreadsheet->getActiveSheet()->setCellValue('P' . $i, $val['is_party']);
            $spreadsheet->getActiveSheet()->setCellValue('Q' . $i, $val['party_delegate']);
            $spreadsheet->getActiveSheet()->setCellValue('R' . $i, $val['disposal_report']);
            $spreadsheet->getActiveSheet()->setCellValue('S' . $i, $val['time_joining_party']);
            $spreadsheet->getActiveSheet()->setCellValue('T' . $i, $val['no_party_objects']);
            $spreadsheet->getActiveSheet()->setCellValue('U' . $i, $val['no_party_objects_details']);
            $spreadsheet->getActiveSheet()->setCellValue('V' . $i, $val['cpc']);
            $spreadsheet->getActiveSheet()->setCellValue('W' . $i, $val['cppcc']);
            $spreadsheet->getActiveSheet()->setCellValue('X' . $i, $val['discipline_commission']);
            $spreadsheet->getActiveSheet()->setCellValue('Y' . $i, $val['party_commission']);
            $spreadsheet->getActiveSheet()->setCellValue('X' . $i, $val['on_job_time']);

            $spreadsheet->getActiveSheet()->setCellValue('AA' . $i, $val['head_violating']);
            $spreadsheet->getActiveSheet()->setCellValue('AB' . $i, $val['head_details']);
            $spreadsheet->getActiveSheet()->setCellValue('AC' . $i, $val['head_details_two']);
            $spreadsheet->getActiveSheet()->setCellValue('AD' . $i, $val['rank_job']);
            $spreadsheet->getActiveSheet()->setCellValue('AE' . $i, $val['deputy_rank_job']);
            $spreadsheet->getActiveSheet()->setCellValue('AF' . $i, $val['duty_job']);
            $spreadsheet->getActiveSheet()->setCellValue('AG' . $i, $val['authority_management']);
            $spreadsheet->getActiveSheet()->setCellValue('AH' . $i, $val['department_class']);
            $spreadsheet->getActiveSheet()->setCellValue('AI' . $i, $val['department_class_one']);
            $spreadsheet->getActiveSheet()->setCellValue('AJ' . $i, $val['department_classtwo']);
            $spreadsheet->getActiveSheet()->setCellValue('AK' . $i, $val['nature_enterprise']);
            $spreadsheet->getActiveSheet()->setCellValue('AL' . $i, $val['nature_enterprise_one']);
            $spreadsheet->getActiveSheet()->setCellValue('AM' . $i, $val['category_enterprise_personnel']);
            $spreadsheet->getActiveSheet()->setCellValue('AN' . $i, $val['enterprise_post']);
            $spreadsheet->getActiveSheet()->setCellValue('AO' . $i, $val['jobbery_lose']);
            $spreadsheet->getActiveSheet()->setCellValue('AP' . $i, $val['discipline_amount']);
            $spreadsheet->getActiveSheet()->setCellValue('AQ' . $i, $val['case_amount']);
            $spreadsheet->getActiveSheet()->setCellValue('AR' . $i, $val['filing_time']);
            $spreadsheet->getActiveSheet()->setCellValue('AS' . $i, $val['source_case']);
            $spreadsheet->getActiveSheet()->setCellValue('AT' . $i, $val['discipline_organ']);
            $spreadsheet->getActiveSheet()->setCellValue('AU' . $i, $val['discipline_organ_time']);
            $spreadsheet->getActiveSheet()->setCellValue('AV' . $i, $val['discipline_organ_stats_time']);
            $spreadsheet->getActiveSheet()->setCellValue('AW' . $i, $val['supervise_register_organ']);
            $spreadsheet->getActiveSheet()->setCellValue('AX' . $i, $val['supervise_register_time']);
            $spreadsheet->getActiveSheet()->setCellValue('AY' . $i, $val['supervise_register_statistics_time']);
            $spreadsheet->getActiveSheet()->setCellValue('AZ' . $i, $val['is_discipline_transfer']);

            $spreadsheet->getActiveSheet()->setCellValue('BA' . $i, $val['other_discipline_method']);
            $spreadsheet->getActiveSheet()->setCellValue('BB' . $i, $val['transfer_unit']);
            $spreadsheet->getActiveSheet()->setCellValue('BC' . $i, $val['brief_case_report']);
            $spreadsheet->getActiveSheet()->setCellValue('BD' . $i, $val['register_report']);
            $spreadsheet->getActiveSheet()->setCellValue('BE' . $i, $val['register_decide_book']);
            $spreadsheet->getActiveSheet()->setCellValue('BF' . $i, $val['remarks']);
            $spreadsheet->getActiveSheet()->setCellValue('BG' . $i, $val['is_violate_stipulate']);
            $spreadsheet->getActiveSheet()->setCellValue('BH' . $i, $val['is_accountabilitye']);
            $spreadsheet->getActiveSheet()->setCellValue('BI' . $i, $val['end_case_stat_time']);
            $spreadsheet->getActiveSheet()->setCellValue('BJ' . $i, $val['close_case_time']);
            $spreadsheet->getActiveSheet()->setCellValue('BK' . $i, $val['end_case_time']);
            $spreadsheet->getActiveSheet()->setCellValue('BL' . $i, $val['accountability']);
            $spreadsheet->getActiveSheet()->setCellValue('BM' . $i, $val['party_discipline']);
            $spreadsheet->getActiveSheet()->setCellValue('BN' . $i, $val['party_discipline_stats_time']);
            $spreadsheet->getActiveSheet()->setCellValue('BO' . $i, $val['administrative_sanction']);
            $spreadsheet->getActiveSheet()->setCellValue('BP' . $i, $val['administrative_sanction_stats_time']);
            $spreadsheet->getActiveSheet()->setCellValue('BQ' . $i, $val['other_treatments']);
            $spreadsheet->getActiveSheet()->setCellValue('BR' . $i, $val['other_treatments_stats_time']);
            $spreadsheet->getActiveSheet()->setCellValue('BS' . $i, $val['transfer_justice_time']);
            $spreadsheet->getActiveSheet()->setCellValue('BT' . $i, $val['transfer_justice_stats_time']);
            $spreadsheet->getActiveSheet()->setCellValue('BU' . $i, $val['public_inspection_processing']);
            $spreadsheet->getActiveSheet()->setCellValue('BV' . $i, $val['public_inspection_processing_detail']);
            $spreadsheet->getActiveSheet()->setCellValue('BW' . $i, $val['punishments_number_years']);
            $spreadsheet->getActiveSheet()->setCellValue('BX' . $i, $val['punishments_number_month']);
            $spreadsheet->getActiveSheet()->setCellValue('BY' . $i, $val['probation_number_years']);
            $spreadsheet->getActiveSheet()->setCellValue('BZ' . $i, $val['probation_number_month']);

            $spreadsheet->getActiveSheet()->setCellValue('CA' . $i, $val['public_inspection_processing_stats_time']);
            $spreadsheet->getActiveSheet()->setCellValue('CB' . $i, $val['retrieve_loss']);
            $spreadsheet->getActiveSheet()->setCellValue('CC' . $i, $val['capture_amount']);
            $spreadsheet->getActiveSheet()->setCellValue('CD' . $i, $val['first_violations_discipline_time']);
            $spreadsheet->getActiveSheet()->setCellValue('CE' . $i, $val['last_violations_discipline_time']);
            $spreadsheet->getActiveSheet()->setCellValue('CF' . $i, $val['violation_discipline_happen_time']);
            $spreadsheet->getActiveSheet()->setCellValue('CG' . $i, $val['desert_time']);
            $spreadsheet->getActiveSheet()->setCellValue('CH' . $i, $val['desert_stats_time']);
            $spreadsheet->getActiveSheet()->setCellValue('CI' . $i, $val['hear_accept_time']);
            $spreadsheet->getActiveSheet()->setCellValue('CJ' . $i, $val['hear_accept_stats_time']);
            $spreadsheet->getActiveSheet()->setCellValue('CK' . $i, $val['hear_office']);
            $spreadsheet->getActiveSheet()->setCellValue('CL' . $i, $val['hear_end_time']);
            $spreadsheet->getActiveSheet()->setCellValue('CM' . $i, $val['hear_end_stats_time']);
            $spreadsheet->getActiveSheet()->setCellValue('CN' . $i, $val['punish_decide']);
            $spreadsheet->getActiveSheet()->setCellValue('CO' . $i, $val['police_handle_time']);
            $spreadsheet->getActiveSheet()->setCellValue('CP' . $i, $val['judicial_judgment_amount']);
            $spreadsheet->getActiveSheet()->setCellValue('CQ' . $i, $val['investigation_report']);
            $spreadsheet->getActiveSheet()->setCellValue('CR' . $i, $val['trial_report']);
            $spreadsheet->getActiveSheet()->setCellValue('CS' . $i, $val['case_analysis']);
            $spreadsheet->getActiveSheet()->setCellValue('CT' . $i, $val['party_watch_limit']);
            $spreadsheet->getActiveSheet()->setCellValue('CU' . $i, $val['enterprise_level']);
            $spreadsheet->getActiveSheet()->setCellValue('CV' . $i, $val['flight_direction']);
            $spreadsheet->getActiveSheet()->setCellValue('CW' . $i, $val['flight_direction_details']);
            $spreadsheet->getActiveSheet()->setCellValue('CX' . $i, $val['investigation_suspension_time']);
            $spreadsheet->getActiveSheet()->setCellValue('CY' . $i, $val['investigation_suspension_stats_time']);
            $spreadsheet->getActiveSheet()->setCellValue('CZ' . $i, $val['administrative_sanctions_suspension_time']);

            $spreadsheet->getActiveSheet()->setCellValue('DA' . $i, $val['administrative_sanctions_suspension_stats_time']);
            $spreadsheet->getActiveSheet()->setCellValue('DB' . $i, $val['seizure_time']);
            $spreadsheet->getActiveSheet()->setCellValue('DC' . $i, $val['seizure_stats_time']);
            $spreadsheet->getActiveSheet()->setCellValue('DD' . $i, $val['case_analysis_time']);
            $spreadsheet->getActiveSheet()->setCellValue('DE' . $i, $val['disciplinary_offence']);
            $spreadsheet->getActiveSheet()->setCellValue('DF' . $i, $val['post_disciplinary_offence']);
            $spreadsheet->getActiveSheet()->setCellValue('DG' . $i, $val['other_disciplinary_offence']);
            $spreadsheet->getActiveSheet()->setCellValue('DH' . $i, $val['organs_take_measures']);
            $spreadsheet->getActiveSheet()->setCellValue('DI' . $i, $val['organs_take_measures_name']);
            $spreadsheet->getActiveSheet()->setCellValue('DJ' . $i, $val['starting_detention_time']);
            $spreadsheet->getActiveSheet()->setCellValue('DK' . $i, $val['starting_detention_stats_time']);
            $spreadsheet->getActiveSheet()->setCellValue('DL' . $i, $val['location_measures_taken']);
            $spreadsheet->getActiveSheet()->setCellValue('DM' . $i, $val['location_measures_taken_class']);
            $spreadsheet->getActiveSheet()->setCellValue('DN' . $i, $val['lien_approval_situation']);
            $spreadsheet->getActiveSheet()->setCellValue('DO' . $i, $val['lien_end_time']);
            $spreadsheet->getActiveSheet()->setCellValue('DP' . $i, $val['lien_end_stats_time']);
            $spreadsheet->getActiveSheet()->setCellValue('DQ' . $i, $val['lien_number_days']);
            $spreadsheet->getActiveSheet()->setCellValue('DR' . $i, $val['is_delay']);
            $spreadsheet->getActiveSheet()->setCellValue('DS' . $i, $val['delay_number_days']);
            $spreadsheet->getActiveSheet()->setCellValue('DT' . $i, $val['delay_approval_situation']);
            $spreadsheet->getActiveSheet()->setCellValue('DU' . $i, $val['organization_measure']);
            $spreadsheet->getActiveSheet()->setCellValue('DV' . $i, $val['organization_measure_stats_time']);
            $spreadsheet->getActiveSheet()->setCellValue('DW' . $i, $val['amount_transferred_judicial_organs']);
            $spreadsheet->getActiveSheet()->setCellValue('DX' . $i, $val['two_rule_start_time']);
            $spreadsheet->getActiveSheet()->setCellValue('DY' . $i, $val['two_rule_stats_time']);
            $spreadsheet->getActiveSheet()->setCellValue('DZ' . $i, $val['two_rule_remove_time']);

            $spreadsheet->getActiveSheet()->setCellValue('EA' . $i, $val['two_rule_remove_stats_time']);
            $spreadsheet->getActiveSheet()->setCellValue('EB' . $i, $val['confessional_books']);
            $spreadsheet->getActiveSheet()->setCellValue('EC' . $i, $val['department_charge']);
            $spreadsheet->getActiveSheet()->setCellValue('ED' . $i, $val['superiors_assigned']);
            $spreadsheet->getActiveSheet()->setCellValue('EE' . $i, $val['del_status']);
            $spreadsheet->getActiveSheet()->setCellValue('EF' . $i, $val['create_date']);
            $spreadsheet->getActiveSheet()->setCellValue('EG' . $i, $val['update_time']);

            $i++;
        }

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.'案管立案-'.date("Y年m月j日").'.xlsx"');
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

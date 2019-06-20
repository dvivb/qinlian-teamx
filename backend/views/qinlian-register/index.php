
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;

use backend\models\QinlianRegister;

$modelLabel = new \backend\models\QinlianRegister();
?>

<?php $this->beginBlock('header');  ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
      
        <div class="box-header">
          <h3 class="box-title">数据列表</h3>
          <div class="box-tools">
<!--            <div class="input-group input-group-sm" style="width: 150px;">-->
<!--                <button id="create_btn" type="button" class="btn btn-xs btn-primary">添&nbsp;&emsp;加</button>-->
<!--        			|-->
<!--        		<button id="delete_btn" type="button" class="btn btn-xs btn-danger">批量删除</button>-->
<!--            </div>-->
              <div class="input-group input-group-sm" >
                  <button id="create_btn" type="button" class="btn btn-xs btn-primary">添&nbsp;&emsp;加</button>
                  |
                  <button id="import_btn" type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#uploadFile">导&nbsp;&emsp;入</button>
                  |
                  <a href="<?=Url::toRoute('qinlian-register/export')?>" class="btn btn-xs btn-info">导&nbsp;&emsp;出</a>
                  |
                  <button id="delete_btn" type="button" class="btn btn-xs btn-danger">批量删除</button>
              </div>
          </div>
        </div>
        <!-- /.box-header -->
        
        <div class="box-body">
          <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap table-responsive">
            <!-- row start search-->
          	<div class="row">
          	<div class="col-sm-12">
                <?php ActiveForm::begin(['id' => 'qinlian-register-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('qinlian-register/index')]); ?>     
                
                  <div class="form-group" style="margin: 4px;">
                      <label><?=$modelLabel->getAttributeLabel('id')?>:</label>
                      <input type="text" class="form-control" id="query[id]" name="query[id]"  value="<?=isset($query["id"]) ? $query["id"] : "" ?>">
                  </div>
                <div class="form-group" style="margin: 4px;">
                    <label><?=$modelLabel->getAttributeLabel('nuit_name')?>:</label>
                    <input type="text" class="form-control" id="query[nuit_name]" name="query[nuit_name]"  value="<?=isset($query["nuit_name"]) ? $query["nuit_name"] : "" ?>">
                </div>
                <div class="form-group" style="margin: 4px;">
                    <label><?=$modelLabel->getAttributeLabel('case_code')?>:</label>
                    <input type="text" class="form-control" id="query[case_code]" name="query[case_code]"  value="<?=isset($query["case_code"]) ? $query["case_code"] : "" ?>">
                </div>
                <div class="form-group" style="margin: 4px;">
                    <label><?=$modelLabel->getAttributeLabel('credentials_number')?>:</label>
                    <input type="text" class="form-control" id="query[credentials_number]" name="query[credentials_number]"  value="<?=isset($query["credentials_number"]) ? $query["credentials_number"] : "" ?>">
                </div>
                <div class="form-group" style="margin: 4px;">
                    <label><?=$modelLabel->getAttributeLabel('discipline_organ')?>:</label>
                    <input type="text" class="form-control" id="query[discipline_organ]" name="query[discipline_organ]"  value="<?=isset($query["discipline_organ"]) ? $query["discipline_organ"] : "" ?>">
                </div>
                <div class="form-group" style="margin: 4px;">
                    <label><?=$modelLabel->getAttributeLabel('department_charge')?>:</label>
                    <input type="text" class="form-control" id="query[department_charge]" name="query[department_charge]"  value="<?=isset($query["department_charge"]) ? $query["department_charge"] : "" ?>">
                </div>
                <div class="form-group" style="margin: 4px;">
                    <label><?=$modelLabel->getAttributeLabel('superiors_assigned')?>:</label>
                    <input type="text" class="form-control" id="query[superiors_assigned]" name="query[superiors_assigned]"  value="<?=isset($query["superiors_assigned"]) ? $query["superiors_assigned"] : "" ?>">
                </div>
              <div class="form-group" style="float: right;">
              	<a onclick="searchAction()" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i> 搜   索</a>
           	  </div>
               <?php ActiveForm::end(); ?> 
            </div>
          	</div>
          	<!-- row end search -->
          	
          	<!-- row start -->
          	<div class="row">
          	<div class="col-sm-12">
          	<table id="data_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="data_table_info">
            <thead class="text-nowrap">
            <tr role="row">
            
            <?php 
              $orderby = isset($_GET['orderby']) ? $_GET['orderby'] : '';
		      echo '<th><input id="data_table_check" type="checkbox"></th>';
              echo '<th onclick="orderby(\'id\', \'desc\')" '.CommonFun::sortClass($orderby, 'id').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('id').'</th>';
              echo '<th onclick="orderby(\'nuit_name\', \'desc\')" '.CommonFun::sortClass($orderby, 'nuit_name').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('nuit_name').'</th>';
              echo '<th onclick="orderby(\'nuit_code\', \'desc\')" '.CommonFun::sortClass($orderby, 'nuit_code').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('nuit_code').'</th>';
              echo '<th onclick="orderby(\'is_nuit\', \'desc\')" '.CommonFun::sortClass($orderby, 'is_nuit').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('is_nuit').'</th>';
              echo '<th onclick="orderby(\'case_code\', \'desc\')" '.CommonFun::sortClass($orderby, 'case_code').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('case_code').'</th>';
              echo '<th onclick="orderby(\'personnel_code\', \'desc\')" '.CommonFun::sortClass($orderby, 'personnel_code').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('personnel_code').'</th>';
              echo '<th onclick="orderby(\'person_investigated\', \'desc\')" '.CommonFun::sortClass($orderby, 'person_investigated').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('person_investigated').'</th>';
              echo '<th onclick="orderby(\'credentials_type\', \'desc\')" '.CommonFun::sortClass($orderby, 'credentials_type').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('credentials_type').'</th>';
              echo '<th onclick="orderby(\'credentials_number\', \'desc\')" '.CommonFun::sortClass($orderby, 'credentials_number').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('credentials_number').'</th>';
              echo '<th onclick="orderby(\'sex\', \'desc\')" '.CommonFun::sortClass($orderby, 'sex').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('sex').'</th>';
              echo '<th onclick="orderby(\'age\', \'desc\')" '.CommonFun::sortClass($orderby, 'age').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('age').'</th>';
              echo '<th onclick="orderby(\'date_birth\', \'desc\')" '.CommonFun::sortClass($orderby, 'date_birth').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('date_birth').'</th>';
              echo '<th onclick="orderby(\'academic\', \'desc\')" '.CommonFun::sortClass($orderby, 'academic').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('academic').'</th>';
              echo '<th onclick="orderby(\'nation\', \'desc\')" '.CommonFun::sortClass($orderby, 'nation').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('nation').'</th>';
              echo '<th onclick="orderby(\'is_supervises_object\', \'desc\')" '.CommonFun::sortClass($orderby, 'is_supervises_object').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('is_supervises_object').'</th>';
              echo '<th onclick="orderby(\'supervises_object_details\', \'desc\')" '.CommonFun::sortClass($orderby, 'supervises_object_details').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('supervises_object_details').'</th>';
              echo '<th onclick="orderby(\'is_party\', \'desc\')" '.CommonFun::sortClass($orderby, 'is_party').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('is_party').'</th>';
              echo '<th onclick="orderby(\'party_delegate\', \'desc\')" '.CommonFun::sortClass($orderby, 'party_delegate').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('party_delegate').'</th>';
              echo '<th onclick="orderby(\'disposal_report\', \'desc\')" '.CommonFun::sortClass($orderby, 'disposal_report').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('disposal_report').'</th>';
              echo '<th onclick="orderby(\'time_joining_party\', \'desc\')" '.CommonFun::sortClass($orderby, 'time_joining_party').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('time_joining_party').'</th>';
              echo '<th onclick="orderby(\'no_party_objects\', \'desc\')" '.CommonFun::sortClass($orderby, 'no_party_objects').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('no_party_objects').'</th>';
              echo '<th onclick="orderby(\'no_party_objects_details\', \'desc\')" '.CommonFun::sortClass($orderby, 'no_party_objects_details').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('no_party_objects_details').'</th>';
              echo '<th onclick="orderby(\'cpc\', \'desc\')" '.CommonFun::sortClass($orderby, 'cpc').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('cpc').'</th>';
              echo '<th onclick="orderby(\'cppcc\', \'desc\')" '.CommonFun::sortClass($orderby, 'cppcc').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('cppcc').'</th>';
              echo '<th onclick="orderby(\'discipline_commission\', \'desc\')" '.CommonFun::sortClass($orderby, 'discipline_commission').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('discipline_commission').'</th>';
              echo '<th onclick="orderby(\'party_commission\', \'desc\')" '.CommonFun::sortClass($orderby, 'party_commission').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('party_commission').'</th>';
              echo '<th onclick="orderby(\'on_job_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'on_job_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('on_job_time').'</th>';
              echo '<th onclick="orderby(\'head_violating\', \'desc\')" '.CommonFun::sortClass($orderby, 'head_violating').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('head_violating').'</th>';
              echo '<th onclick="orderby(\'head_details\', \'desc\')" '.CommonFun::sortClass($orderby, 'head_details').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('head_details').'</th>';
              echo '<th onclick="orderby(\'head_details_two\', \'desc\')" '.CommonFun::sortClass($orderby, 'head_details_two').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('head_details_two').'</th>';
              echo '<th onclick="orderby(\'rank_job\', \'desc\')" '.CommonFun::sortClass($orderby, 'rank_job').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('rank_job').'</th>';
              echo '<th onclick="orderby(\'deputy_rank_job\', \'desc\')" '.CommonFun::sortClass($orderby, 'deputy_rank_job').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('deputy_rank_job').'</th>';
              echo '<th onclick="orderby(\'duty_job\', \'desc\')" '.CommonFun::sortClass($orderby, 'duty_job').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('duty_job').'</th>';
              echo '<th onclick="orderby(\'authority_management\', \'desc\')" '.CommonFun::sortClass($orderby, 'authority_management').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('authority_management').'</th>';
              echo '<th onclick="orderby(\'department_class\', \'desc\')" '.CommonFun::sortClass($orderby, 'department_class').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('department_class').'</th>';
              echo '<th onclick="orderby(\'department_class_one\', \'desc\')" '.CommonFun::sortClass($orderby, 'department_class_one').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('department_class_one').'</th>';
              echo '<th onclick="orderby(\'department_classtwo\', \'desc\')" '.CommonFun::sortClass($orderby, 'department_classtwo').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('department_classtwo').'</th>';
              echo '<th onclick="orderby(\'nature_enterprise\', \'desc\')" '.CommonFun::sortClass($orderby, 'nature_enterprise').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('nature_enterprise').'</th>';
              echo '<th onclick="orderby(\'nature_enterprise_one\', \'desc\')" '.CommonFun::sortClass($orderby, 'nature_enterprise_one').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('nature_enterprise_one').'</th>';
              echo '<th onclick="orderby(\'category_enterprise_personnel\', \'desc\')" '.CommonFun::sortClass($orderby, 'category_enterprise_personnel').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('category_enterprise_personnel').'</th>';
              echo '<th onclick="orderby(\'enterprise_post\', \'desc\')" '.CommonFun::sortClass($orderby, 'enterprise_post').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('enterprise_post').'</th>';
              echo '<th onclick="orderby(\'jobbery_lose\', \'desc\')" '.CommonFun::sortClass($orderby, 'jobbery_lose').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('jobbery_lose').'</th>';
              echo '<th onclick="orderby(\'discipline_amount\', \'desc\')" '.CommonFun::sortClass($orderby, 'discipline_amount').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('discipline_amount').'</th>';
              echo '<th onclick="orderby(\'case_amount\', \'desc\')" '.CommonFun::sortClass($orderby, 'case_amount').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('case_amount').'</th>';
              echo '<th onclick="orderby(\'filing_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'filing_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('filing_time').'</th>';
              echo '<th onclick="orderby(\'source_case\', \'desc\')" '.CommonFun::sortClass($orderby, 'source_case').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('source_case').'</th>';
              echo '<th onclick="orderby(\'discipline_organ\', \'desc\')" '.CommonFun::sortClass($orderby, 'discipline_organ').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('discipline_organ').'</th>';
              echo '<th onclick="orderby(\'discipline_organ_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'discipline_organ_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('discipline_organ_time').'</th>';
              echo '<th onclick="orderby(\'discipline_organ_stats_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'discipline_organ_stats_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('discipline_organ_stats_time').'</th>';
              echo '<th onclick="orderby(\'supervise_register_organ\', \'desc\')" '.CommonFun::sortClass($orderby, 'supervise_register_organ').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('supervise_register_organ').'</th>';
              echo '<th onclick="orderby(\'supervise_register_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'supervise_register_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('supervise_register_time').'</th>';
              echo '<th onclick="orderby(\'supervise_register_statistics_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'supervise_register_statistics_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('supervise_register_statistics_time').'</th>';
              echo '<th onclick="orderby(\'is_discipline_transfer\', \'desc\')" '.CommonFun::sortClass($orderby, 'is_discipline_transfer').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('is_discipline_transfer').'</th>';
              echo '<th onclick="orderby(\'other_discipline_method\', \'desc\')" '.CommonFun::sortClass($orderby, 'other_discipline_method').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('other_discipline_method').'</th>';
              echo '<th onclick="orderby(\'transfer_unit\', \'desc\')" '.CommonFun::sortClass($orderby, 'transfer_unit').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('transfer_unit').'</th>';
              echo '<th onclick="orderby(\'brief_case_report\', \'desc\')" '.CommonFun::sortClass($orderby, 'brief_case_report').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('brief_case_report').'</th>';
              echo '<th onclick="orderby(\'register_report\', \'desc\')" '.CommonFun::sortClass($orderby, 'register_report').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('register_report').'</th>';
              echo '<th onclick="orderby(\'register_decide_book\', \'desc\')" '.CommonFun::sortClass($orderby, 'register_decide_book').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('register_decide_book').'</th>';
              echo '<th onclick="orderby(\'remarks\', \'desc\')" '.CommonFun::sortClass($orderby, 'remarks').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('remarks').'</th>';
              echo '<th onclick="orderby(\'is_violate_stipulate\', \'desc\')" '.CommonFun::sortClass($orderby, 'is_violate_stipulate').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('is_violate_stipulate').'</th>';
              echo '<th onclick="orderby(\'is_accountabilitye\', \'desc\')" '.CommonFun::sortClass($orderby, 'is_accountabilitye').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('is_accountabilitye').'</th>';
              echo '<th onclick="orderby(\'end_case_stat_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'end_case_stat_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('end_case_stat_time').'</th>';
              echo '<th onclick="orderby(\'close_case_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'close_case_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('close_case_time').'</th>';
              echo '<th onclick="orderby(\'end_case_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'end_case_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('end_case_time').'</th>';
              echo '<th onclick="orderby(\'accountability\', \'desc\')" '.CommonFun::sortClass($orderby, 'accountability').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('accountability').'</th>';
              echo '<th onclick="orderby(\'party_discipline\', \'desc\')" '.CommonFun::sortClass($orderby, 'party_discipline').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('party_discipline').'</th>';
              echo '<th onclick="orderby(\'party_discipline_stats_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'party_discipline_stats_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('party_discipline_stats_time').'</th>';
              echo '<th onclick="orderby(\'administrative_sanction\', \'desc\')" '.CommonFun::sortClass($orderby, 'administrative_sanction').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('administrative_sanction').'</th>';
              echo '<th onclick="orderby(\'administrative_sanction_stats_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'administrative_sanction_stats_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('administrative_sanction_stats_time').'</th>';
              echo '<th onclick="orderby(\'other_treatments\', \'desc\')" '.CommonFun::sortClass($orderby, 'other_treatments').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('other_treatments').'</th>';
              echo '<th onclick="orderby(\'other_treatments_stats_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'other_treatments_stats_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('other_treatments_stats_time').'</th>';
              echo '<th onclick="orderby(\'transfer_justice_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'transfer_justice_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('transfer_justice_time').'</th>';
              echo '<th onclick="orderby(\'transfer_justice_stats_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'transfer_justice_stats_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('transfer_justice_stats_time').'</th>';
              echo '<th onclick="orderby(\'public_inspection_processing\', \'desc\')" '.CommonFun::sortClass($orderby, 'public_inspection_processing').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('public_inspection_processing').'</th>';
              echo '<th onclick="orderby(\'public_inspection_processing_detail\', \'desc\')" '.CommonFun::sortClass($orderby, 'public_inspection_processing_detail').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('public_inspection_processing_detail').'</th>';
              echo '<th onclick="orderby(\'punishments_number_years\', \'desc\')" '.CommonFun::sortClass($orderby, 'punishments_number_years').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('punishments_number_years').'</th>';
              echo '<th onclick="orderby(\'punishments_number_month\', \'desc\')" '.CommonFun::sortClass($orderby, 'punishments_number_month').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('punishments_number_month').'</th>';
              echo '<th onclick="orderby(\'probation_number_years\', \'desc\')" '.CommonFun::sortClass($orderby, 'probation_number_years').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('probation_number_years').'</th>';
              echo '<th onclick="orderby(\'probation_number_month\', \'desc\')" '.CommonFun::sortClass($orderby, 'probation_number_month').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('probation_number_month').'</th>';
              echo '<th onclick="orderby(\'public_inspection_processing_stats_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'public_inspection_processing_stats_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('public_inspection_processing_stats_time').'</th>';
              echo '<th onclick="orderby(\'retrieve_loss\', \'desc\')" '.CommonFun::sortClass($orderby, 'retrieve_loss').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('retrieve_loss').'</th>';
              echo '<th onclick="orderby(\'capture_amount\', \'desc\')" '.CommonFun::sortClass($orderby, 'capture_amount').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('capture_amount').'</th>';
              echo '<th onclick="orderby(\'first_violations_discipline_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'first_violations_discipline_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('first_violations_discipline_time').'</th>';
              echo '<th onclick="orderby(\'last_violations_discipline_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'last_violations_discipline_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('last_violations_discipline_time').'</th>';
              echo '<th onclick="orderby(\'violation_discipline_happen_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'violation_discipline_happen_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('violation_discipline_happen_time').'</th>';
              echo '<th onclick="orderby(\'desert_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'desert_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('desert_time').'</th>';
              echo '<th onclick="orderby(\'desert_stats_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'desert_stats_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('desert_stats_time').'</th>';
              echo '<th onclick="orderby(\'hear_accept_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'hear_accept_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('hear_accept_time').'</th>';
              echo '<th onclick="orderby(\'hear_accept_stats_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'hear_accept_stats_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('hear_accept_stats_time').'</th>';
              echo '<th onclick="orderby(\'hear_office\', \'desc\')" '.CommonFun::sortClass($orderby, 'hear_office').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('hear_office').'</th>';
              echo '<th onclick="orderby(\'hear_end_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'hear_end_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('hear_end_time').'</th>';
              echo '<th onclick="orderby(\'hear_end_stats_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'hear_end_stats_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('hear_end_stats_time').'</th>';
              echo '<th onclick="orderby(\'punish_decide\', \'desc\')" '.CommonFun::sortClass($orderby, 'punish_decide').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('punish_decide').'</th>';
              echo '<th onclick="orderby(\'police_handle_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'police_handle_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('police_handle_time').'</th>';
              echo '<th onclick="orderby(\'judicial_judgment_amount\', \'desc\')" '.CommonFun::sortClass($orderby, 'judicial_judgment_amount').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('judicial_judgment_amount').'</th>';
              echo '<th onclick="orderby(\'investigation_report\', \'desc\')" '.CommonFun::sortClass($orderby, 'investigation_report').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('investigation_report').'</th>';
              echo '<th onclick="orderby(\'trial_report\', \'desc\')" '.CommonFun::sortClass($orderby, 'trial_report').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('trial_report').'</th>';
              echo '<th onclick="orderby(\'case_analysis\', \'desc\')" '.CommonFun::sortClass($orderby, 'case_analysis').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('case_analysis').'</th>';
              echo '<th onclick="orderby(\'party_watch_limit\', \'desc\')" '.CommonFun::sortClass($orderby, 'party_watch_limit').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('party_watch_limit').'</th>';
              echo '<th onclick="orderby(\'enterprise_level\', \'desc\')" '.CommonFun::sortClass($orderby, 'enterprise_level').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('enterprise_level').'</th>';
              echo '<th onclick="orderby(\'flight_direction\', \'desc\')" '.CommonFun::sortClass($orderby, 'flight_direction').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('flight_direction').'</th>';
              echo '<th onclick="orderby(\'flight_direction_details\', \'desc\')" '.CommonFun::sortClass($orderby, 'flight_direction_details').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('flight_direction_details').'</th>';
              echo '<th onclick="orderby(\'investigation_suspension_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'investigation_suspension_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('investigation_suspension_time').'</th>';
              echo '<th onclick="orderby(\'investigation_suspension_stats_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'investigation_suspension_stats_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('investigation_suspension_stats_time').'</th>';
              echo '<th onclick="orderby(\'administrative_sanctions_suspension_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'administrative_sanctions_suspension_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('administrative_sanctions_suspension_time').'</th>';
              echo '<th onclick="orderby(\'administrative_sanctions_suspension_stats_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'administrative_sanctions_suspension_stats_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('administrative_sanctions_suspension_stats_time').'</th>';
              echo '<th onclick="orderby(\'seizure_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'seizure_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('seizure_time').'</th>';
              echo '<th onclick="orderby(\'seizure_stats_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'seizure_stats_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('seizure_stats_time').'</th>';
              echo '<th onclick="orderby(\'case_analysis_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'case_analysis_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('case_analysis_time').'</th>';
              echo '<th onclick="orderby(\'disciplinary_offence\', \'desc\')" '.CommonFun::sortClass($orderby, 'disciplinary_offence').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('disciplinary_offence').'</th>';
              echo '<th onclick="orderby(\'post_disciplinary_offence\', \'desc\')" '.CommonFun::sortClass($orderby, 'post_disciplinary_offence').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('post_disciplinary_offence').'</th>';
              echo '<th onclick="orderby(\'other_disciplinary_offence\', \'desc\')" '.CommonFun::sortClass($orderby, 'other_disciplinary_offence').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('other_disciplinary_offence').'</th>';
              echo '<th onclick="orderby(\'organs_take_measures\', \'desc\')" '.CommonFun::sortClass($orderby, 'organs_take_measures').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('organs_take_measures').'</th>';
              echo '<th onclick="orderby(\'organs_take_measures_name\', \'desc\')" '.CommonFun::sortClass($orderby, 'organs_take_measures_name').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('organs_take_measures_name').'</th>';
              echo '<th onclick="orderby(\'starting_detention_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'starting_detention_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('starting_detention_time').'</th>';
              echo '<th onclick="orderby(\'starting_detention_stats_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'starting_detention_stats_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('starting_detention_stats_time').'</th>';
              echo '<th onclick="orderby(\'location_measures_taken\', \'desc\')" '.CommonFun::sortClass($orderby, 'location_measures_taken').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('location_measures_taken').'</th>';
              echo '<th onclick="orderby(\'location_measures_taken_class\', \'desc\')" '.CommonFun::sortClass($orderby, 'location_measures_taken_class').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('location_measures_taken_class').'</th>';
              echo '<th onclick="orderby(\'lien_approval_situation\', \'desc\')" '.CommonFun::sortClass($orderby, 'lien_approval_situation').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('lien_approval_situation').'</th>';
              echo '<th onclick="orderby(\'lien_end_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'lien_end_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('lien_end_time').'</th>';
              echo '<th onclick="orderby(\'lien_end_stats_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'lien_end_stats_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('lien_end_stats_time').'</th>';
              echo '<th onclick="orderby(\'lien_number_days\', \'desc\')" '.CommonFun::sortClass($orderby, 'lien_number_days').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('lien_number_days').'</th>';
              echo '<th onclick="orderby(\'is_delay\', \'desc\')" '.CommonFun::sortClass($orderby, 'is_delay').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('is_delay').'</th>';
              echo '<th onclick="orderby(\'delay_number_days\', \'desc\')" '.CommonFun::sortClass($orderby, 'delay_number_days').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('delay_number_days').'</th>';
              echo '<th onclick="orderby(\'delay_approval_situation\', \'desc\')" '.CommonFun::sortClass($orderby, 'delay_approval_situation').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('delay_approval_situation').'</th>';
              echo '<th onclick="orderby(\'organization_measure\', \'desc\')" '.CommonFun::sortClass($orderby, 'organization_measure').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('organization_measure').'</th>';
              echo '<th onclick="orderby(\'organization_measure_stats_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'organization_measure_stats_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('organization_measure_stats_time').'</th>';
              echo '<th onclick="orderby(\'amount_transferred_judicial_organs\', \'desc\')" '.CommonFun::sortClass($orderby, 'amount_transferred_judicial_organs').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('amount_transferred_judicial_organs').'</th>';
              echo '<th onclick="orderby(\'two_rule_start_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'two_rule_start_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('two_rule_start_time').'</th>';
              echo '<th onclick="orderby(\'two_rule_stats_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'two_rule_stats_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('two_rule_stats_time').'</th>';
              echo '<th onclick="orderby(\'two_rule_remove_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'two_rule_remove_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('two_rule_remove_time').'</th>';
              echo '<th onclick="orderby(\'two_rule_remove_stats_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'two_rule_remove_stats_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('two_rule_remove_stats_time').'</th>';
              echo '<th onclick="orderby(\'confessional_books\', \'desc\')" '.CommonFun::sortClass($orderby, 'confessional_books').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('confessional_books').'</th>';
              echo '<th onclick="orderby(\'department_charge\', \'desc\')" '.CommonFun::sortClass($orderby, 'department_charge').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('department_charge').'</th>';
              echo '<th onclick="orderby(\'superiors_assigned\', \'desc\')" '.CommonFun::sortClass($orderby, 'superiors_assigned').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('superiors_assigned').'</th>';
              echo '<th onclick="orderby(\'del_status\', \'desc\')" '.CommonFun::sortClass($orderby, 'del_status').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('del_status').'</th>';
              echo '<th onclick="orderby(\'create_date\', \'desc\')" '.CommonFun::sortClass($orderby, 'create_date').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('create_date').'</th>';
              echo '<th onclick="orderby(\'update_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'update_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('update_time').'</th>';
         
			?>
	
            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >操作</th>
            </tr>
            </thead>
            <tbody>
            
            <?php
            foreach ($models as $model) {
                echo '<tr id="rowid_' . $model->id . '">';
                echo '  <td><label><input type="checkbox" value="' . $model->id . '"></label></td>';
                echo '  <td>' . $model->id . '</td>';
                echo '  <td>' . $model->nuit_name . '</td>';
                echo '  <td>' . $model->nuit_code . '</td>';
                echo '  <td>' . $model->is_nuit . '</td>';
                echo '  <td>' . $model->case_code . '</td>';
                echo '  <td>' . $model->personnel_code . '</td>';
                echo '  <td>' . $model->person_investigated . '</td>';
                echo '  <td>' . $model->credentials_type . '</td>';
                echo '  <td>' . $model->credentials_number . '</td>';
                echo '  <td>' . $model->sex . '</td>';
                echo '  <td>' . $model->age . '</td>';
                echo '  <td>' . $model->date_birth . '</td>';
                echo '  <td>' . $model->academic . '</td>';
                echo '  <td>' . $model->nation . '</td>';
                echo '  <td>' . $model->is_supervises_object . '</td>';
                echo '  <td>' . $model->supervises_object_details . '</td>';
                echo '  <td>' . $model->is_party . '</td>';
                echo '  <td>' . $model->party_delegate . '</td>';
                echo '  <td>' . $model->disposal_report . '</td>';
                echo '  <td>' . $model->time_joining_party . '</td>';
                echo '  <td>' . $model->no_party_objects . '</td>';
                echo '  <td>' . $model->no_party_objects_details . '</td>';
                echo '  <td>' . $model->cpc . '</td>';
                echo '  <td>' . $model->cppcc . '</td>';
                echo '  <td>' . $model->discipline_commission . '</td>';
                echo '  <td>' . $model->party_commission . '</td>';
                echo '  <td>' . $model->on_job_time . '</td>';
                echo '  <td>' . $model->head_violating . '</td>';
                echo '  <td>' . $model->head_details . '</td>';
                echo '  <td>' . $model->head_details_two . '</td>';
                echo '  <td>' . $model->rank_job . '</td>';
                echo '  <td>' . $model->deputy_rank_job . '</td>';
                echo '  <td>' . $model->duty_job . '</td>';
                echo '  <td>' . $model->authority_management . '</td>';
                echo '  <td>' . $model->department_class . '</td>';
                echo '  <td>' . $model->department_class_one . '</td>';
                echo '  <td>' . $model->department_classtwo . '</td>';
                echo '  <td>' . $model->nature_enterprise . '</td>';
                echo '  <td>' . $model->nature_enterprise_one . '</td>';
                echo '  <td>' . $model->category_enterprise_personnel . '</td>';
                echo '  <td>' . $model->enterprise_post . '</td>';
                echo '  <td>' . $model->jobbery_lose . '</td>';
                echo '  <td>' . $model->discipline_amount . '</td>';
                echo '  <td>' . $model->case_amount . '</td>';
                echo '  <td>' . $model->filing_time . '</td>';
                echo '  <td>' . $model->source_case . '</td>';
                echo '  <td>' . $model->discipline_organ . '</td>';
                echo '  <td>' . $model->discipline_organ_time . '</td>';
                echo '  <td>' . $model->discipline_organ_stats_time . '</td>';
                echo '  <td>' . $model->supervise_register_organ . '</td>';
                echo '  <td>' . $model->supervise_register_time . '</td>';
                echo '  <td>' . $model->supervise_register_statistics_time . '</td>';
                echo '  <td>' . $model->is_discipline_transfer . '</td>';
                echo '  <td>' . $model->other_discipline_method . '</td>';
                echo '  <td>' . $model->transfer_unit . '</td>';
                echo '  <td>' . $model->brief_case_report . '</td>';
                echo '  <td>' . $model->register_report . '</td>';
                echo '  <td>' . $model->register_decide_book . '</td>';
                echo '  <td>' . $model->remarks . '</td>';
                echo '  <td>' . $model->is_violate_stipulate . '</td>';
                echo '  <td>' . $model->is_accountabilitye . '</td>';
                echo '  <td>' . $model->end_case_stat_time . '</td>';
                echo '  <td>' . $model->close_case_time . '</td>';
                echo '  <td>' . $model->end_case_time . '</td>';
                echo '  <td>' . $model->accountability . '</td>';
                echo '  <td>' . $model->party_discipline . '</td>';
                echo '  <td>' . $model->party_discipline_stats_time . '</td>';
                echo '  <td>' . $model->administrative_sanction . '</td>';
                echo '  <td>' . $model->administrative_sanction_stats_time . '</td>';
                echo '  <td>' . $model->other_treatments . '</td>';
                echo '  <td>' . $model->other_treatments_stats_time . '</td>';
                echo '  <td>' . $model->transfer_justice_time . '</td>';
                echo '  <td>' . $model->transfer_justice_stats_time . '</td>';
                echo '  <td>' . $model->public_inspection_processing . '</td>';
                echo '  <td>' . $model->public_inspection_processing_detail . '</td>';
                echo '  <td>' . $model->punishments_number_years . '</td>';
                echo '  <td>' . $model->punishments_number_month . '</td>';
                echo '  <td>' . $model->probation_number_years . '</td>';
                echo '  <td>' . $model->probation_number_month . '</td>';
                echo '  <td>' . $model->public_inspection_processing_stats_time . '</td>';
                echo '  <td>' . $model->retrieve_loss . '</td>';
                echo '  <td>' . $model->capture_amount . '</td>';
                echo '  <td>' . $model->first_violations_discipline_time . '</td>';
                echo '  <td>' . $model->last_violations_discipline_time . '</td>';
                echo '  <td>' . $model->violation_discipline_happen_time . '</td>';
                echo '  <td>' . $model->desert_time . '</td>';
                echo '  <td>' . $model->desert_stats_time . '</td>';
                echo '  <td>' . $model->hear_accept_time . '</td>';
                echo '  <td>' . $model->hear_accept_stats_time . '</td>';
                echo '  <td>' . $model->hear_office . '</td>';
                echo '  <td>' . $model->hear_end_time . '</td>';
                echo '  <td>' . $model->hear_end_stats_time . '</td>';
                echo '  <td>' . $model->punish_decide . '</td>';
                echo '  <td>' . $model->police_handle_time . '</td>';
                echo '  <td>' . $model->judicial_judgment_amount . '</td>';
                echo '  <td>' . $model->investigation_report . '</td>';
                echo '  <td>' . $model->trial_report . '</td>';
                echo '  <td>' . $model->case_analysis . '</td>';
                echo '  <td>' . $model->party_watch_limit . '</td>';
                echo '  <td>' . $model->enterprise_level . '</td>';
                echo '  <td>' . $model->flight_direction . '</td>';
                echo '  <td>' . $model->flight_direction_details . '</td>';
                echo '  <td>' . $model->investigation_suspension_time . '</td>';
                echo '  <td>' . $model->investigation_suspension_stats_time . '</td>';
                echo '  <td>' . $model->administrative_sanctions_suspension_time . '</td>';
                echo '  <td>' . $model->administrative_sanctions_suspension_stats_time . '</td>';
                echo '  <td>' . $model->seizure_time . '</td>';
                echo '  <td>' . $model->seizure_stats_time . '</td>';
                echo '  <td>' . $model->case_analysis_time . '</td>';
                echo '  <td>' . $model->disciplinary_offence . '</td>';
                echo '  <td>' . $model->post_disciplinary_offence . '</td>';
                echo '  <td>' . $model->other_disciplinary_offence . '</td>';
                echo '  <td>' . $model->organs_take_measures . '</td>';
                echo '  <td>' . $model->organs_take_measures_name . '</td>';
                echo '  <td>' . $model->starting_detention_time . '</td>';
                echo '  <td>' . $model->starting_detention_stats_time . '</td>';
                echo '  <td>' . $model->location_measures_taken . '</td>';
                echo '  <td>' . $model->location_measures_taken_class . '</td>';
                echo '  <td>' . $model->lien_approval_situation . '</td>';
                echo '  <td>' . $model->lien_end_time . '</td>';
                echo '  <td>' . $model->lien_end_stats_time . '</td>';
                echo '  <td>' . $model->lien_number_days . '</td>';
                echo '  <td>' . $model->is_delay . '</td>';
                echo '  <td>' . $model->delay_number_days . '</td>';
                echo '  <td>' . $model->delay_approval_situation . '</td>';
                echo '  <td>' . $model->organization_measure . '</td>';
                echo '  <td>' . $model->organization_measure_stats_time . '</td>';
                echo '  <td>' . $model->amount_transferred_judicial_organs . '</td>';
                echo '  <td>' . $model->two_rule_start_time . '</td>';
                echo '  <td>' . $model->two_rule_stats_time . '</td>';
                echo '  <td>' . $model->two_rule_remove_time . '</td>';
                echo '  <td>' . $model->two_rule_remove_stats_time . '</td>';
                echo '  <td>' . $model->confessional_books . '</td>';
                echo '  <td>' . $model->department_charge . '</td>';
                echo '  <td>' . $model->superiors_assigned . '</td>';
                echo '  <td>' . $model->del_status . '</td>';
                echo '  <td>' . $model->create_date . '</td>';
                echo '  <td>' . $model->update_time . '</td>';
                echo '  <td class="center">';
                echo '      <a id="view_btn" onclick="viewAction(' . $model->id . ')" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i>查看</a>';
                echo '      <a id="edit_btn" onclick="editAction(' . $model->id . ')" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-edit icon-white"></i>修改</a>';
                echo '      <a id="delete_btn" onclick="deleteAction(' . $model->id . ')" class="btn btn-danger btn-sm" href="#"> <i class="glyphicon glyphicon-trash icon-white"></i>删除</a>';
                echo '  </td>';
                echo '</tr>';
            }
            
            ?>
            
           
           
            </tbody>
            <!-- <tfoot></tfoot> -->
          </table>
          </div>
          </div>
          <!-- row end -->
          
          <!-- row start -->
          <div class="row">
          	<div class="col-sm-5">
            	<div class="dataTables_info" id="data_table_info" role="status" aria-live="polite">
            		<div class="infos">
            		从<?= $pages->getPage() * $pages->getPageSize() + 1 ?>            		到 <?= ($pageCount = ($pages->getPage() + 1) * $pages->getPageSize()) < $pages->totalCount ?  $pageCount : $pages->totalCount?>            		 共 <?= $pages->totalCount?> 条记录</div>
            	</div>
            </div>
          	<div class="col-sm-7">
              	<div class="dataTables_paginate paging_simple_numbers" id="data_table_paginate">
              	<?= LinkPager::widget([
              	    'pagination' => $pages,
              	    'nextPageLabel' => '»',
              	    'prevPageLabel' => '«',
              	    'firstPageLabel' => '首页',
              	    'lastPageLabel' => '尾页',
              	]); ?>	
              	
              	</div>
          	</div>
		  </div>
		  <!-- row end -->
        </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->

<div class="modal fade" id="edit_dialog" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
                <?php $form = ActiveForm::begin(["id" => "qinlian-register-form", "class"=>"form-horizontal", "action"=>Url::toRoute("qinlian-register/save")]); ?>                      
                 
          <input type="hidden" class="form-control" id="id" name="id" />

          <div id="nuit_name_div" class="form-group">
              <label for="nuit_name" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("nuit_name")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="nuit_name" name="QinlianRegister[nuit_name]" placeholder="" />
              </div>

              <label for="nuit_code" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("nuit_code")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="nuit_code" name="QinlianRegister[nuit_code]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="is_nuit_div" class="form-group">
              <label for="is_nuit" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("is_nuit")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="is_nuit" name="QinlianRegister[is_nuit]" placeholder="" />
              </div>

              <label for="case_code" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("case_code")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="case_code" name="QinlianRegister[case_code]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="personnel_code_div" class="form-group">
              <label for="personnel_code" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("personnel_code")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="personnel_code" name="QinlianRegister[personnel_code]" placeholder="" />
              </div>

              <label for="person_investigated" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("person_investigated")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="person_investigated" name="QinlianRegister[person_investigated]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="credentials_type_div" class="form-group">
              <label for="credentials_type" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("credentials_type")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="credentials_type" name="QinlianRegister[credentials_type]" placeholder="" />
              </div>

              <label for="credentials_number" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("credentials_number")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="credentials_number" name="QinlianRegister[credentials_number]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="sex_div" class="form-group">
              <label for="sex" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("sex")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="sex" name="QinlianRegister[sex]" placeholder="" />
              </div>

              <label for="age" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("age")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="age" name="QinlianRegister[age]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="date_birth_div" class="form-group">
              <label for="date_birth" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("date_birth")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="date_birth" name="QinlianRegister[date_birth]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>

              <label for="academic" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("academic")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="academic" name="QinlianRegister[academic]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="nation_div" class="form-group">
              <label for="nation" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("nation")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="nation" name="QinlianRegister[nation]" placeholder="" />
              </div>

              <label for="is_supervises_object" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("is_supervises_object")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="is_supervises_object" name="QinlianRegister[is_supervises_object]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="supervises_object_details_div" class="form-group">
              <label for="supervises_object_details" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("supervises_object_details")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="supervises_object_details" name="QinlianRegister[supervises_object_details]" placeholder="必填" />
              </div>

              <label for="is_party" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("is_party")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="is_party" name="QinlianRegister[is_party]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="party_delegate_div" class="form-group">
              <label for="party_delegate" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("party_delegate")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="party_delegate" name="QinlianRegister[party_delegate]" placeholder="" />
              </div>

              <label for="disposal_report" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("disposal_report")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="disposal_report" name="QinlianRegister[disposal_report]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="time_joining_party_div" class="form-group">
              <label for="time_joining_party" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("time_joining_party")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="time_joining_party" name="QinlianRegister[time_joining_party]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>

              <label for="no_party_objects" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("no_party_objects")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="no_party_objects" name="QinlianRegister[no_party_objects]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="no_party_objects_details_div" class="form-group">
              <label for="no_party_objects_details" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("no_party_objects_details")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="no_party_objects_details" name="QinlianRegister[no_party_objects_details]" placeholder="" />
              </div>

              <label for="cpc" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("cpc")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="cpc" name="QinlianRegister[cpc]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="cppcc_div" class="form-group">
              <label for="cppcc" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("cppcc")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="cppcc" name="QinlianRegister[cppcc]" placeholder="" />
              </div>

              <label for="discipline_commission" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("discipline_commission")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="discipline_commission" name="QinlianRegister[discipline_commission]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="party_commission_div" class="form-group">
              <label for="party_commission" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("party_commission")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="party_commission" name="QinlianRegister[party_commission]" placeholder="" />
              </div>

              <label for="on_job_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("on_job_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="on_job_time" name="QinlianRegister[on_job_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="head_violating_div" class="form-group">
              <label for="head_violating" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("head_violating")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="head_violating" name="QinlianRegister[head_violating]" placeholder="" />
              </div>

              <label for="head_details" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("head_details")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="head_details" name="QinlianRegister[head_details]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="head_details_two_div" class="form-group">
              <label for="head_details_two" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("head_details_two")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="head_details_two" name="QinlianRegister[head_details_two]" placeholder="" />
              </div>

              <label for="rank_job" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("rank_job")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="rank_job" name="QinlianRegister[rank_job]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="deputy_rank_job_div" class="form-group">
              <label for="deputy_rank_job" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("deputy_rank_job")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="deputy_rank_job" name="QinlianRegister[deputy_rank_job]" placeholder="" />
              </div>

              <label for="duty_job" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("duty_job")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="duty_job" name="QinlianRegister[duty_job]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="authority_management_div" class="form-group">
              <label for="authority_management" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("authority_management")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="authority_management" name="QinlianRegister[authority_management]" placeholder="" />
              </div>

              <label for="department_class" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("department_class")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="department_class" name="QinlianRegister[department_class]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="department_class_one_div" class="form-group">
              <label for="department_class_one" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("department_class_one")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="department_class_one" name="QinlianRegister[department_class_one]" placeholder="" />
              </div>

              <label for="department_classtwo" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("department_classtwo")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="department_classtwo" name="QinlianRegister[department_classtwo]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="nature_enterprise_div" class="form-group">
              <label for="nature_enterprise" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("nature_enterprise")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="nature_enterprise" name="QinlianRegister[nature_enterprise]" placeholder="" />
              </div>

              <label for="nature_enterprise_one" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("nature_enterprise_one")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="nature_enterprise_one" name="QinlianRegister[nature_enterprise_one]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="category_enterprise_personnel_div" class="form-group">
              <label for="category_enterprise_personnel" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("category_enterprise_personnel")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="category_enterprise_personnel" name="QinlianRegister[category_enterprise_personnel]" placeholder="" />
              </div>

              <label for="enterprise_post" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("enterprise_post")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="enterprise_post" name="QinlianRegister[enterprise_post]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="jobbery_lose_div" class="form-group">
              <label for="jobbery_lose" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("jobbery_lose")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="jobbery_lose" name="QinlianRegister[jobbery_lose]" placeholder="" />
              </div>

              <label for="discipline_amount" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("discipline_amount")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="discipline_amount" name="QinlianRegister[discipline_amount]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="case_amount_div" class="form-group">
              <label for="case_amount" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("case_amount")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="case_amount" name="QinlianRegister[case_amount]" placeholder="" />
              </div>

              <label for="filing_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("filing_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="filing_time" name="QinlianRegister[filing_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="source_case_div" class="form-group">
              <label for="source_case" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("source_case")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="source_case" name="QinlianRegister[source_case]" placeholder="" />
              </div>

              <label for="discipline_organ" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("discipline_organ")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="discipline_organ" name="QinlianRegister[discipline_organ]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="discipline_organ_time_div" class="form-group">
              <label for="discipline_organ_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("discipline_organ_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="discipline_organ_time" name="QinlianRegister[discipline_organ_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>

              <label for="discipline_organ_stats_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("discipline_organ_stats_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="discipline_organ_stats_time" name="QinlianRegister[discipline_organ_stats_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="supervise_register_organ_div" class="form-group">
              <label for="supervise_register_organ" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("supervise_register_organ")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="supervise_register_organ" name="QinlianRegister[supervise_register_organ]" placeholder="" />
              </div>

              <label for="supervise_register_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("supervise_register_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="supervise_register_time" name="QinlianRegister[supervise_register_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="supervise_register_statistics_time_div" class="form-group">
              <label for="supervise_register_statistics_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("supervise_register_statistics_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="supervise_register_statistics_time" name="QinlianRegister[supervise_register_statistics_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>

              <label for="is_discipline_transfer" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("is_discipline_transfer")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="is_discipline_transfer" name="QinlianRegister[is_discipline_transfer]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="other_discipline_method_div" class="form-group">
              <label for="other_discipline_method" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("other_discipline_method")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="other_discipline_method" name="QinlianRegister[other_discipline_method]" placeholder="" />
              </div>

              <label for="transfer_unit" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("transfer_unit")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="transfer_unit" name="QinlianRegister[transfer_unit]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="brief_case_report_div" class="form-group">
              <label for="brief_case_report" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("brief_case_report")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="brief_case_report" name="QinlianRegister[brief_case_report]" placeholder="" />
              </div>

              <label for="register_report" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("register_report")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="register_report" name="QinlianRegister[register_report]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="register_decide_book_div" class="form-group">
              <label for="register_decide_book" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("register_decide_book")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="register_decide_book" name="QinlianRegister[register_decide_book]" placeholder="" />
              </div>

              <label for="remarks" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("remarks")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="remarks" name="QinlianRegister[remarks]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="is_violate_stipulate_div" class="form-group">
              <label for="is_violate_stipulate" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("is_violate_stipulate")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="is_violate_stipulate" name="QinlianRegister[is_violate_stipulate]" placeholder="必填" />
              </div>

              <label for="is_accountabilitye" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("is_accountabilitye")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="is_accountabilitye" name="QinlianRegister[is_accountabilitye]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="end_case_stat_time_div" class="form-group">
              <label for="end_case_stat_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("end_case_stat_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="end_case_stat_time" name="QinlianRegister[end_case_stat_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>

              <label for="close_case_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("close_case_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="close_case_time" name="QinlianRegister[close_case_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="end_case_time_div" class="form-group">
              <label for="end_case_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("end_case_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="end_case_time" name="QinlianRegister[end_case_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>

              <label for="accountability" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("accountability")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="accountability" name="QinlianRegister[accountability]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="party_discipline_div" class="form-group">
              <label for="party_discipline" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("party_discipline")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="party_discipline" name="QinlianRegister[party_discipline]" placeholder="" />
              </div>
              <label for="party_discipline_stats_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("party_discipline_stats_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="party_discipline_stats_time" name="QinlianRegister[party_discipline_stats_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="administrative_sanction_div" class="form-group">
              <label for="administrative_sanction" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("administrative_sanction")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="administrative_sanction" name="QinlianRegister[administrative_sanction]" placeholder="" />
              </div>

              <label for="administrative_sanction_stats_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("administrative_sanction_stats_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="administrative_sanction_stats_time" name="QinlianRegister[administrative_sanction_stats_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="other_treatments_div" class="form-group">
              <label for="other_treatments" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("other_treatments")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="other_treatments" name="QinlianRegister[other_treatments]" placeholder="" />
              </div>

              <label for="other_treatments_stats_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("other_treatments_stats_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="other_treatments_stats_time" name="QinlianRegister[other_treatments_stats_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="transfer_justice_time_div" class="form-group">
              <label for="transfer_justice_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("transfer_justice_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="transfer_justice_time" name="QinlianRegister[transfer_justice_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>

              <label for="transfer_justice_stats_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("transfer_justice_stats_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="transfer_justice_stats_time" name="QinlianRegister[transfer_justice_stats_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="public_inspection_processing_div" class="form-group">
              <label for="public_inspection_processing" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("public_inspection_processing")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="public_inspection_processing" name="QinlianRegister[public_inspection_processing]" placeholder="" />
              </div>

              <label for="public_inspection_processing_detail" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("public_inspection_processing_detail")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="public_inspection_processing_detail" name="QinlianRegister[public_inspection_processing_detail]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="punishments_number_years_div" class="form-group">
              <label for="punishments_number_years" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("punishments_number_years")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="punishments_number_years" name="QinlianRegister[punishments_number_years]" placeholder="" />
              </div>

              <label for="punishments_number_month" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("punishments_number_month")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="punishments_number_month" name="QinlianRegister[punishments_number_month]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="probation_number_years_div" class="form-group">
              <label for="probation_number_years" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("probation_number_years")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="probation_number_years" name="QinlianRegister[probation_number_years]" placeholder="" />
              </div>

              <label for="probation_number_month" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("probation_number_month")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="probation_number_month" name="QinlianRegister[probation_number_month]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="public_inspection_processing_stats_time_div" class="form-group">
              <label for="public_inspection_processing_stats_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("public_inspection_processing_stats_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="public_inspection_processing_stats_time" name="QinlianRegister[public_inspection_processing_stats_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>

              <label for="retrieve_loss" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("retrieve_loss")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="retrieve_loss" name="QinlianRegister[retrieve_loss]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="capture_amount_div" class="form-group">
              <label for="capture_amount" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("capture_amount")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="capture_amount" name="QinlianRegister[capture_amount]" placeholder="" />
              </div>

              <label for="first_violations_discipline_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("first_violations_discipline_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="first_violations_discipline_time" name="QinlianRegister[first_violations_discipline_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="last_violations_discipline_time_div" class="form-group">
              <label for="last_violations_discipline_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("last_violations_discipline_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="last_violations_discipline_time" name="QinlianRegister[last_violations_discipline_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>

              <label for="violation_discipline_happen_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("violation_discipline_happen_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="violation_discipline_happen_time" name="QinlianRegister[violation_discipline_happen_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="desert_time_div" class="form-group">
              <label for="desert_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("desert_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="desert_time" name="QinlianRegister[desert_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>

              <label for="desert_stats_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("desert_stats_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="desert_stats_time" name="QinlianRegister[desert_stats_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="hear_accept_time_div" class="form-group">
              <label for="hear_accept_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("hear_accept_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="hear_accept_time" name="QinlianRegister[hear_accept_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>

              <label for="hear_accept_stats_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("hear_accept_stats_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="hear_accept_stats_time" name="QinlianRegister[hear_accept_stats_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="hear_office_div" class="form-group">
              <label for="hear_office" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("hear_office")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="hear_office" name="QinlianRegister[hear_office]" placeholder="" />
              </div>

              <label for="hear_end_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("hear_end_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="hear_end_time" name="QinlianRegister[hear_end_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="hear_end_stats_time_div" class="form-group">
              <label for="hear_end_stats_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("hear_end_stats_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="hear_end_stats_time" name="QinlianRegister[hear_end_stats_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>

              <label for="punish_decide" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("punish_decide")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="punish_decide" name="QinlianRegister[punish_decide]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="police_handle_time_div" class="form-group">
              <label for="police_handle_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("police_handle_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="police_handle_time" name="QinlianRegister[police_handle_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>

              <label for="judicial_judgment_amount" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("judicial_judgment_amount")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="judicial_judgment_amount" name="QinlianRegister[judicial_judgment_amount]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="investigation_report_div" class="form-group">
              <label for="investigation_report" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("investigation_report")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="investigation_report" name="QinlianRegister[investigation_report]" placeholder="" />
              </div>

              <label for="trial_report" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("trial_report")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="trial_report" name="QinlianRegister[trial_report]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="case_analysis_div" class="form-group">
              <label for="case_analysis" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("case_analysis")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="case_analysis" name="QinlianRegister[case_analysis]" placeholder="" />
              </div>

              <label for="party_watch_limit" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("party_watch_limit")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="party_watch_limit" name="QinlianRegister[party_watch_limit]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="enterprise_level_div" class="form-group">
              <label for="enterprise_level" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("enterprise_level")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="enterprise_level" name="QinlianRegister[enterprise_level]" placeholder="" />
              </div>

              <label for="flight_direction" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("flight_direction")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="flight_direction" name="QinlianRegister[flight_direction]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="flight_direction_details_div" class="form-group">
              <label for="flight_direction_details" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("flight_direction_details")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="flight_direction_details" name="QinlianRegister[flight_direction_details]" placeholder="" />
              </div>

              <label for="investigation_suspension_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("investigation_suspension_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="investigation_suspension_time" name="QinlianRegister[investigation_suspension_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="investigation_suspension_stats_time_div" class="form-group">
              <label for="investigation_suspension_stats_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("investigation_suspension_stats_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="investigation_suspension_stats_time" name="QinlianRegister[investigation_suspension_stats_time]" placeholder=" data-provide="datepicker" data-date-format="yyyy-mm-dd"" />
              </div>

              <label for="administrative_sanctions_suspension_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("administrative_sanctions_suspension_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="administrative_sanctions_suspension_time" name="QinlianRegister[administrative_sanctions_suspension_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="administrative_sanctions_suspension_stats_time_div" class="form-group">
              <label for="administrative_sanctions_suspension_stats_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("administrative_sanctions_suspension_stats_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="administrative_sanctions_suspension_stats_time" name="QinlianRegister[administrative_sanctions_suspension_stats_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>

              <label for="seizure_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("seizure_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="seizure_time" name="QinlianRegister[seizure_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="seizure_stats_time_div" class="form-group">
              <label for="seizure_stats_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("seizure_stats_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="seizure_stats_time" name="QinlianRegister[seizure_stats_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>

              <label for="case_analysis_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("case_analysis_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="case_analysis_time" name="QinlianRegister[case_analysis_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="disciplinary_offence_div" class="form-group">
              <label for="disciplinary_offence" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("disciplinary_offence")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="disciplinary_offence" name="QinlianRegister[disciplinary_offence]" placeholder="" />
              </div>

              <label for="post_disciplinary_offence" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("post_disciplinary_offence")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="post_disciplinary_offence" name="QinlianRegister[post_disciplinary_offence]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="other_disciplinary_offence_div" class="form-group">
              <label for="other_disciplinary_offence" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("other_disciplinary_offence")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="other_disciplinary_offence" name="QinlianRegister[other_disciplinary_offence]" placeholder="" />
              </div>

              <label for="organs_take_measures" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("organs_take_measures")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="organs_take_measures" name="QinlianRegister[organs_take_measures]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="organs_take_measures_name_div" class="form-group">
              <label for="organs_take_measures_name" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("organs_take_measures_name")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="organs_take_measures_name" name="QinlianRegister[organs_take_measures_name]" placeholder="" />
              </div>

              <label for="starting_detention_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("starting_detention_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="starting_detention_time" name="QinlianRegister[starting_detention_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="starting_detention_stats_time_div" class="form-group">
              <label for="starting_detention_stats_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("starting_detention_stats_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="starting_detention_stats_time" name="QinlianRegister[starting_detention_stats_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>

              <label for="location_measures_taken" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("location_measures_taken")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="location_measures_taken" name="QinlianRegister[location_measures_taken]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="location_measures_taken_class_div" class="form-group">
              <label for="location_measures_taken_class" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("location_measures_taken_class")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="location_measures_taken_class" name="QinlianRegister[location_measures_taken_class]" placeholder="" />
              </div>

              <label for="lien_approval_situation" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("lien_approval_situation")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="lien_approval_situation" name="QinlianRegister[lien_approval_situation]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="lien_end_time_div" class="form-group">
              <label for="lien_end_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("lien_end_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="lien_end_time" name="QinlianRegister[lien_end_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>

              <label for="lien_end_stats_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("lien_end_stats_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="lien_end_stats_time" name="QinlianRegister[lien_end_stats_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="lien_number_days_div" class="form-group">
              <label for="lien_number_days" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("lien_number_days")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="lien_number_days" name="QinlianRegister[lien_number_days]" placeholder="" />
              </div>

              <label for="is_delay" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("is_delay")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="is_delay" name="QinlianRegister[is_delay]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="delay_number_days_div" class="form-group">
              <label for="delay_number_days" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("delay_number_days")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="delay_number_days" name="QinlianRegister[delay_number_days]" placeholder="" />
              </div>

              <label for="delay_approval_situation" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("delay_approval_situation")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="delay_approval_situation" name="QinlianRegister[delay_approval_situation]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="organization_measure_div" class="form-group">
              <label for="organization_measure" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("organization_measure")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="organization_measure" name="QinlianRegister[organization_measure]" placeholder="" />
              </div>

              <label for="organization_measure_stats_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("organization_measure_stats_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="organization_measure_stats_time" name="QinlianRegister[organization_measure_stats_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="amount_transferred_judicial_organs_div" class="form-group">
              <label for="amount_transferred_judicial_organs" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("amount_transferred_judicial_organs")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="amount_transferred_judicial_organs" name="QinlianRegister[amount_transferred_judicial_organs]" placeholder="" />
              </div>

              <label for="two_rule_start_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("two_rule_start_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="two_rule_start_time" name="QinlianRegister[two_rule_start_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="two_rule_stats_time_div" class="form-group">
              <label for="two_rule_stats_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("two_rule_stats_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="two_rule_stats_time" name="QinlianRegister[two_rule_stats_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>

              <label for="two_rule_remove_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("two_rule_remove_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="two_rule_remove_time" name="QinlianRegister[two_rule_remove_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="two_rule_remove_stats_time_div" class="form-group">
              <label for="two_rule_remove_stats_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("two_rule_remove_stats_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="two_rule_remove_stats_time" name="QinlianRegister[two_rule_remove_stats_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>

              <label for="confessional_books" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("confessional_books")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="confessional_books" name="QinlianRegister[confessional_books]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="department_charge_div" class="form-group">
              <label for="department_charge" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("department_charge")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="department_charge" name="QinlianRegister[department_charge]" placeholder="" />
              </div>

              <label for="superiors_assigned" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("superiors_assigned")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="superiors_assigned" name="QinlianRegister[superiors_assigned]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="del_status_div" class="form-group">
              <label for="del_status" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("del_status")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="del_status" name="QinlianRegister[del_status]" placeholder="" />
              </div>

              <label for="create_date" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("create_date")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="create_date" name="QinlianRegister[create_date]" placeholder="必填" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="update_time_div" class="form-group">
              <label for="update_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("update_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="update_time" name="QinlianRegister[update_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>
              <div class="clearfix"></div>
          </div>
                    

			<?php ActiveForm::end(); ?>          
                </div>
			<div class="modal-footer">
				<a href="#" class="btn btn-default" data-dismiss="modal">关闭</a> <a
					id="edit_dialog_ok" href="#" class="btn btn-primary">确定</a>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="uploadFile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <form action="<?=Url::toRoute('qinlian-register/import')?>" method="post" enctype="multipart/form-data">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><a href="/excel/ExcelImport/case.xlsx" class="btn btn-xs btn-info">下载导入模板</a></h4>
                </div>
                <div class="modal-body">
                    <input  name="importExcelFile" type="file" accept=".xls,.xlsx"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-primary">确认提交</button>
                </div>
            </div>
        </div>
    </form>
</div>

<?php $this->beginBlock('footer');  ?>
<!-- <body></body>后代码块 -->
 <script>
function orderby(field, op){
	 var url = window.location.search;
	 var optemp = field + " desc";
	 if(url.indexOf('orderby') != -1){
		 url = url.replace(/orderby=([^&?]*)/ig,  function($0, $1){ 
			 var optemp = field + " desc";
			 optemp = decodeURI($1) != optemp ? optemp : field + " asc";
			 return "orderby=" + optemp;
		   }); 
	 }
	 else{
		 if(url.indexOf('?') != -1){
			 url = url + "&orderby=" + encodeURI(optemp);
		 }
		 else{
			 url = url + "?orderby=" + encodeURI(optemp);
		 }
	 }
	 window.location.href=url; 
 }
 function searchAction(){
		$('#qinlian-register-search-form').submit();
	}
 function viewAction(id){
		initModel(id, 'view', 'fun');
	}

 function initEditSystemModule(data, type){
	if(type == 'create'){
    	        $("#id").val("");
        $("#nuit_name").val("");
        $("#nuit_code").val("");
        $("#is_nuit").val("");
        $("#case_code").val("");
        $("#personnel_code").val("");
        $("#person_investigated").val("");
        $("#credentials_type").val("");
        $("#credentials_number").val("");
        $("#sex").val("");
        $("#age").val("");
        $("#date_birth").val("");
        $("#academic").val("");
        $("#nation").val("");
        $("#is_supervises_object").val("");
        $("#supervises_object_details").val("");
        $("#is_party").val("");
        $("#party_delegate").val("");
        $("#disposal_report").val("");
        $("#time_joining_party").val("");
        $("#no_party_objects").val("");
        $("#no_party_objects_details").val("");
        $("#cpc").val("");
        $("#cppcc").val("");
        $("#discipline_commission").val("");
        $("#party_commission").val("");
        $("#on_job_time").val("");
        $("#head_violating").val("");
        $("#head_details").val("");
        $("#head_details_two").val("");
        $("#rank_job").val("");
        $("#deputy_rank_job").val("");
        $("#duty_job").val("");
        $("#authority_management").val("");
        $("#department_class").val("");
        $("#department_class_one").val("");
        $("#department_classtwo").val("");
        $("#nature_enterprise").val("");
        $("#nature_enterprise_one").val("");
        $("#category_enterprise_personnel").val("");
        $("#enterprise_post").val("");
        $("#jobbery_lose").val("");
        $("#discipline_amount").val("");
        $("#case_amount").val("");
        $("#filing_time").val("");
        $("#source_case").val("");
        $("#discipline_organ").val("");
        $("#discipline_organ_time").val("");
        $("#discipline_organ_stats_time").val("");
        $("#supervise_register_organ").val("");
        $("#supervise_register_time").val("");
        $("#supervise_register_statistics_time").val("");
        $("#is_discipline_transfer").val("");
        $("#other_discipline_method").val("");
        $("#transfer_unit").val("");
        $("#brief_case_report").val("");
        $("#register_report").val("");
        $("#register_decide_book").val("");
        $("#remarks").val("");
        $("#is_violate_stipulate").val("");
        $("#is_accountabilitye").val("");
        $("#end_case_stat_time").val("");
        $("#close_case_time").val("");
        $("#end_case_time").val("");
        $("#accountability").val("");
        $("#party_discipline").val("");
        $("#party_discipline_stats_time").val("");
        $("#administrative_sanction").val("");
        $("#administrative_sanction_stats_time").val("");
        $("#other_treatments").val("");
        $("#other_treatments_stats_time").val("");
        $("#transfer_justice_time").val("");
        $("#transfer_justice_stats_time").val("");
        $("#public_inspection_processing").val("");
        $("#public_inspection_processing_detail").val("");
        $("#punishments_number_years").val("");
        $("#punishments_number_month").val("");
        $("#probation_number_years").val("");
        $("#probation_number_month").val("");
        $("#public_inspection_processing_stats_time").val("");
        $("#retrieve_loss").val("");
        $("#capture_amount").val("");
        $("#first_violations_discipline_time").val("");
        $("#last_violations_discipline_time").val("");
        $("#violation_discipline_happen_time").val("");
        $("#desert_time").val("");
        $("#desert_stats_time").val("");
        $("#hear_accept_time").val("");
        $("#hear_accept_stats_time").val("");
        $("#hear_office").val("");
        $("#hear_end_time").val("");
        $("#hear_end_stats_time").val("");
        $("#punish_decide").val("");
        $("#police_handle_time").val("");
        $("#judicial_judgment_amount").val("");
        $("#investigation_report").val("");
        $("#trial_report").val("");
        $("#case_analysis").val("");
        $("#party_watch_limit").val("");
        $("#enterprise_level").val("");
        $("#flight_direction").val("");
        $("#flight_direction_details").val("");
        $("#investigation_suspension_time").val("");
        $("#investigation_suspension_stats_time").val("");
        $("#administrative_sanctions_suspension_time").val("");
        $("#administrative_sanctions_suspension_stats_time").val("");
        $("#seizure_time").val("");
        $("#seizure_stats_time").val("");
        $("#case_analysis_time").val("");
        $("#disciplinary_offence").val("");
        $("#post_disciplinary_offence").val("");
        $("#other_disciplinary_offence").val("");
        $("#organs_take_measures").val("");
        $("#organs_take_measures_name").val("");
        $("#starting_detention_time").val("");
        $("#starting_detention_stats_time").val("");
        $("#location_measures_taken").val("");
        $("#location_measures_taken_class").val("");
        $("#lien_approval_situation").val("");
        $("#lien_end_time").val("");
        $("#lien_end_stats_time").val("");
        $("#lien_number_days").val("");
        $("#is_delay").val("");
        $("#delay_number_days").val("");
        $("#delay_approval_situation").val("");
        $("#organization_measure").val("");
        $("#organization_measure_stats_time").val("");
        $("#amount_transferred_judicial_organs").val("");
        $("#two_rule_start_time").val("");
        $("#two_rule_stats_time").val("");
        $("#two_rule_remove_time").val("");
        $("#two_rule_remove_stats_time").val("");
        $("#confessional_books").val("");
        $("#department_charge").val("");
        $("#superiors_assigned").val("");
        $("#del_status").val("");
        $("#create_date").val("");
        $("#update_time").val("");
	
	}
	else{
    	        $("#id").val(data.id)
        $("#nuit_name").val(data.nuit_name)
        $("#nuit_code").val(data.nuit_code)
        $("#is_nuit").val(data.is_nuit)
        $("#case_code").val(data.case_code)
        $("#personnel_code").val(data.personnel_code)
        $("#person_investigated").val(data.person_investigated)
        $("#credentials_type").val(data.credentials_type)
        $("#credentials_number").val(data.credentials_number)
        $("#sex").val(data.sex)
        $("#age").val(data.age)
        $("#date_birth").val(data.date_birth)
        $("#academic").val(data.academic)
        $("#nation").val(data.nation)
        $("#is_supervises_object").val(data.is_supervises_object)
        $("#supervises_object_details").val(data.supervises_object_details)
        $("#is_party").val(data.is_party)
        $("#party_delegate").val(data.party_delegate)
        $("#disposal_report").val(data.disposal_report)
        $("#time_joining_party").val(data.time_joining_party)
        $("#no_party_objects").val(data.no_party_objects)
        $("#no_party_objects_details").val(data.no_party_objects_details)
        $("#cpc").val(data.cpc)
        $("#cppcc").val(data.cppcc)
        $("#discipline_commission").val(data.discipline_commission)
        $("#party_commission").val(data.party_commission)
        $("#on_job_time").val(data.on_job_time)
        $("#head_violating").val(data.head_violating)
        $("#head_details").val(data.head_details)
        $("#head_details_two").val(data.head_details_two)
        $("#rank_job").val(data.rank_job)
        $("#deputy_rank_job").val(data.deputy_rank_job)
        $("#duty_job").val(data.duty_job)
        $("#authority_management").val(data.authority_management)
        $("#department_class").val(data.department_class)
        $("#department_class_one").val(data.department_class_one)
        $("#department_classtwo").val(data.department_classtwo)
        $("#nature_enterprise").val(data.nature_enterprise)
        $("#nature_enterprise_one").val(data.nature_enterprise_one)
        $("#category_enterprise_personnel").val(data.category_enterprise_personnel)
        $("#enterprise_post").val(data.enterprise_post)
        $("#jobbery_lose").val(data.jobbery_lose)
        $("#discipline_amount").val(data.discipline_amount)
        $("#case_amount").val(data.case_amount)
        $("#filing_time").val(data.filing_time)
        $("#source_case").val(data.source_case)
        $("#discipline_organ").val(data.discipline_organ)
        $("#discipline_organ_time").val(data.discipline_organ_time)
        $("#discipline_organ_stats_time").val(data.discipline_organ_stats_time)
        $("#supervise_register_organ").val(data.supervise_register_organ)
        $("#supervise_register_time").val(data.supervise_register_time)
        $("#supervise_register_statistics_time").val(data.supervise_register_statistics_time)
        $("#is_discipline_transfer").val(data.is_discipline_transfer)
        $("#other_discipline_method").val(data.other_discipline_method)
        $("#transfer_unit").val(data.transfer_unit)
        $("#brief_case_report").val(data.brief_case_report)
        $("#register_report").val(data.register_report)
        $("#register_decide_book").val(data.register_decide_book)
        $("#remarks").val(data.remarks)
        $("#is_violate_stipulate").val(data.is_violate_stipulate)
        $("#is_accountabilitye").val(data.is_accountabilitye)
        $("#end_case_stat_time").val(data.end_case_stat_time)
        $("#close_case_time").val(data.close_case_time)
        $("#end_case_time").val(data.end_case_time)
        $("#accountability").val(data.accountability)
        $("#party_discipline").val(data.party_discipline)
        $("#party_discipline_stats_time").val(data.party_discipline_stats_time)
        $("#administrative_sanction").val(data.administrative_sanction)
        $("#administrative_sanction_stats_time").val(data.administrative_sanction_stats_time)
        $("#other_treatments").val(data.other_treatments)
        $("#other_treatments_stats_time").val(data.other_treatments_stats_time)
        $("#transfer_justice_time").val(data.transfer_justice_time)
        $("#transfer_justice_stats_time").val(data.transfer_justice_stats_time)
        $("#public_inspection_processing").val(data.public_inspection_processing)
        $("#public_inspection_processing_detail").val(data.public_inspection_processing_detail)
        $("#punishments_number_years").val(data.punishments_number_years)
        $("#punishments_number_month").val(data.punishments_number_month)
        $("#probation_number_years").val(data.probation_number_years)
        $("#probation_number_month").val(data.probation_number_month)
        $("#public_inspection_processing_stats_time").val(data.public_inspection_processing_stats_time)
        $("#retrieve_loss").val(data.retrieve_loss)
        $("#capture_amount").val(data.capture_amount)
        $("#first_violations_discipline_time").val(data.first_violations_discipline_time)
        $("#last_violations_discipline_time").val(data.last_violations_discipline_time)
        $("#violation_discipline_happen_time").val(data.violation_discipline_happen_time)
        $("#desert_time").val(data.desert_time)
        $("#desert_stats_time").val(data.desert_stats_time)
        $("#hear_accept_time").val(data.hear_accept_time)
        $("#hear_accept_stats_time").val(data.hear_accept_stats_time)
        $("#hear_office").val(data.hear_office)
        $("#hear_end_time").val(data.hear_end_time)
        $("#hear_end_stats_time").val(data.hear_end_stats_time)
        $("#punish_decide").val(data.punish_decide)
        $("#police_handle_time").val(data.police_handle_time)
        $("#judicial_judgment_amount").val(data.judicial_judgment_amount)
        $("#investigation_report").val(data.investigation_report)
        $("#trial_report").val(data.trial_report)
        $("#case_analysis").val(data.case_analysis)
        $("#party_watch_limit").val(data.party_watch_limit)
        $("#enterprise_level").val(data.enterprise_level)
        $("#flight_direction").val(data.flight_direction)
        $("#flight_direction_details").val(data.flight_direction_details)
        $("#investigation_suspension_time").val(data.investigation_suspension_time)
        $("#investigation_suspension_stats_time").val(data.investigation_suspension_stats_time)
        $("#administrative_sanctions_suspension_time").val(data.administrative_sanctions_suspension_time)
        $("#administrative_sanctions_suspension_stats_time").val(data.administrative_sanctions_suspension_stats_time)
        $("#seizure_time").val(data.seizure_time)
        $("#seizure_stats_time").val(data.seizure_stats_time)
        $("#case_analysis_time").val(data.case_analysis_time)
        $("#disciplinary_offence").val(data.disciplinary_offence)
        $("#post_disciplinary_offence").val(data.post_disciplinary_offence)
        $("#other_disciplinary_offence").val(data.other_disciplinary_offence)
        $("#organs_take_measures").val(data.organs_take_measures)
        $("#organs_take_measures_name").val(data.organs_take_measures_name)
        $("#starting_detention_time").val(data.starting_detention_time)
        $("#starting_detention_stats_time").val(data.starting_detention_stats_time)
        $("#location_measures_taken").val(data.location_measures_taken)
        $("#location_measures_taken_class").val(data.location_measures_taken_class)
        $("#lien_approval_situation").val(data.lien_approval_situation)
        $("#lien_end_time").val(data.lien_end_time)
        $("#lien_end_stats_time").val(data.lien_end_stats_time)
        $("#lien_number_days").val(data.lien_number_days)
        $("#is_delay").val(data.is_delay)
        $("#delay_number_days").val(data.delay_number_days)
        $("#delay_approval_situation").val(data.delay_approval_situation)
        $("#organization_measure").val(data.organization_measure)
        $("#organization_measure_stats_time").val(data.organization_measure_stats_time)
        $("#amount_transferred_judicial_organs").val(data.amount_transferred_judicial_organs)
        $("#two_rule_start_time").val(data.two_rule_start_time)
        $("#two_rule_stats_time").val(data.two_rule_stats_time)
        $("#two_rule_remove_time").val(data.two_rule_remove_time)
        $("#two_rule_remove_stats_time").val(data.two_rule_remove_stats_time)
        $("#confessional_books").val(data.confessional_books)
        $("#department_charge").val(data.department_charge)
        $("#superiors_assigned").val(data.superiors_assigned)
        $("#del_status").val(data.del_status)
        $("#create_date").val(data.create_date)
        $("#update_time").val(data.update_time)
	}
	if(type == "view"){
      $("#id").attr({readonly:true,disabled:true});
      $("#nuit_name").attr({readonly:true,disabled:true});
      $("#nuit_code").attr({readonly:true,disabled:true});
      $("#is_nuit").attr({readonly:true,disabled:true});
      $("#case_code").attr({readonly:true,disabled:true});
      $("#personnel_code").attr({readonly:true,disabled:true});
      $("#person_investigated").attr({readonly:true,disabled:true});
      $("#credentials_type").attr({readonly:true,disabled:true});
      $("#credentials_number").attr({readonly:true,disabled:true});
      $("#sex").attr({readonly:true,disabled:true});
      $("#age").attr({readonly:true,disabled:true});
      $("#date_birth").attr({readonly:true,disabled:true});
      $("#academic").attr({readonly:true,disabled:true});
      $("#nation").attr({readonly:true,disabled:true});
      $("#is_supervises_object").attr({readonly:true,disabled:true});
      $("#supervises_object_details").attr({readonly:true,disabled:true});
      $("#is_party").attr({readonly:true,disabled:true});
      $("#party_delegate").attr({readonly:true,disabled:true});
      $("#disposal_report").attr({readonly:true,disabled:true});
      $("#time_joining_party").attr({readonly:true,disabled:true});
      $("#no_party_objects").attr({readonly:true,disabled:true});
      $("#no_party_objects_details").attr({readonly:true,disabled:true});
      $("#cpc").attr({readonly:true,disabled:true});
      $("#cppcc").attr({readonly:true,disabled:true});
      $("#discipline_commission").attr({readonly:true,disabled:true});
      $("#party_commission").attr({readonly:true,disabled:true});
      $("#on_job_time").attr({readonly:true,disabled:true});
      $("#head_violating").attr({readonly:true,disabled:true});
      $("#head_details").attr({readonly:true,disabled:true});
      $("#head_details_two").attr({readonly:true,disabled:true});
      $("#rank_job").attr({readonly:true,disabled:true});
      $("#deputy_rank_job").attr({readonly:true,disabled:true});
      $("#duty_job").attr({readonly:true,disabled:true});
      $("#authority_management").attr({readonly:true,disabled:true});
      $("#department_class").attr({readonly:true,disabled:true});
      $("#department_class_one").attr({readonly:true,disabled:true});
      $("#department_classtwo").attr({readonly:true,disabled:true});
      $("#nature_enterprise").attr({readonly:true,disabled:true});
      $("#nature_enterprise_one").attr({readonly:true,disabled:true});
      $("#category_enterprise_personnel").attr({readonly:true,disabled:true});
      $("#enterprise_post").attr({readonly:true,disabled:true});
      $("#jobbery_lose").attr({readonly:true,disabled:true});
      $("#discipline_amount").attr({readonly:true,disabled:true});
      $("#case_amount").attr({readonly:true,disabled:true});
      $("#filing_time").attr({readonly:true,disabled:true});
      $("#source_case").attr({readonly:true,disabled:true});
      $("#discipline_organ").attr({readonly:true,disabled:true});
      $("#discipline_organ_time").attr({readonly:true,disabled:true});
      $("#discipline_organ_stats_time").attr({readonly:true,disabled:true});
      $("#supervise_register_organ").attr({readonly:true,disabled:true});
      $("#supervise_register_time").attr({readonly:true,disabled:true});
      $("#supervise_register_statistics_time").attr({readonly:true,disabled:true});
      $("#is_discipline_transfer").attr({readonly:true,disabled:true});
      $("#other_discipline_method").attr({readonly:true,disabled:true});
      $("#transfer_unit").attr({readonly:true,disabled:true});
      $("#brief_case_report").attr({readonly:true,disabled:true});
      $("#register_report").attr({readonly:true,disabled:true});
      $("#register_decide_book").attr({readonly:true,disabled:true});
      $("#remarks").attr({readonly:true,disabled:true});
      $("#is_violate_stipulate").attr({readonly:true,disabled:true});
      $("#is_accountabilitye").attr({readonly:true,disabled:true});
      $("#end_case_stat_time").attr({readonly:true,disabled:true});
      $("#close_case_time").attr({readonly:true,disabled:true});
      $("#end_case_time").attr({readonly:true,disabled:true});
      $("#accountability").attr({readonly:true,disabled:true});
      $("#party_discipline").attr({readonly:true,disabled:true});
      $("#party_discipline_stats_time").attr({readonly:true,disabled:true});
      $("#administrative_sanction").attr({readonly:true,disabled:true});
      $("#administrative_sanction_stats_time").attr({readonly:true,disabled:true});
      $("#other_treatments").attr({readonly:true,disabled:true});
      $("#other_treatments_stats_time").attr({readonly:true,disabled:true});
      $("#transfer_justice_time").attr({readonly:true,disabled:true});
      $("#transfer_justice_stats_time").attr({readonly:true,disabled:true});
      $("#public_inspection_processing").attr({readonly:true,disabled:true});
      $("#public_inspection_processing_detail").attr({readonly:true,disabled:true});
      $("#punishments_number_years").attr({readonly:true,disabled:true});
      $("#punishments_number_month").attr({readonly:true,disabled:true});
      $("#probation_number_years").attr({readonly:true,disabled:true});
      $("#probation_number_month").attr({readonly:true,disabled:true});
      $("#public_inspection_processing_stats_time").attr({readonly:true,disabled:true});
      $("#retrieve_loss").attr({readonly:true,disabled:true});
      $("#capture_amount").attr({readonly:true,disabled:true});
      $("#first_violations_discipline_time").attr({readonly:true,disabled:true});
      $("#last_violations_discipline_time").attr({readonly:true,disabled:true});
      $("#violation_discipline_happen_time").attr({readonly:true,disabled:true});
      $("#desert_time").attr({readonly:true,disabled:true});
      $("#desert_stats_time").attr({readonly:true,disabled:true});
      $("#hear_accept_time").attr({readonly:true,disabled:true});
      $("#hear_accept_stats_time").attr({readonly:true,disabled:true});
      $("#hear_office").attr({readonly:true,disabled:true});
      $("#hear_end_time").attr({readonly:true,disabled:true});
      $("#hear_end_stats_time").attr({readonly:true,disabled:true});
      $("#punish_decide").attr({readonly:true,disabled:true});
      $("#police_handle_time").attr({readonly:true,disabled:true});
      $("#judicial_judgment_amount").attr({readonly:true,disabled:true});
      $("#investigation_report").attr({readonly:true,disabled:true});
      $("#trial_report").attr({readonly:true,disabled:true});
      $("#case_analysis").attr({readonly:true,disabled:true});
      $("#party_watch_limit").attr({readonly:true,disabled:true});
      $("#enterprise_level").attr({readonly:true,disabled:true});
      $("#flight_direction").attr({readonly:true,disabled:true});
      $("#flight_direction_details").attr({readonly:true,disabled:true});
      $("#investigation_suspension_time").attr({readonly:true,disabled:true});
      $("#investigation_suspension_stats_time").attr({readonly:true,disabled:true});
      $("#administrative_sanctions_suspension_time").attr({readonly:true,disabled:true});
      $("#administrative_sanctions_suspension_stats_time").attr({readonly:true,disabled:true});
      $("#seizure_time").attr({readonly:true,disabled:true});
      $("#seizure_stats_time").attr({readonly:true,disabled:true});
      $("#case_analysis_time").attr({readonly:true,disabled:true});
      $("#disciplinary_offence").attr({readonly:true,disabled:true});
      $("#post_disciplinary_offence").attr({readonly:true,disabled:true});
      $("#other_disciplinary_offence").attr({readonly:true,disabled:true});
      $("#organs_take_measures").attr({readonly:true,disabled:true});
      $("#organs_take_measures_name").attr({readonly:true,disabled:true});
      $("#starting_detention_time").attr({readonly:true,disabled:true});
      $("#starting_detention_stats_time").attr({readonly:true,disabled:true});
      $("#location_measures_taken").attr({readonly:true,disabled:true});
      $("#location_measures_taken_class").attr({readonly:true,disabled:true});
      $("#lien_approval_situation").attr({readonly:true,disabled:true});
      $("#lien_end_time").attr({readonly:true,disabled:true});
      $("#lien_end_stats_time").attr({readonly:true,disabled:true});
      $("#lien_number_days").attr({readonly:true,disabled:true});
      $("#is_delay").attr({readonly:true,disabled:true});
      $("#delay_number_days").attr({readonly:true,disabled:true});
      $("#delay_approval_situation").attr({readonly:true,disabled:true});
      $("#organization_measure").attr({readonly:true,disabled:true});
      $("#organization_measure_stats_time").attr({readonly:true,disabled:true});
      $("#amount_transferred_judicial_organs").attr({readonly:true,disabled:true});
      $("#two_rule_start_time").attr({readonly:true,disabled:true});
      $("#two_rule_stats_time").attr({readonly:true,disabled:true});
      $("#two_rule_remove_time").attr({readonly:true,disabled:true});
      $("#two_rule_remove_stats_time").attr({readonly:true,disabled:true});
      $("#confessional_books").attr({readonly:true,disabled:true});
      $("#department_charge").attr({readonly:true,disabled:true});
      $("#superiors_assigned").attr({readonly:true,disabled:true});
      $("#del_status").attr({readonly:true,disabled:true});
      $("#create_date").attr({readonly:true,disabled:true});
      $("#update_time").attr({readonly:true,disabled:true});
	$('#edit_dialog_ok').addClass('hidden');
	}
	else{
      $("#id").attr({readonly:false,disabled:false});
      $("#nuit_name").attr({readonly:false,disabled:false});
      $("#nuit_code").attr({readonly:false,disabled:false});
      $("#is_nuit").attr({readonly:false,disabled:false});
      $("#case_code").attr({readonly:false,disabled:false});
      $("#personnel_code").attr({readonly:false,disabled:false});
      $("#person_investigated").attr({readonly:false,disabled:false});
      $("#credentials_type").attr({readonly:false,disabled:false});
      $("#credentials_number").attr({readonly:false,disabled:false});
      $("#sex").attr({readonly:false,disabled:false});
      $("#age").attr({readonly:false,disabled:false});
      $("#date_birth").attr({readonly:false,disabled:false});
      $("#academic").attr({readonly:false,disabled:false});
      $("#nation").attr({readonly:false,disabled:false});
      $("#is_supervises_object").attr({readonly:false,disabled:false});
      $("#supervises_object_details").attr({readonly:false,disabled:false});
      $("#is_party").attr({readonly:false,disabled:false});
      $("#party_delegate").attr({readonly:false,disabled:false});
      $("#disposal_report").attr({readonly:false,disabled:false});
      $("#time_joining_party").attr({readonly:false,disabled:false});
      $("#no_party_objects").attr({readonly:false,disabled:false});
      $("#no_party_objects_details").attr({readonly:false,disabled:false});
      $("#cpc").attr({readonly:false,disabled:false});
      $("#cppcc").attr({readonly:false,disabled:false});
      $("#discipline_commission").attr({readonly:false,disabled:false});
      $("#party_commission").attr({readonly:false,disabled:false});
      $("#on_job_time").attr({readonly:false,disabled:false});
      $("#head_violating").attr({readonly:false,disabled:false});
      $("#head_details").attr({readonly:false,disabled:false});
      $("#head_details_two").attr({readonly:false,disabled:false});
      $("#rank_job").attr({readonly:false,disabled:false});
      $("#deputy_rank_job").attr({readonly:false,disabled:false});
      $("#duty_job").attr({readonly:false,disabled:false});
      $("#authority_management").attr({readonly:false,disabled:false});
      $("#department_class").attr({readonly:false,disabled:false});
      $("#department_class_one").attr({readonly:false,disabled:false});
      $("#department_classtwo").attr({readonly:false,disabled:false});
      $("#nature_enterprise").attr({readonly:false,disabled:false});
      $("#nature_enterprise_one").attr({readonly:false,disabled:false});
      $("#category_enterprise_personnel").attr({readonly:false,disabled:false});
      $("#enterprise_post").attr({readonly:false,disabled:false});
      $("#jobbery_lose").attr({readonly:false,disabled:false});
      $("#discipline_amount").attr({readonly:false,disabled:false});
      $("#case_amount").attr({readonly:false,disabled:false});
      $("#filing_time").attr({readonly:false,disabled:false});
      $("#source_case").attr({readonly:false,disabled:false});
      $("#discipline_organ").attr({readonly:false,disabled:false});
      $("#discipline_organ_time").attr({readonly:false,disabled:false});
      $("#discipline_organ_stats_time").attr({readonly:false,disabled:false});
      $("#supervise_register_organ").attr({readonly:false,disabled:false});
      $("#supervise_register_time").attr({readonly:false,disabled:false});
      $("#supervise_register_statistics_time").attr({readonly:false,disabled:false});
      $("#is_discipline_transfer").attr({readonly:false,disabled:false});
      $("#other_discipline_method").attr({readonly:false,disabled:false});
      $("#transfer_unit").attr({readonly:false,disabled:false});
      $("#brief_case_report").attr({readonly:false,disabled:false});
      $("#register_report").attr({readonly:false,disabled:false});
      $("#register_decide_book").attr({readonly:false,disabled:false});
      $("#remarks").attr({readonly:false,disabled:false});
      $("#is_violate_stipulate").attr({readonly:false,disabled:false});
      $("#is_accountabilitye").attr({readonly:false,disabled:false});
      $("#end_case_stat_time").attr({readonly:false,disabled:false});
      $("#close_case_time").attr({readonly:false,disabled:false});
      $("#end_case_time").attr({readonly:false,disabled:false});
      $("#accountability").attr({readonly:false,disabled:false});
      $("#party_discipline").attr({readonly:false,disabled:false});
      $("#party_discipline_stats_time").attr({readonly:false,disabled:false});
      $("#administrative_sanction").attr({readonly:false,disabled:false});
      $("#administrative_sanction_stats_time").attr({readonly:false,disabled:false});
      $("#other_treatments").attr({readonly:false,disabled:false});
      $("#other_treatments_stats_time").attr({readonly:false,disabled:false});
      $("#transfer_justice_time").attr({readonly:false,disabled:false});
      $("#transfer_justice_stats_time").attr({readonly:false,disabled:false});
      $("#public_inspection_processing").attr({readonly:false,disabled:false});
      $("#public_inspection_processing_detail").attr({readonly:false,disabled:false});
      $("#punishments_number_years").attr({readonly:false,disabled:false});
      $("#punishments_number_month").attr({readonly:false,disabled:false});
      $("#probation_number_years").attr({readonly:false,disabled:false});
      $("#probation_number_month").attr({readonly:false,disabled:false});
      $("#public_inspection_processing_stats_time").attr({readonly:false,disabled:false});
      $("#retrieve_loss").attr({readonly:false,disabled:false});
      $("#capture_amount").attr({readonly:false,disabled:false});
      $("#first_violations_discipline_time").attr({readonly:false,disabled:false});
      $("#last_violations_discipline_time").attr({readonly:false,disabled:false});
      $("#violation_discipline_happen_time").attr({readonly:false,disabled:false});
      $("#desert_time").attr({readonly:false,disabled:false});
      $("#desert_stats_time").attr({readonly:false,disabled:false});
      $("#hear_accept_time").attr({readonly:false,disabled:false});
      $("#hear_accept_stats_time").attr({readonly:false,disabled:false});
      $("#hear_office").attr({readonly:false,disabled:false});
      $("#hear_end_time").attr({readonly:false,disabled:false});
      $("#hear_end_stats_time").attr({readonly:false,disabled:false});
      $("#punish_decide").attr({readonly:false,disabled:false});
      $("#police_handle_time").attr({readonly:false,disabled:false});
      $("#judicial_judgment_amount").attr({readonly:false,disabled:false});
      $("#investigation_report").attr({readonly:false,disabled:false});
      $("#trial_report").attr({readonly:false,disabled:false});
      $("#case_analysis").attr({readonly:false,disabled:false});
      $("#party_watch_limit").attr({readonly:false,disabled:false});
      $("#enterprise_level").attr({readonly:false,disabled:false});
      $("#flight_direction").attr({readonly:false,disabled:false});
      $("#flight_direction_details").attr({readonly:false,disabled:false});
      $("#investigation_suspension_time").attr({readonly:false,disabled:false});
      $("#investigation_suspension_stats_time").attr({readonly:false,disabled:false});
      $("#administrative_sanctions_suspension_time").attr({readonly:false,disabled:false});
      $("#administrative_sanctions_suspension_stats_time").attr({readonly:false,disabled:false});
      $("#seizure_time").attr({readonly:false,disabled:false});
      $("#seizure_stats_time").attr({readonly:false,disabled:false});
      $("#case_analysis_time").attr({readonly:false,disabled:false});
      $("#disciplinary_offence").attr({readonly:false,disabled:false});
      $("#post_disciplinary_offence").attr({readonly:false,disabled:false});
      $("#other_disciplinary_offence").attr({readonly:false,disabled:false});
      $("#organs_take_measures").attr({readonly:false,disabled:false});
      $("#organs_take_measures_name").attr({readonly:false,disabled:false});
      $("#starting_detention_time").attr({readonly:false,disabled:false});
      $("#starting_detention_stats_time").attr({readonly:false,disabled:false});
      $("#location_measures_taken").attr({readonly:false,disabled:false});
      $("#location_measures_taken_class").attr({readonly:false,disabled:false});
      $("#lien_approval_situation").attr({readonly:false,disabled:false});
      $("#lien_end_time").attr({readonly:false,disabled:false});
      $("#lien_end_stats_time").attr({readonly:false,disabled:false});
      $("#lien_number_days").attr({readonly:false,disabled:false});
      $("#is_delay").attr({readonly:false,disabled:false});
      $("#delay_number_days").attr({readonly:false,disabled:false});
      $("#delay_approval_situation").attr({readonly:false,disabled:false});
      $("#organization_measure").attr({readonly:false,disabled:false});
      $("#organization_measure_stats_time").attr({readonly:false,disabled:false});
      $("#amount_transferred_judicial_organs").attr({readonly:false,disabled:false});
      $("#two_rule_start_time").attr({readonly:false,disabled:false});
      $("#two_rule_stats_time").attr({readonly:false,disabled:false});
      $("#two_rule_remove_time").attr({readonly:false,disabled:false});
      $("#two_rule_remove_stats_time").attr({readonly:false,disabled:false});
      $("#confessional_books").attr({readonly:false,disabled:false});
      $("#department_charge").attr({readonly:false,disabled:false});
      $("#superiors_assigned").attr({readonly:false,disabled:false});
      $("#del_status").attr({readonly:false,disabled:false});
      $("#create_date").attr({readonly:false,disabled:false});
      $("#update_time").attr({readonly:false,disabled:false});
		$('#edit_dialog_ok').removeClass('hidden');
		}
		$('#edit_dialog').modal('show');
}

function initModel(id, type, fun){
	
	$.ajax({
		   type: "GET",
		   url: "<?=Url::toRoute('qinlian-register/view')?>",
		   data: {"id":id},
		   cache: false,
		   dataType:"json",
		   error: function (xmlHttpRequest, textStatus, errorThrown) {
			    alert("出错了，" + textStatus);
			},
		   success: function(data){
			   initEditSystemModule(data, type);

			   ////////////////////////////////////////
   		   }
		});
}
	
function editAction(id){
	initModel(id, 'edit');
}

function deleteAction(id){
	var ids = [];
	if(!!id == true){
		ids[0] = id;
	}
	else{
		var checkboxs = $('#data_table :checked');
	    if(checkboxs.size() > 0){
	        var c = 0;
	        for(i = 0; i < checkboxs.size(); i++){
	            var id = checkboxs.eq(i).val();
	            if(id != ""){
	            	ids[c++] = id;
	            }
	        }
	    }
	}
	if(ids.length > 0){
		admin_tool.confirm('请确认是否删除', function(){
		    $.ajax({
				   type: "GET",
				   url: "<?=Url::toRoute('qinlian-register/delete')?>",
				   data: {"ids":ids},
				   cache: false,
				   dataType:"json",
				   error: function (xmlHttpRequest, textStatus, errorThrown) {
					    admin_tool.alert('msg_info', '出错了，' + textStatus, 'warning');
					},
				   success: function(data){
					   for(i = 0; i < ids.length; i++){
						   $('#rowid_' + ids[i]).remove();
					   }
					   admin_tool.alert('msg_info', '删除成功', 'success');
					   window.location.reload();
				   }
				});
		});
	}
	else{
		admin_tool.alert('msg_info', '请先选择要删除的数据', 'warning');
	}
    
}

function getSelectedIdValues(formId)
{
	var value="";
	$( formId + " :checked").each(function(i)
	{
		if(!this.checked)
		{
			return true;
		}
		value += this.value;
		if(i != $("input[name='id']").size()-1)
		{
			value += ",";
		}
	 });
	return value;
}

$('#edit_dialog_ok').click(function (e) {
    e.preventDefault();
	$('#qinlian-register-form').submit();
});

$('#create_btn').click(function (e) {
    e.preventDefault();
    initEditSystemModule({}, 'create');
});

$('#delete_btn').click(function (e) {
    e.preventDefault();
    deleteAction('');
});

$('#qinlian-register-form').bind('submit', function(e) {
	e.preventDefault();
	var id = $("#id").val();
	var action = id == "" ? "<?=Url::toRoute('qinlian-register/create')?>" : "<?=Url::toRoute('qinlian-register/update')?>";
    $(this).ajaxSubmit({
    	type: "post",
    	dataType:"json",
    	url: action,
    	success: function(value) 
    	{
        	if(value.errno == 0){
        		$('#edit_dialog').modal('hide');
        		admin_tool.alert('msg_info', '添加成功', 'success');
        		window.location.reload();
        	}
        	else{
            	var json = value.data;
        		for(var key in json){
        			$('#' + key).attr({'data-placement':'bottom', 'data-content':json[key], 'data-toggle':'popover'}).addClass('popover-show').popover('show');
        			
        		}
        	}

    	}
    });
});

</script>
<?php $this->endBlock(); ?>
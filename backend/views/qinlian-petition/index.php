
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;

use backend\models\QinlianPetition;

$modelLabel = new \backend\models\QinlianPetition();
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
                  <button id="create_btn" type="button" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-plus icon-white"></i>&nbsp;&nbsp;添&nbsp;&emsp;加</button>
                  |
                  <button id="import_btn" type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#uploadFile"><i class="glyphicon glyphicon-import icon-white"></i>&nbsp;&nbsp;导&nbsp;&emsp;入</button>
                  |
                  <a onclick="exportAction()" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-export icon-white"></i>&nbsp;&nbsp;导&nbsp;&emsp;出</a>
                  |
                  <button id="delete_btn" type="button" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash icon-white"></i>&nbsp;&nbsp;批量删除</button>
              </div>
              <!-- row start export-->
              <div class="row" style="display: none;">
                  <div class="col-sm-12">
                      <?php ActiveForm::begin(['id' => 'qinlian-petition-export-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('qinlian-petition/export')]); ?>

                      <div class="form-group" style="margin: 4px;">
                          <label><?=$modelLabel->getAttributeLabel('number')?>:</label>
                          <input type="text" class="form-control" id="query[number]" name="query[number]"  value="<?=isset($query["number"]) ? $query["number"] : "" ?>">
                      </div>
                      <div class="form-group" style="margin: 4px;">
                          <label><?=$modelLabel->getAttributeLabel('name_report')?>:</label>
                          <input type="text" class="form-control" id="query[name_report]" name="query[name_report]"  value="<?=isset($query["name_report"]) ? $query["name_report"] : "" ?>">
                      </div>
                      <div class="form-group" style="margin: 4px;">
                          <label><?=$modelLabel->getAttributeLabel('transfer_organ')?>:</label>
                          <input type="text" class="form-control" id="query[transfer_organ]" name="query[transfer_organ]"  value="<?=isset($query["transfer_organ"]) ? $query["transfer_organ"] : "" ?>">
                      </div>
                      <div class="form-group" style="margin: 4px;">
                          <label><?=$modelLabel->getAttributeLabel('name_reported')?>:</label>
                          <input type="text" class="form-control" id="query[name_reported]" name="query[name_reported]"  value="<?=isset($query["name_reported"]) ? $query["name_reported"] : "" ?>">
                      </div>
                      <div class="form-group" style="margin: 4px;">
                          <label><?=$modelLabel->getAttributeLabel('unit_job')?>:</label>
                          <input type="text" class="form-control" id="query[unit_job]" name="query[unit_job]"  value="<?=isset($query["unit_job"]) ? $query["unit_job"] : "" ?>">
                      </div>
                      <div class="form-group" style="margin: 4px;">
                          <label><?=$modelLabel->getAttributeLabel('rank_job')?>:</label>
                          <select class="form-control" id="duty_job" id="query[rank_job]" name="query[rank_job]">
                              <option value="">全部</option>
                              <option>一级</option>
                              <option>二级</option>
                              <option>三级</option>
                          </select>

                      </div>
                      <div class="form-group" style="margin: 4px;">
                          <label><?=$modelLabel->getAttributeLabel('host_department')?>:</label>
                          <select class="form-control" name="query[host_department]" id="query[host_department]" class="form-control">
                              <option value="">全部</option>
                              <?php
                              foreach ($departments as $department) {
                                  if ($query["host_department"]== $department->department){
                                      echo '<option selected>'. $query["host_department"] .'</option>';
                                  }else{
                                      echo '  <option>' . $department->department . '</option>';
                                  }
                              }
                              ?>
                          </select>

                      </div>
                      <div class="form-group"  style="float: right;">
                      </div>
                      <?php ActiveForm::end(); ?>
                  </div>
              </div>
              <!-- row end export -->
          </div>
        </div>
        <!-- /.box-header -->
        
        <div class="box-body">
          <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap table-responsive">
            <!-- row start search-->
          	<div class="row">
          	<div class="col-sm-12">
                <?php ActiveForm::begin(['id' => 'qinlian-petition-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('qinlian-petition/index')]); ?>
                
                  <div class="form-group" style="margin: 4px;">
                      <label><?=$modelLabel->getAttributeLabel('number')?>:</label>
                      <input type="text" class="form-control" id="query[number]" name="query[number]"  value="<?=isset($query["number"]) ? $query["number"] : "" ?>">
                  </div>
                    <div class="form-group" style="margin: 4px;">
                      <label><?=$modelLabel->getAttributeLabel('name_report')?>:</label>
                      <input type="text" class="form-control" id="query[name_report]" name="query[name_report]"  value="<?=isset($query["name_report"]) ? $query["name_report"] : "" ?>">
                  </div>
                   <div class="form-group" style="margin: 4px;">
                      <label><?=$modelLabel->getAttributeLabel('transfer_organ')?>:</label>
                      <input type="text" class="form-control" id="query[transfer_organ]" name="query[transfer_organ]"  value="<?=isset($query["transfer_organ"]) ? $query["transfer_organ"] : "" ?>">
                  </div>
                  <div class="form-group" style="margin: 4px;">
                      <label><?=$modelLabel->getAttributeLabel('name_reported')?>:</label>
                      <input type="text" class="form-control" id="query[name_reported]" name="query[name_reported]"  value="<?=isset($query["name_reported"]) ? $query["name_reported"] : "" ?>">
                  </div>
                  <div class="form-group" style="margin: 4px;">
                      <label><?=$modelLabel->getAttributeLabel('unit_job')?>:</label>
                      <input type="text" class="form-control" id="query[unit_job]" name="query[unit_job]"  value="<?=isset($query["unit_job"]) ? $query["unit_job"] : "" ?>">
                  </div>
                  <div class="form-group" style="margin: 4px;">
                      <label><?=$modelLabel->getAttributeLabel('rank_job')?>:</label>
                      <select class="form-control" id="duty_job" id="query[rank_job]" name="query[rank_job]">
                          <option value="">全部</option>
                          <option>一级</option>
                          <option>二级</option>
                          <option>三级</option>
                      </select>

                  </div>
                  <div class="form-group" style="margin: 4px;">
                      <label><?=$modelLabel->getAttributeLabel('host_department')?>:</label>
                      <select class="form-control" name="query[host_department]" id="query[host_department]" class="form-control">
                          <option value="">全部</option>
                          <?php
                          foreach ($departments as $department) {
                              if ($query["host_department"]== $department->department){
                                  echo '<option selected>'. $query["host_department"] .'</option>';
                              }else{
                                  echo '  <option>' . $department->department . '</option>';
                              }
                          }
                          ?>
                      </select>

                  </div>
              <div class="form-group"  style="float: right;">
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
//              echo '<th onclick="orderby(\'id\', \'desc\')" '.CommonFun::sortClass($orderby, 'id').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('id').'</th>';
              echo '<th onclick="orderby(\'number\', \'desc\')" '.CommonFun::sortClass($orderby, 'number').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('number').'</th>';
              echo '<th onclick="orderby(\'receipt_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'receipt_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('receipt_time').'</th>';
              echo '<th onclick="orderby(\'turn_number\', \'desc\')" '.CommonFun::sortClass($orderby, 'turn_number').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('turn_number').'</th>';
              echo '<th onclick="orderby(\'transfer_organ\', \'desc\')" '.CommonFun::sortClass($orderby, 'transfer_organ').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('transfer_organ').'</th>';
              echo '<th onclick="orderby(\'name_report\', \'desc\')" '.CommonFun::sortClass($orderby, 'name_report').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('name_report').'</th>';
              echo '<th onclick="orderby(\'name_reported\', \'desc\')" '.CommonFun::sortClass($orderby, 'name_reported').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('name_reported').'</th>';
              echo '<th onclick="orderby(\'political_appearance\', \'desc\')" '.CommonFun::sortClass($orderby, 'political_appearance').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('political_appearance').'</th>';
              echo '<th onclick="orderby(\'unit_job\', \'desc\')" '.CommonFun::sortClass($orderby, 'unit_job').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('unit_job').'</th>';
              echo '<th onclick="orderby(\'duty_job\', \'desc\')" '.CommonFun::sortClass($orderby, 'duty_job').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('duty_job').'</th>';
              echo '<th onclick="orderby(\'rank_job\', \'desc\')" '.CommonFun::sortClass($orderby, 'rank_job').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('rank_job').'</th>';
              echo '<th onclick="orderby(\'main_issues\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('main_issues').'</th>';
              echo '<th onclick="orderby(\'issues_properties\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('issues_properties').'</th>';
              echo '<th onclick="orderby(\'petition_office_opinion\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('petition_office_opinion').'</th>';
              echo '<th onclick="orderby(\'superior_guidance_opinion\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('superior_guidance_opinion').'</th>';
              echo '<th onclick="orderby(\'lu_clerk_opinion\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('lu_clerk_opinion').'</th>';
              echo '<th onclick="orderby(\'major_leadership_approval_opinion\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('major_leadership_approval_opinion').'</th>';
              echo '<th onclick="orderby(\'charge_leadership_approval_opinion\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('charge_leadership_approval_opinion').'</th>';
              echo '<th onclick="orderby(\'host_department\', \'desc\')" '.CommonFun::sortClass($orderby, 'host_department').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('host_department').'</th>';
              echo '<th onclick="orderby(\'handle_results\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('handle_results').'</th>';
              echo '<th onclick="orderby(\'heavy_letter\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('heavy_letter').'</th>';
              echo '<th onclick="orderby(\'unit_responsibility\', \'desc\')" '.CommonFun::sortClass($orderby, 'unit_responsibility').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('unit_responsibility').'</th>';
              echo '<th onclick="orderby(\'approval_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'approval_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('approval_time').'</th>';
              echo '<th onclick="orderby(\'approval_status\', \'desc\')" '.CommonFun::sortClass($orderby, 'approval_status').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('approval_status').'</th>';

              echo '<th onclick="orderby(\'is_thread_disposal\', \'desc\')" '.CommonFun::sortClass($orderby, 'is_thread_disposal').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('is_thread_disposal').'</th>';
              echo '<th onclick="orderby(\'disposal_method\', \'desc\')" '.CommonFun::sortClass($orderby, 'disposal_method').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('disposal_method').'</th>';
              echo '<th onclick="orderby(\'volume_number\', \'desc\')" '.CommonFun::sortClass($orderby, 'volume_number').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('volume_number').'</th>';
              echo '<th onclick="orderby(\'id_card\', \'desc\')" '.CommonFun::sortClass($orderby, 'id_card').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('id_card').'</th>';
              echo '<th onclick="orderby(\'disposal_year\', \'desc\')" '.CommonFun::sortClass($orderby, 'disposal_year').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('disposal_year').'</th>';

              echo '<th onclick="orderby(\'create_date\', \'desc\')" '.CommonFun::sortClass($orderby, 'create_date').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('create_date').'</th>';
              echo '<th onclick="orderby(\'update_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'update_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('update_time').'</th>';
         
			?>
	
            <th tabindex="0" class="th-width-0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >操作</th>
            </tr>
            </thead>
            <tbody>
            
            <?php
            foreach ($models as $model) {
                echo '<tr id="rowid_' . $model->id . '">';
                echo '  <td><label><input type="checkbox" value="' . $model->id . '"></label></td>';
//                echo '  <td>' . $model->id . '</td>';
                echo '  <td>' . $model->number . '</td>';
                echo '  <td>' . $model->receipt_time . '</td>';
                echo '  <td>' . $model->turn_number . '</td>';
                echo '  <td>' . $model->transfer_organ . '</td>';
                echo '  <td>' . $model->name_report . '</td>';
                echo '  <td>' . $model->name_reported . '</td>';
                echo '  <td>' . $model->political_appearance . '</td>';
                echo '  <td>' . $model->unit_job . '</td>';
                echo '  <td>' . $model->duty_job . '</td>';
                echo '  <td>' . $model->rank_job . '</td>';
                echo '  <td>' . mb_substr($model->main_issues, 0, 400) . '</td>';
                echo '  <td>' . mb_substr($model->issues_properties, 0, 400) . '</td>';
                echo '  <td>' . mb_substr($model->petition_office_opinion, 0, 400) . '</td>';
                echo '  <td>' . mb_substr($model->superior_guidance_opinion, 0, 400) . '</td>';
                echo '  <td>' . mb_substr($model->lu_clerk_opinion, 0, 400) . '</td>';
                echo '  <td>' . mb_substr($model->major_leadership_approval_opinion, 0, 400) . '</td>';
                echo '  <td>' . mb_substr($model->charge_leadership_approval_opinion, 0, 400) . '</td>';
                echo '  <td>' . $model->host_department . '</td>';
                echo '  <td>' . mb_substr($model->handle_results, 0, 400) . '</td>';
                echo '  <td>' . mb_substr($model->heavy_letter, 0, 400) . '</td>';
                echo '  <td>' . $model->unit_responsibility . '</td>';
                echo '  <td>' . $model->approval_time . '</td>';
                echo '  <td>' . $model->approval_status . '</td>';

                echo '  <td>' . $model->is_thread_disposal . '</td>';
                echo '  <td>' . $model->disposal_method . '</td>';
                echo '  <td>' . $model->volume_number . '</td>';
                echo '  <td>' . $model->id_card . '</td>';
                echo '  <td>' . $model->disposal_year . '</td>';

                echo '  <td>' . $model->create_date . '</td>';
                echo '  <td>' . $model->update_time . '</td>';
                echo '  <td class="center">';
                echo '      <a id="view_btn" onclick="viewAction(' . $model->id . ')" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i>查看</a>';
                echo '      <a id="edit_btn" onclick="editAction(' . $model->id . ')" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-edit icon-white"></i>修改</a>';
                echo '      <a id="archives_btn" onclick="archivesAction(' . $model->id . ')" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#archives" href="#"> <i class="glyphicon glyphicon-edit icon-white"></i>归档</a>';
                $url = Url::toRoute('qinlian-petition/annex');
                echo '      <a id=""  class="btn btn-primary btn-sm" href="'. $url  .'&table_id='. $model->id .'&number='. $model->number .'&type=1" target="_self"> <i class="glyphicon glyphicon-save-file icon-white"></i>留档</a>';
                echo '      <a id="delete_btn" onclick="deleteAction(' . $model->id . ')" class="btn btn-danger btn-sm" href="#"> <i class="glyphicon glyphicon-trash icon-white"></i>删除</a>';
                $url = Url::toRoute('qinlian-petition/print');
                echo '      <a id="print_btn"  class="btn btn-primary btn-sm" href="'. $url  .'&id='. $model->id .'" target="_self"> <i class="glyphicon glyphicon-print icon-white"></i>纪检监察机关来信来访登记卡</a>';
                $url = Url::toRoute('qinlian-petition/printb');
                echo '      <a id="print_btn"  class="btn btn-primary btn-sm" href="'. $url  .'&id='. $model->id .'" target="_self"> <i class="glyphicon glyphicon-book icon-white"></i>纪检监察机关来信来访来电批办单</a>';
                $url = Url::toRoute('qinlian-petition/printc');
                echo '      <a id="print_btn"  class="btn btn-primary btn-sm" href="'. $url  .'&id='. $model->id .'" target="_self"> <i class="glyphicon glyphicon-print icon-white"></i>纪检监察机关来信来访来电批办单(已了结重复件)</a>';
                echo '  </td>';
                echo '</tr>';
            }
            
            ?>

            </tbody>
             <tfoot>
                <tr role="row">

                 <?php
                 $orderby = isset($_GET['orderby']) ? $_GET['orderby'] : '';
                 echo '<th><input id="data_table_check" type="checkbox"></th>';
                 //              echo '<th onclick="orderby(\'id\', \'desc\')" '.CommonFun::sortClass($orderby, 'id').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('id').'</th>';
                 echo '<th onclick="orderby(\'number\', \'desc\')" '.CommonFun::sortClass($orderby, 'number').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('number').'</th>';
                 echo '<th onclick="orderby(\'receipt_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'receipt_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('receipt_time').'</th>';
                 echo '<th onclick="orderby(\'turn_number\', \'desc\')" '.CommonFun::sortClass($orderby, 'turn_number').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('turn_number').'</th>';
                 echo '<th onclick="orderby(\'transfer_organ\', \'desc\')" '.CommonFun::sortClass($orderby, 'transfer_organ').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('transfer_organ').'</th>';
                 echo '<th onclick="orderby(\'name_report\', \'desc\')" '.CommonFun::sortClass($orderby, 'name_report').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('name_report').'</th>';
                 echo '<th onclick="orderby(\'name_reported\', \'desc\')" '.CommonFun::sortClass($orderby, 'name_reported').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('name_reported').'</th>';
                 echo '<th onclick="orderby(\'political_appearance\', \'desc\')" '.CommonFun::sortClass($orderby, 'political_appearance').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('political_appearance').'</th>';
                 echo '<th onclick="orderby(\'unit_job\', \'desc\')" '.CommonFun::sortClass($orderby, 'unit_job').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('unit_job').'</th>';
                 echo '<th onclick="orderby(\'duty_job\', \'desc\')" '.CommonFun::sortClass($orderby, 'duty_job').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('duty_job').'</th>';
                 echo '<th onclick="orderby(\'rank_job\', \'desc\')" '.CommonFun::sortClass($orderby, 'rank_job').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('rank_job').'</th>';
                 echo '<th onclick="orderby(\'main_issues\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('main_issues').'</th>';
                 echo '<th onclick="orderby(\'issues_properties\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('issues_properties').'</th>';
                 echo '<th onclick="orderby(\'petition_office_opinion\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('petition_office_opinion').'</th>';
                 echo '<th onclick="orderby(\'superior_guidance_opinion\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('superior_guidance_opinion').'</th>';
                 echo '<th onclick="orderby(\'lu_clerk_opinion\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('lu_clerk_opinion').'</th>';
                 echo '<th onclick="orderby(\'major_leadership_approval_opinion\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('major_leadership_approval_opinion').'</th>';
                 echo '<th onclick="orderby(\'charge_leadership_approval_opinion\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('charge_leadership_approval_opinion').'</th>';
                 echo '<th onclick="orderby(\'host_department\', \'desc\')" '.CommonFun::sortClass($orderby, 'host_department').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('host_department').'</th>';
                 echo '<th onclick="orderby(\'handle_results\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('handle_results').'</th>';
                 echo '<th onclick="orderby(\'heavy_letter\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('heavy_letter').'</th>';
                 echo '<th onclick="orderby(\'unit_responsibility\', \'desc\')" '.CommonFun::sortClass($orderby, 'unit_responsibility').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('unit_responsibility').'</th>';
                 echo '<th onclick="orderby(\'approval_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'approval_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('approval_time').'</th>';
                 echo '<th onclick="orderby(\'approval_status\', \'desc\')" '.CommonFun::sortClass($orderby, 'approval_status').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('approval_status').'</th>';

                 echo '<th onclick="orderby(\'is_thread_disposal\', \'desc\')" '.CommonFun::sortClass($orderby, 'is_thread_disposal').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('is_thread_disposal').'</th>';
                 echo '<th onclick="orderby(\'disposal_method\', \'desc\')" '.CommonFun::sortClass($orderby, 'disposal_method').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('disposal_method').'</th>';
                 echo '<th onclick="orderby(\'volume_number\', \'desc\')" '.CommonFun::sortClass($orderby, 'volume_number').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('volume_number').'</th>';
                 echo '<th onclick="orderby(\'id_card\', \'desc\')" '.CommonFun::sortClass($orderby, 'id_card').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('id_card').'</th>';
                 echo '<th onclick="orderby(\'disposal_year\', \'desc\')" '.CommonFun::sortClass($orderby, 'disposal_year').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('disposal_year').'</th>';

                 echo '<th onclick="orderby(\'create_date\', \'desc\')" '.CommonFun::sortClass($orderby, 'create_date').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('create_date').'</th>';
                 echo '<th onclick="orderby(\'update_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'update_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('update_time').'</th>';

                 ?>

                 <th tabindex="0" class="th-width-0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >操作</th>
             </tr>
             </tfoot>
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
                <?php $form = ActiveForm::begin(["id" => "qinlian-petition-form", "class"=>"form-horizontal", "action"=>Url::toRoute("qinlian-petition/save")]); ?>                      
                 
          <input type="hidden" class="form-control" id="id" name="id" />

          <div id="number_div" class="form-group">
              <label for="number" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("number")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="number" name="QinlianPetition[number]" placeholder="必填" />
              </div>

              <label for="receipt_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("receipt_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="receipt_time" name="QinlianPetition[receipt_time]" placeholder="必填" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="turn_number_div" class="form-group">
              <label for="turn_number" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("turn_number")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="turn_number" name="QinlianPetition[turn_number]" placeholder="" />
              </div>

              <label for="transfer_organ" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("transfer_organ")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="transfer_organ" name="QinlianPetition[transfer_organ]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="name_report_div" class="form-group">
              <label for="name_report" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("name_report")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="name_report" name="QinlianPetition[name_report]" placeholder="必填" />
              </div>

              <label for="name_reported" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("name_reported")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="name_reported" name="QinlianPetition[name_reported]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="political_appearance_div" class="form-group">
              <label for="political_appearance" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("political_appearance")?></label>
              <div class="col-sm-4">
                  <select class="form-control" id="political_appearance" name="QinlianPetition[political_appearance]" >
                      <option selected="selected">党员</option>
                      <option >非党员</option>
                  </select>
<!--                  <input type="text" class="form-control" id="political_appearance" name="QinlianPetition[political_appearance]" placeholder="" />-->
              </div>

              <label for="unit_job" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("unit_job")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="unit_job" name="QinlianPetition[unit_job]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="duty_job_div" class="form-group">
              <label for="duty_job" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("duty_job")?></label>
              <div class="col-sm-4">
                  <select class="form-control" id="duty_job" name="QinlianPetition[duty_job]">
                      <option>一般干部</option>
                      <option>乡科级</option>
                      <option>农村干部 </option>
                      <option>股级</option>
                      <option>农村其他人员</option>
                  </select>
              </div>

              <label for="rank_job" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("rank_job")?></label>
              <div class="col-sm-4">
                  <select class="form-control" id="rank_job" name="QinlianPetition[rank_job]">
                      <option>一级</option>
                      <option>二级</option>
                      <option>三级</option>
                  </select>
<!--                  <input type="text" class="form-control" id="rank_job" name="QinlianPetition[rank_job]" placeholder="" />-->
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="main_issues_div" class="form-group">
              <label for="main_issues" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("main_issues")?></label>
              <div class="col-xs-10">
                  <textarea  type="text" class="form-control" id="main_issues" name="QinlianPetition[main_issues]" placeholder="必填" ></textarea>
<!--                  <input type="text" class="form-control" id="main_issues" name="QinlianPetition[main_issues]" placeholder="必填" />-->
              </div>

              <label for="issues_properties" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("issues_properties")?></label>
              <div class="col-xs-10">
                  <textarea type="text" class="form-control" id="issues_properties" name="QinlianPetition[issues_properties]" placeholder="必填" ></textarea>
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="petition_office_opinion_div" class="form-group">
              <label for="petition_office_opinion" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("petition_office_opinion")?></label>
              <div class="col-xs-10">
                  <textarea type="text" class="form-control" id="petition_office_opinion" name="QinlianPetition[petition_office_opinion]" placeholder="" ></textarea>
              </div>

              <label for="superior_guidance_opinion" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("superior_guidance_opinion")?></label>
              <div class="col-xs-10">
                  <textarea type="text" class="form-control" id="superior_guidance_opinion" name="QinlianPetition[superior_guidance_opinion]" placeholder="" ></textarea>
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="lu_clerk_opinion_div" class="form-group">
              <label for="lu_clerk_opinion" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("lu_clerk_opinion")?></label>
              <div class="col-xs-10">
                  <textarea type="text" class="form-control" id="lu_clerk_opinion" name="QinlianPetition[lu_clerk_opinion]" placeholder="" ></textarea>
              </div>

              <label for="major_leadership_approval_opinion" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("major_leadership_approval_opinion")?></label>
              <div class="col-xs-10">
                  <textarea type="text" class="form-control" id="major_leadership_approval_opinion" name="QinlianPetition[major_leadership_approval_opinion]" placeholder="" ></textarea>
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="charge_leadership_approval_opinion_div" class="form-group">
              <label for="charge_leadership_approval_opinion" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("charge_leadership_approval_opinion")?></label>
              <div class="col-xs-10">
                  <textarea type="text" class="form-control" id="charge_leadership_approval_opinion" name="QinlianPetition[charge_leadership_approval_opinion]" placeholder="" ></textarea>
              </div>

              <div class="clearfix"></div>
          </div>

          <div id="handle_results_div" class="form-group">
              <label for="handle_results" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("handle_results")?></label>
              <div class="col-xs-10">
                  <textarea type="text" class="form-control" id="handle_results" name="QinlianPetition[handle_results]" placeholder="" ></textarea>
              </div>

              <label for="heavy_letter" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("heavy_letter")?></label>
              <div class="col-xs-10">
                  <textarea type="text" class="form-control" id="heavy_letter" name="QinlianPetition[heavy_letter]" placeholder="" ></textarea>
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="unit_responsibility_div" class="form-group">
              <label for="host_department" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("host_department")?></label>
              <div class="col-sm-4">
                  <select class="form-control" id="host_department" name="QinlianPetition[host_department]">
                      <?php
                      foreach ($departments as $department) {
                          echo '  <option>' . $department->department . '</option>';
                      }
                      ?>
                  </select>
              </div>


              <label for="unit_responsibility" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("unit_responsibility")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="unit_responsibility" name="QinlianPetition[unit_responsibility]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="approval_status_div" class="form-group">
              <label for="approval_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("approval_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="approval_time" name="QinlianPetition[approval_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>

              <label for="approval_status" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("approval_status")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="approval_status" name="QinlianPetition[approval_status]" placeholder="" />
              </div>

              <div class="clearfix"></div>
          </div>

        <div id="is_thread_disposal_div" class="form-group">
            <label for="is_thread_disposal" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("is_thread_disposal")?></label>
            <div class="col-sm-4">
                <select class="form-control" id="is_thread_disposal" name="QinlianPetition[is_thread_disposal]">
                    <option>是</option>
                    <option>否</option>
                </select>
            </div>

            <label for="id_card" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("id_card")?></label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="id_card" name="QinlianPetition[id_card]" placeholder=""/>
            </div>
            <div class="clearfix"></div>
        </div>

          <div id="create_date_div" class="form-group">
              <label for="create_date" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("create_date")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="create_date" name="QinlianPetition[create_date]" placeholder="必填" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>

              <label for="update_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("update_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="update_time" name="QinlianPetition[update_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
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
    <form action="<?=Url::toRoute('qinlian-petition/import')?>" method="post" id="qinlian-petition-form-import" enctype="multipart/form-data">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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


<!-- archives（Modal） -->
<div class="modal fade" id="archives" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3>归档</h3>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin(["id" => "qinlian-petition-archives-form", "class"=>"form-horizontal", "action"=>Url::toRoute("qinlian-petition/save")]); ?>

                <input type="hidden" class="form-control" id="archives-id" name="id" />

                <div id="number_div" class="form-group">
                    <label for="disposal_method" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("disposal_method")?></label>
                    <div class="col-sm-4">
                        <select class="form-control" id="disposal_method" name="QinlianPetition[disposal_method]" >
                            <option>谈话函询</option>
                            <option>初步核实</option>
                            <option>暂存待查</option>
                            <option>予以了结</option>
                            <option>立案调查</option>
                        </select>
                    </div>

                    <label for="number" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("number")?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="archives-number" name="QinlianPetition[number]" />
                    </div>
                    <div class="clearfix"></div>
                </div>


                <div id="is_thread_disposal_div" class="form-group">
                    <label for="volume_number" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("volume_number")?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="volume_number" name="QinlianPetition[volume_number]"/>
                    </div>

                    <label for="disposal_year" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("disposal_year")?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="disposal_year" name="QinlianPetition[disposal_year]" data-provide="datepicker" data-date-format="yyyy" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="create_date_div" class="form-group">
                    <label for="host_department" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("host_department")?></label>
                    <div class="col-sm-4">
                        <select class="form-control" id="archives-host_department" name="QinlianPetition[host_department]">
                            <option>科室一</option>
                            <option>科室二</option>
                            <option>科室三</option>
                        </select>
                    </div>
                    <div class="clearfix"></div>
                </div>


                <?php ActiveForm::end(); ?>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-default" data-dismiss="modal">关闭</a>
                <a id="archives_dialog_ok" href="#" class="btn btn-primary">确定</a>
            </div>
        </div>
    </div>
</div><!-- /.modal -->

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
		$('#qinlian-petition-search-form').submit();
	}

function exportAction(){
    ////var url = "<?////=Url::toRoute('qinlian-petition/export')?>////";
    //var export_url = "<?//=Url::toRoute('qinlian-petition/export')?>//";
    //// alert(1)
    //$('#qinlian-petition-search-form').attr("action", export_url);
    //$('#query[number]').val('qinlian-petition/export');
    $('#qinlian-petition-export-form').submit();
}

 function viewAction(id){
		initModel(id, 'view', 'fun');
	}

 function initEditSystemModule(data, type){
	if(type == 'create'){
    	        $("#id").val("");
        $("#number").val("");
        $("#receipt_time").val("");
        $("#turn_number").val("");
        $("#transfer_organ").val("");
        $("#name_report").val("");
        $("#name_reported").val("");
        $("#political_appearance").val("");
        $("#unit_job").val("");
        $("#duty_job").val("");
        $("#rank_job").val("");
        $("#main_issues").val("");
        $("#issues_properties").val("");
        $("#petition_office_opinion").val("");
        $("#superior_guidance_opinion").val("");
        $("#lu_clerk_opinion").val("");
        $("#major_leadership_approval_opinion").val("");
        $("#charge_leadership_approval_opinion").val("");
        $("#host_department").val("");
        $("#handle_results").val("");
        $("#heavy_letter").val("");
        $("#unit_responsibility").val("");
        $("#approval_time").val("");
        $("#approval_status").val("");
        $("#is_thread_disposal").val("");
        $("#id_card").val("");
        $("#del_status").val("");
        $("#create_date").val("");
        $("#update_time").val("");
	
	}
	else{
    	        $("#id").val(data.id)
        $("#number").val(data.number)
        $("#receipt_time").val(data.receipt_time)
        $("#turn_number").val(data.turn_number)
        $("#transfer_organ").val(data.transfer_organ)
        $("#name_report").val(data.name_report)
        $("#name_reported").val(data.name_reported)
        $("#political_appearance").val(data.political_appearance)
        $("#unit_job").val(data.unit_job)
        $("#duty_job").val(data.duty_job)
        $("#rank_job").val(data.rank_job)
        $("#main_issues").val(data.main_issues)
        $("#issues_properties").val(data.issues_properties)
        $("#petition_office_opinion").val(data.petition_office_opinion)
        $("#superior_guidance_opinion").val(data.superior_guidance_opinion)
        $("#lu_clerk_opinion").val(data.lu_clerk_opinion)
        $("#major_leadership_approval_opinion").val(data.major_leadership_approval_opinion)
        $("#charge_leadership_approval_opinion").val(data.charge_leadership_approval_opinion)
        $("#host_department").val(data.host_department)
        $("#handle_results").val(data.handle_results)
        $("#heavy_letter").val(data.heavy_letter)
        $("#unit_responsibility").val(data.unit_responsibility)
        $("#approval_time").val(data.approval_time)
        $("#approval_status").val(data.approval_status)
        $("#is_thread_disposal").val(data.is_thread_disposal)
        $("#id_card").val(data.id_card)
        $("#del_status").val(data.del_status)
        $("#create_date").val(data.create_date)
        $("#update_time").val(data.update_time)
	}
	if(type == "view"){
      $("#id").attr({readonly:true,disabled:true});
      $("#number").attr({readonly:true,disabled:true});
      $("#receipt_time").attr({readonly:true,disabled:true});
      $("#turn_number").attr({readonly:true,disabled:true});
      $("#transfer_organ").attr({readonly:true,disabled:true});
      $("#name_report").attr({readonly:true,disabled:true});
      $("#name_reported").attr({readonly:true,disabled:true});
      $("#political_appearance").attr({readonly:true,disabled:true});
      $("#unit_job").attr({readonly:true,disabled:true});
      $("#duty_job").attr({readonly:true,disabled:true});
      $("#rank_job").attr({readonly:true,disabled:true});
      $("#main_issues").attr({readonly:true,disabled:true});
      $("#issues_properties").attr({readonly:true,disabled:true});
      $("#petition_office_opinion").attr({readonly:true,disabled:true});
      $("#superior_guidance_opinion").attr({readonly:true,disabled:true});
      $("#lu_clerk_opinion").attr({readonly:true,disabled:true});
      $("#major_leadership_approval_opinion").attr({readonly:true,disabled:true});
      $("#charge_leadership_approval_opinion").attr({readonly:true,disabled:true});
      $("#host_department").attr({readonly:true,disabled:true});
      $("#handle_results").attr({readonly:true,disabled:true});
      $("#heavy_letter").attr({readonly:true,disabled:true});
      $("#unit_responsibility").attr({readonly:true,disabled:true});
      $("#approval_time").attr({readonly:true,disabled:true});
      $("#approval_status").attr({readonly:true,disabled:true});
      $("#is_thread_disposal").attr({readonly:true,disabled:true});
      $("#id_card").attr({readonly:true,disabled:true});
      $("#del_status").attr({readonly:true,disabled:true});
      $("#create_date").attr({readonly:true,disabled:true});
      $("#update_time").attr({readonly:true,disabled:true});
	$('#edit_dialog_ok').addClass('hidden');
	}
	else{
      $("#id").attr({readonly:false,disabled:false});
      $("#number").attr({readonly:false,disabled:false});
      $("#receipt_time").attr({readonly:false,disabled:false});
      $("#turn_number").attr({readonly:false,disabled:false});
      $("#transfer_organ").attr({readonly:false,disabled:false});
      $("#name_report").attr({readonly:false,disabled:false});
      $("#name_reported").attr({readonly:false,disabled:false});
      $("#political_appearance").attr({readonly:false,disabled:false});
      $("#unit_job").attr({readonly:false,disabled:false});
      $("#duty_job").attr({readonly:false,disabled:false});
      $("#rank_job").attr({readonly:false,disabled:false});
      $("#main_issues").attr({readonly:false,disabled:false});
      $("#issues_properties").attr({readonly:false,disabled:false});
      $("#petition_office_opinion").attr({readonly:false,disabled:false});
      $("#superior_guidance_opinion").attr({readonly:false,disabled:false});
      $("#lu_clerk_opinion").attr({readonly:false,disabled:false});
      $("#major_leadership_approval_opinion").attr({readonly:false,disabled:false});
      $("#charge_leadership_approval_opinion").attr({readonly:false,disabled:false});
      $("#host_department").attr({readonly:false,disabled:false});
      $("#handle_results").attr({readonly:false,disabled:false});
      $("#heavy_letter").attr({readonly:false,disabled:false});
      $("#unit_responsibility").attr({readonly:false,disabled:false});
      $("#approval_time").attr({readonly:false,disabled:false});
      $("#approval_status").attr({readonly:false,disabled:false});
      $("#is_thread_disposal").attr({readonly:false,disabled:false});
      $("#id_card").attr({readonly:false,disabled:false});
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
		   url: "<?=Url::toRoute('qinlian-petition/view')?>",
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
				   url: "<?=Url::toRoute('qinlian-petition/delete')?>",
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
	$('#qinlian-petition-form').submit();
});

$('#create_btn').click(function (e) {
    e.preventDefault();
    initEditSystemModule({}, 'create');
});

$('#delete_btn').click(function (e) {
    e.preventDefault();
    deleteAction('');
});

$('#qinlian-petition-form').bind('submit', function(e) {
	e.preventDefault();
	var id = $("#id").val();
	var action = id == "" ? "<?=Url::toRoute('qinlian-petition/create')?>" : "<?=Url::toRoute('qinlian-petition/update')?>";
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

$('#qinlian-petition-form-import').bind('submit', function(e) {
    e.preventDefault();
    var action = "<?=Url::toRoute('qinlian-petition/import')?>";
    $(this).ajaxSubmit({
        type: "post",
        dataType:"json",
        url: action,
        success: function(value)
        {
            if(value.errno == 0){
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

<script>
    function archivesAction(id){
        $.ajax({
            type: "GET",
            url: "<?=Url::toRoute('qinlian-petition/view')?>",
            data: {"id":id},
            cache: false,
            dataType:"json",
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("出错了，" + textStatus);
            },
            success: function(data){
                console.log(data)
                initArchivesmModule(data);
            }
        });
    }

    function initArchivesmModule(data) {
        $("#archives-id").val(data.id)
        $("#disposal_method").val(data.disposal_method)
        $("#volume_number").val(data.volume_number)
        $("#disposal_year").val(data.disposal_year)
        $("#archives-host_department").val(data.host_department)
        $("#archives-number").val(data.number)
    }

    $('#archives_dialog_ok').click(function (e) {
        e.preventDefault();
        $('#qinlian-petition-archives-form').submit();
    });

    $('#qinlian-petition-archives-form').bind('submit', function(e) {
        e.preventDefault();
        var id = $("#archives-id").val();
        var action = "<?=Url::toRoute('qinlian-petition/update')?>";
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

<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;

use backend\models\QinlianThread;

$modelLabel = new \backend\models\QinlianThread();
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
                  <a href="<?=Url::toRoute('qinlian-thread/export')?>" class="btn btn-xs btn-info">导&nbsp;&emsp;出</a>
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
                <?php ActiveForm::begin(['id' => 'qinlian-thread-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('qinlian-thread/index')]); ?>     
                
                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('id')?>:</label>
                      <input type="text" class="form-control" id="query[id]" name="query[id]"  value="<?=isset($query["id"]) ? $query["id"] : "" ?>">
                  </div>
                <div class="form-group" style="margin: 5px;">
                    <label><?=$modelLabel->getAttributeLabel('nuit_name')?>:</label>
                    <input type="text" class="form-control" id="query[nuit_name]" name="query[nuit_name]"  value="<?=isset($query["nuit_name"]) ? $query["nuit_name"] : "" ?>">
                </div>
                <div class="form-group" style="margin: 5px;">
                    <label><?=$modelLabel->getAttributeLabel('nuit_code')?>:</label>
                    <input type="text" class="form-control" id="query[nuit_code]" name="query[nuit_code]"  value="<?=isset($query["nuit_code"]) ? $query["nuit_code"] : "" ?>">
                </div>
                <div class="form-group" style="margin: 5px;">
                    <label><?=$modelLabel->getAttributeLabel('personnel_code')?>:</label>
                    <input type="text" class="form-control" id="query[personnel_code]" name="query[personnel_code]"  value="<?=isset($query["personnel_code"]) ? $query["personnel_code"] : "" ?>">
                </div>
                <div class="form-group" style="margin: 5px;">
                    <label><?=$modelLabel->getAttributeLabel('person_reflected')?>:</label>
                    <input type="text" class="form-control" id="query[person_reflected]" name="query[person_reflected]"  value="<?=isset($query["person_reflected"]) ? $query["person_reflected"] : "" ?>">
                </div>
                <div class="form-group" style="margin: 5px;">
                    <label><?=$modelLabel->getAttributeLabel('handling_organ')?>:</label>
                    <input type="text" class="form-control" id="query[handling_organ]" name="query[handling_organ]"  value="<?=isset($query["handling_organ"]) ? $query["handling_organ"] : "" ?>">
                </div>
                <div class="form-group" style="margin: 5px;">
                    <label><?=$modelLabel->getAttributeLabel('superiors_assigned')?>:</label>
                    <input type="text" class="form-control" id="query[superiors_assigned]" name="query[superiors_assigned]"  value="<?=isset($query["superiors_assigned"]) ? $query["superiors_assigned"] : "" ?>">
                </div>
                <div class="form-group" style="margin: 5px;">
                    <label><?=$modelLabel->getAttributeLabel('department_charge')?>:</label>
                    <input type="text" class="form-control" id="query[department_charge]" name="query[department_charge]"  value="<?=isset($query["department_charge"]) ? $query["department_charge"] : "" ?>">
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
              echo '<th onclick="orderby(\'is_nuit\', \'desc\')" '.CommonFun::sortClass($orderby, 'is_nuit').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('is_nuit').'</th>';
              echo '<th onclick="orderby(\'nuit_name\', \'desc\')" '.CommonFun::sortClass($orderby, 'nuit_name').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('nuit_name').'</th>';
              echo '<th onclick="orderby(\'nuit_code\', \'desc\')" '.CommonFun::sortClass($orderby, 'nuit_code').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('nuit_code').'</th>';
              echo '<th onclick="orderby(\'statistical_identification\', \'desc\')" '.CommonFun::sortClass($orderby, 'statistical_identification').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('statistical_identification').'</th>';
              echo '<th onclick="orderby(\'clue_code\', \'desc\')" '.CommonFun::sortClass($orderby, 'clue_code').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('clue_code').'</th>';
              echo '<th onclick="orderby(\'personnel_code\', \'desc\')" '.CommonFun::sortClass($orderby, 'personnel_code').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('personnel_code').'</th>';
              echo '<th onclick="orderby(\'person_reflected\', \'desc\')" '.CommonFun::sortClass($orderby, 'person_reflected').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('person_reflected').'</th>';
              echo '<th onclick="orderby(\'duty_job\', \'desc\')" '.CommonFun::sortClass($orderby, 'duty_job').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('duty_job').'</th>';
              echo '<th onclick="orderby(\'is_supervises_object\', \'desc\')" '.CommonFun::sortClass($orderby, 'is_supervises_object').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('is_supervises_object').'</th>';
              echo '<th onclick="orderby(\'rank_job\', \'desc\')" '.CommonFun::sortClass($orderby, 'rank_job').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('rank_job').'</th>';
              echo '<th onclick="orderby(\'recovers_economic_loss\', \'desc\')" '.CommonFun::sortClass($orderby, 'recovers_economic_loss').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('recovers_economic_loss').'</th>';
              echo '<th onclick="orderby(\'collects_amount\', \'desc\')" '.CommonFun::sortClass($orderby, 'collects_amount').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('collects_amount').'</th>';
              echo '<th onclick="orderby(\'handling_organ\', \'desc\')" '.CommonFun::sortClass($orderby, 'handling_organ').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('handling_organ').'</th>';
              echo '<th onclick="orderby(\'main_problem_clues\', \'desc\')" '.CommonFun::sortClass($orderby, 'main_problem_clues').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('main_problem_clues').'</th>';
              echo '<th onclick="orderby(\'remarks\', \'desc\')" '.CommonFun::sortClass($orderby, 'remarks').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('remarks').'</th>';
              echo '<th onclick="orderby(\'nation\', \'desc\')" '.CommonFun::sortClass($orderby, 'nation').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('nation').'</th>';
              echo '<th onclick="orderby(\'date_birth\', \'desc\')" '.CommonFun::sortClass($orderby, 'date_birth').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('date_birth').'</th>';
              echo '<th onclick="orderby(\'cpc\', \'desc\')" '.CommonFun::sortClass($orderby, 'cpc').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('cpc').'</th>';
              echo '<th onclick="orderby(\'cppcc\', \'desc\')" '.CommonFun::sortClass($orderby, 'cppcc').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('cppcc').'</th>';
              echo '<th onclick="orderby(\'disposal_report\', \'desc\')" '.CommonFun::sortClass($orderby, 'disposal_report').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('disposal_report').'</th>';
              echo '<th onclick="orderby(\'time_joining_party\', \'desc\')" '.CommonFun::sortClass($orderby, 'time_joining_party').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('time_joining_party').'</th>';
              echo '<th onclick="orderby(\'authority_management\', \'desc\')" '.CommonFun::sortClass($orderby, 'authority_management').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('authority_management').'</th>';
              echo '<th onclick="orderby(\'acceptance_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'acceptance_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('acceptance_time').'</th>';
              echo '<th onclick="orderby(\'approval_time_one\', \'desc\')" '.CommonFun::sortClass($orderby, 'approval_time_one').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('approval_time_one').'</th>';
              echo '<th onclick="orderby(\'statistical_time_one\', \'desc\')" '.CommonFun::sortClass($orderby, 'statistical_time_one').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('statistical_time_one').'</th>';
              echo '<th onclick="orderby(\'one_level_first\', \'desc\')" '.CommonFun::sortClass($orderby, 'one_level_first').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('one_level_first').'</th>';
              echo '<th onclick="orderby(\'one_level_second\', \'desc\')" '.CommonFun::sortClass($orderby, 'one_level_second').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('one_level_second').'</th>';
              echo '<th onclick="orderby(\'approval_time_two\', \'desc\')" '.CommonFun::sortClass($orderby, 'approval_time_two').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('approval_time_two').'</th>';
              echo '<th onclick="orderby(\'statistical_time_two\', \'desc\')" '.CommonFun::sortClass($orderby, 'statistical_time_two').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('statistical_time_two').'</th>';
              echo '<th onclick="orderby(\'two_level_first\', \'desc\')" '.CommonFun::sortClass($orderby, 'two_level_first').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('two_level_first').'</th>';
              echo '<th onclick="orderby(\'two_level_second\', \'desc\')" '.CommonFun::sortClass($orderby, 'two_level_second').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('two_level_second').'</th>';
              echo '<th onclick="orderby(\'approval_time_three\', \'desc\')" '.CommonFun::sortClass($orderby, 'approval_time_three').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('approval_time_three').'</th>';
              echo '<th onclick="orderby(\'statistical_time_three\', \'desc\')" '.CommonFun::sortClass($orderby, 'statistical_time_three').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('statistical_time_three').'</th>';
              echo '<th onclick="orderby(\'three_level_first\', \'desc\')" '.CommonFun::sortClass($orderby, 'three_level_first').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('three_level_first').'</th>';
              echo '<th onclick="orderby(\'three_level_second\', \'desc\')" '.CommonFun::sortClass($orderby, 'three_level_second').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('three_level_second').'</th>';
              echo '<th onclick="orderby(\'cases_source\', \'desc\')" '.CommonFun::sortClass($orderby, 'cases_source').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('cases_source').'</th>';
              echo '<th onclick="orderby(\'disciplinary_offence\', \'desc\')" '.CommonFun::sortClass($orderby, 'disciplinary_offence').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('disciplinary_offence').'</th>';
              echo '<th onclick="orderby(\'is_checking_me\', \'desc\')" '.CommonFun::sortClass($orderby, 'is_checking_me').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('is_checking_me').'</th>';
              echo '<th onclick="orderby(\'is_party\', \'desc\')" '.CommonFun::sortClass($orderby, 'is_party').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('is_party').'</th>';
              echo '<th onclick="orderby(\'secondary_class_objects\', \'desc\')" '.CommonFun::sortClass($orderby, 'secondary_class_objects').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('secondary_class_objects').'</th>';
              echo '<th onclick="orderby(\'is_supervisory_objects\', \'desc\')" '.CommonFun::sortClass($orderby, 'is_supervisory_objects').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('is_supervisory_objects').'</th>';
              echo '<th onclick="orderby(\'no_secondary_class_objects\', \'desc\')" '.CommonFun::sortClass($orderby, 'no_secondary_class_objects').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('no_secondary_class_objects').'</th>';
              echo '<th onclick="orderby(\'official_offences\', \'desc\')" '.CommonFun::sortClass($orderby, 'official_offences').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('official_offences').'</th>';
              echo '<th onclick="orderby(\'other_offences\', \'desc\')" '.CommonFun::sortClass($orderby, 'other_offences').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('other_offences').'</th>';
              echo '<th onclick="orderby(\'organization_measure_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'organization_measure_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('organization_measure_time').'</th>';
              echo '<th onclick="orderby(\'superiors_assigned\', \'desc\')" '.CommonFun::sortClass($orderby, 'superiors_assigned').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('superiors_assigned').'</th>';
              echo '<th onclick="orderby(\'department_charge\', \'desc\')" '.CommonFun::sortClass($orderby, 'department_charge').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('department_charge').'</th>';
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
                echo '  <td>' . $model->is_nuit . '</td>';
                echo '  <td>' . $model->nuit_name . '</td>';
                echo '  <td>' . $model->nuit_code . '</td>';
                echo '  <td>' . $model->statistical_identification . '</td>';
                echo '  <td>' . $model->clue_code . '</td>';
                echo '  <td>' . $model->personnel_code . '</td>';
                echo '  <td>' . $model->person_reflected . '</td>';
                echo '  <td>' . $model->duty_job . '</td>';
                echo '  <td>' . $model->is_supervises_object . '</td>';
                echo '  <td>' . $model->rank_job . '</td>';
                echo '  <td>' . $model->recovers_economic_loss . '</td>';
                echo '  <td>' . $model->collects_amount . '</td>';
                echo '  <td>' . $model->handling_organ . '</td>';
                echo '  <td>' . $model->main_problem_clues . '</td>';
                echo '  <td>' . $model->remarks . '</td>';
                echo '  <td>' . $model->nation . '</td>';
                echo '  <td>' . $model->date_birth . '</td>';
                echo '  <td>' . $model->cpc . '</td>';
                echo '  <td>' . $model->cppcc . '</td>';
                echo '  <td>' . $model->disposal_report . '</td>';
                echo '  <td>' . $model->time_joining_party . '</td>';
                echo '  <td>' . $model->authority_management . '</td>';
                echo '  <td>' . $model->acceptance_time . '</td>';
                echo '  <td>' . $model->approval_time_one . '</td>';
                echo '  <td>' . $model->statistical_time_one . '</td>';
                echo '  <td>' . $model->one_level_first . '</td>';
                echo '  <td>' . $model->one_level_second . '</td>';
                echo '  <td>' . $model->approval_time_two . '</td>';
                echo '  <td>' . $model->statistical_time_two . '</td>';
                echo '  <td>' . $model->two_level_first . '</td>';
                echo '  <td>' . $model->two_level_second . '</td>';
                echo '  <td>' . $model->approval_time_three . '</td>';
                echo '  <td>' . $model->statistical_time_three . '</td>';
                echo '  <td>' . $model->three_level_first . '</td>';
                echo '  <td>' . $model->three_level_second . '</td>';
                echo '  <td>' . $model->cases_source . '</td>';
                echo '  <td>' . $model->disciplinary_offence . '</td>';
                echo '  <td>' . $model->is_checking_me . '</td>';
                echo '  <td>' . $model->is_party . '</td>';
                echo '  <td>' . $model->secondary_class_objects . '</td>';
                echo '  <td>' . $model->is_supervisory_objects . '</td>';
                echo '  <td>' . $model->no_secondary_class_objects . '</td>';
                echo '  <td>' . $model->official_offences . '</td>';
                echo '  <td>' . $model->other_offences . '</td>';
                echo '  <td>' . $model->organization_measure_time . '</td>';
                echo '  <td>' . $model->superiors_assigned . '</td>';
                echo '  <td>' . $model->department_charge . '</td>';
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
                <?php $form = ActiveForm::begin(["id" => "qinlian-thread-form", "class"=>"form-horizontal", "action"=>Url::toRoute("qinlian-thread/save")]); ?>                      
                 
          <input type="hidden" class="form-control" id="id" name="id" />

          <div id="is_nuit_div" class="form-group">
              <label for="is_nuit" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("is_nuit")?></label>
              <div class="col-sm-4">
                  <select class="form-control" id="is_nuit" name="QinlianThread[is_nuit]" >
                      <option>是</option>
                      <option>否</option>
                  </select>
<!--                  <input type="text" class="form-control" id="is_nuit" name="QinlianThread[is_nuit]" placeholder="必填" />-->
              </div>

              <label for="nuit_name" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("nuit_name")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="nuit_name" name="QinlianThread[nuit_name]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="nuit_code_div" class="form-group">
              <label for="nuit_code" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("nuit_code")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="nuit_code" name="QinlianThread[nuit_code]" placeholder="" />
              </div>

              <label for="statistical_identification" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("statistical_identification")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="statistical_identification" name="QinlianThread[statistical_identification]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="clue_code_div" class="form-group">
              <label for="clue_code" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("clue_code")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="clue_code" name="QinlianThread[clue_code]" placeholder="" />
              </div>

              <label for="personnel_code" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("personnel_code")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="personnel_code" name="QinlianThread[personnel_code]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="person_reflected_div" class="form-group">
              <label for="person_reflected" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("person_reflected")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="person_reflected" name="QinlianThread[person_reflected]" placeholder="" />
              </div>

              <label for="duty_job" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("duty_job")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="duty_job" name="QinlianThread[duty_job]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="is_supervises_object_div" class="form-group">
              <label for="is_supervises_object" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("is_supervises_object")?></label>
              <div class="col-sm-4">
                  <select class="form-control" id="is_supervises_object" name="QinlianThread[is_supervises_object]" >
                      <option>是</option>
                      <option>否</option>
                  </select>
<!--                  <input type="text" class="form-control" id="is_supervises_object" name="QinlianThread[is_supervises_object]" placeholder="必填" />-->
              </div>

              <label for="rank_job" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("rank_job")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="rank_job" name="QinlianThread[rank_job]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="recovers_economic_loss_div" class="form-group">
              <label for="recovers_economic_loss" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("recovers_economic_loss")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="recovers_economic_loss" name="QinlianThread[recovers_economic_loss]" placeholder="" />
              </div>

              <label for="collects_amount" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("collects_amount")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="collects_amount" name="QinlianThread[collects_amount]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="handling_organ_div" class="form-group">
              <label for="handling_organ" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("handling_organ")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="handling_organ" name="QinlianThread[handling_organ]" placeholder="" />
              </div>

              <label for="main_problem_clues" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("main_problem_clues")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="main_problem_clues" name="QinlianThread[main_problem_clues]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="remarks_div" class="form-group">
              <label for="remarks" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("remarks")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="remarks" name="QinlianThread[remarks]" placeholder="" />
              </div>

              <label for="nation" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("nation")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="nation" name="QinlianThread[nation]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="date_birth_div" class="form-group">
              <label for="date_birth" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("date_birth")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="date_birth" name="QinlianThread[date_birth]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>

              <label for="cpc" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("cpc")?></label>
              <div class="col-sm-4">
                  <select class="form-control" id="is_party" name="QinlianThread[cpc]" >
                      <option>是</option>
                      <option>否</option>
                  </select>
<!--                  <input type="text" class="form-control" id="cpc" name="QinlianThread[cpc]" placeholder="" />-->
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="cppcc_div" class="form-group">
              <label for="cppcc" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("cppcc")?></label>
              <div class="col-sm-4">
                  <select class="form-control" id="is_party" name="QinlianThread[cppcc]" >
                      <option>是</option>
                      <option>否</option>
                  </select>
<!--                  <input type="text" class="form-control" id="cppcc" name="QinlianThread[cppcc]" placeholder="" />-->
              </div>

              <label for="disposal_report" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("disposal_report")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="disposal_report" name="QinlianThread[disposal_report]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="time_joining_party_div" class="form-group">
              <label for="time_joining_party" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("time_joining_party")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="time_joining_party" name="QinlianThread[time_joining_party]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>

              <label for="authority_management" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("authority_management")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="authority_management" name="QinlianThread[authority_management]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="acceptance_time_div" class="form-group">
              <label for="acceptance_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("acceptance_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="acceptance_time" name="QinlianThread[acceptance_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>

              <label for="approval_time_one" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("approval_time_one")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="approval_time_one" name="QinlianThread[approval_time_one]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="statistical_time_one_div" class="form-group">
              <label for="statistical_time_one" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("statistical_time_one")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="statistical_time_one" name="QinlianThread[statistical_time_one]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>

              <label for="one_level_first" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("one_level_first")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="one_level_first" name="QinlianThread[one_level_first]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="one_level_second_div" class="form-group">
              <label for="one_level_second" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("one_level_second")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="one_level_second" name="QinlianThread[one_level_second]" placeholder="" />
              </div>

              <label for="approval_time_two" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("approval_time_two")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="approval_time_two" name="QinlianThread[approval_time_two]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="statistical_time_two_div" class="form-group">
              <label for="statistical_time_two" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("statistical_time_two")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="statistical_time_two" name="QinlianThread[statistical_time_two]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>

              <label for="two_level_first" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("two_level_first")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="two_level_first" name="QinlianThread[two_level_first]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="two_level_second_div" class="form-group">
              <label for="two_level_second" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("two_level_second")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="two_level_second" name="QinlianThread[two_level_second]" placeholder="" />
              </div>

              <label for="approval_time_three" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("approval_time_three")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="approval_time_three" name="QinlianThread[approval_time_three]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="statistical_time_three_div" class="form-group">
              <label for="statistical_time_three" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("statistical_time_three")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="statistical_time_three" name="QinlianThread[statistical_time_three]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>

              <label for="three_level_first" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("three_level_first")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="three_level_first" name="QinlianThread[three_level_first]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="three_level_second_div" class="form-group">
              <label for="three_level_second" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("three_level_second")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="three_level_second" name="QinlianThread[three_level_second]" placeholder="" />
              </div>

              <label for="cases_source" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("cases_source")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="cases_source" name="QinlianThread[cases_source]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="disciplinary_offence_div" class="form-group">
              <label for="disciplinary_offence" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("disciplinary_offence")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="disciplinary_offence" name="QinlianThread[disciplinary_offence]" placeholder="" />
              </div>

              <label for="is_checking_me" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("is_checking_me")?></label>
              <div class="col-sm-4">
                  <select class="form-control" id="is_checking_me" name="QinlianThread[is_checking_me]" >
                      <option>是</option>
                      <option>否</option>
                  </select>
<!--                  <input type="text" class="form-control" id="is_checking_me" name="QinlianThread[is_checking_me]" placeholder="必填" />-->
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="is_party_div" class="form-group">
              <label for="is_party" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("is_party")?></label>
              <div class="col-sm-4">
                  <select class="form-control" id="is_party" name="QinlianThread[is_party]" >
                      <option>是</option>
                      <option>否</option>
                  </select>
<!--                  <input type="text" class="form-control" id="is_party" name="QinlianThread[is_party]" placeholder="必填" />-->
              </div>

              <label for="secondary_class_objects" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("secondary_class_objects")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="secondary_class_objects" name="QinlianThread[secondary_class_objects]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="is_supervisory_objects_div" class="form-group">
              <label for="is_supervisory_objects" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("is_supervisory_objects")?></label>
              <div class="col-sm-4">
                  <select class="form-control" id="is_supervisory_objects" name="QinlianThread[is_supervisory_objects]" >
                      <option>是</option>
                      <option>否</option>
                  </select>
<!--                  <input type="text" class="form-control" id="is_supervisory_objects" name="QinlianThread[is_supervisory_objects]" placeholder="必填" />-->
              </div>

              <label for="no_secondary_class_objects" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("no_secondary_class_objects")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="no_secondary_class_objects" name="QinlianThread[no_secondary_class_objects]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="official_offences_div" class="form-group">
              <label for="official_offences" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("official_offences")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="official_offences" name="QinlianThread[official_offences]" placeholder="" />
              </div>

              <label for="other_offences" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("other_offences")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="other_offences" name="QinlianThread[other_offences]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="organization_measure_time_div" class="form-group">
              <label for="organization_measure_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("organization_measure_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="organization_measure_time" name="QinlianThread[organization_measure_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>

              <label for="superiors_assigned" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("superiors_assigned")?></label>
              <div class="col-sm-4">
                  <select class="form-control" id="superiors_assigned" name="QinlianThread[superiors_assigned]">
                      <option>一级</option>
                      <option>二级</option>
                      <option>三级</option>
                  </select>
<!--                  <input type="text" class="form-control" id="superiors_assigned" name="QinlianThread[superiors_assigned]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />-->
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="department_charge_div" class="form-group">
              <label for="department_charge" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("department_charge")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="department_charge" name="QinlianThread[department_charge]" placeholder="" />
              </div>

              <label for="del_status" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("del_status")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="del_status" name="QinlianThread[del_status]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="create_date_div" class="form-group">
              <label for="create_date" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("create_date")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="create_date" name="QinlianThread[create_date]" placeholder="必填" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
              </div>

              <label for="update_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("update_time")?></label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="update_time" name="QinlianThread[update_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
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
    <form action="<?=Url::toRoute('qinlian-thread/import')?>" method="post" id="qinlian-thread-import-form" enctype="multipart/form-data">
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
		$('#qinlian-thread-search-form').submit();
	}
 function viewAction(id){
		initModel(id, 'view', 'fun');
	}

 function initEditSystemModule(data, type){
	if(type == 'create'){
    	        $("#id").val("");
        $("#is_nuit").val("");
        $("#nuit_name").val("");
        $("#nuit_code").val("");
        $("#statistical_identification").val("");
        $("#clue_code").val("");
        $("#personnel_code").val("");
        $("#person_reflected").val("");
        $("#duty_job").val("");
        $("#is_supervises_object").val("");
        $("#rank_job").val("");
        $("#recovers_economic_loss").val("");
        $("#collects_amount").val("");
        $("#handling_organ").val("");
        $("#main_problem_clues").val("");
        $("#remarks").val("");
        $("#nation").val("");
        $("#date_birth").val("");
        $("#cpc").val("");
        $("#cppcc").val("");
        $("#disposal_report").val("");
        $("#time_joining_party").val("");
        $("#authority_management").val("");
        $("#acceptance_time").val("");
        $("#approval_time_one").val("");
        $("#statistical_time_one").val("");
        $("#one_level_first").val("");
        $("#one_level_second").val("");
        $("#approval_time_two").val("");
        $("#statistical_time_two").val("");
        $("#two_level_first").val("");
        $("#two_level_second").val("");
        $("#approval_time_three").val("");
        $("#statistical_time_three").val("");
        $("#three_level_first").val("");
        $("#three_level_second").val("");
        $("#cases_source").val("");
        $("#disciplinary_offence").val("");
        $("#is_checking_me").val("");
        $("#is_party").val("");
        $("#secondary_class_objects").val("");
        $("#is_supervisory_objects").val("");
        $("#no_secondary_class_objects").val("");
        $("#official_offences").val("");
        $("#other_offences").val("");
        $("#organization_measure_time").val("");
        $("#superiors_assigned").val("");
        $("#department_charge").val("");
        $("#del_status").val("");
        $("#create_date").val("");
        $("#update_time").val("");
	
	}
	else{
    	        $("#id").val(data.id)
        $("#is_nuit").val(data.is_nuit)
        $("#nuit_name").val(data.nuit_name)
        $("#nuit_code").val(data.nuit_code)
        $("#statistical_identification").val(data.statistical_identification)
        $("#clue_code").val(data.clue_code)
        $("#personnel_code").val(data.personnel_code)
        $("#person_reflected").val(data.person_reflected)
        $("#duty_job").val(data.duty_job)
        $("#is_supervises_object").val(data.is_supervises_object)
        $("#rank_job").val(data.rank_job)
        $("#recovers_economic_loss").val(data.recovers_economic_loss)
        $("#collects_amount").val(data.collects_amount)
        $("#handling_organ").val(data.handling_organ)
        $("#main_problem_clues").val(data.main_problem_clues)
        $("#remarks").val(data.remarks)
        $("#nation").val(data.nation)
        $("#date_birth").val(data.date_birth)
        $("#cpc").val(data.cpc)
        $("#cppcc").val(data.cppcc)
        $("#disposal_report").val(data.disposal_report)
        $("#time_joining_party").val(data.time_joining_party)
        $("#authority_management").val(data.authority_management)
        $("#acceptance_time").val(data.acceptance_time)
        $("#approval_time_one").val(data.approval_time_one)
        $("#statistical_time_one").val(data.statistical_time_one)
        $("#one_level_first").val(data.one_level_first)
        $("#one_level_second").val(data.one_level_second)
        $("#approval_time_two").val(data.approval_time_two)
        $("#statistical_time_two").val(data.statistical_time_two)
        $("#two_level_first").val(data.two_level_first)
        $("#two_level_second").val(data.two_level_second)
        $("#approval_time_three").val(data.approval_time_three)
        $("#statistical_time_three").val(data.statistical_time_three)
        $("#three_level_first").val(data.three_level_first)
        $("#three_level_second").val(data.three_level_second)
        $("#cases_source").val(data.cases_source)
        $("#disciplinary_offence").val(data.disciplinary_offence)
        $("#is_checking_me").val(data.is_checking_me)
        $("#is_party").val(data.is_party)
        $("#secondary_class_objects").val(data.secondary_class_objects)
        $("#is_supervisory_objects").val(data.is_supervisory_objects)
        $("#no_secondary_class_objects").val(data.no_secondary_class_objects)
        $("#official_offences").val(data.official_offences)
        $("#other_offences").val(data.other_offences)
        $("#organization_measure_time").val(data.organization_measure_time)
        $("#superiors_assigned").val(data.superiors_assigned)
        $("#department_charge").val(data.department_charge)
        $("#del_status").val(data.del_status)
        $("#create_date").val(data.create_date)
        $("#update_time").val(data.update_time)
	}
	if(type == "view"){
      $("#id").attr({readonly:true,disabled:true});
      $("#is_nuit").attr({readonly:true,disabled:true});
      $("#nuit_name").attr({readonly:true,disabled:true});
      $("#nuit_code").attr({readonly:true,disabled:true});
      $("#statistical_identification").attr({readonly:true,disabled:true});
      $("#clue_code").attr({readonly:true,disabled:true});
      $("#personnel_code").attr({readonly:true,disabled:true});
      $("#person_reflected").attr({readonly:true,disabled:true});
      $("#duty_job").attr({readonly:true,disabled:true});
      $("#is_supervises_object").attr({readonly:true,disabled:true});
      $("#rank_job").attr({readonly:true,disabled:true});
      $("#recovers_economic_loss").attr({readonly:true,disabled:true});
      $("#collects_amount").attr({readonly:true,disabled:true});
      $("#handling_organ").attr({readonly:true,disabled:true});
      $("#main_problem_clues").attr({readonly:true,disabled:true});
      $("#remarks").attr({readonly:true,disabled:true});
      $("#nation").attr({readonly:true,disabled:true});
      $("#date_birth").attr({readonly:true,disabled:true});
      $("#cpc").attr({readonly:true,disabled:true});
      $("#cppcc").attr({readonly:true,disabled:true});
      $("#disposal_report").attr({readonly:true,disabled:true});
      $("#time_joining_party").attr({readonly:true,disabled:true});
      $("#authority_management").attr({readonly:true,disabled:true});
      $("#acceptance_time").attr({readonly:true,disabled:true});
      $("#approval_time_one").attr({readonly:true,disabled:true});
      $("#statistical_time_one").attr({readonly:true,disabled:true});
      $("#one_level_first").attr({readonly:true,disabled:true});
      $("#one_level_second").attr({readonly:true,disabled:true});
      $("#approval_time_two").attr({readonly:true,disabled:true});
      $("#statistical_time_two").attr({readonly:true,disabled:true});
      $("#two_level_first").attr({readonly:true,disabled:true});
      $("#two_level_second").attr({readonly:true,disabled:true});
      $("#approval_time_three").attr({readonly:true,disabled:true});
      $("#statistical_time_three").attr({readonly:true,disabled:true});
      $("#three_level_first").attr({readonly:true,disabled:true});
      $("#three_level_second").attr({readonly:true,disabled:true});
      $("#cases_source").attr({readonly:true,disabled:true});
      $("#disciplinary_offence").attr({readonly:true,disabled:true});
      $("#is_checking_me").attr({readonly:true,disabled:true});
      $("#is_party").attr({readonly:true,disabled:true});
      $("#secondary_class_objects").attr({readonly:true,disabled:true});
      $("#is_supervisory_objects").attr({readonly:true,disabled:true});
      $("#no_secondary_class_objects").attr({readonly:true,disabled:true});
      $("#official_offences").attr({readonly:true,disabled:true});
      $("#other_offences").attr({readonly:true,disabled:true});
      $("#organization_measure_time").attr({readonly:true,disabled:true});
      $("#superiors_assigned").attr({readonly:true,disabled:true});
      $("#department_charge").attr({readonly:true,disabled:true});
      $("#del_status").attr({readonly:true,disabled:true});
      $("#create_date").attr({readonly:true,disabled:true});
      $("#update_time").attr({readonly:true,disabled:true});
	$('#edit_dialog_ok').addClass('hidden');
	}
	else{
      $("#id").attr({readonly:false,disabled:false});
      $("#is_nuit").attr({readonly:false,disabled:false});
      $("#nuit_name").attr({readonly:false,disabled:false});
      $("#nuit_code").attr({readonly:false,disabled:false});
      $("#statistical_identification").attr({readonly:false,disabled:false});
      $("#clue_code").attr({readonly:false,disabled:false});
      $("#personnel_code").attr({readonly:false,disabled:false});
      $("#person_reflected").attr({readonly:false,disabled:false});
      $("#duty_job").attr({readonly:false,disabled:false});
      $("#is_supervises_object").attr({readonly:false,disabled:false});
      $("#rank_job").attr({readonly:false,disabled:false});
      $("#recovers_economic_loss").attr({readonly:false,disabled:false});
      $("#collects_amount").attr({readonly:false,disabled:false});
      $("#handling_organ").attr({readonly:false,disabled:false});
      $("#main_problem_clues").attr({readonly:false,disabled:false});
      $("#remarks").attr({readonly:false,disabled:false});
      $("#nation").attr({readonly:false,disabled:false});
      $("#date_birth").attr({readonly:false,disabled:false});
      $("#cpc").attr({readonly:false,disabled:false});
      $("#cppcc").attr({readonly:false,disabled:false});
      $("#disposal_report").attr({readonly:false,disabled:false});
      $("#time_joining_party").attr({readonly:false,disabled:false});
      $("#authority_management").attr({readonly:false,disabled:false});
      $("#acceptance_time").attr({readonly:false,disabled:false});
      $("#approval_time_one").attr({readonly:false,disabled:false});
      $("#statistical_time_one").attr({readonly:false,disabled:false});
      $("#one_level_first").attr({readonly:false,disabled:false});
      $("#one_level_second").attr({readonly:false,disabled:false});
      $("#approval_time_two").attr({readonly:false,disabled:false});
      $("#statistical_time_two").attr({readonly:false,disabled:false});
      $("#two_level_first").attr({readonly:false,disabled:false});
      $("#two_level_second").attr({readonly:false,disabled:false});
      $("#approval_time_three").attr({readonly:false,disabled:false});
      $("#statistical_time_three").attr({readonly:false,disabled:false});
      $("#three_level_first").attr({readonly:false,disabled:false});
      $("#three_level_second").attr({readonly:false,disabled:false});
      $("#cases_source").attr({readonly:false,disabled:false});
      $("#disciplinary_offence").attr({readonly:false,disabled:false});
      $("#is_checking_me").attr({readonly:false,disabled:false});
      $("#is_party").attr({readonly:false,disabled:false});
      $("#secondary_class_objects").attr({readonly:false,disabled:false});
      $("#is_supervisory_objects").attr({readonly:false,disabled:false});
      $("#no_secondary_class_objects").attr({readonly:false,disabled:false});
      $("#official_offences").attr({readonly:false,disabled:false});
      $("#other_offences").attr({readonly:false,disabled:false});
      $("#organization_measure_time").attr({readonly:false,disabled:false});
      $("#superiors_assigned").attr({readonly:false,disabled:false});
      $("#department_charge").attr({readonly:false,disabled:false});
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
		   url: "<?=Url::toRoute('qinlian-thread/view')?>",
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
				   url: "<?=Url::toRoute('qinlian-thread/delete')?>",
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
	$('#qinlian-thread-form').submit();
});

$('#create_btn').click(function (e) {
    e.preventDefault();
    initEditSystemModule({}, 'create');
});

$('#delete_btn').click(function (e) {
    e.preventDefault();
    deleteAction('');
});

$('#qinlian-thread-form').bind('submit', function(e) {
	e.preventDefault();
	var id = $("#id").val();
	var action = id == "" ? "<?=Url::toRoute('qinlian-thread/create')?>" : "<?=Url::toRoute('qinlian-thread/update')?>";
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

$('#qinlian-thread-import-form').bind('submit', function(e) {
    e.preventDefault();
    var action = "<?=Url::toRoute('qinlian-thread/import')?>";
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
<?php $this->endBlock(); ?>
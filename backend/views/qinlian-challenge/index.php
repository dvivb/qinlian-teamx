
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;

use backend\models\QinlianChallenge;

$modelLabel = new \backend\models\QinlianChallenge();
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
              <a href="<?=Url::toRoute('qinlian-challenge/export')?>" class="btn btn-xs btn-info">导&nbsp;&emsp;出</a>
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
                <?php ActiveForm::begin(['id' => 'qinlian-challenge-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('qinlian-challenge/index')]); ?>     
                
                  <div class="form-group" style="margin: 4px;">
                      <label><?=$modelLabel->getAttributeLabel('id')?>:</label>
                      <input type="text" class="form-control" id="query[id]" name="query[id]"  value="<?=isset($query["id"]) ? $query["id"] : "" ?>">
                  </div>

                <div class="form-group" style="margin: 4px;">
                    <label><?=$modelLabel->getAttributeLabel('letter_number')?>:</label>
                    <input type="text" class="form-control" id="query[letter_number]" name="query[letter_number]"  value="<?=isset($query["letter_number"]) ? $query["letter_number"] : "" ?>">
                </div>

                <div class="form-group" style="margin: 4px;">
                    <label><?=$modelLabel->getAttributeLabel('respondent_unit')?>:</label>
                    <input type="text" class="form-control" id="query[respondent_unit]" name="query[respondent_unit]"  value="<?=isset($query["respondent_unit"]) ? $query["respondent_unit"] : "" ?>">
                </div>

                <div class="form-group" style="margin: 4px;">
                    <label><?=$modelLabel->getAttributeLabel('rank_job')?>:</label>
                    <input type="text" class="form-control" id="query[rank_job]" name="query[rank_job]"  value="<?=isset($query["rank_job"]) ? $query["rank_job"] : "" ?>">
                </div>
                <div class="form-group" style="margin: 4px;">
                    <label><?=$modelLabel->getAttributeLabel('related_unit')?>:</label>
                    <input type="text" class="form-control" id="query[related_unit]" name="query[related_unit]"  value="<?=isset($query["related_unit"]) ? $query["related_unit"] : "" ?>">
                </div>
                <div class="form-group" style="margin: 4px;">
                    <label><?=$modelLabel->getAttributeLabel('host_department')?>:</label>
                    <input type="text" class="form-control" id="query[host_department]" name="query[host_department]"  value="<?=isset($query["host_department"]) ? $query["host_department"] : "" ?>">
                </div>
                <div class="form-group" style="margin: 4px;">
                    <label><?=$modelLabel->getAttributeLabel('transfer_organ')?>:</label>
                    <input type="text" class="form-control" id="query[transfer_organ]" name="query[transfer_organ]"  value="<?=isset($query["transfer_organ"]) ? $query["transfer_organ"] : "" ?>">
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
              echo '<th onclick="orderby(\'id\', \'desc\')" '.CommonFun::sortClass($orderby, 'id').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('id').'</th>';
              echo '<th onclick="orderby(\'number\', \'desc\')" '.CommonFun::sortClass($orderby, 'number').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('number').'</th>';
              echo '<th onclick="orderby(\'incoming_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'incoming_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('incoming_time').'</th>';
              echo '<th onclick="orderby(\'clue_level\', \'desc\')" '.CommonFun::sortClass($orderby, 'clue_level').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('clue_level').'</th>';
              echo '<th onclick="orderby(\'clue_category\', \'desc\')" '.CommonFun::sortClass($orderby, 'clue_category').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('clue_category').'</th>';
              echo '<th onclick="orderby(\'clue_source\', \'desc\')" '.CommonFun::sortClass($orderby, 'clue_source').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('clue_source').'</th>';
              echo '<th onclick="orderby(\'letter_number\', \'desc\')" '.CommonFun::sortClass($orderby, 'letter_number').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('letter_number').'</th>';
              echo '<th onclick="orderby(\'signature\', \'desc\')" '.CommonFun::sortClass($orderby, 'signature').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('signature').'</th>';
              echo '<th onclick="orderby(\'leader_instructions\', \'desc\')" '.CommonFun::sortClass($orderby, 'leader_instructions').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('leader_instructions').'</th>';
              echo '<th onclick="orderby(\'respondent_unit\', \'desc\')" '.CommonFun::sortClass($orderby, 'respondent_unit').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('respondent_unit').'</th>';
              echo '<th onclick="orderby(\'duty_job\', \'desc\')" '.CommonFun::sortClass($orderby, 'duty_job').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('duty_job').'</th>';
              echo '<th onclick="orderby(\'rank_job\', \'desc\')" '.CommonFun::sortClass($orderby, 'rank_job').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('rank_job').'</th>';
              echo '<th onclick="orderby(\'main_issues\', \'desc\')" '.CommonFun::sortClass($orderby, 'main_issues').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('main_issues').'</th>';
              echo '<th onclick="orderby(\'related_unit\', \'desc\')" '.CommonFun::sortClass($orderby, 'related_unit').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('related_unit').'</th>';
              echo '<th onclick="orderby(\'heavy_cases\', \'desc\')" '.CommonFun::sortClass($orderby, 'heavy_cases').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('heavy_cases').'</th>';
              echo '<th onclick="orderby(\'date_receipt\', \'desc\')" '.CommonFun::sortClass($orderby, 'date_receipt').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('date_receipt').'</th>';
              echo '<th onclick="orderby(\'transfer_organ\', \'desc\')" '.CommonFun::sortClass($orderby, 'transfer_organ').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('transfer_organ').'</th>';
              echo '<th onclick="orderby(\'results\', \'desc\')" '.CommonFun::sortClass($orderby, 'results').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('results').'</th>';
              echo '<th onclick="orderby(\'supervisory_leadership\', \'desc\')" '.CommonFun::sortClass($orderby, 'supervisory_leadership').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('supervisory_leadership').'</th>';
              echo '<th onclick="orderby(\'host_department\', \'desc\')" '.CommonFun::sortClass($orderby, 'host_department').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('host_department').'</th>';
              echo '<th onclick="orderby(\'progress_case\', \'desc\')" '.CommonFun::sortClass($orderby, 'progress_case').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('progress_case').'</th>';
              echo '<th onclick="orderby(\'investigation_disposal\', \'desc\')" '.CommonFun::sortClass($orderby, 'investigation_disposal').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('investigation_disposal').'</th>';
              echo '<th onclick="orderby(\'remarks\', \'desc\')" '.CommonFun::sortClass($orderby, 'remarks').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('remarks').'</th>';
              echo '<th onclick="orderby(\'number_disposals\', \'desc\')" '.CommonFun::sortClass($orderby, 'number_disposals').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('number_disposals').'</th>';
              echo '<th onclick="orderby(\'organizations_number\', \'desc\')" '.CommonFun::sortClass($orderby, 'organizations_number').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('organizations_number').'</th>';
              echo '<th onclick="orderby(\'first_form\', \'desc\')" '.CommonFun::sortClass($orderby, 'first_form').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('first_form').'</th>';
              echo '<th onclick="orderby(\'second_form\', \'desc\')" '.CommonFun::sortClass($orderby, 'second_form').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('second_form').'</th>';
              echo '<th onclick="orderby(\'third_form\', \'desc\')" '.CommonFun::sortClass($orderby, 'third_form').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('third_form').'</th>';
              echo '<th onclick="orderby(\'fourth_form\', \'desc\')" '.CommonFun::sortClass($orderby, 'fourth_form').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('fourth_form').'</th>';
              echo '<th onclick="orderby(\'approval_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'approval_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('approval_time').'</th>';
              echo '<th onclick="orderby(\'approval_status\', \'desc\')" '.CommonFun::sortClass($orderby, 'approval_status').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('approval_status').'</th>';
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
                echo '  <td>' . $model->number . '</td>';
                echo '  <td>' . $model->incoming_time . '</td>';
                echo '  <td>' . $model->clue_level . '</td>';
                echo '  <td>' . $model->clue_category . '</td>';
                echo '  <td>' . $model->clue_source . '</td>';
                echo '  <td>' . $model->letter_number . '</td>';
                echo '  <td>' . $model->signature . '</td>';
                echo '  <td>' . mb_substr($model->leader_instructions, 0, 70) . '</td>';
                echo '  <td>' . $model->respondent_unit . '</td>';
                echo '  <td>' . $model->duty_job . '</td>';
                echo '  <td>' . $model->rank_job . '</td>';
                echo '  <td>' . mb_substr($model->main_issues, 0, 70) . '</td>';
                echo '  <td>' . $model->related_unit . '</td>';
                echo '  <td>' . mb_substr($model->heavy_cases, 0, 70) . '</td>';
                echo '  <td>' . $model->date_receipt . '</td>';
                echo '  <td>' . $model->transfer_organ . '</td>';
                echo '  <td>' . $model->results . '</td>';
                echo '  <td>' . $model->supervisory_leadership . '</td>';
                echo '  <td>' . $model->host_department . '</td>';
                echo '  <td>' . $model->progress_case . '</td>';
                echo '  <td>' . mb_substr($model->investigation_disposal, 0, 70) . '</td>';
                echo '  <td>' . mb_substr($model->remarks, 0, 70) . '</td>';
                echo '  <td>' . $model->number_disposals . '</td>';
                echo '  <td>' . $model->organizations_number . '</td>';
                echo '  <td>' . $model->first_form . '</td>';
                echo '  <td>' . $model->second_form . '</td>';
                echo '  <td>' . $model->third_form . '</td>';
                echo '  <td>' . $model->fourth_form . '</td>';
                echo '  <td>' . $model->approval_time . '</td>';
                echo '  <td>' . $model->approval_status . '</td>';
                echo '  <td>' . $model->create_date . '</td>';
                echo '  <td>' . $model->update_time . '</td>';
                echo '  <td class="center">';
                echo '      <a id="view_btn" onclick="viewAction(' . $model->id . ')" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i>查看</a>';
                echo '      <a id="edit_btn" onclick="editAction(' . $model->id . ')" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-edit icon-white"></i>修改</a>';
                echo '      <a id="delete_btn" onclick="deleteAction(' . $model->id . ')" class="btn btn-danger btn-sm" href="#"> <i class="glyphicon glyphicon-trash icon-white"></i>删除</a>';
                $url = Url::toRoute('qinlian-challenge/print');
                echo '      <a id="print_btn"  class="btn btn-primary btn-sm" href="'. $url  .'&id='. $model->id .'" target="_self"> <i class="glyphicon glyphicon-print icon-white"></i>案管室问题线索拟办单(排查会404)</a>';
                $url = Url::toRoute('qinlian-challenge/printb');
                echo '      <a id="print_btn"  class="btn btn-primary btn-sm" href="'. $url  .'&id='. $model->id .'" target="_self"> <i class="glyphicon glyphicon-print icon-white"></i>案管室问题线索拟办单(直批001)</a>';
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
                <?php $form = ActiveForm::begin(["id" => "qinlian-challenge-form", "class"=>"form-horizontal", "action"=>Url::toRoute("qinlian-challenge/save")]); ?>

                <input type="hidden" class="form-control" id="id" name="id" />

                <div id="number_div" class="form-group">
                    <label for="number" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("number")?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="number" name="QinlianChallenge[number]" placeholder="" />
                    </div>


                    <label for="incoming_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("incoming_time")?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="incoming_time" name="QinlianChallenge[incoming_time]" placeholder="必填" data-provide="datepicker" data-date-format="yyyy-mm-dd"  />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="clue_level_div" class="form-group">
                    <label for="clue_level" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("clue_level")?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="clue_level" name="QinlianChallenge[clue_level]" placeholder="" />
                    </div>

                    <label for="clue_category" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("clue_category")?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="clue_category" name="QinlianChallenge[clue_category]" placeholder="" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="clue_source_div" class="form-group">
                    <label for="clue_source" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("clue_source")?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="clue_source" name="QinlianChallenge[clue_source]" placeholder="" />
                    </div>

                    <label for="letter_number" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("letter_number")?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="letter_number" name="QinlianChallenge[letter_number]" placeholder="必填" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="signature_div" class="form-group">
                    <label for="signature" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("signature")?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="signature" name="QinlianChallenge[signature]" placeholder="" />
                    </div>

                    <label for="leader_instructions" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("leader_instructions")?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="leader_instructions" name="QinlianChallenge[leader_instructions]" placeholder="必填" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="respondent_unit_div" class="form-group">
                    <label for="respondent_unit" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("respondent_unit")?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="respondent_unit" name="QinlianChallenge[respondent_unit]" placeholder="必填" />
                    </div>

                    <label for="duty_job" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("duty_job")?></label>
                    <div class="col-sm-4">
                        <select class="form-control" id="duty_job" name="QinlianChallenge[duty_job]">
                            <option >未知</option>
                            <option >一般干部</option>
                            <option >乡科级</option>
                            <option >农村干部 </option>
                            <option >股级</option>
                            <option >农村其他人员</option>
                        </select>
<!--                        <input type="text" class="form-control" id="duty_job" name="QinlianChallenge[duty_job]" placeholder="必填" />-->
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="rank_job_div" class="form-group">
                    <label for="rank_job" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("rank_job")?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="rank_job" name="QinlianChallenge[rank_job]" placeholder="必填" />
                    </div>

                    <label for="main_issues" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("main_issues")?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="main_issues" name="QinlianChallenge[main_issues]" placeholder="必填" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="related_unit_div" class="form-group">
                    <label for="related_unit" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("related_unit")?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="related_unit" name="QinlianChallenge[related_unit]" placeholder="必填" />
                    </div>

                    <label for="heavy_cases" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("heavy_cases")?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="heavy_cases" name="QinlianChallenge[heavy_cases]" placeholder="" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="date_receipt_div" class="form-group">
                    <label for="date_receipt" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("date_receipt")?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="date_receipt" name="QinlianChallenge[date_receipt]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
                    </div>

                    <label for="transfer_organ" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("transfer_organ")?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="transfer_organ" name="QinlianChallenge[transfer_organ]" placeholder="" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="results_div" class="form-group">
                    <label for="results" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("results")?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="results" name="QinlianChallenge[results]" placeholder="" />
                    </div>

                    <label for="supervisory_leadership" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("supervisory_leadership")?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="supervisory_leadership" name="QinlianChallenge[supervisory_leadership]" placeholder="" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="host_department_div" class="form-group">
                    <label for="host_department" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("host_department")?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="host_department" name="QinlianChallenge[host_department]" placeholder="" />
                    </div>

                    <label for="progress_case" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("progress_case")?></label>
                    <div class="col-sm-4">
                        <select class="form-control" id="progress_case" name="QinlianChallenge[progress_case]">
                            <option>完成</option>
                            <option>未完成</option>
                        </select>
<!--                        <input type="text" class="form-control" id="progress_case" name="QinlianChallenge[progress_case]" placeholder="" />-->
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="investigation_disposal_div" class="form-group">
                    <label for="investigation_disposal" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("investigation_disposal")?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="investigation_disposal" name="QinlianChallenge[investigation_disposal]" placeholder="" />
                    </div>

                    <label for="remarks" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("remarks")?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="remarks" name="QinlianChallenge[remarks]" placeholder="" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="number_disposals_div" class="form-group">
                    <label for="number_disposals" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("number_disposals")?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="number_disposals" name="QinlianChallenge[number_disposals]" placeholder="" />
                    </div>

                    <label for="organizations_number" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("organizations_number")?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="organizations_number" name="QinlianChallenge[organizations_number]" placeholder="" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="first_form_div" class="form-group">
                    <label for="first_form" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("first_form")?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="first_form" name="QinlianChallenge[first_form]" placeholder="" />
                    </div>

                    <label for="second_form" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("second_form")?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="second_form" name="QinlianChallenge[second_form]" placeholder="" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="third_form_div" class="form-group">
                    <label for="third_form" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("third_form")?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="third_form" name="QinlianChallenge[third_form]" placeholder="" />
                    </div>

                    <label for="fourth_form" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("fourth_form")?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="fourth_form" name="QinlianChallenge[fourth_form]" placeholder="" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="approval_time_div" class="form-group">
                    <label for="approval_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("approval_time")?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="approval_time" name="QinlianChallenge[approval_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd"  />
                    </div>

                    <label for="approval_status" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("approval_status")?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="approval_status" name="QinlianChallenge[approval_status]" placeholder="" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="del_status_div" class="form-group">
                    <label for="del_status" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("del_status")?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="del_status" name="QinlianChallenge[del_status]" placeholder="" />
                    </div>

                    <label for="create_date" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("create_date")?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="create_date" name="QinlianChallenge[create_date]" placeholder="必填" data-provide="datepicker" data-date-format="yyyy-mm-dd"  />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="update_time_div" class="form-group">
                    <label for="update_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("update_time")?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="update_time" name="QinlianChallenge[update_time]" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd"  />
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
    <form action="<?=Url::toRoute('qinlian-challenge/import')?>" method="post" id="qinlian-challenge-import-form" enctype="multipart/form-data">
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
		$('#qinlian-challenge-search-form').submit();
	}
 function viewAction(id){
		initModel(id, 'view', 'fun');
	}

 function initEditSystemModule(data, type){
	if(type == 'create'){
    	        $("#id").val("");
        $("#number").val("");
        $("#incoming_time").val("");
        $("#clue_level").val("");
        $("#clue_category").val("");
        $("#clue_source").val("");
        $("#letter_number").val("");
        $("#signature").val("");
        $("#leader_instructions").val("");
        $("#respondent_unit").val("");
        $("#duty_job").val("");
        $("#rank_job").val("");
        $("#main_issues").val("");
        $("#related_unit").val("");
        $("#heavy_cases").val("");
        $("#date_receipt").val("");
        $("#transfer_organ").val("");
        $("#results").val("");
        $("#supervisory_leadership").val("");
        $("#host_department").val("");
        $("#progress_case").val("");
        $("#investigation_disposal").val("");
        $("#remarks").val("");
        $("#number_disposals").val("");
        $("#organizations_number").val("");
        $("#first_form").val("");
        $("#second_form").val("");
        $("#third_form").val("");
        $("#fourth_form").val("");
        $("#approval_time").val("");
        $("#approval_status").val("");
        $("#del_status").val("");
        $("#create_date").val("");
        $("#update_time").val("");
	
	}
	else{
    	        $("#id").val(data.id)
        $("#number").val(data.number)
        $("#incoming_time").val(data.incoming_time)
        $("#clue_level").val(data.clue_level)
        $("#clue_category").val(data.clue_category)
        $("#clue_source").val(data.clue_source)
        $("#letter_number").val(data.letter_number)
        $("#signature").val(data.signature)
        $("#leader_instructions").val(data.leader_instructions)
        $("#respondent_unit").val(data.respondent_unit)
        $("#duty_job").val(data.duty_job)
        $("#rank_job").val(data.rank_job)
        $("#main_issues").val(data.main_issues)
        $("#related_unit").val(data.related_unit)
        $("#heavy_cases").val(data.heavy_cases)
        $("#date_receipt").val(data.date_receipt)
        $("#transfer_organ").val(data.transfer_organ)
        $("#results").val(data.results)
        $("#supervisory_leadership").val(data.supervisory_leadership)
        $("#host_department").val(data.host_department)
        $("#progress_case").val(data.progress_case)
        $("#investigation_disposal").val(data.investigation_disposal)
        $("#remarks").val(data.remarks)
        $("#number_disposals").val(data.number_disposals)
        $("#organizations_number").val(data.organizations_number)
        $("#first_form").val(data.first_form)
        $("#second_form").val(data.second_form)
        $("#third_form").val(data.third_form)
        $("#fourth_form").val(data.fourth_form)
        $("#approval_time").val(data.approval_time)
        $("#approval_status").val(data.approval_status)
        $("#del_status").val(data.del_status)
        $("#create_date").val(data.create_date)
        $("#update_time").val(data.update_time)
	}
	if(type == "view"){
      $("#id").attr({readonly:true,disabled:true});
      $("#number").attr({readonly:true,disabled:true});
      $("#incoming_time").attr({readonly:true,disabled:true});
      $("#clue_level").attr({readonly:true,disabled:true});
      $("#clue_category").attr({readonly:true,disabled:true});
      $("#clue_source").attr({readonly:true,disabled:true});
      $("#letter_number").attr({readonly:true,disabled:true});
      $("#signature").attr({readonly:true,disabled:true});
      $("#leader_instructions").attr({readonly:true,disabled:true});
      $("#respondent_unit").attr({readonly:true,disabled:true});
      $("#duty_job").attr({readonly:true,disabled:true});
      $("#rank_job").attr({readonly:true,disabled:true});
      $("#main_issues").attr({readonly:true,disabled:true});
      $("#related_unit").attr({readonly:true,disabled:true});
      $("#heavy_cases").attr({readonly:true,disabled:true});
      $("#date_receipt").attr({readonly:true,disabled:true});
      $("#transfer_organ").attr({readonly:true,disabled:true});
      $("#results").attr({readonly:true,disabled:true});
      $("#supervisory_leadership").attr({readonly:true,disabled:true});
      $("#host_department").attr({readonly:true,disabled:true});
      $("#progress_case").attr({readonly:true,disabled:true});
      $("#investigation_disposal").attr({readonly:true,disabled:true});
      $("#remarks").attr({readonly:true,disabled:true});
      $("#number_disposals").attr({readonly:true,disabled:true});
      $("#organizations_number").attr({readonly:true,disabled:true});
      $("#first_form").attr({readonly:true,disabled:true});
      $("#second_form").attr({readonly:true,disabled:true});
      $("#third_form").attr({readonly:true,disabled:true});
      $("#fourth_form").attr({readonly:true,disabled:true});
      $("#approval_time").attr({readonly:true,disabled:true});
      $("#approval_status").attr({readonly:true,disabled:true});
      $("#del_status").attr({readonly:true,disabled:true});
      $("#create_date").attr({readonly:true,disabled:true});
      $("#update_time").attr({readonly:true,disabled:true});
	$('#edit_dialog_ok').addClass('hidden');
	}
	else{
      $("#id").attr({readonly:false,disabled:false});
      $("#number").attr({readonly:false,disabled:false});
      $("#incoming_time").attr({readonly:false,disabled:false});
      $("#clue_level").attr({readonly:false,disabled:false});
      $("#clue_category").attr({readonly:false,disabled:false});
      $("#clue_source").attr({readonly:false,disabled:false});
      $("#letter_number").attr({readonly:false,disabled:false});
      $("#signature").attr({readonly:false,disabled:false});
      $("#leader_instructions").attr({readonly:false,disabled:false});
      $("#respondent_unit").attr({readonly:false,disabled:false});
      $("#duty_job").attr({readonly:false,disabled:false});
      $("#rank_job").attr({readonly:false,disabled:false});
      $("#main_issues").attr({readonly:false,disabled:false});
      $("#related_unit").attr({readonly:false,disabled:false});
      $("#heavy_cases").attr({readonly:false,disabled:false});
      $("#date_receipt").attr({readonly:false,disabled:false});
      $("#transfer_organ").attr({readonly:false,disabled:false});
      $("#results").attr({readonly:false,disabled:false});
      $("#supervisory_leadership").attr({readonly:false,disabled:false});
      $("#host_department").attr({readonly:false,disabled:false});
      $("#progress_case").attr({readonly:false,disabled:false});
      $("#investigation_disposal").attr({readonly:false,disabled:false});
      $("#remarks").attr({readonly:false,disabled:false});
      $("#number_disposals").attr({readonly:false,disabled:false});
      $("#organizations_number").attr({readonly:false,disabled:false});
      $("#first_form").attr({readonly:false,disabled:false});
      $("#second_form").attr({readonly:false,disabled:false});
      $("#third_form").attr({readonly:false,disabled:false});
      $("#fourth_form").attr({readonly:false,disabled:false});
      $("#approval_time").attr({readonly:false,disabled:false});
      $("#approval_status").attr({readonly:false,disabled:false});
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
		   url: "<?=Url::toRoute('qinlian-challenge/view')?>",
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
				   url: "<?=Url::toRoute('qinlian-challenge/delete')?>",
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
	$('#qinlian-challenge-form').submit();
});

$('#create_btn').click(function (e) {
    e.preventDefault();
    initEditSystemModule({}, 'create');
});

$('#delete_btn').click(function (e) {
    e.preventDefault();
    deleteAction('');
});

$('#qinlian-challenge-form').bind('submit', function(e) {
	e.preventDefault();
	var id = $("#id").val();
	var action = id == "" ? "<?=Url::toRoute('qinlian-challenge/create')?>" : "<?=Url::toRoute('qinlian-challenge/update')?>";
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

$('#qinlian-challenge-import-form').bind('submit', function(e) {
    e.preventDefault();
    var action = "<?=Url::toRoute('qinlian-challenge/import')?>";
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
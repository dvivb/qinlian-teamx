
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;

use backend\models\ComplaintRecord;

$modelLabel = new \backend\models\ComplaintRecord();
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
            <div class="input-group input-group-sm" style="width: 350px;">
                <button id="create_btn" type="button" class="btn btn-xs btn-primary">添&nbsp;&emsp;加</button>
                |
                <a href="/excel/ExcelImport/complaint.xlsx" class="btn btn-xs btn-info">导入模板</a>
                |
                <button id="import_btn" type="button" class="btn btn-xs btn-info">导&nbsp;&emsp;入</button>
                |
<!--                <a href="/excel/ExcelImport/complaint.xlsx" class="btn btn-xs btn-info">导&nbsp;&emsp;出</a>-->
                <a href="/index.php?r=complaint-record/export" class="btn btn-xs btn-info">导&nbsp;&emsp;出</a>
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
                <?php ActiveForm::begin(['id' => 'complaint-record-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('complaint-record/index')]); ?>     
                
                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('id')?>:</label>
                      <input type="text" class="form-control" id="query[id]" name="query[id]"  value="<?=isset($query["id"]) ? $query["id"] : "" ?>">
                  </div>
              <div class="form-group">
              	<a onclick="searchAction()" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i>搜索</a>
           	  </div>
               <?php ActiveForm::end(); ?> 
            </div>
          	</div>
          	<!-- row end search -->
          	
          	<!-- row start -->
          	<div class="row">
          	<div class="col-sm-12 table-responsive">
          	<table id="data_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="data_table_info">
            <thead class="text-nowrap">
            <tr role="row">
            
            <?php 
              $orderby = isset($_GET['orderby']) ? $_GET['orderby'] : '';
		      echo '<th><input id="data_table_check" type="checkbox"></th>';
              echo '<th onclick="orderby(\'id\', \'desc\')" '.CommonFun::sortClass($orderby, 'id').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('id').'</th>';
              echo '<th onclick="orderby(\'report_name\', \'desc\')" '.CommonFun::sortClass($orderby, 'report_name').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('report_name').'</th>';
              echo '<th onclick="orderby(\'report_address\', \'desc\')" '.CommonFun::sortClass($orderby, 'report_address').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('report_address').'</th>';
              echo '<th onclick="orderby(\'report_moblie\', \'desc\')" '.CommonFun::sortClass($orderby, 'report_moblie').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('report_moblie').'</th>';
              echo '<th onclick="orderby(\'report_idcard\', \'desc\')" '.CommonFun::sortClass($orderby, 'report_idcard').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('report_idcard').'</th>';
              echo '<th onclick="orderby(\'reported_name\', \'desc\')" '.CommonFun::sortClass($orderby, 'reported_name').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('reported_name').'</th>';
              echo '<th onclick="orderby(\'reported_organization_name\', \'desc\')" '.CommonFun::sortClass($orderby, 'reported_organization_name').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('reported_organization_name').'</th>';
              echo '<th onclick="orderby(\'reported_politics_status\', \'desc\')" '.CommonFun::sortClass($orderby, 'reported_politics_status').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('reported_politics_status').'</th>';
              echo '<th onclick="orderby(\'reported_duty\', \'desc\')" '.CommonFun::sortClass($orderby, 'reported_duty').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('reported_duty').'</th>';
              echo '<th onclick="orderby(\'reported_rank\', \'desc\')" '.CommonFun::sortClass($orderby, 'reported_rank').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('reported_rank').'</th>';
              echo '<th onclick="orderby(\'reported_question\', \'desc\')" '.CommonFun::sortClass($orderby, 'reported_question').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('reported_question').'</th>';
              echo '<th onclick="orderby(\'reported_location\', \'desc\')" '.CommonFun::sortClass($orderby, 'reported_location').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('reported_location').'</th>';
              echo '<th onclick="orderby(\'reported_property\', \'desc\')" '.CommonFun::sortClass($orderby, 'reported_property').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('reported_property').'</th>';
              echo '<th onclick="orderby(\'reported_keyword\', \'desc\')" '.CommonFun::sortClass($orderby, 'reported_keyword').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('reported_keyword').'</th>';
              echo '<th onclick="orderby(\'flow_instructions_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'flow_instructions_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('flow_instructions_time').'</th>';
              echo '<th onclick="orderby(\'flow_instructions_status\', \'desc\')" '.CommonFun::sortClass($orderby, 'flow_instructions_status').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('flow_instructions_status').'</th>';
              echo '<th onclick="orderby(\'flow_instructions_opinion\', \'desc\')" '.CommonFun::sortClass($orderby, 'flow_instructions_opinion').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('flow_instructions_opinion').'</th>';
              echo '<th onclick="orderby(\'reported_organizer\', \'desc\')" '.CommonFun::sortClass($orderby, 'reported_organizer').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('reported_organizer').'</th>';
              echo '<th onclick="orderby(\'flow_transferred_out_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'flow_transferred_out_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('flow_transferred_out_time').'</th>';
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
                echo '  <td>' . $model->report_name . '</td>';
                echo '  <td>' . $model->report_address . '</td>';
                echo '  <td>' . $model->report_moblie . '</td>';
                echo '  <td>' . $model->report_idcard . '</td>';
                echo '  <td>' . $model->reported_name . '</td>';
                echo '  <td>' . $model->reported_organization_name . '</td>';
                echo '  <td>' . $model->reported_politics_status . '</td>';
                echo '  <td>' . $model->reported_duty . '</td>';
                echo '  <td>' . $model->reported_rank . '</td>';
                echo '  <td>' . $model->reported_question . '</td>';
                echo '  <td>' . $model->reported_location . '</td>';
                echo '  <td>' . $model->reported_property . '</td>';
                echo '  <td>' . $model->reported_keyword . '</td>';
                echo '  <td>' . $model->flow_instructions_time . '</td>';
                echo '  <td>' . $model->flow_instructions_status . '</td>';
                echo '  <td>' . $model->flow_instructions_opinion . '</td>';
                echo '  <td>' . $model->reported_organizer . '</td>';
                echo '  <td>' . $model->flow_transferred_out_time . '</td>';
//                echo '  <td>' . $model->del_status . '</td>';
                if ($model->del_status == 0){ echo '  <td>未删除</td>';} else { echo '<td>已删除</td>';}
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
                <?php $form = ActiveForm::begin(["id" => "complaint-record-form", "class"=>"form-horizontal", "action"=>Url::toRoute("complaint-record/save")]); ?>                      
                 
          <input type="hidden" class="form-control" id="id" name="id" />

          <div id="report_name_div" class="form-group">
              <label for="report_name" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("report_name")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="report_name" name="ComplaintRecord[report_name]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="report_address_div" class="form-group">
              <label for="report_address" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("report_address")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="report_address" name="ComplaintRecord[report_address]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="report_moblie_div" class="form-group">
              <label for="report_moblie" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("report_moblie")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="report_moblie" name="ComplaintRecord[report_moblie]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="report_idcard_div" class="form-group">
              <label for="report_idcard" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("report_idcard")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="report_idcard" name="ComplaintRecord[report_idcard]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="reported_name_div" class="form-group">
              <label for="reported_name" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("reported_name")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="reported_name" name="ComplaintRecord[reported_name]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="reported_organization_name_div" class="form-group">
              <label for="reported_organization_name" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("reported_organization_name")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="reported_organization_name" name="ComplaintRecord[reported_organization_name]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="reported_politics_status_div" class="form-group">
              <label for="reported_politics_status" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("reported_politics_status")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="reported_politics_status" name="ComplaintRecord[reported_politics_status]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="reported_duty_div" class="form-group">
              <label for="reported_duty" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("reported_duty")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="reported_duty" name="ComplaintRecord[reported_duty]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="reported_rank_div" class="form-group">
              <label for="reported_rank" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("reported_rank")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="reported_rank" name="ComplaintRecord[reported_rank]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="reported_question_div" class="form-group">
              <label for="reported_question" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("reported_question")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="reported_question" name="ComplaintRecord[reported_question]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="reported_location_div" class="form-group">
              <label for="reported_location" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("reported_location")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="reported_location" name="ComplaintRecord[reported_location]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="reported_property_div" class="form-group">
              <label for="reported_property" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("reported_property")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="reported_property" name="ComplaintRecord[reported_property]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="reported_keyword_div" class="form-group">
              <label for="reported_keyword" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("reported_keyword")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="reported_keyword" name="ComplaintRecord[reported_keyword]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="flow_instructions_time_div" class="form-group">
              <label for="flow_instructions_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("flow_instructions_time")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="flow_instructions_time" name="ComplaintRecord[flow_instructions_time]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="flow_instructions_status_div" class="form-group">
              <label for="flow_instructions_status" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("flow_instructions_status")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="flow_instructions_status" name="ComplaintRecord[flow_instructions_status]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="flow_instructions_opinion_div" class="form-group">
              <label for="flow_instructions_opinion" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("flow_instructions_opinion")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="flow_instructions_opinion" name="ComplaintRecord[flow_instructions_opinion]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="reported_organizer_div" class="form-group">
              <label for="reported_organizer" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("reported_organizer")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="reported_organizer" name="ComplaintRecord[reported_organizer]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="flow_transferred_out_time_div" class="form-group">
              <label for="flow_transferred_out_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("flow_transferred_out_time")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="flow_transferred_out_time" name="ComplaintRecord[flow_transferred_out_time]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="del_status_div" class="form-group">
              <label for="del_status" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("del_status")?></label>
              <div class="col-sm-10">
<!--                  <input type="text" class="form-control" id="del_status" name="ComplaintRecord[del_status]" placeholder="" />-->
                  <select class="form-control" name="IncorruptRecord[del_status]" id="del_status">
                      <option value='0' selected>未删除</option>
                      <option value='1' >已删除</option>
                  </select>
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="create_date_div" class="form-group">
              <label for="create_date" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("create_date")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="create_date" name="ComplaintRecord[create_date]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="update_time_div" class="form-group">
              <label for="update_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("update_time")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="update_time" name="ComplaintRecord[update_time]" placeholder="" />
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
		$('#complaint-record-search-form').submit();
	}
 function viewAction(id){
		initModel(id, 'view', 'fun');
	}

 function initEditSystemModule(data, type){
	if(type == 'create'){
		$("#id").val('');
		$("#report_name").val('');
		$("#report_address").val('');
		$("#report_moblie").val('');
		$("#report_idcard").val('');
		$("#reported_name").val('');
		$("#reported_organization_name").val('');
		$("#reported_politics_status").val('');
		$("#reported_duty").val('');
		$("#reported_rank").val('');
		$("#reported_question").val('');
		$("#reported_location").val('');
		$("#reported_property").val('');
		$("#reported_keyword").val('');
		$("#flow_instructions_time").val('');
		$("#flow_instructions_status").val('');
		$("#flow_instructions_opinion").val('');
		$("#reported_organizer").val('');
		$("#flow_transferred_out_time").val('');
		$("#del_status").val('');
		$("#create_date").val('');
		$("#update_time").val('');
		
	}
	else{
		$("#id").val(data.id);
    	$("#report_name").val(data.report_name);
    	$("#report_address").val(data.report_address);
    	$("#report_moblie").val(data.report_moblie);
    	$("#report_idcard").val(data.report_idcard);
    	$("#reported_name").val(data.reported_name);
    	$("#reported_organization_name").val(data.reported_organization_name);
    	$("#reported_politics_status").val(data.reported_politics_status);
    	$("#reported_duty").val(data.reported_duty);
    	$("#reported_rank").val(data.reported_rank);
    	$("#reported_question").val(data.reported_question);
    	$("#reported_location").val(data.reported_location);
    	$("#reported_property").val(data.reported_property);
    	$("#reported_keyword").val(data.reported_keyword);
    	$("#flow_instructions_time").val(data.flow_instructions_time);
    	$("#flow_instructions_status").val(data.flow_instructions_status);
    	$("#flow_instructions_opinion").val(data.flow_instructions_opinion);
    	$("#reported_organizer").val(data.reported_organizer);
    	$("#flow_transferred_out_time").val(data.flow_transferred_out_time);
    	$("#del_status").val(data.del_status);
    	$("#create_date").val(data.create_date);
    	$("#update_time").val(data.update_time);
    	}
	if(type == "view"){
      $("#id").attr({readonly:true,disabled:true});
      $("#report_name").attr({readonly:true,disabled:true});
      $("#report_address").attr({readonly:true,disabled:true});
      $("#report_moblie").attr({readonly:true,disabled:true});
      $("#report_idcard").attr({readonly:true,disabled:true});
      $("#reported_name").attr({readonly:true,disabled:true});
      $("#reported_organization_name").attr({readonly:true,disabled:true});
      $("#reported_politics_status").attr({readonly:true,disabled:true});
      $("#reported_duty").attr({readonly:true,disabled:true});
      $("#reported_rank").attr({readonly:true,disabled:true});
      $("#reported_question").attr({readonly:true,disabled:true});
      $("#reported_location").attr({readonly:true,disabled:true});
      $("#reported_property").attr({readonly:true,disabled:true});
      $("#reported_keyword").attr({readonly:true,disabled:true});
      $("#flow_instructions_time").attr({readonly:true,disabled:true});
      $("#flow_instructions_status").attr({readonly:true,disabled:true});
      $("#flow_instructions_opinion").attr({readonly:true,disabled:true});
      $("#reported_organizer").attr({readonly:true,disabled:true});
      $("#flow_transferred_out_time").attr({readonly:true,disabled:true});
      $("#del_status").attr({readonly:true,disabled:true});
      $("#create_date").attr({readonly:true,disabled:true});
      $("#update_time").attr({readonly:true,disabled:true});
	$('#edit_dialog_ok').addClass('hidden');
	}
	else{
      $("#id").attr({readonly:false,disabled:false});
      $("#report_name").attr({readonly:false,disabled:false});
      $("#report_address").attr({readonly:false,disabled:false});
      $("#report_moblie").attr({readonly:false,disabled:false});
      $("#report_idcard").attr({readonly:false,disabled:false});
      $("#reported_name").attr({readonly:false,disabled:false});
      $("#reported_organization_name").attr({readonly:false,disabled:false});
      $("#reported_politics_status").attr({readonly:false,disabled:false});
      $("#reported_duty").attr({readonly:false,disabled:false});
      $("#reported_rank").attr({readonly:false,disabled:false});
      $("#reported_question").attr({readonly:false,disabled:false});
      $("#reported_location").attr({readonly:false,disabled:false});
      $("#reported_property").attr({readonly:false,disabled:false});
      $("#reported_keyword").attr({readonly:false,disabled:false});
      $("#flow_instructions_time").attr({readonly:false,disabled:false});
      $("#flow_instructions_status").attr({readonly:false,disabled:false});
      $("#flow_instructions_opinion").attr({readonly:false,disabled:false});
      $("#reported_organizer").attr({readonly:false,disabled:false});
      $("#flow_transferred_out_time").attr({readonly:false,disabled:false});
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
		   url: "<?=Url::toRoute('complaint-record/view')?>",
		   data: {"id":id},
		   cache: false,
		   dataType:"json",
		   error: function (xmlHttpRequest, textStatus, errorThrown) {
			    alert("出错了，" + textStatus);
			},
		   success: function(data){
			   initEditSystemModule(data, type);
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
				   url: "<?=Url::toRoute('complaint-record/delete')?>",
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
	$('#complaint-record-form').submit();
});

$('#create_btn').click(function (e) {
    e.preventDefault();
    initEditSystemModule({}, 'create');
});

$('#delete_btn').click(function (e) {
    e.preventDefault();
    deleteAction('');
});

$('#complaint-record-form').bind('submit', function(e) {
	e.preventDefault();
	var id = $("#id").val();
	var action = id == "" ? "<?=Url::toRoute('complaint-record/create')?>" : "<?=Url::toRoute('complaint-record/update')?>";
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
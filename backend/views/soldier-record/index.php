
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;

use backend\models\SoldierRecord;

$modelLabel = new \backend\models\SoldierRecord();
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
            <div class="input-group input-group-sm" style="width: 150px;">
                <button id="create_btn" type="button" class="btn btn-xs btn-primary">添&nbsp;&emsp;加</button>
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
                <?php ActiveForm::begin(['id' => 'soldier-record-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('soldier-record/index')]); ?>     
                
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
              echo '<th onclick="orderby(\'name\', \'desc\')" '.CommonFun::sortClass($orderby, 'name').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('name').'</th>';
              echo '<th onclick="orderby(\'sex\', \'desc\')" '.CommonFun::sortClass($orderby, 'sex').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('sex').'</th>';
              echo '<th onclick="orderby(\'moblie\', \'desc\')" '.CommonFun::sortClass($orderby, 'moblie').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('moblie').'</th>';
              echo '<th onclick="orderby(\'email\', \'desc\')" '.CommonFun::sortClass($orderby, 'email').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('email').'</th>';
              echo '<th onclick="orderby(\'birthday\', \'desc\')" '.CommonFun::sortClass($orderby, 'birthday').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('birthday').'</th>';
              echo '<th onclick="orderby(\'height\', \'desc\')" '.CommonFun::sortClass($orderby, 'height').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('height').'</th>';
              echo '<th onclick="orderby(\'weight\', \'desc\')" '.CommonFun::sortClass($orderby, 'weight').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('weight').'</th>';
              echo '<th onclick="orderby(\'idcard\', \'desc\')" '.CommonFun::sortClass($orderby, 'idcard').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('idcard').'</th>';
              echo '<th onclick="orderby(\'address\', \'desc\')" '.CommonFun::sortClass($orderby, 'address').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('address').'</th>';
              echo '<th onclick="orderby(\'leave_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'leave_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('leave_time').'</th>';
              echo '<th onclick="orderby(\'report_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'report_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('report_time').'</th>';
              echo '<th onclick="orderby(\'train_status\', \'desc\')" '.CommonFun::sortClass($orderby, 'train_status').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('train_status').'</th>';
              echo '<th onclick="orderby(\'job_status\', \'desc\')" '.CommonFun::sortClass($orderby, 'job_status').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('job_status').'</th>';
              echo '<th onclick="orderby(\'check_status\', \'desc\')" '.CommonFun::sortClass($orderby, 'check_status').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('check_status').'</th>';
              echo '<th onclick="orderby(\'create_date\', \'desc\')" '.CommonFun::sortClass($orderby, 'create_date').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('create_date').'</th>';
         
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
                echo '  <td>' . $model->name . '</td>';
                if ($model->sex == 1) echo '  <td>男</td>'; elseif($model->sex == 2) echo '<td>女</td>'; else echo '<td>其它</td>';
                echo '  <td>' . $model->moblie . '</td>';
                echo '  <td>' . $model->email . '</td>';
                echo '  <td>' . $model->birthday . '</td>';
                echo '  <td>' . $model->height . '</td>';
                echo '  <td>' . $model->weight . '</td>';
                echo '  <td>' . $model->idcard . '</td>';
                echo '  <td>' . $model->address . '</td>';
                echo '  <td>' . $model->leave_time . '</td>';
                echo '  <td>' . $model->report_time . '</td>';
//                echo '  <td>' . $model->train_status . '</td>';
//                echo '  <td>' . $model->job_status . '</td>';
//                echo '  <td>' . $model->check_status . '</td>';
                if ($model->train_status == 0) echo '  <td>未培训</td>'; elseif($model->train_status == 1) echo '<td>培训中</td>'; elseif($model->train_status == 2) echo '<td>已培训</td>'; else echo '<td>其它</td>';
                if ($model->job_status == 0) echo '  <td>待就业</td>'; elseif($model->job_status == 1) echo '<td>已就业</td>'; else echo '<td>其它</td>';
                if ($model->check_status == 0) echo '  <td>未审核</td>'; elseif($model->check_status == 1) echo '<td>已审核</td>'; else echo '<td>其它</td>';
                //echo '  <td>' . $model->del_status . '</td>';
                echo '  <td>' . $model->create_date . '</td>';
                //echo '  <td>' . $model->upload_time . '</td>';
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
                <?php $form = ActiveForm::begin(["id" => "soldier-record-form", "class"=>"form-horizontal", "action"=>Url::toRoute("soldier-record/save")]); ?>

          <input type="hidden" class="form-control" id="id" name="id" />

          <div id="name_div" class="form-group">
              <label for="name" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("name")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="name" name="SoldierRecord[name]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="sex_div" class="form-group">
              <label for="sex" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("sex")?></label>
              <div class="col-sm-10">
<!--                  <input type="radio" class="form-control" id="sex" name="SoldierRecord[sex]" placeholder="" />-->
                  <select class="form-control" name="SoldierRecord[sex]" id="sex">
                      <option value='1'>男</option>
                      <option value='2'>女</option>
                  </select>
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="moblie_div" class="form-group">
              <label for="moblie" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("moblie")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="moblie" name="SoldierRecord[moblie]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="email_div" class="form-group">
              <label for="email" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("email")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="email" name="SoldierRecord[email]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="birthday_div" class="form-group">
              <label for="birthday" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("birthday")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="birthday" name="SoldierRecord[birthday]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="height_div" class="form-group">
              <label for="height" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("height")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="height" name="SoldierRecord[height]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="weight_div" class="form-group">
              <label for="weight" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("weight")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="weight" name="SoldierRecord[weight]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="idcard_div" class="form-group">
              <label for="idcard" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("idcard")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="idcard" name="SoldierRecord[idcard]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="address_div" class="form-group">
              <label for="address" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("address")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="address" name="SoldierRecord[address]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="leave_time_div" class="form-group">
              <label for="leave_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("leave_time")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="leave_time" name="SoldierRecord[leave_time]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="report_time_div" class="form-group">
              <label for="report_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("report_time")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="report_time" name="SoldierRecord[report_time]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="train_status_div" class="form-group">
              <label for="train_status" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("train_status")?></label>
              <div class="col-sm-10">
<!--                  <input type="text" class="form-control" id="train_status" name="SoldierRecord[train_status]" placeholder="" />-->
                  <select class="form-control" name="SoldierRecord[train_status]" id="train_status">
                      <option value='0'>未培训</option>
                      <option value='1'>培训中</option>
                      <option value='2'>已培训</option>
                  </select>
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="job_status_div" class="form-group">
              <label for="job_status" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("job_status")?></label>
              <div class="col-sm-10">
<!--                  <input type="text" class="form-control" id="job_status" name="SoldierRecord[job_status]" placeholder="" />-->
                  <select class="form-control" name="SoldierRecord[job_status]" id="job_status">
                      <option value='0'>未就业</option>
                      <option value='1'>已就业</option>
                  </select>
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="check_status_div" class="form-group">
              <label for="check_status" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("check_status")?></label>
              <div class="col-sm-10">
<!--                  <input type="text" class="form-control" id="check_status" name="SoldierRecord[check_status]" placeholder="" />-->
                  <select class="form-control" name="SoldierRecord[check_status]" id="check_status">
                      <option value='0'>未审核</option>
                      <option value='1'>已审核</option>
                  </select>
              </div>
              <div class="clearfix"></div>
          </div>

<!--          <div id="del_status_div" class="form-group">-->
<!--              <label for="del_status" class="col-sm-2 control-label">--><?php //echo $modelLabel->getAttributeLabel("del_status")?><!--</label>-->
<!--              <div class="col-sm-10">-->
<!--                  <input type="text" class="form-control" id="del_status" name="SoldierRecord[del_status]" placeholder="" />-->
<!--              </div>-->
<!--              <div class="clearfix"></div>-->
<!--          </div>-->

<!--          <div id="create_date_div" class="form-group">-->
<!--              <label for="create_date" class="col-sm-2 control-label">--><?php //echo $modelLabel->getAttributeLabel("create_date")?><!--</label>-->
<!--              <div class="col-sm-10">-->
<!--                  <input type="text" class="form-control" id="create_date" name="SoldierRecord[create_date]" placeholder="" />-->
<!--              </div>-->
<!--              <div class="clearfix"></div>-->
<!--          </div>-->
<!---->
<!--          <div id="upload_time_div" class="form-group">-->
<!--              <label for="upload_time" class="col-sm-2 control-label">--><?php //echo $modelLabel->getAttributeLabel("upload_time")?><!--</label>-->
<!--              <div class="col-sm-10">-->
<!--                  <input type="text" class="form-control" id="upload_time" name="SoldierRecord[upload_time]" placeholder="必填" />-->
<!--              </div>-->
<!--              <div class="clearfix"></div>-->
<!--          </div>-->
                    

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
		$('#soldier-record-search-form').submit();
	}
 function viewAction(id){
		initModel(id, 'view', 'fun');
	}

 function initEditSystemModule(data, type){
	if(type == 'create'){
		$("#id").val('');
		$("#sex").val('');
		$("#birthday").val('');
		$("#height").val('');
		$("#weight").val('');
		$("#idcard").val('');
		$("#name").val('');
		$("#moblie").val('');
		$("#email").val('');
		$("#address").val('');
		$("#leave_time").val('');
		$("#report_time").val('');
		$("#train_status").val('');
		$("#job_status").val('');
		$("#check_status").val('');
		$("#del_status").val('');
		$("#create_date").val('');
		$("#upload_time").val('');
		
	}
	else{
		$("#id").val(data.id);
    	$("#sex").val(data.sex);
    	$("#birthday").val(data.birthday);
    	$("#height").val(data.height);
    	$("#weight").val(data.weight);
    	$("#idcard").val(data.idcard);
    	$("#name").val(data.name);
    	$("#moblie").val(data.moblie);
    	$("#email").val(data.email);
    	$("#address").val(data.address);
    	$("#leave_time").val(data.leave_time);
    	$("#report_time").val(data.report_time);
    	$("#train_status").val(data.train_status);
    	$("#job_status").val(data.job_status);
    	$("#check_status").val(data.check_status);
    	$("#del_status").val(data.del_status);
    	$("#create_date").val(data.create_date);
    	$("#upload_time").val(data.upload_time);
    	}
	if(type == "view"){
      $("#id").attr({readonly:true,disabled:true});
      $("#sex").attr({readonly:true,disabled:true});
      $("#birthday").attr({readonly:true,disabled:true});
      $("#height").attr({readonly:true,disabled:true});
      $("#weight").attr({readonly:true,disabled:true});
      $("#idcard").attr({readonly:true,disabled:true});
      $("#name").attr({readonly:true,disabled:true});
      $("#moblie").attr({readonly:true,disabled:true});
      $("#email").attr({readonly:true,disabled:true});
      $("#address").attr({readonly:true,disabled:true});
      $("#leave_time").attr({readonly:true,disabled:true});
      $("#report_time").attr({readonly:true,disabled:true});
      $("#train_status").attr({readonly:true,disabled:true});
      $("#job_status").attr({readonly:true,disabled:true});
      $("#check_status").attr({readonly:true,disabled:true});
      $("#del_status").attr({readonly:true,disabled:true});
      $("#create_date").attr({readonly:true,disabled:true});
      $("#upload_time").attr({readonly:true,disabled:true});
	$('#edit_dialog_ok').addClass('hidden');
	}
	else{
      $("#id").attr({readonly:false,disabled:false});
      $("#sex").attr({readonly:false,disabled:false});
      $("#birthday").attr({readonly:false,disabled:false});
      $("#height").attr({readonly:false,disabled:false});
      $("#weight").attr({readonly:false,disabled:false});
      $("#idcard").attr({readonly:false,disabled:false});
      $("#name").attr({readonly:false,disabled:false});
      $("#moblie").attr({readonly:false,disabled:false});
      $("#email").attr({readonly:false,disabled:false});
      $("#address").attr({readonly:false,disabled:false});
      $("#leave_time").attr({readonly:false,disabled:false});
      $("#report_time").attr({readonly:false,disabled:false});
      $("#train_status").attr({readonly:false,disabled:false});
      $("#job_status").attr({readonly:false,disabled:false});
      $("#check_status").attr({readonly:false,disabled:false});
      $("#del_status").attr({readonly:false,disabled:false});
      $("#create_date").attr({readonly:false,disabled:false});
      $("#upload_time").attr({readonly:false,disabled:false});
		$('#edit_dialog_ok').removeClass('hidden');
		}
		$('#edit_dialog').modal('show');
}

function initModel(id, type, fun){
	
	$.ajax({
		   type: "GET",
		   url: "<?=Url::toRoute('soldier-record/view')?>",
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
				   url: "<?=Url::toRoute('soldier-record/delete')?>",
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
	$('#soldier-record-form').submit();
});

$('#create_btn').click(function (e) {
    e.preventDefault();
    initEditSystemModule({}, 'create');
});

$('#delete_btn').click(function (e) {
    e.preventDefault();
    deleteAction('');
});

$('#soldier-record-form').bind('submit', function(e) {
	e.preventDefault();
	var id = $("#id").val();
	var action = id == "" ? "<?=Url::toRoute('soldier-record/create')?>" : "<?=Url::toRoute('soldier-record/update')?>";
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

<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;

use backend\models\CaseRecord;

$modelLabel = new \backend\models\CaseRecord();
?>

<?php $this->beginBlock('header');  ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-6">
            <!-- AREA CHART -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Area Chart</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body chart-responsive">
                    <div class="chart" id="revenue-chart" style="height: 300px;"></div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- DONUT CHART -->
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Donut Chart</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body chart-responsive">
                    <div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
        <!-- /.col (LEFT) -->
        <div class="col-md-6">
            <!-- LINE CHART -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Line Chart</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body chart-responsive">
                    <div class="chart" id="line-chart" style="height: 300px;"></div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- BAR CHART -->
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Bar Chart</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body chart-responsive">
                    <div class="chart" id="bar-chart" style="height: 300px;"></div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
        <!-- /.col (RIGHT) -->
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
                <?php $form = ActiveForm::begin(["id" => "case-record-form", "class"=>"form-horizontal", "action"=>Url::toRoute("case-record/save")]); ?>                      
                 
          <input type="hidden" class="form-control" id="id" name="id" />

          <div id="name_div" class="form-group">
              <label for="name" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("name")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="name" name="CaseRecord[name]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="sex_div" class="form-group">
              <label for="sex" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("sex")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="sex" name="CaseRecord[sex]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="nation_div" class="form-group">
              <label for="nation" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("nation")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="nation" name="CaseRecord[nation]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="age_div" class="form-group">
              <label for="age" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("age")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="age" name="CaseRecord[age]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="politics_status_div" class="form-group">
              <label for="politics_status" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("politics_status")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="politics_status" name="CaseRecord[politics_status]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="join_party_date_div" class="form-group">
              <label for="join_party_date" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("join_party_date")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="join_party_date" name="CaseRecord[join_party_date]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="organization_name_div" class="form-group">
              <label for="organization_name" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("organization_name")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="organization_name" name="CaseRecord[organization_name]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="duty_div" class="form-group">
              <label for="duty" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("duty")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="duty" name="CaseRecord[duty]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="rank_div" class="form-group">
              <label for="rank" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("rank")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="rank" name="CaseRecord[rank]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="is_monitor_div" class="form-group">
              <label for="is_monitor" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("is_monitor")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="is_monitor" name="CaseRecord[is_monitor]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="is_official_div" class="form-group">
              <label for="is_official" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("is_official")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="is_official" name="CaseRecord[is_official]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="clue_code_div" class="form-group">
              <label for="clue_code" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("clue_code")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="clue_code" name="CaseRecord[clue_code]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="clue_people_code_div" class="form-group">
              <label for="clue_people_code" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("clue_people_code")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="clue_people_code" name="CaseRecord[clue_people_code]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="clue_accept_time_div" class="form-group">
              <label for="clue_accept_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("clue_accept_time")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="clue_accept_time" name="CaseRecord[clue_accept_time]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="clue_manage_office_div" class="form-group">
              <label for="clue_manage_office" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("clue_manage_office")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="clue_manage_office" name="CaseRecord[clue_manage_office]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="clue_source_div" class="form-group">
              <label for="clue_source" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("clue_source")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="clue_source" name="CaseRecord[clue_source]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="clue_violations_type_div" class="form-group">
              <label for="clue_violations_type" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("clue_violations_type")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="clue_violations_type" name="CaseRecord[clue_violations_type]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="clue_outlawed_type_div" class="form-group">
              <label for="clue_outlawed_type" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("clue_outlawed_type")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="clue_outlawed_type" name="CaseRecord[clue_outlawed_type]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="clue_disposition_method_div" class="form-group">
              <label for="clue_disposition_method" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("clue_disposition_method")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="clue_disposition_method" name="CaseRecord[clue_disposition_method]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="clue_summary_div" class="form-group">
              <label for="clue_summary" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("clue_summary")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="clue_summary" name="CaseRecord[clue_summary]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="clue_protokaryon_report_div" class="form-group">
              <label for="clue_protokaryon_report" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("clue_protokaryon_report")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="clue_protokaryon_report" name="CaseRecord[clue_protokaryon_report]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="case_code_div" class="form-group">
              <label for="case_code" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("case_code")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="case_code" name="CaseRecord[case_code]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="case_people_code_div" class="form-group">
              <label for="case_people_code" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("case_people_code")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="case_people_code" name="CaseRecord[case_people_code]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="case_register_time_div" class="form-group">
              <label for="case_register_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("case_register_time")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="case_register_time" name="CaseRecord[case_register_time]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="case_register_office_div" class="form-group">
              <label for="case_register_office" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("case_register_office")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="case_register_office" name="CaseRecord[case_register_office]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="case_summary_div" class="form-group">
              <label for="case_summary" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("case_summary")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="case_summary" name="CaseRecord[case_summary]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="case_register_report_div" class="form-group">
              <label for="case_register_report" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("case_register_report")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="case_register_report" name="CaseRecord[case_register_report]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="case_register_decision_div" class="form-group">
              <label for="case_register_decision" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("case_register_decision")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="case_register_decision" name="CaseRecord[case_register_decision]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="case_review_report_div" class="form-group">
              <label for="case_review_report" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("case_review_report")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="case_review_report" name="CaseRecord[case_review_report]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="settle_accept_time_div" class="form-group">
              <label for="settle_accept_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("settle_accept_time")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="settle_accept_time" name="CaseRecord[settle_accept_time]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="settle_accept_report_div" class="form-group">
              <label for="settle_accept_report" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("settle_accept_report")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="settle_accept_report" name="CaseRecord[settle_accept_report]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="settle_conclude_time_div" class="form-group">
              <label for="settle_conclude_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("settle_conclude_time")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="settle_conclude_time" name="CaseRecord[settle_conclude_time]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="settle_finish_time_div" class="form-group">
              <label for="settle_finish_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("settle_finish_time")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="settle_finish_time" name="CaseRecord[settle_finish_time]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="settle_party_disposal_div" class="form-group">
              <label for="settle_party_disposal" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("settle_party_disposal")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="settle_party_disposal" name="CaseRecord[settle_party_disposal]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="settle_political_disposal_div" class="form-group">
              <label for="settle_political_disposal" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("settle_political_disposal")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="settle_political_disposal" name="CaseRecord[settle_political_disposal]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="settle_disposal_decision_div" class="form-group">
              <label for="settle_disposal_decision" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("settle_disposal_decision")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="settle_disposal_decision" name="CaseRecord[settle_disposal_decision]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="settle_judiciary_time_div" class="form-group">
              <label for="settle_judiciary_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("settle_judiciary_time")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="settle_judiciary_time" name="CaseRecord[settle_judiciary_time]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="settle_prosecutor_time_div" class="form-group">
              <label for="settle_prosecutor_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("settle_prosecutor_time")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="settle_prosecutor_time" name="CaseRecord[settle_prosecutor_time]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="settle_prosecutor_details_div" class="form-group">
              <label for="settle_prosecutor_details" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("settle_prosecutor_details")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="settle_prosecutor_details" name="CaseRecord[settle_prosecutor_details]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="del_status_div" class="form-group">
              <label for="del_status" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("del_status")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="del_status" name="CaseRecord[del_status]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="create_date_div" class="form-group">
              <label for="create_date" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("create_date")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="create_date" name="CaseRecord[create_date]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="update_time_div" class="form-group">
              <label for="update_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("update_time")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="update_time" name="CaseRecord[update_time]" placeholder="" />
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
		$('#case-record-search-form').submit();
	}
 function viewAction(id){
		initModel(id, 'view', 'fun');
	}

 function initEditSystemModule(data, type){
	if(type == 'create'){
		$("#id").val('');
		$("#name").val('');
		$("#sex").val('');
		$("#nation").val('');
		$("#age").val('');
		$("#politics_status").val('');
		$("#join_party_date").val('');
		$("#organization_name").val('');
		$("#duty").val('');
		$("#rank").val('');
		$("#is_monitor").val('');
		$("#is_official").val('');
		$("#clue_code").val('');
		$("#clue_people_code").val('');
		$("#clue_accept_time").val('');
		$("#clue_manage_office").val('');
		$("#clue_source").val('');
		$("#clue_violations_type").val('');
		$("#clue_outlawed_type").val('');
		$("#clue_disposition_method").val('');
		$("#clue_summary").val('');
		$("#clue_protokaryon_report").val('');
		$("#case_code").val('');
		$("#case_people_code").val('');
		$("#case_register_time").val('');
		$("#case_register_office").val('');
		$("#case_summary").val('');
		$("#case_register_report").val('');
		$("#case_register_decision").val('');
		$("#case_review_report").val('');
		$("#settle_accept_time").val('');
		$("#settle_accept_report").val('');
		$("#settle_conclude_time").val('');
		$("#settle_finish_time").val('');
		$("#settle_party_disposal").val('');
		$("#settle_political_disposal").val('');
		$("#settle_disposal_decision").val('');
		$("#settle_judiciary_time").val('');
		$("#settle_prosecutor_time").val('');
		$("#settle_prosecutor_details").val('');
		$("#del_status").val('');
		$("#create_date").val('');
		$("#update_time").val('');
		
	}
	else{
		$("#id").val(data.id);
    	$("#name").val(data.name);
    	$("#sex").val(data.sex);
    	$("#nation").val(data.nation);
    	$("#age").val(data.age);
    	$("#politics_status").val(data.politics_status);
    	$("#join_party_date").val(data.join_party_date);
    	$("#organization_name").val(data.organization_name);
    	$("#duty").val(data.duty);
    	$("#rank").val(data.rank);
    	$("#is_monitor").val(data.is_monitor);
    	$("#is_official").val(data.is_official);
    	$("#clue_code").val(data.clue_code);
    	$("#clue_people_code").val(data.clue_people_code);
    	$("#clue_accept_time").val(data.clue_accept_time);
    	$("#clue_manage_office").val(data.clue_manage_office);
    	$("#clue_source").val(data.clue_source);
    	$("#clue_violations_type").val(data.clue_violations_type);
    	$("#clue_outlawed_type").val(data.clue_outlawed_type);
    	$("#clue_disposition_method").val(data.clue_disposition_method);
    	$("#clue_summary").val(data.clue_summary);
    	$("#clue_protokaryon_report").val(data.clue_protokaryon_report);
    	$("#case_code").val(data.case_code);
    	$("#case_people_code").val(data.case_people_code);
    	$("#case_register_time").val(data.case_register_time);
    	$("#case_register_office").val(data.case_register_office);
    	$("#case_summary").val(data.case_summary);
    	$("#case_register_report").val(data.case_register_report);
    	$("#case_register_decision").val(data.case_register_decision);
    	$("#case_review_report").val(data.case_review_report);
    	$("#settle_accept_time").val(data.settle_accept_time);
    	$("#settle_accept_report").val(data.settle_accept_report);
    	$("#settle_conclude_time").val(data.settle_conclude_time);
    	$("#settle_finish_time").val(data.settle_finish_time);
    	$("#settle_party_disposal").val(data.settle_party_disposal);
    	$("#settle_political_disposal").val(data.settle_political_disposal);
    	$("#settle_disposal_decision").val(data.settle_disposal_decision);
    	$("#settle_judiciary_time").val(data.settle_judiciary_time);
    	$("#settle_prosecutor_time").val(data.settle_prosecutor_time);
    	$("#settle_prosecutor_details").val(data.settle_prosecutor_details);
    	$("#del_status").val(data.del_status);
    	$("#create_date").val(data.create_date);
    	$("#update_time").val(data.update_time);
    	}
	if(type == "view"){
      $("#id").attr({readonly:true,disabled:true});
      $("#name").attr({readonly:true,disabled:true});
      $("#sex").attr({readonly:true,disabled:true});
      $("#nation").attr({readonly:true,disabled:true});
      $("#age").attr({readonly:true,disabled:true});
      $("#politics_status").attr({readonly:true,disabled:true});
      $("#join_party_date").attr({readonly:true,disabled:true});
      $("#organization_name").attr({readonly:true,disabled:true});
      $("#duty").attr({readonly:true,disabled:true});
      $("#rank").attr({readonly:true,disabled:true});
      $("#is_monitor").attr({readonly:true,disabled:true});
      $("#is_official").attr({readonly:true,disabled:true});
      $("#clue_code").attr({readonly:true,disabled:true});
      $("#clue_people_code").attr({readonly:true,disabled:true});
      $("#clue_accept_time").attr({readonly:true,disabled:true});
      $("#clue_manage_office").attr({readonly:true,disabled:true});
      $("#clue_source").attr({readonly:true,disabled:true});
      $("#clue_violations_type").attr({readonly:true,disabled:true});
      $("#clue_outlawed_type").attr({readonly:true,disabled:true});
      $("#clue_disposition_method").attr({readonly:true,disabled:true});
      $("#clue_summary").attr({readonly:true,disabled:true});
      $("#clue_protokaryon_report").attr({readonly:true,disabled:true});
      $("#case_code").attr({readonly:true,disabled:true});
      $("#case_people_code").attr({readonly:true,disabled:true});
      $("#case_register_time").attr({readonly:true,disabled:true});
      $("#case_register_office").attr({readonly:true,disabled:true});
      $("#case_summary").attr({readonly:true,disabled:true});
      $("#case_register_report").attr({readonly:true,disabled:true});
      $("#case_register_decision").attr({readonly:true,disabled:true});
      $("#case_review_report").attr({readonly:true,disabled:true});
      $("#settle_accept_time").attr({readonly:true,disabled:true});
      $("#settle_accept_report").attr({readonly:true,disabled:true});
      $("#settle_conclude_time").attr({readonly:true,disabled:true});
      $("#settle_finish_time").attr({readonly:true,disabled:true});
      $("#settle_party_disposal").attr({readonly:true,disabled:true});
      $("#settle_political_disposal").attr({readonly:true,disabled:true});
      $("#settle_disposal_decision").attr({readonly:true,disabled:true});
      $("#settle_judiciary_time").attr({readonly:true,disabled:true});
      $("#settle_prosecutor_time").attr({readonly:true,disabled:true});
      $("#settle_prosecutor_details").attr({readonly:true,disabled:true});
      $("#del_status").attr({readonly:true,disabled:true});
      $("#create_date").attr({readonly:true,disabled:true});
      $("#update_time").attr({readonly:true,disabled:true});
	$('#edit_dialog_ok').addClass('hidden');
	}
	else{
      $("#id").attr({readonly:false,disabled:false});
      $("#name").attr({readonly:false,disabled:false});
      $("#sex").attr({readonly:false,disabled:false});
      $("#nation").attr({readonly:false,disabled:false});
      $("#age").attr({readonly:false,disabled:false});
      $("#politics_status").attr({readonly:false,disabled:false});
      $("#join_party_date").attr({readonly:false,disabled:false});
      $("#organization_name").attr({readonly:false,disabled:false});
      $("#duty").attr({readonly:false,disabled:false});
      $("#rank").attr({readonly:false,disabled:false});
      $("#is_monitor").attr({readonly:false,disabled:false});
      $("#is_official").attr({readonly:false,disabled:false});
      $("#clue_code").attr({readonly:false,disabled:false});
      $("#clue_people_code").attr({readonly:false,disabled:false});
      $("#clue_accept_time").attr({readonly:false,disabled:false});
      $("#clue_manage_office").attr({readonly:false,disabled:false});
      $("#clue_source").attr({readonly:false,disabled:false});
      $("#clue_violations_type").attr({readonly:false,disabled:false});
      $("#clue_outlawed_type").attr({readonly:false,disabled:false});
      $("#clue_disposition_method").attr({readonly:false,disabled:false});
      $("#clue_summary").attr({readonly:false,disabled:false});
      $("#clue_protokaryon_report").attr({readonly:false,disabled:false});
      $("#case_code").attr({readonly:false,disabled:false});
      $("#case_people_code").attr({readonly:false,disabled:false});
      $("#case_register_time").attr({readonly:false,disabled:false});
      $("#case_register_office").attr({readonly:false,disabled:false});
      $("#case_summary").attr({readonly:false,disabled:false});
      $("#case_register_report").attr({readonly:false,disabled:false});
      $("#case_register_decision").attr({readonly:false,disabled:false});
      $("#case_review_report").attr({readonly:false,disabled:false});
      $("#settle_accept_time").attr({readonly:false,disabled:false});
      $("#settle_accept_report").attr({readonly:false,disabled:false});
      $("#settle_conclude_time").attr({readonly:false,disabled:false});
      $("#settle_finish_time").attr({readonly:false,disabled:false});
      $("#settle_party_disposal").attr({readonly:false,disabled:false});
      $("#settle_political_disposal").attr({readonly:false,disabled:false});
      $("#settle_disposal_decision").attr({readonly:false,disabled:false});
      $("#settle_judiciary_time").attr({readonly:false,disabled:false});
      $("#settle_prosecutor_time").attr({readonly:false,disabled:false});
      $("#settle_prosecutor_details").attr({readonly:false,disabled:false});
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
		   url: "<?=Url::toRoute('case-record/view')?>",
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
				   url: "<?=Url::toRoute('case-record/delete')?>",
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
	$('#case-record-form').submit();
});

$('#create_btn').click(function (e) {
    e.preventDefault();
    initEditSystemModule({}, 'create');
});

$('#delete_btn').click(function (e) {
    e.preventDefault();
    deleteAction('');
});

$('#case-record-form').bind('submit', function(e) {
	e.preventDefault();
	var id = $("#id").val();
	var action = id == "" ? "<?=Url::toRoute('case-record/create')?>" : "<?=Url::toRoute('case-record/update')?>";
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

<script>
    $(function () {
        "use strict";

        // AREA CHART
        var area = new Morris.Area({
            element: 'revenue-chart',
            resize: true,
            data: [
                {y: '2011 Q1', item1: 2666, item2: 2666},
                {y: '2011 Q2', item1: 2778, item2: 2294},
                {y: '2011 Q3', item1: 4912, item2: 1969},
                {y: '2011 Q4', item1: 3767, item2: 3597},
                {y: '2012 Q1', item1: 6810, item2: 1914},
                {y: '2012 Q2', item1: 5670, item2: 4293},
                {y: '2012 Q3', item1: 4820, item2: 3795},
                {y: '2012 Q4', item1: 15073, item2: 5967},
                {y: '2013 Q1', item1: 10687, item2: 4460},
                {y: '2013 Q2', item1: 8432, item2: 5713}
            ],
            xkey: 'y',
            ykeys: ['item1', 'item2'],
            labels: ['Item 1', 'Item 2'],
            lineColors: ['#a0d0e0', '#3c8dbc'],
            hideHover: 'auto'
        });

        // LINE CHART
        var line = new Morris.Line({
            element: 'line-chart',
            resize: true,
            data: [
                {y: '2011 Q1', item1: 2666},
                {y: '2011 Q2', item1: 2778},
                {y: '2011 Q3', item1: 4912},
                {y: '2011 Q4', item1: 3767},
                {y: '2012 Q1', item1: 6810},
                {y: '2012 Q2', item1: 5670},
                {y: '2012 Q3', item1: 4820},
                {y: '2012 Q4', item1: 15073},
                {y: '2013 Q1', item1: 10687},
                {y: '2013 Q2', item1: 8432}
            ],
            xkey: 'y',
            ykeys: ['item1'],
            labels: ['Item 1'],
            lineColors: ['#3c8dbc'],
            hideHover: 'auto'
        });

        //DONUT CHART
        var donut = new Morris.Donut({
            element: 'sales-chart',
            resize: true,
            colors: ["#3c8dbc", "#f56954", "#00a65a"],
            data: [
                {label: "Download Sales", value: 12},
                {label: "In-Store Sales", value: 30},
                {label: "Mail-Order Sales", value: 20}
            ],
            hideHover: 'auto'
        });
        //BAR CHART
        var bar = new Morris.Bar({
            element: 'bar-chart',
            resize: true,
            data: [
                {y: '2006', a: 100, b: 90},
                {y: '2007', a: 75, b: 65},
                {y: '2008', a: 50, b: 40},
                {y: '2009', a: 75, b: 65},
                {y: '2010', a: 50, b: 40},
                {y: '2011', a: 75, b: 65},
                {y: '2012', a: 100, b: 90}
            ],
            barColors: ['#00a65a', '#f56954'],
            xkey: 'y',
            ykeys: ['a', 'b'],
            labels: ['CPU', 'DISK'],
            hideHover: 'auto'
        });
    });
</script>
<?php $this->endBlock(); ?>
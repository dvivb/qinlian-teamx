
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;

use backend\models\QinlianPetition;

$modelLabel = new \backend\models\QinlianPetition();
$ChallengeModelLabel = new \backend\models\QinlianChallenge();
$ThreadModelLabel = new \backend\models\QinlianThread();
$RegisterModelLabel = new \backend\models\QinlianRegister();
?>

<?php $this->beginBlock('header');  ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">

                <!-- row start search-->
                <div class="row">
                    <div class="col-xs-12" style="padding: 30px 70px;background: #ffffff;">
                        <?php ActiveForm::begin(['id' => 'qinlian-unique-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('qinlian-unique/index')]); ?>

                        <div class="form-group" style="margin: 4px;">
                            <label><?=$ChallengeModelLabel->getAttributeLabel('number')?>:</label>
                            <input type="text" class="form-control" id="query[number]" name="query[number]"  value="<?=isset($query["number"]) ? $query["number"] : "" ?>">
                        </div>
                        <div class="form-group" style="margin: 4px;">
                            <label>姓名</label>
                            <input type="text" class="form-control" id="query[name]" name="query[name]"  value="<?=isset($query["name"]) ? $query["name"] : "" ?>">
                        </div>

                        <div class="form-group" style="margin: 4px;">
                            <label><?=$ChallengeModelLabel->getAttributeLabel('disposal_year')?>:</label>
                            <input type="text" class="form-control" id="query[disposal_year]" name="query[disposal_year]"  value="<?=isset($query["disposal_year"]) ? $query["disposal_year"] : "" ?>">
                        </div>

                        <div class="form-group" style="margin: 4px;">
                            <label><?=$ChallengeModelLabel->getAttributeLabel('disposal_method')?>:</label>
                            <select class="form-control" id="disposal_method" name="query[disposal_method]" >
                                <option value="">全&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;部</option>
                                <option>谈话函询</option>
                                <option>初步核实</option>
                                <option>暂存待查</option>
                                <option>予以了结</option>
                                <option>立案调查</option>
                            </select>
                        </div>

                        <div class="form-group" style="margin: 4px;">
                            <label>简要案情关键词</label>
                            <input type="text" class="form-control" id="query[case_keyword]" name="query[case_keyword]"  value="<?=isset($query["case_keyword"]) ? $query["case_keyword"] : "" ?>">
                        </div>
                        <div class="form-group" style="margin: 4px;">
                            <label><?=$ChallengeModelLabel->getAttributeLabel('id_card')?>:</label>
                            <input type="text" class="form-control" id="query[id_card]" name="query[id_card]"  value="<?=isset($query["id_card"]) ? $query["id_card"] : "" ?>">
                        </div>

                        <div class="form-group">
                            <a onclick="searchAction()" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i> 搜   索</a>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
                <!-- row end search -->
            </div>
        </div>
    </div>

    <div class="row" <?php if (empty($models)) echo "style='display: none;'";?>>
        <div class="col-xs-12">
            <div class="box">

                <div class="box-header">
                    <h3 class="box-title">信访信息查询结果</h3>
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
                <!-- /.box-header -->

                <div class="box-body">
                    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap table-responsive">

                        <!-- row start -->
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="data_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="data_table_info">
                                    <thead class="text-nowrap">
                                    <tr role="row">

                                        <?php
                                        $orderby = isset($_GET['orderby']) ? $_GET['orderby'] : '';
//                                        echo '<th><input id="data_table_check" type="checkbox"></th>';
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
//                                        echo '  <td><label><input type="checkbox" value="' . $model->id . '"></label></td>';
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
                                    <!-- <tfoot></tfoot> -->
                                </table>
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


    <div class="row"  <?php if (empty($ChallengeModels)) echo "style='display: none;'";?>>
        <div class="col-xs-12">
            <div class="box">

                <div class="box-header">
                    <h3 class="box-title">案管问题查询结果</h3>

                    <!-- row start -->
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="data_table_info" role="status" aria-live="polite">
                                <div class="infos">
                                    从<?= $ChallengePages->getPage() * $ChallengePages->getPageSize() + 1 ?>            		到 <?= ($ChallengePagesCount = ($ChallengePages->getPage() + 1) * $ChallengePages->getPageSize()) < $ChallengePages->totalCount ?  $ChallengePagesCount : $ChallengePages->totalCount?>            		 共 <?= $ChallengePages->totalCount?> 条记录</div>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="data_table_paginate">
                                <?= LinkPager::widget([
                                    'pagination' => $ChallengePages,
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
                <!-- /.box-header -->

                <div class="box-body">
                    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap table-responsive">
                        <!-- row start -->
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="data_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="data_table_info">
                                    <thead class="text-nowrap">
                                    <tr role="row">

                                        <?php
                                        $orderby = isset($_GET['orderby']) ? $_GET['orderby'] : '';
//                                        echo '<th><input id="data_table_check" type="checkbox"></th>';
                                        //              echo '<th onclick="orderby(\'id\', \'desc\')" '.CommonFun::sortClass($orderby, 'id').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('id').'</th>';
                                        echo '<th onclick="orderby(\'number\', \'desc\')" '.CommonFun::sortClass($orderby, 'number').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('number').'</th>';
                                        echo '<th onclick="orderby(\'incoming_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'incoming_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('incoming_time').'</th>';
                                        echo '<th onclick="orderby(\'clue_level\', \'desc\')" '.CommonFun::sortClass($orderby, 'clue_level').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('clue_level').'</th>';
                                        echo '<th onclick="orderby(\'clue_category\', \'desc\')" '.CommonFun::sortClass($orderby, 'clue_category').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('clue_category').'</th>';
                                        echo '<th onclick="orderby(\'clue_source\', \'desc\')" '.CommonFun::sortClass($orderby, 'clue_source').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('clue_source').'</th>';
                                        echo '<th onclick="orderby(\'letter_number\', \'desc\')" '.CommonFun::sortClass($orderby, 'letter_number').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('letter_number').'</th>';
                                        echo '<th onclick="orderby(\'signature\', \'desc\')" '.CommonFun::sortClass($orderby, 'signature').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('signature').'</th>';
                                        echo '<th onclick="orderby(\'leader_instructions\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('leader_instructions').'</th>';
                                        echo '<th onclick="orderby(\'respondent_unit\', \'desc\')" '.CommonFun::sortClass($orderby, 'respondent_unit').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('respondent_unit').'</th>';
                                        echo '<th onclick="orderby(\'duty_job\', \'desc\')" '.CommonFun::sortClass($orderby, 'duty_job').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('duty_job').'</th>';
                                        echo '<th onclick="orderby(\'rank_job\', \'desc\')" '.CommonFun::sortClass($orderby, 'rank_job').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('rank_job').'</th>';
                                        echo '<th onclick="orderby(\'main_issues\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('main_issues').'</th>';
                                        echo '<th onclick="orderby(\'related_unit\', \'desc\')" '.CommonFun::sortClass($orderby, 'related_unit').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('related_unit').'</th>';
                                        echo '<th onclick="orderby(\'heavy_cases\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('heavy_cases').'</th>';
                                        echo '<th onclick="orderby(\'date_receipt\', \'desc\')" '.CommonFun::sortClass($orderby, 'date_receipt').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('date_receipt').'</th>';
                                        echo '<th onclick="orderby(\'transfer_organ\', \'desc\')" '.CommonFun::sortClass($orderby, 'transfer_organ').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('transfer_organ').'</th>';
                                        echo '<th onclick="orderby(\'results\', \'desc\')" '.CommonFun::sortClass($orderby, 'results').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('results').'</th>';
                                        echo '<th onclick="orderby(\'supervisory_leadership\', \'desc\')" '.CommonFun::sortClass($orderby, 'supervisory_leadership').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('supervisory_leadership').'</th>';
                                        echo '<th onclick="orderby(\'host_department\', \'desc\')" '.CommonFun::sortClass($orderby, 'host_department').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('host_department').'</th>';
                                        echo '<th onclick="orderby(\'progress_case\', \'desc\')" '.CommonFun::sortClass($orderby, 'progress_case').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('progress_case').'</th>';
                                        echo '<th onclick="orderby(\'investigation_disposal\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('investigation_disposal').'</th>';
                                        echo '<th onclick="orderby(\'remarks\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('remarks').'</th>';
                                        echo '<th onclick="orderby(\'number_disposals\', \'desc\')" '.CommonFun::sortClass($orderby, 'number_disposals').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('number_disposals').'</th>';
                                        echo '<th onclick="orderby(\'organizations_number\', \'desc\')" '.CommonFun::sortClass($orderby, 'organizations_number').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('organizations_number').'</th>';
                                        echo '<th onclick="orderby(\'first_form\', \'desc\')" '.CommonFun::sortClass($orderby, 'first_form').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('first_form').'</th>';
                                        echo '<th onclick="orderby(\'second_form\', \'desc\')" '.CommonFun::sortClass($orderby, 'second_form').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('second_form').'</th>';
                                        echo '<th onclick="orderby(\'third_form\', \'desc\')" '.CommonFun::sortClass($orderby, 'third_form').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('third_form').'</th>';
                                        echo '<th onclick="orderby(\'fourth_form\', \'desc\')" '.CommonFun::sortClass($orderby, 'fourth_form').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('fourth_form').'</th>';
                                        echo '<th onclick="orderby(\'approval_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'approval_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('approval_time').'</th>';
                                        echo '<th onclick="orderby(\'approval_status\', \'desc\')" '.CommonFun::sortClass($orderby, 'approval_status').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('approval_status').'</th>';

                                        echo '<th onclick="orderby(\'is_thread_disposal\', \'desc\')" '.CommonFun::sortClass($orderby, 'is_thread_disposal').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('is_thread_disposal').'</th>';
                                        echo '<th onclick="orderby(\'disposal_method\', \'desc\')" '.CommonFun::sortClass($orderby, 'disposal_method').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('disposal_method').'</th>';
                                        echo '<th onclick="orderby(\'volume_number\', \'desc\')" '.CommonFun::sortClass($orderby, 'volume_number').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('volume_number').'</th>';
                                        echo '<th onclick="orderby(\'id_card\', \'desc\')" '.CommonFun::sortClass($orderby, 'id_card').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('id_card').'</th>';
                                        echo '<th onclick="orderby(\'disposal_year\', \'desc\')" '.CommonFun::sortClass($orderby, 'disposal_year').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('disposal_year').'</th>';

                                        echo '<th onclick="orderby(\'create_date\', \'desc\')" '.CommonFun::sortClass($orderby, 'create_date').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('create_date').'</th>';
                                        echo '<th onclick="orderby(\'update_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'update_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ChallengeModelLabel->getAttributeLabel('update_time').'</th>';

                                        ?>

                                        <th tabindex="0" class="th-width-0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    foreach ($ChallengeModels as $model) {
                                        echo '<tr id="rowid_' . $model->id . '">';
//                                        echo '  <td><label><input type="checkbox" value="' . $model->id . '"></label></td>';
//                echo '  <td>' . $model->id . '</td>';
                                        echo '  <td>' . $model->number . '</td>';
                                        echo '  <td>' . $model->incoming_time . '</td>';
                                        echo '  <td>' . $model->clue_level . '</td>';
                                        echo '  <td>' . $model->clue_category . '</td>';
                                        echo '  <td>' . $model->clue_source . '</td>';
                                        echo '  <td>' . $model->letter_number . '</td>';
                                        echo '  <td>' . $model->signature . '</td>';
                                        echo '  <td>' . mb_substr($model->leader_instructions, 0, 400) . '</td>';
                                        echo '  <td>' . $model->respondent_unit . '</td>';
                                        echo '  <td>' . $model->duty_job . '</td>';
                                        echo '  <td>' . $model->rank_job . '</td>';
                                        echo '  <td>' . mb_substr($model->main_issues, 0, 400) . '</td>';
                                        echo '  <td>' . $model->related_unit . '</td>';
                                        echo '  <td>' . mb_substr($model->heavy_cases, 0, 400) . '</td>';
                                        echo '  <td>' . $model->date_receipt . '</td>';
                                        echo '  <td>' . $model->transfer_organ . '</td>';
                                        echo '  <td>' . $model->results . '</td>';
                                        echo '  <td>' . $model->supervisory_leadership . '</td>';
                                        echo '  <td>' . $model->host_department . '</td>';
                                        echo '  <td>' . $model->progress_case . '</td>';
                                        echo '  <td>' . mb_substr($model->investigation_disposal, 0, 400) . '</td>';
                                        echo '  <td>' . mb_substr($model->remarks, 0, 400) . '</td>';
                                        echo '  <td>' . $model->number_disposals . '</td>';
                                        echo '  <td>' . $model->organizations_number . '</td>';
                                        echo '  <td>' . $model->first_form . '</td>';
                                        echo '  <td>' . $model->second_form . '</td>';
                                        echo '  <td>' . $model->third_form . '</td>';
                                        echo '  <td>' . $model->fourth_form . '</td>';
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

                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row" <?php if (empty($ThreadModels)) echo "style='display: none;'";?>>
        <div class="col-xs-12">
            <div class="box">

                <div class="box-header">
                    <h3 class="box-title">案管线索查询结果</h3>

                    <!-- row start -->
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="data_table_info" role="status" aria-live="polite">
                                <div class="infos">
                                    从<?= $ThreadPages->getPage() * $ThreadPages->getPageSize() + 1 ?>            		到 <?= ($pageCount = ($ThreadPages->getPage() + 1) * $ThreadPages->getPageSize()) < $ThreadPages->totalCount ?  $pageCount : $ThreadPages->totalCount?>            		 共 <?= $ThreadPages->totalCount?> 条记录</div>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="data_table_paginate">
                                <?= LinkPager::widget([
                                    'pagination' => $ThreadPages,
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
                <!-- /.box-header -->

                <div class="box-body">
                    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap table-responsive">
                        <!-- row start -->
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="data_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="data_table_info">
                                    <thead class="text-nowrap">
                                    <tr role="row">

                                        <?php
                                        $orderby = isset($_GET['orderby']) ? $_GET['orderby'] : '';
//                                        echo '<th><input id="data_table_check" type="checkbox"></th>';
                                        echo '<th onclick="orderby(\'number\', \'desc\')" '.CommonFun::sortClass($orderby, 'number').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('number').'</th>';
                                        echo '<th onclick="orderby(\'is_nuit\', \'desc\')" '.CommonFun::sortClass($orderby, 'is_nuit').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('is_nuit').'</th>';
                                        echo '<th onclick="orderby(\'nuit_name\', \'desc\')" '.CommonFun::sortClass($orderby, 'nuit_name').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('nuit_name').'</th>';
                                        echo '<th onclick="orderby(\'nuit_code\', \'desc\')" '.CommonFun::sortClass($orderby, 'nuit_code').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('nuit_code').'</th>';
                                        echo '<th onclick="orderby(\'statistical_identification\', \'desc\')" '.CommonFun::sortClass($orderby, 'statistical_identification').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('statistical_identification').'</th>';
                                        echo '<th onclick="orderby(\'clue_code\', \'desc\')" '.CommonFun::sortClass($orderby, 'clue_code').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('clue_code').'</th>';
                                        echo '<th onclick="orderby(\'personnel_code\', \'desc\')" '.CommonFun::sortClass($orderby, 'personnel_code').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('personnel_code').'</th>';
                                        echo '<th onclick="orderby(\'person_reflected\', \'desc\')" '.CommonFun::sortClass($orderby, 'person_reflected').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('person_reflected').'</th>';
                                        echo '<th onclick="orderby(\'duty_job\', \'desc\')" '.CommonFun::sortClass($orderby, 'duty_job').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('duty_job').'</th>';
                                        echo '<th onclick="orderby(\'is_supervises_object\', \'desc\')" '.CommonFun::sortClass($orderby, 'is_supervises_object').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('is_supervises_object').'</th>';
                                        echo '<th onclick="orderby(\'rank_job\', \'desc\')" '.CommonFun::sortClass($orderby, 'rank_job').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('rank_job').'</th>';
                                        echo '<th onclick="orderby(\'recovers_economic_loss\', \'desc\')" '.CommonFun::sortClass($orderby, 'recovers_economic_loss').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('recovers_economic_loss').'</th>';
                                        echo '<th onclick="orderby(\'collects_amount\', \'desc\')" '.CommonFun::sortClass($orderby, 'collects_amount').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('collects_amount').'</th>';
                                        echo '<th onclick="orderby(\'handling_organ\', \'desc\')" '.CommonFun::sortClass($orderby, 'handling_organ').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('handling_organ').'</th>';
                                        echo '<th onclick="orderby(\'main_problem_clues\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('main_problem_clues').'</th>';
                                        echo '<th onclick="orderby(\'remarks\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('remarks').'</th>';
                                        echo '<th onclick="orderby(\'nation\', \'desc\')" '.CommonFun::sortClass($orderby, 'nation').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('nation').'</th>';
                                        echo '<th onclick="orderby(\'date_birth\', \'desc\')" '.CommonFun::sortClass($orderby, 'date_birth').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('date_birth').'</th>';
                                        echo '<th onclick="orderby(\'cpc\', \'desc\')" '.CommonFun::sortClass($orderby, 'cpc').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('cpc').'</th>';
                                        echo '<th onclick="orderby(\'cppcc\', \'desc\')" '.CommonFun::sortClass($orderby, 'cppcc').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('cppcc').'</th>';
                                        echo '<th onclick="orderby(\'disposal_report\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('disposal_report').'</th>';
                                        echo '<th onclick="orderby(\'time_joining_party\', \'desc\')" '.CommonFun::sortClass($orderby, 'time_joining_party').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('time_joining_party').'</th>';
                                        echo '<th onclick="orderby(\'authority_management\', \'desc\')" '.CommonFun::sortClass($orderby, 'authority_management').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('authority_management').'</th>';
                                        echo '<th onclick="orderby(\'acceptance_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'acceptance_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('acceptance_time').'</th>';
                                        echo '<th onclick="orderby(\'approval_time_one\', \'desc\')" '.CommonFun::sortClass($orderby, 'approval_time_one').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('approval_time_one').'</th>';
                                        echo '<th onclick="orderby(\'statistical_time_one\', \'desc\')" '.CommonFun::sortClass($orderby, 'statistical_time_one').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('statistical_time_one').'</th>';
                                        echo '<th onclick="orderby(\'one_level_first\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('one_level_first').'</th>';
                                        echo '<th onclick="orderby(\'one_level_second\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('one_level_second').'</th>';
                                        echo '<th onclick="orderby(\'approval_time_two\', \'desc\')" '.CommonFun::sortClass($orderby, 'approval_time_two').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('approval_time_two').'</th>';
                                        echo '<th onclick="orderby(\'statistical_time_two\', \'desc\')" '.CommonFun::sortClass($orderby, 'statistical_time_two').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('statistical_time_two').'</th>';
                                        echo '<th onclick="orderby(\'two_level_first\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('two_level_first').'</th>';
                                        echo '<th onclick="orderby(\'two_level_second\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('two_level_second').'</th>';
                                        echo '<th onclick="orderby(\'approval_time_three\', \'desc\')" '.CommonFun::sortClass($orderby, 'approval_time_three').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('approval_time_three').'</th>';
                                        echo '<th onclick="orderby(\'statistical_time_three\', \'desc\')" '.CommonFun::sortClass($orderby, 'statistical_time_three').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('statistical_time_three').'</th>';
                                        echo '<th onclick="orderby(\'three_level_first\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('three_level_first').'</th>';
                                        echo '<th onclick="orderby(\'three_level_second\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('three_level_second').'</th>';
                                        echo '<th onclick="orderby(\'cases_source\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('cases_source').'</th>';
                                        echo '<th onclick="orderby(\'disciplinary_offence\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('disciplinary_offence').'</th>';
                                        echo '<th onclick="orderby(\'is_checking_me\', \'desc\')" '.CommonFun::sortClass($orderby, 'is_checking_me').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('is_checking_me').'</th>';
                                        echo '<th onclick="orderby(\'is_party\', \'desc\')" '.CommonFun::sortClass($orderby, 'is_party').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('is_party').'</th>';
                                        echo '<th onclick="orderby(\'secondary_class_objects\', \'desc\')" '.CommonFun::sortClass($orderby, 'secondary_class_objects').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('secondary_class_objects').'</th>';
                                        echo '<th onclick="orderby(\'is_supervisory_objects\', \'desc\')" '.CommonFun::sortClass($orderby, 'is_supervisory_objects').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('is_supervisory_objects').'</th>';
                                        echo '<th onclick="orderby(\'no_secondary_class_objects\', \'desc\')" '.CommonFun::sortClass($orderby, 'no_secondary_class_objects').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('no_secondary_class_objects').'</th>';
                                        echo '<th onclick="orderby(\'official_offences\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('official_offences').'</th>';
                                        echo '<th onclick="orderby(\'other_offences\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('other_offences').'</th>';
                                        echo '<th onclick="orderby(\'organization_measure_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'organization_measure_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('organization_measure_time').'</th>';
                                        echo '<th onclick="orderby(\'superiors_assigned\', \'desc\')" '.CommonFun::sortClass($orderby, 'superiors_assigned').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('superiors_assigned').'</th>';
                                        echo '<th onclick="orderby(\'department_charge\', \'desc\')" '.CommonFun::sortClass($orderby, 'department_charge').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('department_charge').'</th>';

                                        echo '<th onclick="orderby(\'disposal_method\', \'desc\')" '.CommonFun::sortClass($orderby, 'disposal_method').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('disposal_method').'</th>';
                                        echo '<th onclick="orderby(\'volume_number\', \'desc\')" '.CommonFun::sortClass($orderby, 'volume_number').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('volume_number').'</th>';
                                        echo '<th onclick="orderby(\'id_card\', \'desc\')" '.CommonFun::sortClass($orderby, 'id_card').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('id_card').'</th>';
                                        echo '<th onclick="orderby(\'disposal_year\', \'desc\')" '.CommonFun::sortClass($orderby, 'disposal_year').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('disposal_year').'</th>';

                                        echo '<th onclick="orderby(\'create_date\', \'desc\')" '.CommonFun::sortClass($orderby, 'create_date').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('create_date').'</th>';
                                        echo '<th onclick="orderby(\'update_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'update_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$ThreadModelLabel->getAttributeLabel('update_time').'</th>';

                                        ?>

                                        <th tabindex="0" class="th-width-0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    foreach ($ThreadModels as $model) {
                                        echo '<tr id="rowid_' . $model->id . '">';
//                                        echo '  <td><label><input type="checkbox" value="' . $model->id . '"></label></td>';
                                        echo '  <td>' . $model->number . '</td>';
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
                                        echo '  <td>' . mb_substr($model->main_problem_clues, 0, 400) . '</td>';
                                        echo '  <td>' . mb_substr($model->remarks, 0, 400) . '</td>';
                                        echo '  <td>' . $model->nation . '</td>';
                                        echo '  <td>' . $model->date_birth . '</td>';
                                        echo '  <td>' . $model->cpc . '</td>';
                                        echo '  <td>' . $model->cppcc . '</td>';
                                        echo '  <td>' . mb_substr($model->disposal_report, 0, 400) . '</td>';
                                        echo '  <td>' . $model->time_joining_party . '</td>';
                                        echo '  <td>' . $model->authority_management . '</td>';
                                        echo '  <td>' . $model->acceptance_time . '</td>';
                                        echo '  <td>' . $model->approval_time_one . '</td>';
                                        echo '  <td>' . $model->statistical_time_one . '</td>';
                                        echo '  <td>' . mb_substr($model->one_level_first, 0, 400) . '</td>';
                                        echo '  <td>' . mb_substr($model->one_level_second, 0, 400) . '</td>';
                                        echo '  <td>' . $model->approval_time_two . '</td>';
                                        echo '  <td>' . $model->statistical_time_two . '</td>';
                                        echo '  <td>' . mb_substr($model->two_level_first, 0, 400) . '</td>';
                                        echo '  <td>' . mb_substr($model->two_level_second, 0, 400) . '</td>';
                                        echo '  <td>' . $model->approval_time_three . '</td>';
                                        echo '  <td>' . $model->statistical_time_three . '</td>';
                                        echo '  <td>' . mb_substr($model->three_level_first, 0, 400) . '</td>';
                                        echo '  <td>' . mb_substr($model->three_level_second, 0, 400) . '</td>';
                                        echo '  <td>' . mb_substr($model->cases_source, 0, 400) . '</td>';
                                        echo '  <td>' . mb_substr($model->disciplinary_offence, 0, 400) . '</td>';
                                        echo '  <td>' . $model->is_checking_me . '</td>';
                                        echo '  <td>' . $model->is_party . '</td>';
                                        echo '  <td>' . $model->secondary_class_objects . '</td>';
                                        echo '  <td>' . $model->is_supervisory_objects . '</td>';
                                        echo '  <td>' . $model->no_secondary_class_objects . '</td>';
                                        echo '  <td>' . mb_substr($model->official_offences, 0, 400) . '</td>';
                                        echo '  <td>' . mb_substr($model->other_offences, 0, 400) . '</td>';
                                        echo '  <td>' . $model->organization_measure_time . '</td>';
                                        echo '  <td>' . $model->superiors_assigned . '</td>';
                                        echo '  <td>' . $model->department_charge . '</td>';
                                        echo '  <td>' . $model->disposal_method . '</td>';
                                        echo '  <td>' . $model->volume_number . '</td>';
                                        echo '  <td>' . $model->id_card . '</td>';
                                        echo '  <td>' . $model->disposal_year . '</td>';
                                        echo '  <td>' . $model->create_date . '</td>';
                                        echo '  <td>' . $model->update_time . '</td>';
                                        echo '  <td class="center">';
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

                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row" <?php if (empty($RegisterModels)) echo "style='display: none;'";?>>
        <div class="col-xs-12">
            <div class="box">

                <div class="box-header">
                    <h3 class="box-title">案管立案查询结果</h3>

                    <!-- row start -->
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="data_table_info" role="status" aria-live="polite">
                                <div class="infos">
                                    从<?= $RegisterPages->getPage() * $RegisterPages->getPageSize() + 1 ?>            		到 <?= ($pageCount = ($RegisterPages->getPage() + 1) * $RegisterPages->getPageSize()) < $RegisterPages->totalCount ?  $pageCount : $RegisterPages->totalCount?>            		 共 <?= $RegisterPages->totalCount?> 条记录</div>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="data_table_paginate">
                                <?= LinkPager::widget([
                                    'pagination' => $RegisterPages,
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
                <!-- /.box-header -->

                <div class="box-body">
                    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap table-responsive">
                        <!-- row start -->
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="data_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="data_table_info">
                                    <thead class="text-nowrap">
                                    <tr role="row">

                                        <?php
                                        $orderby = isset($_GET['orderby']) ? $_GET['orderby'] : '';
//                                        echo '<th><input id="data_table_check" type="checkbox"></th>';
                                        echo '<th onclick="orderby(\'number\', \'desc\')" '.CommonFun::sortClass($orderby, 'number').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('number').'</th>';
                                        echo '<th onclick="orderby(\'nuit_name\', \'desc\')" '.CommonFun::sortClass($orderby, 'nuit_name').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('nuit_name').'</th>';
                                        echo '<th onclick="orderby(\'nuit_code\', \'desc\')" '.CommonFun::sortClass($orderby, 'nuit_code').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('nuit_code').'</th>';
                                        echo '<th onclick="orderby(\'is_nuit\', \'desc\')" '.CommonFun::sortClass($orderby, 'is_nuit').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('is_nuit').'</th>';
                                        echo '<th onclick="orderby(\'case_code\', \'desc\')" '.CommonFun::sortClass($orderby, 'case_code').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('case_code').'</th>';
                                        echo '<th onclick="orderby(\'personnel_code\', \'desc\')" '.CommonFun::sortClass($orderby, 'personnel_code').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('personnel_code').'</th>';
                                        echo '<th onclick="orderby(\'person_investigated\', \'desc\')" '.CommonFun::sortClass($orderby, 'person_investigated').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('person_investigated').'</th>';
                                        echo '<th onclick="orderby(\'credentials_type\', \'desc\')" '.CommonFun::sortClass($orderby, 'credentials_type').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('credentials_type').'</th>';
                                        echo '<th onclick="orderby(\'credentials_number\', \'desc\')" '.CommonFun::sortClass($orderby, 'credentials_number').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('credentials_number').'</th>';
                                        echo '<th onclick="orderby(\'sex\', \'desc\')" '.CommonFun::sortClass($orderby, 'sex').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('sex').'</th>';
                                        echo '<th onclick="orderby(\'age\', \'desc\')" '.CommonFun::sortClass($orderby, 'age').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('age').'</th>';
                                        echo '<th onclick="orderby(\'date_birth\', \'desc\')" '.CommonFun::sortClass($orderby, 'date_birth').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('date_birth').'</th>';
                                        echo '<th onclick="orderby(\'academic\', \'desc\')" '.CommonFun::sortClass($orderby, 'academic').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('academic').'</th>';
                                        echo '<th onclick="orderby(\'nation\', \'desc\')" '.CommonFun::sortClass($orderby, 'nation').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('nation').'</th>';
                                        echo '<th onclick="orderby(\'is_supervises_object\', \'desc\')" '.CommonFun::sortClass($orderby, 'is_supervises_object').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('is_supervises_object').'</th>';
                                        echo '<th onclick="orderby(\'supervises_object_details\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('supervises_object_details').'</th>';
                                        echo '<th onclick="orderby(\'is_party\', \'desc\')" '.CommonFun::sortClass($orderby, 'is_party').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('is_party').'</th>';
                                        echo '<th onclick="orderby(\'party_delegate\', \'desc\')" '.CommonFun::sortClass($orderby, 'party_delegate').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('party_delegate').'</th>';
                                        echo '<th onclick="orderby(\'disposal_report\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('disposal_report').'</th>';
                                        echo '<th onclick="orderby(\'time_joining_party\', \'desc\')" '.CommonFun::sortClass($orderby, 'time_joining_party').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('time_joining_party').'</th>';
                                        echo '<th onclick="orderby(\'no_party_objects\', \'desc\')" '.CommonFun::sortClass($orderby, 'no_party_objects').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('no_party_objects').'</th>';
                                        echo '<th onclick="orderby(\'no_party_objects_details\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('no_party_objects_details').'</th>';
                                        echo '<th onclick="orderby(\'cpc\', \'desc\')" '.CommonFun::sortClass($orderby, 'cpc').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('cpc').'</th>';
                                        echo '<th onclick="orderby(\'cppcc\', \'desc\')" '.CommonFun::sortClass($orderby, 'cppcc').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('cppcc').'</th>';
                                        echo '<th onclick="orderby(\'discipline_commission\', \'desc\')" '.CommonFun::sortClass($orderby, 'discipline_commission').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('discipline_commission').'</th>';
                                        echo '<th onclick="orderby(\'party_commission\', \'desc\')" '.CommonFun::sortClass($orderby, 'party_commission').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('party_commission').'</th>';
                                        echo '<th onclick="orderby(\'on_job_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'on_job_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('on_job_time').'</th>';
                                        echo '<th onclick="orderby(\'head_violating\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('head_violating').'</th>';
                                        echo '<th onclick="orderby(\'head_details\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('head_details').'</th>';
                                        echo '<th onclick="orderby(\'head_details_two\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('head_details_two').'</th>';
                                        echo '<th onclick="orderby(\'rank_job\', \'desc\')" '.CommonFun::sortClass($orderby, 'rank_job').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('rank_job').'</th>';
                                        echo '<th onclick="orderby(\'deputy_rank_job\', \'desc\')" '.CommonFun::sortClass($orderby, 'deputy_rank_job').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('deputy_rank_job').'</th>';
                                        echo '<th onclick="orderby(\'duty_job\', \'desc\')" '.CommonFun::sortClass($orderby, 'duty_job').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('duty_job').'</th>';
                                        echo '<th onclick="orderby(\'authority_management\', \'desc\')" '.CommonFun::sortClass($orderby, 'authority_management').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('authority_management').'</th>';
                                        echo '<th onclick="orderby(\'department_class\', \'desc\')" '.CommonFun::sortClass($orderby, 'department_class').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('department_class').'</th>';
                                        echo '<th onclick="orderby(\'department_class_one\', \'desc\')" '.CommonFun::sortClass($orderby, 'department_class_one').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('department_class_one').'</th>';
                                        echo '<th onclick="orderby(\'department_classtwo\', \'desc\')" '.CommonFun::sortClass($orderby, 'department_classtwo').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('department_classtwo').'</th>';
                                        echo '<th onclick="orderby(\'nature_enterprise\', \'desc\')" '.CommonFun::sortClass($orderby, 'nature_enterprise').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('nature_enterprise').'</th>';
                                        echo '<th onclick="orderby(\'nature_enterprise_one\', \'desc\')" '.CommonFun::sortClass($orderby, 'nature_enterprise_one').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('nature_enterprise_one').'</th>';
                                        echo '<th onclick="orderby(\'category_enterprise_personnel\', \'desc\')" '.CommonFun::sortClass($orderby, 'category_enterprise_personnel').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('category_enterprise_personnel').'</th>';
                                        echo '<th onclick="orderby(\'enterprise_post\', \'desc\')" '.CommonFun::sortClass($orderby, 'enterprise_post').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('enterprise_post').'</th>';
                                        echo '<th onclick="orderby(\'jobbery_lose\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('jobbery_lose').'</th>';
                                        echo '<th onclick="orderby(\'discipline_amount\', \'desc\')" '.CommonFun::sortClass($orderby, 'discipline_amount').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('discipline_amount').'</th>';
                                        echo '<th onclick="orderby(\'case_amount\', \'desc\')" '.CommonFun::sortClass($orderby, 'case_amount').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('case_amount').'</th>';
                                        echo '<th onclick="orderby(\'filing_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'filing_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('filing_time').'</th>';
                                        echo '<th onclick="orderby(\'source_case\', \'desc\')" '.CommonFun::sortClass($orderby, 'source_case').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('source_case').'</th>';
                                        echo '<th onclick="orderby(\'discipline_organ\', \'desc\')" '.CommonFun::sortClass($orderby, 'discipline_organ').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('discipline_organ').'</th>';
                                        echo '<th onclick="orderby(\'discipline_organ_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'discipline_organ_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('discipline_organ_time').'</th>';
                                        echo '<th onclick="orderby(\'discipline_organ_stats_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'discipline_organ_stats_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('discipline_organ_stats_time').'</th>';
                                        echo '<th onclick="orderby(\'supervise_register_organ\', \'desc\')" '.CommonFun::sortClass($orderby, 'supervise_register_organ').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('supervise_register_organ').'</th>';
                                        echo '<th onclick="orderby(\'supervise_register_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'supervise_register_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('supervise_register_time').'</th>';
                                        echo '<th onclick="orderby(\'supervise_register_statistics_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'supervise_register_statistics_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('supervise_register_statistics_time').'</th>';
                                        echo '<th onclick="orderby(\'is_discipline_transfer\', \'desc\')" '.CommonFun::sortClass($orderby, 'is_discipline_transfer').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('is_discipline_transfer').'</th>';
                                        echo '<th onclick="orderby(\'other_discipline_method\', \'desc\')" '.CommonFun::sortClass($orderby, 'other_discipline_method').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('other_discipline_method').'</th>';
                                        echo '<th onclick="orderby(\'transfer_unit\', \'desc\')" '.CommonFun::sortClass($orderby, 'transfer_unit').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('transfer_unit').'</th>';
                                        echo '<th onclick="orderby(\'brief_case_report\', \'desc\')" class="th-width-2" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('brief_case_report').'</th>';
                                        echo '<th onclick="orderby(\'register_report\', \'desc\')" class="th-width-2" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('register_report').'</th>';
                                        echo '<th onclick="orderby(\'register_decide_book\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('register_decide_book').'</th>';
                                        echo '<th onclick="orderby(\'remarks\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('remarks').'</th>';
                                        echo '<th onclick="orderby(\'is_violate_stipulate\', \'desc\')" '.CommonFun::sortClass($orderby, 'is_violate_stipulate').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('is_violate_stipulate').'</th>';
                                        echo '<th onclick="orderby(\'is_accountabilitye\', \'desc\')" '.CommonFun::sortClass($orderby, 'is_accountabilitye').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('is_accountabilitye').'</th>';
                                        echo '<th onclick="orderby(\'end_case_stat_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'end_case_stat_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('end_case_stat_time').'</th>';
                                        echo '<th onclick="orderby(\'close_case_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'close_case_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('close_case_time').'</th>';
                                        echo '<th onclick="orderby(\'end_case_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'end_case_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('end_case_time').'</th>';
                                        echo '<th onclick="orderby(\'accountability\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('accountability').'</th>';
                                        echo '<th onclick="orderby(\'party_discipline\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('party_discipline').'</th>';
                                        echo '<th onclick="orderby(\'party_discipline_stats_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'party_discipline_stats_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('party_discipline_stats_time').'</th>';
                                        echo '<th onclick="orderby(\'administrative_sanction\', \'desc\')" '.CommonFun::sortClass($orderby, 'administrative_sanction').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('administrative_sanction').'</th>';
                                        echo '<th onclick="orderby(\'administrative_sanction_stats_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'administrative_sanction_stats_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('administrative_sanction_stats_time').'</th>';
                                        echo '<th onclick="orderby(\'other_treatments\', \'desc\')" '.CommonFun::sortClass($orderby, 'other_treatments').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('other_treatments').'</th>';
                                        echo '<th onclick="orderby(\'other_treatments_stats_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'other_treatments_stats_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('other_treatments_stats_time').'</th>';
                                        echo '<th onclick="orderby(\'transfer_justice_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'transfer_justice_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('transfer_justice_time').'</th>';
                                        echo '<th onclick="orderby(\'transfer_justice_stats_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'transfer_justice_stats_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('transfer_justice_stats_time').'</th>';
                                        echo '<th onclick="orderby(\'public_inspection_processing\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('public_inspection_processing').'</th>';
                                        echo '<th onclick="orderby(\'public_inspection_processing_detail\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('public_inspection_processing_detail').'</th>';
                                        echo '<th onclick="orderby(\'punishments_number_years\', \'desc\')" '.CommonFun::sortClass($orderby, 'punishments_number_years').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('punishments_number_years').'</th>';
                                        echo '<th onclick="orderby(\'punishments_number_month\', \'desc\')" '.CommonFun::sortClass($orderby, 'punishments_number_month').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('punishments_number_month').'</th>';
                                        echo '<th onclick="orderby(\'probation_number_years\', \'desc\')" '.CommonFun::sortClass($orderby, 'probation_number_years').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('probation_number_years').'</th>';
                                        echo '<th onclick="orderby(\'probation_number_month\', \'desc\')" '.CommonFun::sortClass($orderby, 'probation_number_month').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('probation_number_month').'</th>';
                                        echo '<th onclick="orderby(\'public_inspection_processing_stats_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'public_inspection_processing_stats_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('public_inspection_processing_stats_time').'</th>';
                                        echo '<th onclick="orderby(\'retrieve_loss\', \'desc\')" '.CommonFun::sortClass($orderby, 'retrieve_loss').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('retrieve_loss').'</th>';
                                        echo '<th onclick="orderby(\'capture_amount\', \'desc\')" '.CommonFun::sortClass($orderby, 'capture_amount').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('capture_amount').'</th>';
                                        echo '<th onclick="orderby(\'first_violations_discipline_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'first_violations_discipline_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('first_violations_discipline_time').'</th>';
                                        echo '<th onclick="orderby(\'last_violations_discipline_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'last_violations_discipline_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('last_violations_discipline_time').'</th>';
                                        echo '<th onclick="orderby(\'violation_discipline_happen_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'violation_discipline_happen_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('violation_discipline_happen_time').'</th>';
                                        echo '<th onclick="orderby(\'desert_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'desert_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('desert_time').'</th>';
                                        echo '<th onclick="orderby(\'desert_stats_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'desert_stats_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('desert_stats_time').'</th>';
                                        echo '<th onclick="orderby(\'hear_accept_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'hear_accept_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('hear_accept_time').'</th>';
                                        echo '<th onclick="orderby(\'hear_accept_stats_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'hear_accept_stats_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('hear_accept_stats_time').'</th>';
                                        echo '<th onclick="orderby(\'hear_office\', \'desc\')" '.CommonFun::sortClass($orderby, 'hear_office').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('hear_office').'</th>';
                                        echo '<th onclick="orderby(\'hear_end_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'hear_end_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('hear_end_time').'</th>';
                                        echo '<th onclick="orderby(\'hear_end_stats_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'hear_end_stats_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('hear_end_stats_time').'</th>';
                                        echo '<th onclick="orderby(\'punish_decide\', \'desc\')" '.CommonFun::sortClass($orderby, 'punish_decide').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('punish_decide').'</th>';
                                        echo '<th onclick="orderby(\'police_handle_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'police_handle_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('police_handle_time').'</th>';
                                        echo '<th onclick="orderby(\'judicial_judgment_amount\', \'desc\')" '.CommonFun::sortClass($orderby, 'judicial_judgment_amount').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('judicial_judgment_amount').'</th>';
                                        echo '<th onclick="orderby(\'investigation_report\', \'desc\')" class="th-width-2" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('investigation_report').'</th>';
                                        echo '<th onclick="orderby(\'trial_report\', \'desc\')" class="th-width-2" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('trial_report').'</th>';
                                        echo '<th onclick="orderby(\'case_analysis\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('case_analysis').'</th>';
                                        echo '<th onclick="orderby(\'party_watch_limit\', \'desc\')" '.CommonFun::sortClass($orderby, 'party_watch_limit').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('party_watch_limit').'</th>';
                                        echo '<th onclick="orderby(\'enterprise_level\', \'desc\')" '.CommonFun::sortClass($orderby, 'enterprise_level').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('enterprise_level').'</th>';
                                        echo '<th onclick="orderby(\'flight_direction\', \'desc\')" '.CommonFun::sortClass($orderby, 'flight_direction').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('flight_direction').'</th>';
                                        echo '<th onclick="orderby(\'flight_direction_details\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('flight_direction_details').'</th>';
                                        echo '<th onclick="orderby(\'investigation_suspension_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'investigation_suspension_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('investigation_suspension_time').'</th>';
                                        echo '<th onclick="orderby(\'investigation_suspension_stats_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'investigation_suspension_stats_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('investigation_suspension_stats_time').'</th>';
                                        echo '<th onclick="orderby(\'administrative_sanctions_suspension_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'administrative_sanctions_suspension_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('administrative_sanctions_suspension_time').'</th>';
                                        echo '<th onclick="orderby(\'administrative_sanctions_suspension_stats_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'administrative_sanctions_suspension_stats_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('administrative_sanctions_suspension_stats_time').'</th>';
                                        echo '<th onclick="orderby(\'seizure_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'seizure_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('seizure_time').'</th>';
                                        echo '<th onclick="orderby(\'seizure_stats_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'seizure_stats_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('seizure_stats_time').'</th>';
                                        echo '<th onclick="orderby(\'case_analysis_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'case_analysis_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('case_analysis_time').'</th>';
                                        echo '<th onclick="orderby(\'disciplinary_offence\', \'desc\')" '.CommonFun::sortClass($orderby, 'disciplinary_offence').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('disciplinary_offence').'</th>';
                                        echo '<th onclick="orderby(\'post_disciplinary_offence\', \'desc\')" '.CommonFun::sortClass($orderby, 'post_disciplinary_offence').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('post_disciplinary_offence').'</th>';
                                        echo '<th onclick="orderby(\'other_disciplinary_offence\', \'desc\')" '.CommonFun::sortClass($orderby, 'other_disciplinary_offence').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('other_disciplinary_offence').'</th>';
                                        echo '<th onclick="orderby(\'organs_take_measures\', \'desc\')" '.CommonFun::sortClass($orderby, 'organs_take_measures').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('organs_take_measures').'</th>';
                                        echo '<th onclick="orderby(\'organs_take_measures_name\', \'desc\')" '.CommonFun::sortClass($orderby, 'organs_take_measures_name').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('organs_take_measures_name').'</th>';
                                        echo '<th onclick="orderby(\'starting_detention_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'starting_detention_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('starting_detention_time').'</th>';
                                        echo '<th onclick="orderby(\'starting_detention_stats_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'starting_detention_stats_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('starting_detention_stats_time').'</th>';
                                        echo '<th onclick="orderby(\'location_measures_taken\', \'desc\')" '.CommonFun::sortClass($orderby, 'location_measures_taken').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('location_measures_taken').'</th>';
                                        echo '<th onclick="orderby(\'location_measures_taken_class\', \'desc\')" '.CommonFun::sortClass($orderby, 'location_measures_taken_class').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('location_measures_taken_class').'</th>';
                                        echo '<th onclick="orderby(\'lien_approval_situation\', \'desc\')" '.CommonFun::sortClass($orderby, 'lien_approval_situation').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('lien_approval_situation').'</th>';
                                        echo '<th onclick="orderby(\'lien_end_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'lien_end_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('lien_end_time').'</th>';
                                        echo '<th onclick="orderby(\'lien_end_stats_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'lien_end_stats_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('lien_end_stats_time').'</th>';
                                        echo '<th onclick="orderby(\'lien_number_days\', \'desc\')" '.CommonFun::sortClass($orderby, 'lien_number_days').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('lien_number_days').'</th>';
                                        echo '<th onclick="orderby(\'is_delay\', \'desc\')" '.CommonFun::sortClass($orderby, 'is_delay').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('is_delay').'</th>';
                                        echo '<th onclick="orderby(\'delay_number_days\', \'desc\')" '.CommonFun::sortClass($orderby, 'delay_number_days').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('delay_number_days').'</th>';
                                        echo '<th onclick="orderby(\'delay_approval_situation\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('delay_approval_situation').'</th>';
                                        echo '<th onclick="orderby(\'organization_measure\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('organization_measure').'</th>';
                                        echo '<th onclick="orderby(\'organization_measure_stats_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'organization_measure_stats_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('organization_measure_stats_time').'</th>';
                                        echo '<th onclick="orderby(\'amount_transferred_judicial_organs\', \'desc\')" '.CommonFun::sortClass($orderby, 'amount_transferred_judicial_organs').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('amount_transferred_judicial_organs').'</th>';
                                        echo '<th onclick="orderby(\'two_rule_start_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'two_rule_start_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('two_rule_start_time').'</th>';
                                        echo '<th onclick="orderby(\'two_rule_stats_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'two_rule_stats_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('two_rule_stats_time').'</th>';
                                        echo '<th onclick="orderby(\'two_rule_remove_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'two_rule_remove_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('two_rule_remove_time').'</th>';
                                        echo '<th onclick="orderby(\'two_rule_remove_stats_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'two_rule_remove_stats_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('two_rule_remove_stats_time').'</th>';
                                        echo '<th onclick="orderby(\'confessional_books\', \'desc\')" class="th-width-1" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('confessional_books').'</th>';
                                        echo '<th onclick="orderby(\'department_charge\', \'desc\')" '.CommonFun::sortClass($orderby, 'department_charge').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('department_charge').'</th>';
                                        echo '<th onclick="orderby(\'superiors_assigned\', \'desc\')" '.CommonFun::sortClass($orderby, 'superiors_assigned').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('superiors_assigned').'</th>';

                                        echo '<th onclick="orderby(\'disposal_method\', \'desc\')" '.CommonFun::sortClass($orderby, 'disposal_method').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('disposal_method').'</th>';
                                        echo '<th onclick="orderby(\'volume_number\', \'desc\')" '.CommonFun::sortClass($orderby, 'volume_number').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('volume_number').'</th>';
                                        echo '<th onclick="orderby(\'id_card\', \'desc\')" '.CommonFun::sortClass($orderby, 'id_card').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('id_card').'</th>';
                                        echo '<th onclick="orderby(\'disposal_year\', \'desc\')" '.CommonFun::sortClass($orderby, 'disposal_year').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('disposal_year').'</th>';

                                        echo '<th onclick="orderby(\'create_date\', \'desc\')" '.CommonFun::sortClass($orderby, 'create_date').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('create_date').'</th>';
                                        echo '<th onclick="orderby(\'update_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'update_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$RegisterModelLabel->getAttributeLabel('update_time').'</th>';

                                        ?>

                                        <th tabindex="0" class="th-width-0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    foreach ($RegisterModels as $model) {
                                        echo '<tr id="rowid_' . $model->id . '">';
//                                        echo '  <td><label><input type="checkbox" value="' . $model->id . '"></label></td>';
                                        echo '  <td>' . $model->number . '</td>';
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
                                        echo '  <td>' . mb_substr($model->supervises_object_details, 0, 400) . '</td>';
                                        echo '  <td>' . $model->is_party . '</td>';
                                        echo '  <td>' . $model->party_delegate . '</td>';
                                        echo '  <td>' . mb_substr($model->disposal_report, 0, 400) . '</td>';
                                        echo '  <td>' . $model->time_joining_party . '</td>';
                                        echo '  <td>' . $model->no_party_objects . '</td>';
                                        echo '  <td>' . mb_substr($model->no_party_objects_details, 0, 400) . '</td>';
                                        echo '  <td>' . $model->cpc . '</td>';
                                        echo '  <td>' . $model->cppcc . '</td>';
                                        echo '  <td>' . $model->discipline_commission . '</td>';
                                        echo '  <td>' . $model->party_commission . '</td>';
                                        echo '  <td>' . $model->on_job_time . '</td>';
                                        echo '  <td>' . mb_substr($model->head_violating, 0, 400) . '</td>';
                                        echo '  <td>' . mb_substr($model->head_details, 0, 400) . '</td>';
                                        echo '  <td>' . mb_substr($model->head_details_two, 0, 400) . '</td>';
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
                                        echo '  <td>' . mb_substr($model->jobbery_lose, 0, 400) . '</td>';
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
                                        echo '  <td>' . mb_substr($model->brief_case_report, 0, 3000) . '</td>';
                                        echo '  <td>' . mb_substr($model->register_report, 0, 3000) . '</td>';
                                        echo '  <td>' . mb_substr($model->register_decide_book, 0, 400) . '</td>';
                                        echo '  <td>' . mb_substr($model->remarks, 0, 400) . '</td>';
                                        echo '  <td>' . $model->is_violate_stipulate . '</td>';;
                                        echo '  <td>' . $model->is_accountabilitye . '</td>';
                                        echo '  <td>' . $model->end_case_stat_time . '</td>';
                                        echo '  <td>' . $model->close_case_time . '</td>';
                                        echo '  <td>' . $model->end_case_time . '</td>';
                                        echo '  <td>' . mb_substr($model->accountability, 0, 400) . '</td>';
                                        echo '  <td>' . mb_substr($model->party_discipline, 0, 400) . '</td>';
                                        echo '  <td>' . $model->party_discipline_stats_time . '</td>';
                                        echo '  <td>' . mb_substr($model->administrative_sanction, 0, 400) . '</td>';
                                        echo '  <td>' . $model->administrative_sanction_stats_time . '</td>';
                                        echo '  <td>' . $model->other_treatments . '</td>';
                                        echo '  <td>' . $model->other_treatments_stats_time . '</td>';
                                        echo '  <td>' . $model->transfer_justice_time . '</td>';
                                        echo '  <td>' . $model->transfer_justice_stats_time . '</td>';
                                        echo '  <td>' . mb_substr($model->public_inspection_processing, 0, 400) . '</td>';
                                        echo '  <td>' . mb_substr($model->public_inspection_processing_detail, 0, 400) . '</td>';
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
                                        echo '  <td>' . mb_substr($model->investigation_report, 0, 3000) . '</td>';
                                        echo '  <td>' . mb_substr($model->trial_report, 0, 3000) . '</td>';
                                        echo '  <td>' . mb_substr($model->case_analysis, 0, 400) . '</td>';
                                        echo '  <td>' . $model->party_watch_limit . '</td>';
                                        echo '  <td>' . $model->enterprise_level . '</td>';
                                        echo '  <td>' . $model->flight_direction . '</td>';
                                        echo '  <td>' . mb_substr($model->flight_direction_details, 0, 400) . '</td>';
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
                                        echo '  <td>' . mb_substr($model->delay_approval_situation, 0, 400) . '</td>';
                                        echo '  <td>' . mb_substr($model->organization_measure, 0, 400) . '</td>';
                                        echo '  <td>' . $model->organization_measure_stats_time . '</td>';
                                        echo '  <td>' . $model->amount_transferred_judicial_organs . '</td>';
                                        echo '  <td>' . $model->two_rule_start_time . '</td>';
                                        echo '  <td>' . $model->two_rule_stats_time . '</td>';
                                        echo '  <td>' . $model->two_rule_remove_time . '</td>';
                                        echo '  <td>' . $model->two_rule_remove_stats_time . '</td>';
                                        echo '  <td>' . mb_substr($model->confessional_books, 0, 400) . '</td>';
                                        echo '  <td>' . $model->department_charge . '</td>';
                                        echo '  <td>' . $model->superiors_assigned . '</td>';
                                        echo '  <td>' . $model->disposal_method . '</td>';
                                        echo '  <td>' . $model->volume_number . '</td>';
                                        echo '  <td>' . $model->id_card . '</td>';
                                        echo '  <td>' . $model->disposal_year . '</td>';
                                        echo '  <td>' . $model->create_date . '</td>';
                                        echo '  <td>' . $model->update_time . '</td>';
                                        echo '  <td class="center">';

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


<?php $this->beginBlock('footer');  ?>
<!-- <body></body>后代码块 -->
 <script>

 function searchAction(){
		$('#qinlian-unique-search-form').submit();
	}
 </script>
<?php $this->endBlock(); ?>
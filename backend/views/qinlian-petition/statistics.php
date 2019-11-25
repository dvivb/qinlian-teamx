
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;
use backend\assets\AppAsset;

use backend\models\QinlianPetition;

$modelLabel = new \backend\models\QinlianPetition();
?>

<?php $this->beginBlock('header');  ?>
<script src="<?=Url::base()?>/plugins/echarts/echarts.min.js"></script>
<script src="<?=Url::base()?>/plugins/echarts/echarts.shine.js"></script>
<!-- <head>
</head>中代码块 -->

<?php $this->endBlock(); ?>

<!-- Main content -->
<section class="content">

    <div class="col-md-12">

        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">搜索条件</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="<?=Url::toRoute('qinlian-petition/statistics')?>" method="post">
                <div class="box-body">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="clue_level" class="col-sm-2 control-label">政治面貌</label>

                            <div class="col-sm-8">
                                <select class="form-control" name="political_appearance" id="political_appearance" class="form-control">
                                    <option value="">全部</option>
                                    <option>党员</option>
                                    <option>非党员</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="clue_category" class="col-sm-2 control-label">职务</label>

                            <div class="col-sm-8">
                                <select class="form-control" name="duty_job" id="duty_job" class="form-control">
                                    <option value="">全部</option>
                                    <option>一般干部</option>
                                    <option>乡科级</option>
                                    <option>农村干部 </option>
                                    <option>股级 </option>
                                    <option>农村其他人员 </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="rank_job" class="col-sm-2 control-label">职级</label>

                            <div class="col-sm-8">
                                <select class="form-control" name="rank_job" id="rank_job" class="form-control">
                                    <option value="">全部</option>
                                    <option>一级</option>
                                    <option>二级</option>
                                    <option>三级</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="duty_job" class="col-sm-2 control-label">承办科室</label>

                            <div class="col-sm-8">
                                <select class="form-control" name="host_department" id="host_department" class="form-control">
                                    <option value="">全部</option>
                                    <?php

                                    foreach ($departments as $department) {
//                                        if ($query["host_department"]== $department->department){
//                                            echo '<option selected>'. $query["host_department"] .'</option>';
//                                        }else{
                                            echo '  <option>' . $department->department . '</option>';
//                                        }
                                    }
                                    ?>
                                </select>

                            </div>
                        </div>

                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="incoming_time" class="col-sm-2 control-label">收件时间</label>

<!--                            <div class="col-sm-8">-->
<!--                                <input type="text" class="form-control" name="receipt_time" id="receipt_time" data-provide="datepicker" data-date-format="yyyy-mm">-->
<!--                                -->
<!--                            </div>-->
                            <div class="input-daterange input-group" id="datepicker">
                                <input type="text" class="input-sm form-control" name="start_time" data-provide="datepicker" data-date-format="yyyy-mm"/>
                                <span class="input-group-addon">to</span>
                                <input type="text" class="input-sm form-control" name="end_time" data-provide="datepicker" data-date-format="yyyy-mm"/>
                            </div>
                            <!-- /.input group -->
                        </div>

                        <div class="form-group">
                            <label for="approval_time" class="col-sm-2 control-label">审批时间</label>

                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="approval_time" name="approval_time" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd"  />
                            </div>
                        </div>
                    </div>


                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-success pull-right">搜索</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
        <!-- /.box -->

    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div id="main" style="width: 1000px;height:600px;"></div>
            </div>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div id="main-b" style="width: 1000px;height:600px;"></div>
            </div>
        </div>
    </div>
    <!-- /.row -->

</section>
<!-- /.content -->


<?php $this->beginBlock('footer');  ?>

<!-- <body></body>后代码块 -->
<script type="text/javascript">
    $('#sandbox-container .input-daterange').datepicker({
        language: "zh-CN",
        autoclose: true
    });



    var app = echarts.init(document.getElementById('main'));

    app.title = '折线图';

    option = {

        title : {
            text: '信访承办科室柱状图',
        },
        tooltip : {
            trigger: 'axis'
        },
        legend: {
            data: <?php echo json_encode($data['name'],true);?>
        },
        toolbox: {
            show : true,
            feature : {
                dataView : {show: true, readOnly: false},
                magicType : {show: true, type: ['line', 'bar']},
                restore : {show: true},
                saveAsImage : {show: true}
            }
        },
        calculable : true,
        xAxis : [
            {
                type : 'category',
                data : <?php echo json_encode($data['category'],true);?>
            }
        ],
        yAxis : [
            {
                type : 'value'
            }
        ],
        series : <?php echo json_encode($data['series_bar'],true);?>
    };



    // 使用刚指定的配置项和数据显示图表。
    app.setOption(option);


    var appb = echarts.init(document.getElementById('main-b'));

    appb.title = '折线图';

    option = {
        title: {
            text: '信访件数量折线图'
        },
        tooltip: {
            trigger: 'axis'
        },
        legend: {
            data:<?php echo json_encode($data['name'],true);?>
        },
        toolbox: {
            show : true,
            feature : {
                dataView : {show: true, readOnly: false},
                magicType : {show: true, type: ['line', 'bar']},
                restore : {show: true},
                saveAsImage : {show: true}
            }
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        toolbox: {
            show : true,
            feature : {
                dataView : {show: true, readOnly: false},
                magicType : {show: true, type: ['line', 'bar']},
                restore : {show: true},
                saveAsImage : {show: true}
            }
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data : <?php echo json_encode($data['category'],true);?>
        },
        yAxis: {
            type: 'value'
        },
        series: <?php echo json_encode($data['series_line'],true);?>
    };




    // 使用刚指定的配置项和数据显示图表。
    appb.setOption(option);
</script>


<?php $this->endBlock(); ?>
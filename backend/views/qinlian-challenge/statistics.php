
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
            <form class="form-horizontal" action="<?=Url::toRoute('qinlian-challenge/statistics')?>" method="post">
                <div class="box-body">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="clue_level" class="col-sm-2 control-label">线索级别</label>

                            <div class="col-sm-8">
                                <select class="form-control" name="clue_level" id="clue_level" class="form-control">
                                    <option value="">全部</option>
                                    <option value="一级">一级</option>
                                    <option value="二级">二级</option>
                                    <option value="三级">三级</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="clue_category" class="col-sm-2 control-label">线索类别</label>

                            <div class="col-sm-8">
                                <select class="form-control" name="clue_category" id="clue_category" class="form-control">
                                    <option value="">全部</option>
                                    <option value="一般">一般</option>
                                    <option value="违纪">违纪</option>
                                    <option value="违法">违法</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="duty_job" class="col-sm-2 control-label">职级</label>

                            <div class="col-sm-8">
                                <select class="form-control" name="duty_job" id="duty_job" class="form-control">
                                    <option value="">全部</option>
                                    <option value="一级">一级</option>
                                    <option value="二级">二级</option>
                                    <option value="三级">三级</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="transfer_organ" class="col-sm-2 control-label">案件进度</label>

                            <div class="col-sm-8">
                                <select class="form-control" name="progress_case" id="progress_case" class="form-control">
                                    <option value="">全部</option>
                                    <option>完成</option>
                                    <option>未完成</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="incoming_time" class="col-sm-2 control-label">来件时间</label>

                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="incoming_time" id="incoming_time" data-provide="datepicker" data-date-format="yyyy-mm">
                            </div>
                            <!-- /.input group -->
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

    var app = echarts.init(document.getElementById('main'));

    app.title = '折线图';

    option = {

        title : {
            text: '案件进度柱状图',
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
            text: '案管问题线索数量折线图'
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

<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;
use backend\assets\AppAsset;

use backend\models\QinlianRegister;

$modelLabel = new \backend\models\QinlianRegister();
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
            <form class="form-horizontal" action="<?=Url::toRoute('qinlian-register/statistics')?>" method="post">
                <div class="box-body">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="is_discipline_transfer" class="col-sm-4 control-label">是否其他纪检监察机关立案后移送</label>

                            <div class="col-sm-8">
                                <select class="form-control" name="is_discipline_transfer" id="is_discipline_transfer" class="form-control">
                                    <option value="-1">全部</option>
                                    <option value="0">未知</option>
                                    <option value="1">党员</option>
                                    <option value="2">非党员</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="is_supervises_object" class="col-sm-4 control-label">否国家监察对象</label>

                            <div class="col-sm-8">
                                <select class="form-control" name="is_supervises_object" id="is_supervises_object" class="form-control">
                                    <option value="-1">全部</option>
                                    <option value="0">未知</option>
                                    <option value="1">是</option>
                                    <option value="2"> 否</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="disciplinary_offence" class="col-sm-4 control-label">违纪行为</label>

                            <div class="col-sm-8">
                                <select class="form-control" name="disciplinary_offence" id="disciplinary_offence" class="form-control">
                                    <option value="-1">全部</option>
                                    <option value="1">一般</option>
                                    <option value="2">违纪</option>
                                    <option value="3">违法</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="duty_job" class="col-sm-2 control-label">职级</label>

                            <div class="col-sm-8">
                                <select class="form-control" name="duty_job" id="duty_job" class="form-control">
                                    <option value="-1">全部</option>
                                    <option value="1">一级</option>
                                    <option value="2">二级</option>
                                    <option value="3">三级</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="academic" class="col-sm-2 control-label">学历</label>

                            <div class="col-sm-8">
                                <select class="form-control" name="academic" id="academic" class="form-control">
                                    <option value="-1">全部</option>
                                    <option value="0">未知</option>
                                    <option value="1">高中</option>
                                    <option value="2">大专</option>
                                    <option value="3">本科</option>
                                    <option value="4">研究</option>
                                    <option value="5">博士</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="discipline_organ_time" class="col-sm-2 control-label">纪委立案时间</label>

                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="discipline_organ_time" id="discipline_organ_time" data-provide="datepicker" data-date-format="yyyy-mm">
                            </div>
                            <!-- /.input group -->
                        </div>

                        <div class="form-group">
                            <label for="seizure_time" class="col-sm-2 control-label">结案时间</label>

                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="end_case_time" name="end_case_time" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm"  />
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

    var app = echarts.init(document.getElementById('main'));

    app.title = '折线图';

    option = {
        title: {
            text: '案管立案数量折线图'
        },
        tooltip: {
            trigger: 'axis'
        },
        legend: {
            data:['科室一','科室二','科室三']
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        toolbox: {
            feature: {
                saveAsImage: {}
            }
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data : ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月']
        },
        yAxis: {
            type: 'value'
        },
        series: [
            {
                name:'科室一',
                type:'line',
                stack: '总量',
                data:[120, 132, 101, 134, 90, 230, 210]
            },
            {
                name:'科室二',
                type:'line',
                stack: '总量',
                data:[220, 182, 191, 234, 290, 330, 310]
            },
            {
                name:'科室三',
                type:'line',
                stack: '总量',
                data:[150, 232, 201, 154, 190, 330, 410]
            },
        ]
    };



    // 使用刚指定的配置项和数据显示图表。
    app.setOption(option);


    var appb = echarts.init(document.getElementById('main-b'));

    appb.title = '折线图';

    option = {
        title: {
            text: '案管结案数量折线图'
        },
        tooltip: {
            trigger: 'axis'
        },
        legend: {
            data:['科室一','科室二','科室三']
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        toolbox: {
            feature: {
                saveAsImage: {}
            }
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data : ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月']
        },
        yAxis: {
            type: 'value'
        },
        series: [
            {
                name:'科室一',
                type:'line',
                stack: '总量',
                data:[120, 132, 101, 134, 90, 230, 210]
            },
            {
                name:'科室二',
                type:'line',
                stack: '总量',
                data:[220, 182, 191, 234, 290, 330, 310]
            },
            {
                name:'科室三',
                type:'line',
                stack: '总量',
                data:[150, 232, 201, 154, 190, 330, 410]
            },
        ]
    };




    // 使用刚指定的配置项和数据显示图表。
    appb.setOption(option);
</script>


<?php $this->endBlock(); ?>
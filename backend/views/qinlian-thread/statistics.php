
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;
use backend\assets\AppAsset;

use backend\models\QinlianThread;

$modelLabel = new \backend\models\QinlianThread();
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
            <form class="form-horizontal" action="qinlian-thread/statistics" method="get">
                <div class="box-body">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="is_nuit" class="col-sm-2 control-label">是否单位</label>

                            <div class="col-sm-8">
                                <select class="form-control" name="is_nuit" id="is_nuit" class="form-control">
                                    <option value="-1">全部</option>
                                    <option value="0">未知</option>
                                    <option value="1">是</option>
                                    <option value="2"> 否</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="is_supervises_object" class="col-sm-2 control-label">否国家监察对象</label>

                            <div class="col-sm-8">
                                <select class="form-control" name="is_supervises_object" id="is_supervises_object" class="form-control">
                                    <option value="-1">全部</option>
                                    <option value="0">未知</option>
                                    <option value="1">是</option>
                                    <option value="2"> 否</option>
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
                            <label for="disciplinary_offence" class="col-sm-2 control-label">违纪行为</label>

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
                            <label for="acceptance_time" class="col-sm-2 control-label">受理时间</label>

                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="acceptance_time" id="acceptance_time" data-provide="datepicker" data-date-format="yyyy-mm">
                            </div>
                            <!-- /.input group -->
                        </div>

                        <div class="form-group">
                            <label for="organization_measure_time" class="col-sm-2 control-label">组织措施统计时间</label>

                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="organization_measure_time" name="organization_measure_time" placeholder="" data-provide="datepicker" data-date-format="yyyy-mm-dd"  />
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
            <!-- AREA CHART -->
            <div class="box box-primary">

                <div id="main" style="width: 1000px;height:600px;"></div>

                <!-- /.box-body -->
            </div>
            <!-- /.box -->



        </div>
        <!-- /.col (LEFT) -->

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
            text: '演示数据',
            subtext: '纯属虚构'
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'cross',
                label: {
                    backgroundColor: '#283b56'
                }
            }
        },
        legend: {
            data:['案管线索上级交', '案管线索数量']
        },
        toolbox: {
            show: true,
            feature: {
                dataView: {readOnly: false},
                restore: {},
                saveAsImage: {}
            }
        },
        dataZoom: {
            show: false,
            start: 0,
            end: 100
        },
        xAxis: [
            {
                type: 'category',
                boundaryGap: true,
                data: (function (){
                    var now = new Date();
                    var res = [];
                    var len = 10;
                    while (len--) {
                        res.unshift(now.toLocaleTimeString().replace(/^\D*/,''));
                        now = new Date(now - 2000);
                    }
                    return res;
                })()
            },
            {
                type: 'category',
                boundaryGap: true,
                data: (function (){
                    var res = [];
                    var len = 10;
                    while (len--) {
                        res.push(10 - len - 1);
                    }
                    return res;
                })()
            }
        ],
        yAxis: [
            {
                type: 'value',
                scale: true,
                name: '案管线索上级交',
                max: 30,
                min: 0,
                boundaryGap: [0.2, 0.2]
            },
            {
                type: 'value',
                scale: true,
                name: '案管线索数量',
                max: 1200,
                min: 0,
                boundaryGap: [0.2, 0.2]
            }
        ],
        series: [
            {
                name:'案管线索上级交',
                type:'bar',
                xAxisIndex: 1,
                yAxisIndex: 1,
                data:(function (){
                    var res = [];
                    var len = 10;
                    while (len--) {
                        res.push(Math.round(Math.random() * 1000));
                    }
                    return res;
                })()
            },
            {
                name:'案管线索数量',
                type:'line',
                data:(function (){
                    var res = [];
                    var len = 0;
                    while (len < 10) {
                        res.push((Math.random()*10 + 5).toFixed(1) - 0);
                        len++;
                    }
                    return res;
                })()
            }
        ]
    };

    app.count = 11;
    setInterval(function (){
        axisData = (new Date()).toLocaleTimeString().replace(/^\D*/,'');

        var data0 = option.series[0].data;
        var data1 = option.series[1].data;
        data0.shift();
        data0.push(Math.round(Math.random() * 1000));
        data1.shift();
        data1.push((Math.random() * 10 + 5).toFixed(1) - 0);

        option.xAxis[0].data.shift();
        option.xAxis[0].data.push(axisData);
        option.xAxis[1].data.shift();
        option.xAxis[1].data.push(app.count++);

        myChart.setOption(option);
    }, 2100);


    // 使用刚指定的配置项和数据显示图表。
    app.setOption(option);
</script>


<?php $this->endBlock(); ?>
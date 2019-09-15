
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;

use backend\models\QinlianPetition;

$modelLabel = new \backend\models\QinlianPetition();
?>

<?php $this->beginBlock('header');  ?>
<!-- <head></head>中代码块 -->
<!--    <script>-->
<!--        window.print();-->
<!--    </script>-->
<?php $this->endBlock(); ?>

<!-- Main content -->
<section class="content print-page">
    <div class="row">
        <div class="col-sm-12">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr>
                    <td align="left" colspan="7" class="biaoti btbg" height="60">档案号:<?=$model->number;?></td>
                    <td align="right" colspan="7" class="biaoti btbg" height="60">
                        <a id="archives_btn" onclick="archivesAction(<?=$model->id;?>)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#archives" href="#"> <i class="glyphicon glyphicon-edit icon-white"></i>添加留档</a>
                    </td>
                </tr>
            </table>
            <table width="100%" border="1" cellspacing="1" cellpadding="1" bgcolor="#cccccc" class="tabtop13" align="center">
                <tr>
                    <th>图片流水号</th>
                    <th>案卷目录</th>
                    <th>页码</th>
                    <th>图片</th>
                </tr>
                <tr>
                    <td width="10%" class="btbg font-center titfont" ></td>
                    <td width="10%" class="btbg font-center titfont" ></td>
                    <td width="10%" class="btbg font-center titfont"></td>
                    <td width="10%" class="btbg font-center titfont"><img src="/"/></td>
                </tr>
                <tr>
                    <td width="10%" class="btbg font-center titfont" ></td>
                    <td width="10%" class="btbg font-center titfont" ></td>
                    <td width="10%" class="btbg font-center titfont"></td>
                    <td width="10%" class="btbg font-center titfont"><img src="/"/></td>
                </tr>
            </table>
        </div>
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

<!-- archives（Modal） -->
<div class="modal fade" id="archives" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3>留档</h3>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin(["id" => "qinlian-petition-archives-form", "class"=>"form-horizontal", "action"=>Url::toRoute("qinlian-petition/save")]); ?>

                <input type="hidden" class="form-control" id="archives-id" name="id" />

                <div id="is_thread_disposal_div" class="form-group">
                    <label for="volume_number" class="col-sm-2 control-label">图片</label>
                    <div class="col-sm-4">
                        <input type="file" class="form-control" id="catalog" name="catalog"/>
                    </div>

                    <label for="disposal_year" class="col-sm-2 control-label">页码</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="volume_number" name="page"/>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-default" data-dismiss="modal">关闭</a>
                <a id="archives_dialog_ok" href="#" class="btn btn-primary">确定</a>
            </div>
        </div>
    </div>
</div><!-- /.modal -->


<?php $this->beginBlock('footer');  ?>

<script>
    function archivesAction(id){
        $.ajax({
            type: "GET",
            url: "<?=Url::toRoute('qinlian-petition/view')?>",
            data: {"id":id},
            cache: false,
            dataType:"json",
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("出错了，" + textStatus);
            },
            success: function(data){
                console.log(data)
                initArchivesmModule(data);
            }
        });
    }

    function initArchivesmModule(data) {
        $("#archives-id").val(data.id)
        $("#disposal_method").val(data.disposal_method)
        $("#volume_number").val(data.volume_number)
        $("#disposal_year").val(data.disposal_year)
        $("#archives-host_department").val(data.host_department)
        $("#archives-number").val(data.number)
    }

    $('#archives_dialog_ok').click(function (e) {
        e.preventDefault();
        $('#qinlian-petition-archives-form').submit();
    });

    $('#qinlian-petition-archives-form').bind('submit', function(e) {
        e.preventDefault();
        var id = $("#archives-id").val();
        var action = "<?=Url::toRoute('qinlian-petition/update')?>";
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
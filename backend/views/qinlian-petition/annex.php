
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;

use backend\models\QinlianAnnex;

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
                        <td align="left" colspan="6" class="biaoti btbg" height="60">档案号:<?=$query['number'];?></td>
                        <td align="right" colspan="6" class="biaoti btbg" height="60">
                            <a id="archives_btn"  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#archives" href="#"> <i class="glyphicon glyphicon-edit icon-white"></i>添加留档</a>
                        </td>
                    </tr>
                </table>
                <table width="100%" border="1" cellspacing="1" cellpadding="1" bgcolor="#cccccc" class="tabtop13" align="center">
                    <tr>

                        <th>案卷目录</th>
                        <th>页码</th>
                        <th>创建时间</th>
                        <th>附属文件</th>
                        <th>操作</th>
                    </tr>
                    <?php
                    foreach ($models as $model) {
                        echo '<tr id="rowid_' . $model->id . '">';
                        echo '  <td width="10%" class="btbg font-center titfont" >' . $model->catalog . '</td>';
                        echo '  <td width="10%" class="btbg font-center titfont" >' . $model->page . '</td>';
                        echo '  <td width="10%" class="btbg font-center titfont" >' . $model->create_date . '</td>';
                        echo '  <td width="10%" class="right">';
                        $url = Url::toRoute('qinlian-petition/files');
                        echo '      <a id=""  class="btn btn-primary btn-sm" href="'. $url  .'&table_id='. $model->id .'&table_name=1" target="_self"> <i class="glyphicon glyphicon-save-file icon-white"></i>查看更多附属文件</a>';
                        echo '  </td>';
                        echo '  <td width="10%" class="right">';
                        echo '      <a id="delete_btn" onclick="deleteAction(' . $model->id . ')" class="btn btn-danger btn-sm" href="#"> <i class="glyphicon glyphicon-trash icon-white"></i>删除</a>';
                        echo '  </td>';
                        echo '</tr>';
                    }

                    if(empty($models)){
                        echo ' <tr><td colspan="7" class="btbg font-center titfont" >没有数据</td></tr>';
                    }
                    ?>

                </table>
            </div>
        </div>
        <!-- /.row -->

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
<!--                    --><?php //$form = ActiveForm::begin(["id" => "qinlian-petition-archives-form", "class"=>"form-horizontal", "action"=>Url::toRoute("qinlian-petition/annex-save")]); ?>
                    <?php $form = ActiveForm::begin(["id" => "qinlian-petition-archives-form", "class"=>"form-horizontal", "action"=>Url::toRoute("qinlian-petition/annex-save"), 'options' => ['enctype' => 'multipart/form-data']]); ?>

                    <input type="hidden" class="form-control" id="number" name="number" value="<?=$query['number'];?>" />
                    <input type="hidden" class="form-control" id="type" name="type" value="<?=$query['type'];?>"/>
                    <input type="hidden" class="form-control" id="table_id" name="table_id" value="<?=$query['table_id'];?>" />

                    <div id="catalog_div" class="form-group">
                        <label for="catalog" class="col-sm-2 control-label">案卷目录</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="catalog" name="catalog"/>
                        </div>


                        <label for="url" class="col-sm-2 control-label">图片</label>
                        <div class="col-sm-4">
                            <input type="file" accept="image/jpeg" multiple="multiple" class="form-control" id="url" name="url[]"/>
                            (单次上传限制20张内)
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
                <div class="modal-footer">
                    <span id="error_msg" style="color: red; float: left;"></span>
                    <a href="#" class="btn btn-default" data-dismiss="modal">关闭</a>
                    <a id="archives_dialog_ok" href="#" class="btn btn-primary">确定</a>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->


<?php $this->beginBlock('footer');  ?>

<script>
    function deleteAction(id){
        $.ajax({
            type: "GET",
            url: "<?=Url::toRoute('qinlian-petition/annex-delete')?>",
            data: {"id":id},
            cache: false,
            dataType:"json",
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("出错了，" + textStatus);
            },
            success: function(value){
                if(value.errno == 0){
                    admin_tool.alert('msg_info', '删除成功', 'success');
                    window.location.reload();
                }
            }
        });
    }

    function initArchivesmModule(data) {
        $("#code").val(data.code)
        $("#catalog").val(data.catalog)
        $("#page").val(data.page)
    }

    $('#archives_dialog_ok').click(function (e) {
        e.preventDefault();
        $('#qinlian-petition-archives-form').submit();
    });



    $('#qinlian-petition-archives-form').bind('submit', function(e) {
        e.preventDefault();
        var id = $("#archives-id").val();
        var action = "<?=Url::toRoute('qinlian-petition/annex-create')?>";
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
                    $("#error_msg").text(value.msg);
                }

            }
        });
    });
</script>

<?php $this->endBlock(); ?>
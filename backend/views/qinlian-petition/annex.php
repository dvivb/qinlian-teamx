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
                        <td align="left" colspan="7" class="biaoti btbg" height="60">案件编号:<?=$model->case_code;?></td>
                        <td align="right" colspan="7" class="biaoti btbg" height="60">
                            <a id="edit_btn" onclick="editAction(' . $model->id . ')" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-edit icon-white"></i>上传图片</a>
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



<?php $this->beginBlock('footer');  ?>
<?php $this->endBlock(); ?>
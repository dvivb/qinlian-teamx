<?php $this->beginBlock('header');  ?>
<!-- <head></head>中代码块 -->
<script>
    window.print();
</script>
<?php $this->endBlock(); ?>

<!-- Main content -->
<section class="content print-page">
    <div class="row">
        <div class="col-sm-12">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr>
                    <td align="center" class="biaoti btbg" height="60">重要问题线索拟办单重要问题线索拟办单</td>
                </tr>
            </table>
            <table width="100%" border="1" cellspacing="1" cellpadding="4" bgcolor="#cccccc" class="tabtop13" align="center">
                <tr>
                    <td width="6%" class="btbg font-center titfont" >线索来源</td>
                    <td width="20%" class="btbg font-center titfont" ><?=$model->clue_source;?></td>
                    <td width="4%" class="btbg font-center titfont" >接收日期</td>
                    <td width="20%" class="btbg font-center titfont" ><?=date('Y年m月d日', strtotime($model->date_receipt));?></td>
                    <td width="4%" class="btbg font-center titfont" >线索编号</td>
                    <td width="20%" class="btbg font-center titfont" ><?=$model->letter_number;?></td>
                </tr>

                <tr>
                    <td rowspan="2" width="20%" class="btbg font-center titfont" >被反映人（单位）</td>
                    <td rowspan="2" width="10%" class="btbg font-center titfont" ><?=$model->respondent_unit;?></td>
                    <td class="btbg font-center titfont" >单位/职务</td>
                    <td colspan="3" width="10%" class="btbg font-center titfont" ><?=$model->duty_job;?></td>
                </tr>
                <tr>
                    <td class="btbg font-center titfont" >职级</td>
                    <td colspan="3" width="10%" class="btbg font-center titfont" ><?=$model->rank_job;?></td>
                </tr>
                <tr>
                    <td width="10%"  class="btbg font-center titfont tdrows-8" >举报内容摘要</td>
                    <td colspan="5" width="20%" class="btbg font-center titfont" ><?=$model->main_issues;?></td>
                </tr>
                <tr>
                    <td class="btbg font-center titfont tdrows-4" >排查会意见</td>
                    <td colspan="5" width="20%" class="btbg font-center titfont" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;经<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>年<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>月<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>日线索排查会研究决定,此问题<br/>线索交由问题线索交由<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>进行<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>。</td>
                </tr>
            </table>
        </div>
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->



<?php $this->beginBlock('footer');  ?>
<?php $this->endBlock(); ?>
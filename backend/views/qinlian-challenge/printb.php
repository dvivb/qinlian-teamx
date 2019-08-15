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
                    <td align="center" colspan="8" class="biaoti btbg" height="60" style="font-family: SimSun;size: 18px;">重要问题线索拟办单</td>
                </tr>
            </table>
            <table width="100%" border="1" cellspacing="1" cellpadding="1" bgcolor="#cccccc" class="tabtop13" align="center">

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
                    <td width="10%"  class="btbg font-center titfont tdrows-2" >主要内容</td>
                    <td colspan="5" width="20%" class="btbg font-center titfont" ><?=$model->main_issues;?></td>
                </tr>
                <tr>
                    <td width="10%"  class="btbg font-center titfont tdrows-3" >本委领导意见</td>
                    <td colspan="5" width="20%" class="btbg font-center titfont" ><?=$model->leader_instructions;?></td>
                </tr>
                <tr>
                    <td width="10%"  class="btbg font-center titfont tdrows-3" >分管领导意见</td>
                    <td colspan="5" width="20%" class="btbg font-center titfont" ><?=$model->host_department;?></td>
                </tr>
                <tr>
                    <td width="10%"  class="btbg font-center titfont tdrows-2" >案管室意见</td>
                    <td colspan="5" width="20%" class="btbg font-center titfont" ><?=$model->investigation_disposal;?></td>
                </tr>
            </table>
        </div>
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->



<?php $this->beginBlock('footer');  ?>
<?php $this->endBlock(); ?>
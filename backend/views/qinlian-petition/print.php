
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
                    <td align="center" class="biaoti btbg" height="60">纪检监察机关来信来访登记卡</td>
                </tr>
            </table>
            <table width="100%" border="1" cellspacing="1" cellpadding="4" bgcolor="#cccccc" class="tabtop13" align="center">
                <tr>
                    <td colspan="4" width="20%" class="btbg font-center titfont" ></td>
                    <td width="10%" class="btbg font-center titfont" >编号</td>
                    <td width="10%" class="btbg font-center titfont" ><?=$model->number;?></td>
                </tr>
                <tr>
                    <td width="10%" class="btbg font-center titfont" >举报人</td>
                    <td width="10%" class="btbg font-center titfont" ><?=$model->name_report;?></td>
                    <td width="10%" class="btbg font-center titfont" >单位及住址</td>
                    <td width="10%" class="btbg font-center titfont" ></td>
                    <td width="10%" class="btbg font-center titfont" >收件时间</td>
                    <td width="10%" class="btbg font-center titfont" ><?=date('Y年m月d日', strtotime($model->receipt_time));?></td>
                </tr>
                <tr>
                    <td width="10%" class="btbg font-center titfont" >被举报人姓名</td>
                    <td width="10%" class="btbg font-center titfont" ><?=$model->name_reported;?></td>
                    <td width="10%" class="btbg font-center titfont" >单位</td>
                    <td width="10%" class="btbg font-center titfont" ><?=$model->unit_job;?></td>
                    <td width="10%" class="btbg font-center titfont" >职务级别政治面貌</td>
                    <td width="10%" class="btbg font-center titfont" ><?=$model->duty_job;$model->rank_job;$model->political_appearance;?></td>
                </tr>
                <tr>
                    <td width="10%"  class="btbg font-center titfont tdrows-2" >举报内容摘要</td>
                    <td colspan="5" width="20%" class="btbg font-center titfont" ><?=$model->main_issues;?></td>
                </tr>
                <tr>
                    <td width="10%" class="btbg font-center titfont tdrows-1" >信访室意见</td>
                    <td colspan="5" width="20%" class="btbg font-center titfont" ><?=$model->petition_office_opinion;?></td>
                </tr>
                <tr>
                    <td width="10%" class="btbg font-center titfont tdrows-3" >委局领导批示</td>
                    <td colspan="5" width="20%" class="btbg font-center titfont" ><?=$model->lu_clerk_opinion;?></td>
                </tr>
                <tr>
                    <td width="10%" class="btbg font-center titfont tdrows-2" >重信重访情况</td>
                    <td colspan="5" width="20%" class="btbg font-center titfont" ><?=$model->heavy_letter;?></td>
                </tr>
                <tr>
                    <td width="10%" class="btbg font-center titfont" >要求办结时间</td>
                    <td width="10%" class="btbg font-center titfont" ></td>
                    <td width="10%" class="btbg font-center titfont" >承办单位</td>
                    <td width="10%" class="btbg font-center titfont" ><?=$model->host_department;?></td>
                    <td width="10%" class="btbg font-center titfont" >转出时间</td>
                    <td width="10%" class="btbg font-center titfont" ><?=date('Y年m月d日', strtotime($model->approval_time));?></td>
                </tr>
                <tr>
                    <td width="10%" class="btbg font-center titfont tdrows-1" >办理结果</td>
                    <td colspan="5" width="20%" class="btbg font-center titfont" ><?=$model->handle_results;?></td>
                </tr>
            </table>
        </div>
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->



<?php $this->beginBlock('footer');  ?>
<?php $this->endBlock(); ?>
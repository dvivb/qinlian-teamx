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
                        <td align="center" colspan="8" class="biaoti btbg" height="60">纪检监察机关来信来访来电批办单</td>
                    </tr>
                    <tr>
                        <td colspan="6" width="20%" class="btbg font-center titfont" ></td>
                        <td width="1%" class="btbg font-center titfont" >时间</td>
                        <td width="5%" class="btbg font-center titfont" ><?=date('Y年m月d日', strtotime($model->receipt_time));?></td>
                    </tr>
                </table>
                <table width="100%" border="1" cellspacing="1" cellpadding="1" bgcolor="#cccccc" class="tabtop13" align="center">

                    <tr>
                        <td width="2%" rowspan="5" class="btbg font-center titfont" >来访（信电网） 人</td>
                        <td width="4%" class="btbg font-center titfont" >姓名</td>
                        <td width="26%" class="btbg font-center titfont" ><?=$model->name_report;?></td>
                        <td width="1%" rowspan="5" class="btbg font-center titfont" >被检举、控告人</td>
                        <td width="4%" class="btbg font-center titfont" >姓名</td>
                        <td width="26%" class="btbg font-center titfont"><?=$model->name_reported;?></td>
                        <td width="1%" rowspan="2" class="btbg font-center titfont" >信件编号</td>
                        <td width="4%" rowspan="2" class="btbg font-center titfont" ><?=$model->number;?></td>
                    </tr>
                    <tr>
                        <td width="10%" class="btbg font-center titfont" >单位职务</td>
                        <td width="10%" class="btbg font-center titfont" ></td>
                        <td width="10%" class="btbg font-center titfont" >单位</td>
                        <td width="10%" class="btbg font-center titfont" ><?=$model->unit_job;?></td>
                    </tr>
                    <tr>
                        <td width="10%" class="btbg font-center titfont" >政治面貌</td>
                        <td width="10%" class="btbg font-center titfont" ><?=$model->name_reported;?></td>
                        <td width="10%" class="btbg font-center titfont" >职务</td>
                        <td width="10%" class="btbg font-center titfont" ><?=$model->duty_job;?></td>
                        <td width="1%" rowspan="3" class="btbg font-center titfont" >登记人</td>
                        <td width="4%" rowspan="3" class="btbg font-center titfont"></td>
                    </tr>
                    <tr>
                        <td width="10%" class="btbg font-center titfont" >身份证号</td>
                        <td width="10%" class="btbg font-center titfont" ></td>
                        <td width="10%" class="btbg font-center titfont" >政治面貌</td>
                        <td width="10%" class="btbg font-center titfont" ><?=$model->political_appearance;?></td>
                    </tr>
                    <tr>
                        <td width="10%" class="btbg font-center titfont" >联系电话</td>
                        <td width="10%" class="btbg font-center titfont" ></td>
                        <td width="10%" class="btbg font-center titfont" >联系电话</td>
                        <td width="10%" class="btbg font-center titfont" ></td>
                    </tr>
                    <tr>
                        <td width="2%"  class="btbg font-center titfont tdrows-2" >举报内容摘要</td>
                        <td colspan="7" width="20%" class="btbg font-center titfont" ><?=$model->main_issues;?></td>
                    </tr>
                    <tr>
                        <td width="2%" class="btbg font-center titfont tdrows-1" >主要领导批示意见</td>
                        <td colspan="7" width="20%" class="btbg font-center titfont" ><?=$model->major_leadership_approval_opinion;?></td>
                    </tr>
                    <tr>
                        <td width="2%" class="btbg font-center titfont tdrows-2" >分管或主管领导批示意见</td>
                        <td colspan="7" width="20%" class="btbg font-center titfont" ><?=$model->charge_leadership_approval_opinion;?></td>
                    </tr>
                    <tr>
                        <td width="2%" class="btbg font-center titfont tdrows-1" >原核查组意见</td>
                        <td colspan="7" width="20%" class="btbg font-center titfont" ><?=$model->petition_office_opinion;?></td>
                    </tr>
                    <tr>
                        <td width="2%" class="btbg font-center titfont tdrows-1" >信访室意见</td>
                        <td colspan="7" width="20%" class="btbg font-center titfont" ><?=$model->petition_office_opinion;?></td>
                    </tr>
                    <tr>
                        <td width="2%" class="btbg font-center titfont tdrows-1" >重信重访情况</td>
                        <td colspan="7" width="20%" class="btbg font-center titfont" ><?=$model->heavy_letter;?></td>
                    </tr>
                    <tr>
                        <td width="2%" class="btbg font-center titfont" >备注</td>
                        <td colspan="7" width="20%" class="btbg font-center titfont" >批办单由领导签批后转信访室登记	，由信访室转交承办科室</td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->



<?php $this->beginBlock('footer');  ?>
<?php $this->endBlock(); ?>
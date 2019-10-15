
<?php

$modelLabel = new \backend\models\QinlianRegister();
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

                    </tr>
                </table>
                <table width="100%" border="1" cellspacing="1" cellpadding="1" bgcolor="#cccccc" class="tabtop13" align="center">
                    <tr>
                        <th>图片</th>
                    </tr>
                    <?php
                    foreach ($models as $model) {
                        echo '<tr id="rowid_' . $model->id . '">';
                        echo '  <td width="10%" class="btbg font-center titfont" ><a target="_blank" href="/uplaod/' . $model->url . '"> <img width="300" height="300" src="/uplaod/' . $model->url . '"/></a>&nbsp;&nbsp;留档页码:'. $model->code .'</td>';
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
                    <?= \yii\widgets\LinkPager::widget([
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


<?php $this->beginBlock('footer');  ?>


<?php $this->endBlock(); ?>
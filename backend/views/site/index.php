

<!-- Main content -->
<section class="content">
	<!-- Small boxes (Stat box) -->

    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?= $statistics['petition_count'];?></h3>

                    <p>信访信息</p>
                </div>
                <div class="icon">
                    <i class="fa fa-table"></i>
                </div>
                <a href="/index.php?r=qinlian-petition/index" class="small-box-footer">更多信息 <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?= $statistics['challenge_count'];?></h3>

                    <p>案管问题</p>
                </div>
                <div class="icon">
                    <i class="fa fa-table"></i>
                </div>
                <a href="/index.php?r=qinlian-challenge/index" class="small-box-footer">更多信息 <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?= $statistics['thread_count'];?></h3>

                    <p>案管线索</p>
                </div>
                <div class="icon">
                    <i class="fa fa-table"></i>
                </div>
                <a href="/index.php?r=qinlian-thread/index" class="small-box-footer">更多信息 <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3><?= $statistics['register_count'];?></h3>

                    <p>案管立案</p>
                </div>
                <div class="icon">
                    <i class="fa fa-table"></i>
                </div>
                <a href="/index.php?r=qinlian-register/index" class="small-box-footer">更多信息 <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->

    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-table"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><a href="/index.php?r=qinlian-petition/statistics" class="small-box-footer"><h2>信访信息数据</h2> </a></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-table"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><a href="/index.php?r=qinlian-challenge/statistics" class="small-box-footer"><h2>案管问题数据</h2></a></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-table"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><a href="/index.php?r=qinlian-thread/statistics" class="small-box-footer"><h2>案管线索数据</h2></a></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-table"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><a href="/index.php?r=qinlian-register/statistics" class="small-box-footer"><h2>案管立案数据</h2></a></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

    </div>
    <!-- /.row -->

	<div class="row">
		<div class="col-md-12">
		<div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">系统信息</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">#</th>
                  <th style="width: 200px">名称</th>
                  <th>信息</th>
                  <th style="width: 200px">说明</th>
                </tr>
                <?php 
                    $count = 1;
                    foreach($sysInfo as $info){
    			       echo '<tr>';
    			       echo '  <td>'. $count .'</td>';
    			       echo '  <td>'.$info['name'].'</td>';
    			       echo '  <td>'.$info['value'].'</td>';
    			       echo '  <td></td>';
    			       echo '</tr>';
    			       $count++;
    			   }
    			   ?>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              
            </div>
          </div>
          <!-- /.box -->
		</div>
		
		
	</div>
	<!-- /.row -->
	<!-- Main row -->
	<div class="row">
		
	</div>
	<!-- /.row (main row) -->

</section>
<!-- /.content -->
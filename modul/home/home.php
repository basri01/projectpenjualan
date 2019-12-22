<?php
 $user           = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) as semua FROM tbl_user"));
 $member         = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) as semua FROM tbl_member"));
 $transaksi      = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) as semua FROM tbl_transaksi"));
?>

        <?php 
            $status= $_SESSION['status'] == 'Admin';
            if($status){
          ?>
     <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $user ['semua'] ?></h3>

              <p>User</p>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
            <a href="index2.php?module=user" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $member['semua'] ?></h3>

              <p>Member</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="index2.php?module=member" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $transaksi ['semua'] ?></h3>

              <p>Transaksi Pembayaran</p>
            </div>
            <div class="icon">
              <i class="fa  fa-clipboard"></i>
            </div>
            <a href="index2.php?module=transaksi" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
  
    <?php }?>

    <br>
    <div class="col-md-12" align='center'>
          <div class="box box-danger"><br><br>
          <!-- /.box-header -->
            <div class="box-body">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                </ol>
                <div class="carousel-inner">
                    <div class="item active">

                  <img src="images/G1.png" alt="First slide">

                    <div class="carousel-caption">
                    </div>
                  </div>
                  <div class="item">
                    <img src="images/G2.jpg" alt="Second slide">

                    <div class="carousel-caption">
                    </div>
                  </div>
                  <div class="item">
                    <img src="images/B1.png" alt="Third slide">

                    <div class="carousel-caption">
                    </div>
                  </div>

                  <div class="item">
                    <img src="images/G3.jpg" alt="Fourth slide">

                    <div class="carousel-caption">
                    </div>
                  </div>  

                   <div class="item">
                    <img src="images/B3.jpg" alt="Fifth slide">

                    <div class="carousel-caption">
                    </div>
                  </div>  
                    </div>
                  </div>
                </div>
                
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="fa fa-angle-right"></span>
                </a>
              </div><br><br>
            </div>
          </div>
          <!-- /.box -->
        </div> 

      <!-- /.row -->
      <!-- Main row -->
      <!-- /.row (main row) -->
    </section>
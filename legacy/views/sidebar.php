<?php
if (!defined('website')) {include("index.php");die();}
?>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo $BaseUrl; ?>/themes/server/user.jpg" class="img-circle" alt="">
            </div>
            
            <div class="pull-left info">
                <p><?php echo strtoupper($_SESSION['adminwebsite123']);?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        
        <div>
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MAIN NAVIGATION</li>
                <?php
                    if($modul == 'HOME'){
                        echo '<li class="active"><a href="'.$BaseUrl.'/home.php"><i class="fa fa-home"></i> <span>HOME</span></a></li>';
                    }
                    else{
                        echo '<li><a href="'.$BaseUrl.'/home.php"><i class="fa fa-home"></i> <span>HOME</span></a></li>';
                    }

                    if($modul == 'MASTER-DATA'){
                        echo '<li class="active"><a href="'.$BaseUrl.'/master-data.php"><i class="fa fa-database"></i> <span>MASTER DATA</span></a></li>';
                    }
                    else{
                        echo '<li><a href="'.$BaseUrl.'/master-data.php"><i class="fa fa-database"></i> <span>MASTER DATA</span></a></li>';
                    }

                    if($modul == 'IMPORT'){
                        echo '<li class="active"><a href="'.$BaseUrl.'/import.php"><i class="fa fa-upload"></i> <span>IMPORT DATA</span></a></li>';
                    }
                    else{
                        echo '<li><a href="'.$BaseUrl.'/import.php"><i class="fa fa-upload"></i> <span>IMPORT DATA</span></a></li>';
                    }

                    if($modul == 'ABSENSI'){
                        echo '<li class="active"><a href="'.$BaseUrl.'/absensi.php"><i class="fa fa-book"></i> <span>ABSENSI</span></a></li>';
                    }
                    else{
                        echo '<li><a href="'.$BaseUrl.'/absensi.php"><i class="fa fa-book"></i> <span>ABSENSI</span></a></li>';
                    }

                    if($modul == 'LAPORAN'){
                        echo '<li class="active"><a href="'.$BaseUrl.'/laporan.php"><i class="fa fa-file"></i> <span>LAPORAN</span></a></li>';
                    }
                    else{
                        echo '<li><a href="'.$BaseUrl.'/laporan.php"><i class="fa fa-file"></i> <span>LAPORAN</span></a></li>';
                    }
                ?>
            </ul>
        </div>
    </section>
</aside>
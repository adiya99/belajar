<link rel="stylesheet" href="https://bti.icu/bs.min.css">
<body onload="window.print()">
<?php
  $db = mysqli_connect("localhost","root","","inventory_sd");
@$f1=$_GET['f1'];
@$f2=$_GET['f2'];
$where="";
if(($f1!=null) && ($f2!=null)){
@$where=" where tgl between '$f1' and '$f2'";
}
$sql = "select * from mahasiswa".$where;
    $query = mysqli_query($db,$sql);
    ?>
<!-- <h1>Filter : <?= $f1?> Sampai <?= $f2?></h1> -->
    <table class="table table-striped">
      <tr>
        <th>No</th>
        <th>nama</th>
        <th>alamat</th>
        <th>kelas</th>
      
      </tr>

      <?php if(mysqli_num_rows($query)>0){ ?>

      <?php
        $no = 1;
        while($d = mysqli_fetch_object($query)){
      ?>

      <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $d->nama;?></td>
        <td><?php echo $d->alamat;?></td>
        <td><?php echo $d->kelas;?></td>
    
      </tr>

      <?php $no++; } ?>

      <?php } ?>

    </table>
<link rel="stylesheet" href="https://bti.icu/bs.min.css">
<h1>BELAJAR CRUD</h1>
<?php
  $db = mysqli_connect("mysql-142614-0.cloudclusters.net:18515","admin","xUqI9xrd","belajar");

  if(isset($_GET['edit'])){
  $s1 = mysqli_query($db,"select * from mahasiswa where id_mahasiswa='$_GET[edit]'");
  $r1 = mysqli_fetch_object($s1);  
$nama=$r1->nama;
$alamat=$r1->alamat;
$kelas=$r1->kelas;
 }
?>
<div class="row">
  <div class="col-md-12">
    <form action="" method="post">
    <input type="hidden" class="form-control" name="id_mahasiswa" value="<?= @$_GET['edit']?>">
    <label>nama : </label>
       <input type="text" class="form-control" name="nama" value="<?= @$nama?>">
       <label>alamat : </label>
       <input type="text" class="form-control" name="alamat" value="<?= @$alamat?>">       
       <label>kelas : </label>
       <input type="text" class="form-control" name="kelas" value="<?= @$kelas?>">
    
       <input type="submit" name="submit" value="Simpan" class="btn btn-primary">
</form>
</div>
</div>

<?php
   
if(isset($_POST['submit'])){
    @$id_mahasiswa = $_POST['id_mahasiswa'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $kelas = $_POST['kelas'];
   
    if($id_mahasiswa>0){
      $sql = "update mahasiswa set nama='$nama',alamat='$alamat',kelas='$kelas' where id_mahasiswa=$id_mahasiswa";

    }else{
    $sql = "insert into mahasiswa values(null,'$nama', '$alamat','$kelas')";
    }

    if(!mysqli_query($db, $sql)){
        echo 'Not Inserted';
    }else{
        //echo 'Inserted';
    }

 echo'<script>window.location.href = "index.php";</script>';

}
@$f1=$_GET['f1'];
@$f2=$_GET['f2'];
$where="";
if(isset($f1) && isset($f2)){
@$where=" where tgl between '$f1' and '$f2'";
}
  $sql = "select * from mahasiswa".$where;
    $query = mysqli_query($db,$sql);
    ?>
     <!-- <form action="" method="get">
 
    <label>Dari Tanggal :</label>
    <input type="date" name="f1" value="<?= @$f1?>">
    <label>Sampai Tanggal :</label>
    <input type="date" name="f2" value="<?= @$f2?>">
    <input type="submit" name="submit" value="Filter" class="btn btn-primary">
</form> -->
<a href="cetak.php?f1=<?= $f1?>&f2=<?= $f2?>" class="btn btn-success">Cetak</a>
    <table class="table table-striped">
      <tr>
        <th>No</th>
        <th>nama</th>
        <th>alamat</th>
        <th>kelas</th>
      
        <th>Edit</th>
        <th>Hapus</th>
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
       
        <td><a href="?edit=<?= $d->id_mahasiswa ?>">Edit</a></td>
        <td><a href="?delete=<?= $d->id_mahasiswa?>">Delete</a></td>
    
      </tr>

      <?php $no++; } ?>

      <?php } ?>

    </table>
<?php
    if(isset($_GET['delete'])){

    $sql = "delete from mahasiswa where id_mahasiswa=$_GET[delete]";

    if(!mysqli_query($db, $sql)){
        echo 'Not Inserted';
    }else{
        //echo 'Inserted';
    }

 echo'<script>window.location.href = "index.php";</script>';

}
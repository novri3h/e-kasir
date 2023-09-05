<?php error_reporting (E_ALL ^ E_NOTICE);?>
<?php include 'template/header.php';?>
<?php $barang=mysqli_query($conn, "SELECT * FROM barang");
$jsArray = "var harga_barang = new Array();";
$jsArray1 = "var nama_barang = new Array();";
 ?>
  <div class="col-md-9 mb-2">
    <div class="row">

    <!-- kasir -->
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-body py-4">
            <form method="POST">
            <div class="form-group row mb-0">
                        <label class="col-sm-4 col-form-label col-form-label-sm"><b>Tgl. Transaksi</b></label>
                        <div class="col-sm-8 mb-2">
                            <input type="text" class="form-control form-control-sm" name="tgl_input" value="<?php echo  date("j F Y");?>" readonly>
                        </div>
                        <label class="col-sm-4 col-form-label col-form-label-sm"><b>Kode Barang</b></label>
                        <div class="col-sm-8 mb-2">
                            <div class="input-group">
                            <input type="text" name="kode_barang" class="form-control form-control-sm border-right-0" list="datalist1" onchange="changeValue(this.value)"  aria-describedby="basic-addon2" required>
                            <datalist id="datalist1">
                            <?php if(mysqli_num_rows($barang)) {?>
                                <?php while($row_brg= mysqli_fetch_array($barang)) {?>
                                    <option value="<?php echo $row_brg["id_barang"]?>"> <?php echo $row_brg["id_barang"]?>
                                <?php $jsArray .= "harga_barang['" . $row_brg['id_barang'] . "'] = {harga_barang:'" . addslashes($row_brg['harga_barang']) . "'};";
                                $jsArray1 .= "nama_barang['" . $row_brg['id_barang'] . "'] = {nama_barang:'" . addslashes($row_brg['nama_barang']) . "'};"; } ?>
                            <?php } ?>
                                </datalist>
                                <div class="input-group-append">
                                    <span class="input-group-text bg-white border-left-0" id="basic-addon2" style="border-radius:0px 15px 15px 0px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-upc-scan" viewBox="0 0 16 16">
                                        <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5zM3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z"/>
                                        </svg></span>
                                </div>
                                </div>
                        </div>
                        <label class="col-sm-4 col-form-label col-form-label-sm"><b>Nama Barang</b></label>
                        <div class="col-sm-8 mb-2">
                            <input type="text" class="form-control form-control-sm" name="nama_barang" id="nama_barang" readonly>
                        </div>
                        <label class="col-sm-4 col-form-label col-form-label-sm"><b>Harga</b></label>
                        <div class="col-sm-8 mb-2">
                            <input type="number" class="form-control form-control-sm" id="harga_barang" onchange="total()"
                             value="<?php echo $row['harga_barang'];?>" name="harga_barang" readonly>
                        </div>
                        <label class="col-sm-4 col-form-label col-form-label-sm"><b>Quantity</b></label>
                        <div class="col-sm-8 mb-2">
                            <input type="number" class="form-control form-control-sm" id="quantity" onchange="total()"
                             name="quantity" placeholder="0" required>
                        </div>
                        <label class="col-sm-4 col-form-label col-form-label-sm"><b>Sub-Total</b></label>
                        <div class="col-sm-8">
                            <div class="input-group">
                            <input type="text" class="form-control form-control-sm"  id="subtotal" name="subtotal" onchange="total()"
                             name="sub_total" readonly>
                            <div class="input-group-append">
                                <button class="btn btn-purple btn-sm" name="save" value="simpan" type="submit">
                                    <i class="fa fa-plus mr-2"></i>Tambah</button>
                            </div>
                            </div>
                        </div>
                    </div>
            </form>
            <?php
            if(isset($_POST['save'])){
                $idb = $_POST['kode_barang'];
                $nama = $_POST['nama_barang'];
                $harga = $_POST['harga_barang'];
                $qty = $_POST['quantity'];
                $total= $_POST['subtotal'];
                $tgl = $_POST['tgl_input'];

                $sql = "INSERT INTO keranjang (kode_barang, nama_barang, harga_barang, quantity, subtotal, tgl_input)
                 VALUES('$idb','$nama','$harga','$qty','$total','$tgl')";
                $query = mysqli_query($conn, $sql) or die (mysqli_error());

                if($query){
                echo '<script>window.location=""</script>';
                } else {
                echo "Error :".$sql."<br>".mysqli_error($conn);
                }

                mysqli_close($conn);

            }?>
            <hr>
            <?php

function format_ribuan ($nilai){
    return number_format ($nilai, 0, ',', '.');
}
                $tgl = date("jmYGi");
                $huruf = "AD";
                $kodeCart = $huruf . $tgl;
                ?>
                <?php
                $query = mysqli_query($conn, "SELECT * FROM keranjang");
                $total = 0;
                $tot_bayar= 0;
                $no = 1;
                while ($r = $query->fetch_assoc()) {
                $total = $r['harga_barang'] * $r['quantity'];
                $tot_bayar += $total;
                $bayar = $r['bayar'];
                $kembalian = $r['kembalian'];
             }
             error_reporting(0);
                ?>
            <form method="POST">
                <div class="form-group row mb-0">
                <input type="hidden" class="form-control" name="no_transaksi" value="<?php echo $kodeCart; ?>" readonly>
                <input type="hidden" class="form-control" value="<?php echo $tot_bayar; ?>" id="hargatotal" readonly>
                    <label class="col-sm-4 col-form-label col-form-label-sm"><b>Bayar</b></label>
                        <div class="col-sm-8 mb-2">
                            <input type="number" class="form-control form-control-sm"
                            name="bayar" id="bayarnya" onchange="totalnya()">
                    </div>
                    <label class="col-sm-4 col-form-label col-form-label-sm"><b>Kembali</b></label>
                        <div class="col-sm-8 mb-2">
                            <input type="number" class="form-control form-control-sm"
                            name="kembalian" id="total1" readonly>
                    </div>
                </div>
                <div class="text-right">
                <button class="btn btn-purple btn-sm" name="save1" value="simpan" type="submit">
                    <i class="fa fa-shopping-cart mr-2"></i>Bayar</button>
                </div>
            </form>
            <?php
            if(isset($_POST['save1'])){
                $notrans = $_POST['no_transaksi'];
                $bayar = $_POST['bayar'];
                $kembalian = $_POST['kembalian'];

                $sql = "UPDATE keranjang SET no_transaksi='$notrans',bayar='$bayar',kembalian='$kembalian' ";
                $query = mysqli_query($conn, $sql) or die (mysqli_error());
                echo '<script>window.location="index.php"</script>';

            }?>
            </div>
        </div>
    </div>
    <!-- end kasir -->

  <!-- tes -->
  <div class="col-md-6 mb-3">
      <div class="card" id="print">
          <div class="card-header bg-white border-0 pb-0 pt-4">
              <?php
      $toko = mysqli_query($conn,"SELECT * FROM login ORDER BY nama_toko ASC");
      while($dat = mysqli_fetch_array($toko)){
        $user = $dat['user'];
        $nama_toko = $dat['nama_toko'];
        $alamat = $dat['alamat'];
        $telp = $dat['telp'];
        echo "<h5 class='card-tittle mb-0 text-center'><b>$nama_toko</b></h5>
        <p class='m-0 small text-center'>$alamat</p>
          <p class='small text-center'>Telp. $telp</p>";
      }
          ?>
          <div class="row">
              <div class="col-8 col-sm-9 pr-0">
                <ul class="pl-0 small" style="list-style: none;text-transform: uppercase;">
                    <li>NOTA : <?php
      $notrans = mysqli_query($conn,"SELECT * FROM keranjang ORDER BY no_transaksi ASC LIMIT 1");
      while($dat2 = mysqli_fetch_array($notrans)){
        $notransaksi = $dat2['no_transaksi'];
        echo "$notransaksi";
      }
          ?></li>
                    <li>KASIR : <?php echo $user ?></li>
                </ul>
              </div>
              <div class="col-4 col-sm-3 pl-0">
              <ul class="pl-0 small" style="list-style: none;">
                    <li>TGL : <?php echo  date("j-m-Y");?></li>
                    <li>JAM : <?php echo  date("G:i:s");?></li>
                </ul>
              </div>
          </div>
          </div>
          <div class="card-body small pt-0">
          <hr class="mt-0">
              <div class="row">
              <div class="col-5 pr-0">
                    <span><b>Nama Barang</b></span>
              </div>
              <div class="col-1 px-0 text-center">
                  <span><b>Qty</b></span>
              </div>

              <div class="col-3 px-0 text-right">
                  <span><b>Harga</b></span>
              </div>
              <div class="col-3 pl-0 text-right">
                  <span><b>Subtotal</b></span>
              </div>
              <div class="col-12">
                  <hr class="mt-2">
              </div>
              <?php
                $data_barang = mysqli_query($conn,"SELECT * FROM keranjang");
                while($d = mysqli_fetch_array($data_barang)){
                    ?>
              <div class="col-5 pr-0">
                  <a href="?id=<?php echo $d['id_cart']; ?>" onclick="javascript:return confirm('Hapus Data Barang ?');" style="text-decoration:none;">
                      <i class="fa fa-times fa-xs text-danger mr-1"></i>
                      <span class="text-dark"><?php echo $d['nama_barang']; ?></span>
                  </a>
              </div>
              <div class="col-1 px-0 text-center">
                  <span><?php echo $d['quantity']; ?></span>
              </div>
              <div class="col-3 px-0 text-right">
                  <span><?php echo format_ribuan($d['harga_barang']); ?></span>
              </div>
              <div class="col-3 pl-0 text-right">
                  <span><?php echo format_ribuan($d['subtotal']); ?></span>
              </div>
              <?php }?>
              <div class="col-12">
                  <hr class="mt-2">
                    <ul class="list-group border-0">
                    <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                        <b>Total</b>
                        <span><b><?php echo format_ribuan($tot_bayar); ?></b></span>
                    </li>
                    <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                        <b>Bayar</b>
                        <span><b><?php echo format_ribuan($bayar); ?></b></span>
                    </li>
                    <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                        <b>Kembalian</b>
                        <span><b><?php echo format_ribuan($kembalian); ?></b></span>
                    </li>
                    </ul>
              </div>
              <div class="col-sm-12 mt-3 text-center">
                  <p>* TERIMA KASIH TELAH BERBELANJA*</p>
              </div>
              </div>
          </div>
      </div>
      <div class="text-right mt-3">
          <form method="POST">
            <button class="btn btn-purple-light btn-sm mr-2" onclick="printContent('print')"><i class="fa fa-print mr-1"></i> Print</button>
            <button class="btn btn-purple btn-sm" name="selesai" type="submit"><i class="fa fa-check mr-1"></i> Selesai</button>
          </form>
      </div>
      <?php
               if(isset($_POST['selesai'])){
                $ambildata = mysqli_query($conn,"INSERT INTO laporanku (no_transaksi,bayar,kembalian,id_Cart,kode_barang, nama_barang, harga_barang, quantity, subtotal, tgl_input)
                SELECT no_transaksi,bayar,kembalian,id_Cart,kode_barang, nama_barang, harga_barang, quantity, subtotal, tgl_input
                FROM keranjang ") or die (mysqli_connect_error());
                $hapusdata = mysqli_query($conn,"DELETE FROM keranjang");
                echo '<script>window.location="index.php"</script>';
                }
                ?>
  </div>
  <!-- end tes -->

    <?php
	include 'config.php';
	if(!empty($_GET['id'])){
		$id= $_GET['id'];
		$hapus_data = mysqli_query($conn, "DELETE FROM keranjang WHERE id_cart ='$id'");
		echo '<script>window.location="index.php"</script>';
	}

?>
    </div><!-- end row col-md-9 -->
  </div>
  <script type="text/javascript">
      <?php echo $jsArray; ?>
    <?php echo $jsArray1; ?>
    function changeValue(id_barang) {
      document.getElementById("nama_barang").value = nama_barang[id_barang].nama_barang;
      document.getElementById("harga_barang").value = harga_barang[id_barang].harga_barang;
    };

function total() {
   var harga =  parseInt(document.getElementById('harga_barang').value);
   var jumlah_beli =  parseInt(document.getElementById('quantity').value);
   var jumlah_harga = harga * jumlah_beli;
    document.getElementById('subtotal').value = jumlah_harga;
  }

  function totalnya() {
   var harga =  parseInt(document.getElementById('hargatotal').value);
   var pembayaran =  parseInt(document.getElementById('bayarnya').value);
   var kembali = pembayaran - harga;
    document.getElementById('total1').value = kembali;
  }

  function printContent(print){
			var restorepage = document.body.innerHTML;
			var printcontent = document.getElementById(print).innerHTML;
			document.body.innerHTML = printcontent;
			window.print();
			document.body.innerHTML = restorepage;
		}
  </script>
<?php include 'template/footer.php';?>

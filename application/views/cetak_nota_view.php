Petshop<br>
Finaudi<br>
_________________________________<br>
No Nota :<?= $ts->id_transaksi ?><br>
nama Kasir : <?= $ts->id_kasir ?><br>
Tanggal : <?= $ts->tgl_beli ?>


<table border="1px solid black" style="border-collapse: collapse;">


	<tr>
	<th>No</th><th>Kode Hewan</th><th>Nama Hewan</th><th>Harga</th><th>Jumlah</th><th>Sub Total</th>
	</tr>

	<?php $no=0; foreach($dts as $dts):$no++; $total += $dts->harga*$dts->jumlah;?>

	<tr>

	<td><?= $no?></td><td><?= $dts->kode_hewan?></td><td><?= $dts->nama_hewan?></td><td><?= number_format($dts->harga*$dts->jumlah)?></td><td><?= $dts->jumlah?></td><td><?= number_format($dts->harga * $dts->jumlah)?></td>

	</tr>
<?php endforeach?>

	<tr>

	<td colspan="2">total</td><td colspan="4"><?= $total ?></td>

	</tr>


</table>


<script type="text/javascript">

window.print();
location.href="<?= base_url('index.php/Transaksi')?>";

</script>

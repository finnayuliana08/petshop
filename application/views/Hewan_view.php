<section id="main-content">
<section class="wrapper">
  <div class="row">
    <div class="col-md-15">
      <div class="content-panel">
  <center><h2>Data Hewan</h2></center>
  </div>
  </div>

  <div class="body">

                            <div class="row">
                                <center><a href="#tambah" class="btn btn-primary" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> Tambah</a></center>
                          <div class="panel-body">

                                  <table width="100%" class="table table-striped table-bordered table-hover">
                                  <tr>
                                  <th>ID Hewan</th>
                                  <th>Nama Hewan</th>
                                  <th>Kode Hewan</th>
                                  <th>Jenis Hewan</th>
                                  <th>Jenis Kelamin</th>
                                  <th>Stok</th>
                                  <th>Harga</th>
                                  <th>AKSI</th>
                                </tr>

                                <?php
                                // $no=0;
                                foreach ($arr as $dt_bar) {
                                  // $no++;
                                  echo '<tr>
                                  <td>'.$dt_bar->id_hewan.'</td><td>'.$dt_bar->nama_hewan.'</td><td>'.$dt_bar->kode_hewan.'</td>
                                  <td>'.$dt_bar->jenis_hewan.'</td><td>'.$dt_bar->jenis_kelamin.'</td><td>'.$dt_bar->stok.'</td><td>'.$dt_bar->harga.'</td>

                                  <td>
                                  <a href="#" onclick="prepare_update_hewan('.$dt_bar->id_hewan.')" data-toggle="modal" data-target="#ubahModal" class="btn btn-success btn-md">Ubah</a>
                                  <a href="'.base_url().'index.php/Hewan/hapus/'.$dt_bar->id_hewan.'" class="btn btn-danger btn-md">Hapus</a>
                                </td>
                                  </tr>';
                                }
                                ?>
            </div>
            </div>
            </div>
    </div>
            <!-- /content-panel -->
          </div>
          <!-- /col-md-12 -->
        </div>
        <!-- /row -->
      </section>
    </section>
          <!-- MODAL TAMBAH BARANG -->
<!-- Modal -->
    <div class="modal fade" id="tambah">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">Tambah Hewan</h4>
        </div>
        <div class="modal-body">
        <form action="<?php echo base_url(); ?>index.php/Hewan/add_Hewan" method="post">
        Nama Hewan
        <input type="text" name="nama_hewan" class="form-control"><br>
        Kode Hewan
        <input type="text" name="kode_hewan" class="form-control"><br>
        Jenis Hewan
        <input type="text" name="jenis_hewan" class="form-control"><br>
        Jenis Kelamin
        <input type="text" name="jenis_kelamin" class="form-control"><br>
        Stok
        <input type="text" name="stok" class="form-control"><br>
        Harga
        <input type="text" name="harga" class="form_control"><br>
        <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
        </form>
      </div>
                                </table>
                                <?php if($this->session->flashdata('pesan')!=null): ?>
                                <div class= "alert alert-danger"><?= $this->session->flashdata('pesan');?></div>
                                <?php endif?>
                              </div>
                              </div>
                          </div>

    <div class="modal fade" id="ubahModal">
    <div class="modal-dialog">
      <div class="modal-content">
      <form action="<?php echo base_url() ?>index.php/Hewan/ubah" method="post">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Ubah Hewan</h4>
      </div>
      <div class="modal-body">
      <input type="hidden" name="id_hewan_edit" id="id_hewan_edit">

        Nama Hewan
        <input type="text" id="nama_hewan_edit" name="nama_hewan_edit" class="form-control"><br>
        Jenis Hewan
        <input type="text" id="jenis_hewan_edit" name="jenis_hewan_edit" class="form-control"><br>
        Jenis Kelamin
        <br>
        <input type="text" id="jenis_kelamin_edit" name="jenis_kelamin_edit" class="form-control"><br/>
       <br>
       Stok
       <input type="text" id="stok_hewan_edit" name="stok_hewan_edit" class="form-control"><br>
        <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
      </form>
        </div>

        <script type="text/javascript">
          function prepare_update_hewan(id_hewan)
          {
            $.getJSON('<?php echo base_url() ?>index.php/hewan/json_hewan_by_id/'+id_hewan, function(data){
              $("#nama_hewan_edit").val(data.nama_hewan);
              $("#jenis_hewan_edit").val(data.jenis_hewan);
              $("#jenis_kelamin_edit").val(data.jenis_kelamin);
              $("#id_hewan_edit").val(data.id_hewan);
                $("#stok_hewan_edit").val(data.stok);

            });
          }
        </script>

<section id="main-content">
<section class="wrapper">
  <div class="row">
    <div class="col-md-15">
      <div class="content-panel">
  <center><h2>Data User</h2></center>
  </div>
  </div>


  <div class="body">
    <div class="row">
        <center><a href="#tambah" class="btn btn-primary" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> Tambah</a></center>
  <div class="panel-body">
    <table width="100%" class="table table-striped table-bordered table-hover">
      <tr>
        <th>ID USER</th>
          <th>NAMA USER</th>
          <th>USERNAME</th>
          <th>AKSI</th>
      </tr>
    
    <?php
      foreach ($arr as $dt_bar) {
      echo '<tr>
                                  <td>'.$dt_bar->id_user.'</td><td>'.$dt_bar->nama.'</td><td>'.$dt_bar->uname.'</td>
                                  <td>
                                    <a href="#" onclick="prepare_update_user('.$dt_bar->id_user.')" data-toggle="modal" data-target="#ubah" class="btn btn-success btn-md">Ubah</a>
                                    <a href="'.base_url().'index.php/user/hapus/'.$dt_bar->id_user.'" class="btn btn-danger btn-md">Hapus</a>
                                  </td>
                                  </tr>';
                                }
                                ?>
<!-- MODAL TAMBAH BARANG -->
<!-- Modal -->
    <div class="modal fade" id="tambah">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">Tambah User</h4>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url() ?>index.php/user/add_user" method="post">
          Nama User
          <input type="text"  id="nama"name="nama" class="form-control"><br>
         Username
          <input type="text"  id="uname" name="uname" class="form-control"><br>
          Password
          <input type="text" id="pass" name="pass" class="form-control"><br>
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

    <div class="modal fade" id="ubah">
    <div class="modal-dialog">
      <div class="modal-content">
      <form action="<?php echo base_url() ?>index.php/user/ubah" method="post">
        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">Ubah User</h4>
        </div>
        <div class="modal-body">
        <input type="hidden" name="id_user_edit" id="id_user_edit">

          Nama User
          <input type="text" id="nama_edit" name="nama_edit" class="form-control"><br>
          Username
          <input type="text" id="uname_edit" name="uname_edit" class="form-control"><br>
          Password
          <input type="password" id="pass_edit" name="pass_edit" class="form-control"><br>
          <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
          </form>
        </div>

        <script type="text/javascript">
          function prepare_update_user(id_user)
          {
            $.getJSON('<?php echo base_url() ?>index.php/user/json_user_by_id/'+id_user,function(data){

              $("#nama_edit").val(data.nama);
              $("#uname_edit").val(data.uname);
              $("#pass_edit").val(data.pass);
              $("#id_user_edit").val(data.id_user);

            });
          }
        </script>

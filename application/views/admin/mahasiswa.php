<!-- modal add mahasiswa -->
    <div class="modal fade" id="modalAddMahasiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddMahasiswaTitle">Tambah Data Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url()?>mahasiswa/add_mahasiswa" method="post">
                        <div class="form-group">
                            <label for="nama">Nama Mahasiswa</label>
                            <input type="text" name="nama" id="nama" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="id_kelas">Kelas</label>
                            <select name="id_kelas" id="id_kelas" class="form-control form-control-sm">
                                <option value="">Pilih Kelas</option>
                                <?php foreach ($kelas as $data) :?>
                                    <option value="<?= $data['id_kelas']?>"><?= $data['nama_kelas']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <input type="submit" value="Tambah Mahasiswa" class="btn btn-sm btn-primary" id="submitModalAddMahasiswa">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- modal add mahasiswa -->

<!-- modal edit mahasiswa -->
    <div class="modal fade" id="modalEditMahasiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditMahasiswaTitle">Edit Data Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url()?>mahasiswa/edit_mahasiswa" method="post">
                        <input type="hidden" name="id_user" id="id_user_edit">
                        <div class="form-group">
                            <label for="nama">Status</label>
                            <select name="status" id="status_edit" class="form-control form-control-sm" required>
                                <option value="">Pilih Status</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Nonaktif">Nonaktif</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Mahasiswa</label>
                            <input type="text" name="nama" id="nama_edit" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="id_kelas">Kelas</label>
                            <select name="id_kelas" id="id_kelas_edit" class="form-control form-control-sm">
                                <option value="">Pilih Kelas</option>
                                <?php foreach ($kelas as $data) :?>
                                    <option value="<?= $data['id_kelas']?>"><?= $data['nama_kelas']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <input type="submit" value="Edit Mahasiswa" class="btn btn-sm btn-success" id="submitModalEditMahasiswa">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- modal edit mahasiswa -->

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 mt-3"><?= $title?></h1>
    </div>

    <?php if( $this->session->flashdata('pesan') ) : ?>
        <div class="row">
            <div class="col-6">
                <?= $this->session->flashdata('pesan');?>
                </div>
        </div>
    <?php endif; ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4" style="max-width:850px">
        <div class="card-header">
            <?php if($title == "List Mahasiswa Aktif"):?>
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a href="#modalAddMahasiswa" class="modal-add-mahasiswa nav-link bg-success text-light" data-toggle="modal">tambah mahasiswa</a>
                    </li>
                </ul>
            <?php endif;?>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-sm cus-font" id="dataTable" cellspacing="0">
                    <thead>
                        <th width="5%">No</th>
                        <th width=10%>status</th>
                        <th>Nama</th>
                        <th>Kosa Kata</th>
                        <th>Kelas</th>
                        <th>Wali</th>
                        <th>detail</th>
                    </thead>
                    <tbody>
                        <?php
                            $no = 0;
                            foreach ($mahasiswa as $data) :?>
                                <tr>
                                    <td><center><?= ++$no?></center></td>
                                    <td><center><?= $data['status']?></center></td>
                                    <td><?= $data['nama']?></td>
                                    <td><center><?= $data['kata']?></center></td>
                                    <?php if(!$data['kelas']):?>
                                        <td><center>-</center></td>
                                        <td><center>-</center></td>
                                    <?php else:?>
                                        <td><?= $data['kelas']['nama_kelas']?></td>
                                        <td><?= $data['dosen']['nama_dosen']?></td>
                                    <?php endif;?>
                                    <td><a href="#modalEditMahasiswa" data-id="<?= $data['id_user']?>" data-toggle="modal" class="modal-edit-mahasiswa badge badge-warning">detail</a></td>
                                </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $("#mahasiswa").addClass("active");

    $(".modal-edit-mahasiswa").click(function(){
        var y = 1;
        var urut1 = 1;

        let id = $(this).data("id");

        $.ajax({
            url: "<?= base_url()?>mahasiswa/get_mahasiswa_by_id",
            data: {id: id},
            async: true,
            dataType: 'json',
            method: "POST",
            success: function(data){
                $("#id_user_edit").val(data.id_user);
                $("#nama_edit").val(data.nama);
                $("#status_edit").val(data.status);
                $("#id_kelas_edit").val(data.id_kelas);
            }
        })
        
    })

    // confirm
        $("#submitModalAddMahasiswa").click(function(){
            var c = confirm("Yakin akan menambahkan data mahasiswa?");
            return c;
        })

        $("#submitModalEditMahasiswa").click(function(){
            var c = confirm("Yakin akan mengubah data mahasiswa?");
            return c;
        })
    // confirm
</script>
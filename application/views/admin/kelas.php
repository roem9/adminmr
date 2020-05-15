<!-- modal add kelas -->
    <div class="modal fade" id="modalAddKelas" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddKelasTitle">Tambah Data Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url()?>kelas/add_kelas" method="post">
                        <div class="form-group">
                            <label for="nama_kelas">Nama Kelas</label>
                            <input type="text" name="nama_kelas" id="nama_kelas" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="mustawa">Mustawa</label>
                            <select name="mustawa" id="mustawa" class="form-control form-control-sm">
                                <option value="">Pilih Mustawa</option>
                                <option value="Awwal">Awwal</option>
                                <option value="Tsani">Tsani</option>
                                <option value="Tsalits">Tsalits</option>
                                <option value="Rabi">Rabi</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_dosen">Dosen Wali</label>
                            <select name="id_dosen" id="id_dosen" class="form-control form-control-sm">
                                <option value="">Pilih Dosen Wali</option>
                                <?php foreach ($dosen as $data) :?>
                                    <option value="<?= $data['id_dosen']?>"><?= $data['nama_dosen']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <input type="submit" value="Tambah Kelas" class="btn btn-sm btn-primary" id="submitModalAddKelas">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- modal add kelas -->

<!-- modal edit kelas -->
    <div class="modal fade" id="modalEditKelas" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditKelasTitle">Edit Data Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url()?>kelas/edit_kelas" method="post">
                        <input type="hidden" name="id_kelas" id="id_kelas_edit">
                        <div class="form-group">
                            <label for="nama_kelas">Nama Kelas</label>
                            <input type="text" name="nama_kelas" id="nama_kelas_edit" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="mustawa">Mustawa</label>
                            <select name="mustawa" id="mustawa_edit" class="form-control form-control-sm">
                                <option value="">Pilih Mustawa</option>
                                <option value="Awwal">Awwal</option>
                                <option value="Tsani">Tsani</option>
                                <option value="Tsalits">Tsalits</option>
                                <option value="Rabi">Rabi</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_dosen">Dosen Wali</label>
                            <select name="id_dosen" id="id_dosen_edit" class="form-control form-control-sm">
                                <option value="">Pilih Dosen Wali</option>
                                <?php foreach ($dosen as $data) :?>
                                    <option value="<?= $data['id_dosen']?>"><?= $data['nama_dosen']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <input type="submit" value="Edit Kelas" class="btn btn-sm btn-success" id="submitModalEditKelas">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- modal edit kelas -->

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
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a href="#modalAddKelas" class="modal-add-kelas nav-link bg-success text-light" data-toggle="modal">tambah kelas</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-sm cus-font" id="dataTable" cellspacing="0">
                    <thead>
                        <th width="5%">No</th>
                        <th>Mustawa</th>
                        <th>Nama Kelas</th>
                        <th>Mahasiswa</th>
                        <th>Dosen Wali</th>
                        <th>detail</th>
                    </thead>
                    <tbody>
                        <?php
                            $no = 0;
                            foreach ($kelas as $data) :?>
                                <tr>
                                    <td><center><?= ++$no?></center></td>
                                    <td><?= $data['mustawa']?></td>
                                    <td><?= $data['nama_kelas']?></td>
                                    <td><center><?= $data['mahasiswa']?></center></td>
                                    <td><?= $data['dosen']['nama_dosen']?></td>
                                    <td><a href="#modalEditKelas" data-id="<?= $data['id_kelas']?>" data-toggle="modal" class="modal-edit-kelas badge badge-warning">detail</a></td>
                                </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $("#kelas").addClass("active");

    $(".modal-edit-kelas").click(function(){
        var y = 1;
        var urut1 = 1;

        let id = $(this).data("id");

        $.ajax({
            url: "<?= base_url()?>kelas/get_kelas_by_id",
            data: {id: id},
            async: true,
            dataType: 'json',
            method: "POST",
            success: function(data){
                $("#id_kelas_edit").val(data.id_kelas);
                $("#nama_kelas_edit").val(data.nama_kelas);
                $("#mustawa_edit").val(data.mustawa);
                $("#id_dosen_edit").val(data.id_dosen);
            }
        })
        
    })

    // confirm
        $("#submitModalAddKelas").click(function(){
            var c = confirm("Yakin akan menambahkan data kelas?");
            return c;
        })

        $("#submitModalEditKelas").click(function(){
            var c = confirm("Yakin akan mengubah data kelas?");
            return c;
        })
    // confirm
</script>
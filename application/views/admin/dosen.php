<!-- modal add dosen -->
    <div class="modal fade" id="modalAddDosen" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddDosenTitle">Tambah Data Dosen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url()?>dosen/add_dosen" method="post">
                        <div class="form-group">
                            <label for="nama_dosen">Nama Dosen</label>
                            <input type="text" name="nama_dosen" id="nama_dosen" class="form-control form-control-sm" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <input type="submit" value="Tambah Dosen" class="btn btn-sm btn-primary" id="submitModalAddDosen">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- modal add dosen -->

<!-- modal edit dosen -->
    <div class="modal fade" id="modalEditDosen" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditDosenTitle">Edit Data Dosen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url()?>dosen/edit_dosen" method="post">
                        <input type="hidden" name="id_dosen" id="id_dosen_edit">
                        <div class="form-group">
                            <label for="nama_dosen">Nama Dosen</label>
                            <input type="text" name="nama_dosen" id="nama_dosen_edit" class="form-control form-control-sm" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <input type="submit" value="Edit Dosen" class="btn btn-sm btn-success" id="submitModalEditDosen">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- modal edit dosen -->

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
                    <a href="#modalAddDosen" class="modal-add-dosen nav-link bg-success text-light" data-toggle="modal">tambah dosen</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-sm cus-font" id="dataTable" cellspacing="0">
                    <thead>
                        <th width="5%">No</th>
                        <th width=10%>status</th>
                        <th>Nama</th>
                        <th>detail</th>
                    </thead>
                    <tbody>
                        <?php
                            $no = 0;
                            foreach ($dosen as $data) :?>
                                <tr>
                                    <td><center><?= ++$no?></center></td>
                                    <td><center><?= $data['status']?></center></td>
                                    <td><?= $data['nama_dosen']?></td>
                                    <td><a href="#modalEditDosen" data-id="<?= $data['id_dosen']?>" data-toggle="modal" class="modal-edit-dosen badge badge-warning">detail</a></td>
                                </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $("#dosen").addClass("active");

    $(".modal-edit-dosen").click(function(){
        var y = 1;
        var urut1 = 1;

        let id = $(this).data("id");

        $.ajax({
            url: "<?= base_url()?>dosen/get_dosen_by_id",
            data: {id: id},
            async: true,
            dataType: 'json',
            method: "POST",
            success: function(data){
                $("#id_dosen_edit").val(data.id_dosen);
                $("#nama_dosen_edit").val(data.nama_dosen);
            }
        })
        
    })

    // confirm
        $("#submitModalAddDosen").click(function(){
            var c = confirm("Yakin akan menambahkan data dosen?");
            return c;
        })

        $("#submitModalEditDosen").click(function(){
            var c = confirm("Yakin akan mengubah data dosen?");
            return c;
        })
    // confirm
</script>
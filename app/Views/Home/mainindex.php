<?= $this->extend('template/index new'); ?>

<?= $this->section("content"); ?>

<div class="row">
    <div class="col-lg-12 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-12">
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary m-3" data-bs-toggle="modal"
                            data-bs-target="#basicModal" onclick="add_dialog();">
                            Tambah
                        </button>
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-datatable">
                                <thead>
                                    <tr>
                                        <th> No. </th>
                                        <th> ID Transaksi </th>
                                        <th> Nama Barang </th>
                                        <th> Jumlah </th>
                                        <th> Keterangan </th>
                                        <th> Total </th>
                                        <th> Tanggal Transaksi </th>
                                        <th> Aksi </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Tambah Data</h5>
            </div>
            <div class="modal-body">
                <input type="text" id="id_trans" class="form-control" hidden />
                <input type="text" id="date_trans" class="form-control" hidden />
                <input type="text" id="total" class="form-control" hidden />
                <div class="row">
                    <div class="col mb-3">
                        <label for="id" class="form-label">ID Barang</label>
                        <select id="id" name="id" class="form-select" required>
                            <option value="">Pilih Barang</option>
                            <?php foreach ($getData as $data): ?>
                                <option value="<?= $data->id ?>">
                                    <?= $data->id ?> -
                                    <?= $data->nama ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="text" id="jumlah" class="form-control" placeholder="Masukkan Jumlah Barang"
                            required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="ket" class="form-label">Keterangan Barang</label>
                        <select id="ket" name="ket" class="form-select" required>
                            <option value="">Pilih Keterangan</option>
                            <option value="bks">Bungkus</option>
                            <option value="pak">Pak</option>
                            <option value="pcs">Pcs</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="dismiss();">
                    Tutup
                </button>
                <button type="button" class="btn btn-primary" onclick="saveData();">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    var tabel = null;
    var editDataId = null;
    $(document).ready(function () {
        tabel = $('#table-datatable').DataTable({
            "processing": true,
            "responsive": true,
            "serverSide": true,
            "ordering": true,
            "order": [
                [0, 'asc']
            ],
            "ajax": {
                "url": "<?= base_url('/public/home/grid'); ?>",
                "type": "POST",

            },
            "deferRender": true,
            "aLengthMenu": [
                [10, 25, 50],
                [10, 25, 50]
            ],
            "columns": [
                {
                    "data": 'id_transaksi', "sortable": false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },

                { "data": "id_transaksi" },
                { "data": "nama" },
                { "data": "jumlah" },
                { "data": "keterangan" },
                { "data": "total" },
                { "data": "tanggal_transaksi" },
                {
                    "data": "id_transaksi",
                    "render":
                        function (data, type, row, meta) {
                            return "<a class='btn btn-warning mx-1' href='#' onclick='editData(\"" + data + "\")'>Edit</a><a class='btn btn-danger mx-1' href='#' onclick='deleteData(\"" + data + "\")'>Delete</a>";
                        }
                },
            ],
        });

    });

    function dismiss() {
        $("#basicModal").modal("hide");
    }

    function add_dialog() {
        $("input").val("").prop('readonly', false);
        $("select").val("");
        editDataId = null;
        $("#basicModal").modal("show");
    }

    function saveData() {
        var url = editDataId ? "<?= base_url(); ?>public/home/update" : "<?= base_url(); ?>public/home/save";
        $.ajax({
            method: "POST",
            url: url,
            data: {
                editId: editDataId,
                id_trans: $("#id_trans").val(),
                date_trans: $("#date_trans").val(),
                total: $("#total").val(),
                id: $("#id").val(),
                jumlah: $("#jumlah").val(),
                keterangan: $("#ket").val()
            },
            success: function (result) {
                if (result == "success") {
                    alert("Berhasil disimpan");
                    tabel.ajax.reload();
                    $("#basicModal").modal("hide");
                } else {
                    alert(result);
                }
            }
        });
    }

    function deleteData(data) {
        var id_delete = data;
        $.ajax({
            method: "POST",
            url: "<?= base_url(); ?>public/home/delete",
            data: {
                deleteId: id_delete
            },
            success: function (result) {
                if (result == "success") {
                    alert("Berhasil dihapus");
                    tabel.ajax.reload();
                } else {
                    alert(result);
                }
            }
        });
    }

    function editData(data) {
        editDataId = data;
        $.ajax({
            method: "POST",
            url: "<?= base_url(); ?>public/home/edit",
            data: {
                editId: editDataId
            },
            success: function (result) {
                try {
                    var data = JSON.parse(result);
                    $("#id_trans").val(data.id_transaksi);
                    $("#date_trans").val(data.tanggal_transaksi);
                    $("#total").val(data.total);
                    $("#id").val(data.id);
                    $("#jumlah").val(data.jumlah);
                    $("#ket").val(data.keterangan);

                    $("#basicModal").modal("show");
                } catch (error) {
                    alert("Failed");
                }
            },
            error: function (error) {
                alert("Error: " + error.responseText);
            }
        });
    }
</script>

<?= $this->endSection(); ?>
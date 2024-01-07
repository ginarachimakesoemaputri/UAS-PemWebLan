<?= $this->extend('template/main index'); ?>

<?= $this->section("contentBarang"); ?>

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
                                        <th> ID </th>
                                        <th> Nama </th>
                                        <th> Jumlah </th>
                                        <th> Harga </th>
                                        <th> Jumlah Satuan </th>
                                        <th> Harga Satuan </th>
                                        <th> Keterangan </th>
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
                <div class="row">
                    <div class="col mb-3">
                        <label for="id" class="form-label">ID</label>
                        <input type="text" id="id" class="form-control" placeholder="Masukkan ID Barang" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" id="nama" class="form-control" placeholder="Masukkan Nama Barang" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="text" id="jumlah" class="form-control" placeholder="Masukkan Jumlah" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="text" id="harga" class="form-control" placeholder="Masukkan Harga" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="jumlahpcs" class="form-label">Jumlah Satuan (dijual /pcs)</label>
                        <input type="text" id="jumlahpcs" class="form-control" placeholder="Masukkan Jumlah Satuan" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="hargapcs" class="form-label">Harga Satuan (harga /pcs)</label>
                        <input type="text" id="hargapcs" class="form-control" placeholder="Masukkan Harga Satuan" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="ket" class="form-label">Keterangan</label>
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
                <button type="button" class="btn btn-outline-secondary"  onclick="dismiss();">
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
                "url": "<?= base_url('/public/home/barang/grid'); ?>",
                "type": "POST",

            },
            "deferRender": true,
            "aLengthMenu": [
                [10, 25, 50],
                [10, 25, 50]
            ],
            "columns": [
                {
                    "data": 'id', "sortable": false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                { "data": "id" },
                { "data": "nama" },
                { "data": "jumlah" },
                { "data": "harga" },
                { "data": "jumlah_satuan" },
                { "data": "harga_satuan" },
                { "data": "keterangan" },
                {
                    "data": "id",
                    "render":
                        function (data, type, row, meta) {
                            return "<a class='btn btn-warning mx-1' href='#' onclick='editData(\"" + data + "\")'>Edit</a><a class='btn btn-danger mx-1' href='#' onclick='deleteData(\"" + data + "\")'>Delete</a>";
                        }
                },
            ],
        });

    });

    function add_dialog() {
        $("input").val("").prop('readonly', false);
        $("select").val("");
        editDataId = null;
        $("#basicModal").modal("show");
    }

    function dismiss() {
        $("#basicModal").modal("hide");
    }

    function saveData() {
        var url = editDataId ? "<?= base_url(); ?>public/home/barang/update" : "<?= base_url(); ?>public/home/barang/save";
        $.ajax({
            method: "POST",
            url: url,
            data: {
                editId: editDataId,
                id: $("#id").val(),
                nama: $("#nama").val(),
                jumlah: $("#jumlah").val(),
                keterangan: $("#ket").val(),
                harga: $("#harga").val(),
                harga_satuan: $("#hargapcs").val(),
                jumlah_satuan: $("#jumlahpcs").val()
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
            url: "<?= base_url(); ?>public/home/barang/delete",
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
            url: "<?= base_url(); ?>public/home/barang/edit",
            data: {
                editId: editDataId
            },
            success: function (result) {
                try {
                    var data = JSON.parse(result);
                    $("#id").val(data.id).prop('readonly', true);
                    $("#nama").val(data.nama);
                    $("#jumlah").val(data.jumlah);
                    $("#ket").val(data.keterangan);
                    $("#harga").val(data.harga);
                    $("#hargapcs").val(data.harga_satuan);
                    $("#jumlahpcs").val(data.jumlah_satuan);

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
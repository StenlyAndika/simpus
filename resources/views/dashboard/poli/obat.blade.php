<div class="modal fade" id="tambahObatKeluar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Obat Keluar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="obatKeluarFormSubmit" action="{{ route("admin.poli.storeobat") }}" method="post">
                    @csrf
                    <div class="row mb-2">
                        <div class="col-md-6">    
                            <div class="input-group">
                                <span class="input-group-text col-md-3">Cari Obat</span>
                                <input type="text" class="form-control" id="cariobat" name="nama" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text col-md-3">Jumlah</span>
                                <input type="number" class="form-control numberInput" id="jumlah" name="jumlah" value="1">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text col-md-3">Dosis</span>
                                <input type="hidden" class="form-control" id="idobat" name="id" value="">
                                <input type="text" class="form-control" id="dosis" name="dosis" value="" placeholder="3x1">
                                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="mb-2">
                    <div class="table-responsive">
                        <table id="obatTable" class="table table-striped datatablea">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Obat</th>
                                    <th>Jumlah</th>
                                    <th>Dosis</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Rows will be added here by JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div>
                    <button type="button" class="btn btn-sm btn-primary formAmbilObat">Simpan</button>
                    <button type="button" class="btn btn-sm btn-secondary formAmbilObat">Batal</button>
                </div>
            </div>
        </div>
    </div>
</div>
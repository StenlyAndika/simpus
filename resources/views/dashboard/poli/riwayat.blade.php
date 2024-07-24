<div class="modal fade" id="dataRiwayat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Riwayat Berobat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="table-responsive col-md-8">
                        <table class="table table-striped datatable">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">#</th>
                                    <th style="text-align: left;">Tanggal Berobat</th>
                                    <th style="text-align: left;">Dokter</th>
                                    <th style="text-align: left;">S</th>
                                    <th style="text-align: left;">P</th>
                                    <th style="text-align: left;">Alergi Obat</th>
                                    <th style="text-align: left;">Opsi</th>
                                </tr>
                            </thead>
                            <tbody id="tableriwayat">
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-2">
                            <div class="input-group">
                                <span class="input-group-text col-md-5">Tanggal Berobat</span>
                                <input type="text" class="form-control" id="rtgl" value="" readonly>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="input-group">
                                <span class="input-group-text col-md-5">Dokter</span>
                                <input type="text" class="form-control" id="rdokter" value="" readonly>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="input-group">
                                <span class="input-group-text col-md-5">S (Subjective)</span>
                                <textarea class="form-control" id="rs" cols="30" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="input-group">
                                <span class="input-group-text col-md-5">O (Objective)</span>
                                <textarea class="form-control" id="ro" cols="30" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="input-group">
                                <span class="input-group-text col-md-5">A (Penilaian)</span>
                                <textarea class="form-control" id="ra" cols="30" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="input-group">
                                <span class="input-group-text col-md-5">P (Perencanaan)</span>
                                <textarea class="form-control" id="rp" cols="30" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>
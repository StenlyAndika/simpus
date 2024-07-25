<div class="modal fade" id="tambahObjective" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Objective (Objektif)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="formObjective" action="{{ route('admin.poli.storesoap') }}" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="col-md-12 mb-2">
                        <div class="input-group">
                            <span class="input-group-text col-md-4">Tekanan Darah</span>
                            <input type="number" class="form-control numberInput" id="td" name="td" value="{{ session('temp_soap_data.td') ?? '' }}" autocomplete="off">
                            <span class="input-group-text col-md-2">MmHg</span>
                        </div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <div class="input-group">
                            <span class="input-group-text col-md-4">Nadi</span>
                            <input type="number" class="form-control numberInput" id="n" name="n" value="{{ session('temp_soap_data.n') ?? '' }}" autocomplete="off">
                            <span class="input-group-text col-md-2">x/mnt</span>
                        </div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <div class="input-group">
                            <span class="input-group-text col-md-4">Resp</span>
                            <input type="number" class="form-control numberInput" id="r" name="r" value="{{ session('temp_soap_data.r') ?? '' }}" autocomplete="off">
                            <span class="input-group-text col-md-2">x/mnt</span>
                        </div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <div class="input-group">
                            <span class="input-group-text col-md-4">Suhu</span>
                            <input type="number" class="form-control numberInput" id="suhu" name="suhu" value="{{ session('temp_soap_data.suhu') ?? '' }}" autocomplete="off">
                            <span class="input-group-text col-md-2">°C</span>
                        </div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <div class="input-group">
                            <span class="input-group-text col-md-4">Tinggi Badan</span>
                            <input type="number" class="form-control numberInput" id="tb" name="tb" value="{{ session('temp_soap_data.tb') ?? '' }}" autocomplete="off">
                            <span class="input-group-text col-md-2">cm</span>
                        </div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <div class="input-group">
                            <span class="input-group-text col-md-4">Berat Badan</span>
                            <input type="number" class="form-control numberInput" id="bb" name="bb" value="{{ session('temp_soap_data.bb') ?? '' }}" autocomplete="off">
                            <span class="input-group-text col-md-2">kg</span>
                        </div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <div class="input-group">
                            <span class="input-group-text col-md-4">Kepala</span>
                            <input type="number" class="form-control numberInput" id="kepala" name="kepala" value="{{ session('temp_soap_data.kepala') ?? '' }}" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <div class="input-group">
                            <span class="input-group-text col-md-4">Dada</span>
                            <input type="number" class="form-control numberInput" id="dada" name="dada" value="{{ session('temp_soap_data.dada') ?? '' }}" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <div class="input-group">
                            <span class="input-group-text col-md-4">Abdomen</span>
                            <input type="number" class="form-control numberInput" id="abdomen" name="abdomen" value="{{ session('temp_soap_data.abdomen') ?? '' }}" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <div class="input-group">
                            <span class="input-group-text col-md-4">Extermitas</span>
                            <input type="number" class="form-control numberInput" id="extermitas" name="extermitas" value="{{ session('temp_soap_data.extermitas') ?? '' }}" autocomplete="off">
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
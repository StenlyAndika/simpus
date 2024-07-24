<div class="modal fade" id="tambahAssesment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Assesment (Penilaian)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="formAssesment" action="{{ route('admin.poli.storesoap') }}" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="mb-2">
                        <input type="hidden" id="a" name="a" value="{{ session('temp_soap_data.a') ?? '' }}">
                        <trix-editor input="a"></trix-editor>
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <meta name="description" content="-">
    <meta name="keywords" content="- Kota Sungai Penuh">
    <meta name="author" content="Pemerintah Kota Sungai Penuh">

    <link rel="icon" href="/img/tablogo.png">
    <title>{{ $title }}</title>

    <!-- Vendor CSS STYLE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/vendor/datepicker/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link href="/rocker/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="/rocker/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="/rocker/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="/rocker/css/bootstrap-extended.css" rel="stylesheet">
	<link href="/rocker/css/app.css" rel="stylesheet">
	<link href="/css/custom.css" rel="stylesheet">

    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }
        span, input, button, label, textarea{
            font-size: 14px !important;
        }
    </style>
</head>
<body>
    <div class="wrapper">

        @include('partials.adminnav')

        <div class="page-wrapper">
            <div class="page-content">

            @yield('container')

            </div>
        </div>
        <div class="overlay toggle-icon"></div>
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    </div>

    <!-- Vendor JS Files -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="/vendor/datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/rocker/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="/rocker/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="/rocker/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="/rocker/js/app.js"></script>
    
    @include('sweetalert::alert')

    @if(auth()->user()->poli != "SUPER ADMIN" && auth()->user()->poli != 'PENDAFTARAN' && auth()->user()->poli != 'APOTEK' && request()->segment(2) == "")
    <script>
        $(document).ready(function() {
            function cekAntrianPoli() {
                $.ajax({
                    url: '{{ route("admin.poli.cekantrian") }}',
                    method: 'GET',
                    success: function(response) {
                        if (response.waiting) {
                            Swal.fire({
                                title: 'Ada Pasien!',
                                text: "ada pasien sedang menunggu antrian!",
                                icon: 'info',
                                toast: true,
                                position: 'bottom-end', 
                                showConfirmButton: false,
                                timer: 5000});
                        }
                    },
                    error: function() {
                        console.error('Error checking waiting status.');
                    }
                });
            }

            setInterval(cekAntrianPoli, 15000);
        });
    </script>
    @endif
    @if(request()->segment(2) == "diagnosa")
    <script>
        $(document).ready(function() {
            $('#cariobat').autocomplete({
                appendTo: '#tambahObatKeluar',
                source: function(request, response) {
                    $.ajax({
                        url: "{{ route('cariobat') }}",
                        data: {
                            term: request.term
                        },
                        dataType: "json",
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                minLength: 2,
                select: function(event, ui) {
                    $('#idobat').val(ui.item.id); // Set the hidden input with the selected ID
                }
            });

            $('#obatKeluarFormSubmit').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response) {
                        if(response.success) {
                            updateTable();
                        }
                        $('#cariobat').val('');
                        $('#jumlah').val('1');
                        $('#idobat').val('');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });

            function updateTable() {
                $.ajax({
                    url: '{{ route("gettempObat") }}',
                    method: 'GET',
                    success: function(response) {
                        var tableBody = $('#obatTable tbody');
                        tableBody.empty();
                        var i = 1;
                        response.data.forEach(function(item) {
                            tableBody.append('<tr data-id="' + item.id + '"><td>' + i + '</td><td>' + item.nama + '</td><td>' + item.jumlah + '</td><td><button type="button" class="btn btn-danger hapusObat">Delete</button></td></tr>');
                            i++;
                        });

                        // Attach delete event handler to new buttons
                        attachDeleteHandlers();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }

            function attachDeleteHandlers() {
                $('.hapusObat').on('click', function(e) {
                    e.preventDefault();
                
                    // Get the row element and ID
                    var row = $(this).closest('tr');
                    var id = row.data('id');

                    $.ajax({
                        url: '/delete-obat/' + id, // Adjust URL as needed
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                // Remove the row from the table
                                row.remove();
                            } else {
                                console.log('Failed to delete data.');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error deleting data:', error);
                        }
                    });
                });
            }

            // Initial load of table data
            updateTable();

            $('.formAmbilObat').on('click', function(e){
                e.preventDefault();
                $('#tambahObatKeluar').modal('hide');
                $('#ambilObatContainer').load(location.href + ' #ambilObatInput');
            });

            $('#formSubjective').on('submit', function(e){
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#tambahSubjective').modal('hide');
                        $('#subjectiveContainer').load(location.href + ' #subjectiveInput');
                    },
                    error: function(response) {
                        alert('An error on subjective occurred. Please try again.');
                    }
                });
            });

            $('#formObjective').on('submit', function(e){
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#tambahObjective').modal('hide');
                        $('#objectiveContainer').load(location.href + ' #objectiveInput');
                    },
                    error: function(response) {
                        alert('An error on objective occurred. Please try again.');
                    }
                });
            });

            $('#formAssesment').on('submit', function(e){
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#tambahAssesment').modal('hide');
                        $('#assesmentContainer').load(location.href + ' #assesmentInput');
                    },
                    error: function(response) {
                        alert('An error on assesment occurred. Please try again.');
                    }
                });
            });

            $('#formPlanning').on('submit', function(e){
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#tambahPlanning').modal('hide');
                        $('#planningContainer').load(location.href + ' #planningInput');
                    },
                    error: function(response) {
                        alert('An error occurred. Please try again.');
                    }
                });
            });

            $('#dataRiwayat').on('shown.bs.modal',function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var nik = button.data('id'); // Extract info from data-* attributes
                var modal = $(this);

                // Make an AJAX request to fetch data by ID
                $.ajax({
                    url: '/dashboard/cekriwayat/' + nik, // Change this URL to your endpoint
                    type: 'GET',
                    success: function(response) {
                        $('#rtgl').val('');
                        $('#rdokter').val('');
                        $('#rs').val('');
                        $('#ro').val('');
                        $('#ra').val('');
                        $('#rp').val('');
                        // Clear the table body
                        var tableBody = modal.find('#tableriwayat');
                        tableBody.empty();

                        // Populate the table with the fetched data
                        response.data.forEach(function(item, index) {
                            var date = new Date(item.tgl);
                            var formattedDate = ('0' + date.getDate()).slice(-2) + '-' + 
                                                ('0' + (date.getMonth() + 1)).slice(-2) + '-' + 
                                                date.getFullYear();
                            var row = `<tr>
                                        <th scope="row">${index + 1}</th>
                                        <td>${formattedDate}</td>
                                        <td>${item.nama}</td>
                                        <td>${item.s}</td>
                                        <td>${item.a}</td>
                                        <td><button type="button" class="btn btn-block btn-sm btn-primary cekDataBtn" data-row-id="${item.idp}">Cek Data</button></td>
                                    </tr>`;
                            tableBody.append(row);
                        });
                        attachGetRiwayatHandlers();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', error);
                    }
                });
            });

            function attachGetRiwayatHandlers() {
                $('.cekDataBtn').on('click', function() {
                    var rowId = $(this).data('row-id');

                    $.ajax({
                        type: 'GET',
                        url: '/dashboard/getriwayat/' + rowId, // Adjust the URL as needed
                        success: function(response) {
                            // console.log(data.tgl);
                            // Populate the modal with the fetched data
                            var date = new Date(response.data[0].tgl);
                            var formattedDate = ('0' + date.getDate()).slice(-2) + '-' + 
                                                ('0' + (date.getMonth() + 1)).slice(-2) + '-' + 
                                                date.getFullYear();
                            $('#rtgl').val(formattedDate);
                            $('#rdokter').val(response.data[0].nama);
                            $('#rs').val(response.data[0].ds.replace(/<\/?[^>]+(>|$)/g, ""));
                            $('#ro').val('td: ' + response.data[0].td + ', n: '+response.data[0].n+
                            '\nr: '+response.data[0].r + ', s: '+response.data[0].suhu+
                            '\ntb: '+response.data[0].tb + ', bb: '+response.data[0].bb+
                            '\nkepala: '+response.data[0].kepala + ', dada: '+response.data[0].dada+
                            '\nabdomen: '+response.data[0].abdomen + ', extermitas: '+response.data[0].extermitas);
                            $('#ra').val(response.data[0].a.replace(/<\/?[^>]+(>|$)/g, ""));
                            // $('#rp').val('Obat diambil:\n'+
                            //     response.data[0].namaobat
                            // );
                        },
                        error: function(response) {
                            console.log('An error occurred while fetching data.');
                        }
                    });
                });
            }

        });
    </script>
    @endif
    <script>
        $(document).ready(function() {
            document.addEventListener('trix-file-accept', function(e) {
                e.preventDefault();
            });

            $('.select2-bootstrap4').select2({
                theme: 'bootstrap4',
            });

            $('.numberInput').on('keypress', function(evt) {
                // Allow only backspace, delete, arrow keys, and numbers
                var ASCIICode = (evt.which) ? evt.which : evt.keyCode;
                if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) {
                    evt.preventDefault();
                }
            });

            $('#pasbaru').click(function() {
                $('#status').val('Belum Terdaftar');
                $('#idpas').val('');
                $('#tgl').val('');
                $('#bln').val('');
                $('#thn').val('');
                $('#namakk').val('');
                $('#nomr').val('');
                $('#nik').val('');
                $('#jekel').val('0').change();
                $('#pekerjaan').val('');
                $('#alamat').val('');
                $('#nohp').val('');
            });

            $('#poli').change(function() {
                var poli = $(this).val();
                $.ajax({
                    url: `/noantri/${poli}`,
                    type: 'GET',
                    success: function(response) {
                        var prefix = poli.substring(0, 2).toUpperCase();
                        var newRegNumber;
                        if (response.noantrian) {
                            var number = parseInt(response.noantrian.substring(2));
                            var incrementedNumber = number + 1;
                            newRegNumber = prefix + String(incrementedNumber).padStart(3, '0');
                        } else {
                            newRegNumber = prefix + '001';
                        }
                        $('#noantrian').val(newRegNumber);
                    },
                    error: function(xhr) {
                        $('#noantrian').val('Error');
                    }
                });
            });

            $('#rujukIntern').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var id = button.data('id'); // Extract info from data-* attributes
                var urlTemplate = button.data('url'); // Get the URL with the placeholder
                var actionUrl = urlTemplate.replace(':idp', id); // Replace the placeholder with the actual ID
                $('#updateRujukIntern').attr('action', actionUrl);
            });

            $('#caripasien').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "{{ route('caripasien') }}",
                        data: {
                            term: request.term
                        },
                        dataType: "json",
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                minLength: 2,
                select: function(event, ui) {
                    $.ajax({
                        url: `/getpasien/${ui.item.idpas}`,
                        dataType: "json",
                        success: function(data) {
                            // Populate the input fields
                            $('#idpas').val(data.idpas);
                            $('#namakk').val(data.namakk);
                            $('#nomr').val(data.nomr);
                            $('#nik').val(data.nik);

                            let birthdate = new Date(data.tgl);
                            let day = birthdate.getDate();
                            let month = birthdate.getMonth() + 1; // Months are zero-indexed
                            let year = birthdate.getFullYear();
                            $('#tgl').val(day);
                            $('#bln').val(month);
                            $('#thn').val(year);

                            $('#jekel').val(data.jekel).change();
                            $('#pekerjaan').val(data.pekerjaan).change();
                            $('#alamat').val(data.alamat);
                            $('#nohp').val(data.nohp);
                            $('#status').val('Sudah Terdaftar');
                        },
                        error: function() {
                            alert('User data could not be retrieved.');
                        }
                    });
                }
            });

            $('.datatable').DataTable({
                pageLength : 10,
                lengthMenu: [[10, 20, 30], [10, 20, 30]],
                'paging': true,
                'lengthChange': true,
                'searching': true,
                'ordering': false,
                'info': false,
                'autoWidth': true,
                "language":{
                    "url":"https://cdn.datatables.net/plug-ins/1.11.5/i18n/id.json",
                    "sEmptyTable":"Tidak ada data."
                }
            });

            $(".hapusDataM").click(function (event) {
                var form =  $(this).closest("form");
                event.preventDefault();
                Swal.fire({
                    title: 'Hapus data?',
                    text: "data yang sudah dihapus tidak akan bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#004A99',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            $(".setSuperAdmin").click(function (event) {
                var form =  $(this).closest("form");
                event.preventDefault();
                Swal.fire({
                    title: 'Akses Super Admin?',
                    html: "Berikan akses super admin pada user ini?<br>user akan dapat mengoperasikan seluruh fitur yang terdapat pada Akses Super Admin!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#004A99',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Beri Akses',
                    cancelButtonText: 'Batalkan'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

        });
    </script>

</body>
</html>
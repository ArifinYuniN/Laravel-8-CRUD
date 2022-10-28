<!DOCTYPE html>
<html>

<head>
    <title>Laravel 8 Crud operation using ajax(Real Programmer)</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <h1>Info Pendaftaran Siswa Baru</h1>
        <a class="btn btn-success" href="javascript:void(0)" id="createNewBook"> Create New Book</a>
        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Asal Sekolah</th>
                    <th>Agama</th>
                    <th>Bahasa Indo</th>
                    <th>IPA</th>
                    <th>MTK</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="bookForm" name="bookForm" class="form-horizontal">
                        <input type="hidden" name="book_id" id="book_id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Nama</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="title" required name="nama" placeholder="Nama..." value="" maxlength="50">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Alamat</label>
                            <div class="col-sm-12">
                                <textarea id="alamat" name="alamat" placeholder="Alamat" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tanggal Lahir</label>
                            <div class="col-sm-12">
                                <input type="date" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir..." class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Jenis Kelamin</label>
                            <div class="col-sm-12">
                                <select class="form-control" name="jenis_kelamin">
                                    <option selected>Pilih</option>
                                    <option value="Pria">Pria</option>
                                    <option value="Wanita">Wanita</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Asal Sekolah</label>
                            <div class="col-sm-12">
                                <input type="text" id="asal_sekolah" name="asal_sekolah" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Agama</label>
                            <div class="col-sm-12">
                                <select class="form-control" name="agama_id">
                                    <option selected>Pilih</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Budha">Budha</option>
                                    <option value="Konghucu">Konghucu</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nilai Indo</label>
                            <div class="col-sm-12">
                                <input type="number" id="nilai_ind" name="nilai_ind" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nilai IPA</label>
                            <div class="col-sm-12">
                                <input type="number" id="nilai_ipa" name="nilai_ipa" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nilai MTK</label>
                            <div class="col-sm-12">
                                <input type="number" id="nilai_mtk" name="nilai_mtk" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save AS
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('books.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'tanggal_lahir',
                        name: 'tanggal_lahir'
                    },
                    {
                        data: 'jenis_kelamin',
                        name: 'jenis_kelamin'
                    },
                    {
                        data: 'asal_sekolah',
                        name: 'asal_sekolah'
                    },
                    {
                        data: 'agama_id',
                        name: 'agama_id'
                    },
                    {
                        data: 'nilai_ind',
                        name: 'nilai_ind'
                    },
                    {
                        data: 'nilai_ipa',
                        name: 'nilai_ipa'
                    },
                    {
                        data: 'nilai_mtk',
                        name: 'nilai_mtk'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
            $('#createNewBook').click(function() {
                $('#saveBtn').val("create-book");
                $('#book_id').val('');
                $('#bookForm').trigger("reset");
                $('#modelHeading').html("Create New Book hast");
                $('#ajaxModel').modal('show');
            });
            $('body').on('click', '.editBook', function() {
                var book_id = $(this).data('id');
                $.get("{{ route('books.index') }}" + '/' + book_id + '/edit', function(data) {
                    $('#modelHeading').html("Edit Book");
                    $('#saveBtn').val("edit-book");
                    $('#ajaxModel').modal('show');
                    $('#book_id').val(data.id);
                    $('#nama').val(data.nama);
                    $('#alamat').val(data.alamat);
                    $('#tanggal_lahir').val(data.tanggal_lahir);
                    $('#jenis_kelamin').val(data.jenis_kelamin);
                    $('#asal_sekolah').val(data.asal_sekolah);
                    $('#agama_id').val(data.agama_id);
                    $('#nilai_ind').val(data.nilai_ind);
                    $('#nilai_ipa').val(data.nilai_ipa);
                    $('#nilai_mtk').val(data.nilai_mtk);
                })
            });
            $('#saveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Save su');

                $.ajax({
                    data: $('#bookForm').serialize(),
                    url: "{{ route('books.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {

                        $('#bookForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();

                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                    }
                });
            });

            $('body').on('click', '.deleteBook', function() {

                var book_id = $(this).data("id");
                confirm("Are You sure want to delete !");

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('books.store') }}" + '/' + book_id,
                    success: function(data) {
                        table.draw();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            });

        });
    </script>
</body>

</html>
@extends('layouts.admin')

@section('content')

<script src='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.js'></script>
<link href='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.css' rel='stylesheet' />
<style type="text/css">
    #createMap {
        position: relative;
        width: 100%;
        height: 350px;
    }

    #updateMap {
        position: relative;
        width: 100%;
        height: 350px;
    }
</style>

<div class="mt-4">
    <h1 style="margin-bottom: 20px;">Tempat Vaksin</h1>
    <!-- Button trigger modal -->
    <a class="btn btn-primary" href="javascript:void(0)" id="createButton">Tambah Tempat Vaksin</a>
    <div class="w-100 mt-3">
        <div class="">
            <table class="table table-bordered data-table table-responsive">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="">Nama Tempat Vaksin</th>
                        <th width="">Alamat</th>
                        <th width="">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>    
        </div>
    </div>

    <div>
        <div class="modal fade" id="CreateOrUpdateModal" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="CreateOrUpdateHeader"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                    <form id="vaksinForm" name="vaksinForm" class="form-horizontal">
                        <input type="hidden" name="tempat_id" id="tempat_id">
                        <div class="row">
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="nama" class="control-label">Nama Tempat Vaksin</label>
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Tempat Vaksin" value="" maxlength="50" required="">
                                </div>                            

                                <div class="form-group">
                                    <label for="alamat" class="control-label">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat" value="" maxlength="200" required="">
                                </div>                            
                            </div>

                            <div class="col-sm-8 mb-2">
                                <label>Masukkan Lokasi Berdasarkan Maps</label>
                                <div id="createMap"></div>
                                <div id="updateMap"></div>
                            </div>

                            <input type="hidden" id="latitude" name="latitude" value>
                            <input type="hidden" id="longitude" name="longitude" value>
                        </div>

                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary w-100" id="saveBtn" value="create">Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="modal fade" id="DeleteModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="DeleteHeader"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                    <form id="vaksinDeleteForm" name="vaksinDeleteForm" class="form-horizontal">
                        <input type="hidden" name="tempat_id_delete" id="tempat_id_delete">
                        <h5>Ingin menghapus tempat vaksin di <strong id="namas"></strong>?</h5>

                        <button type="submit" class="btn btn-danger w-100" id="delBtn" value="delete">Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    L.mapbox.accessToken = 'pk.eyJ1IjoiYXJpcG9uIiwiYSI6ImNrbjV3cmZ5NTA4aDUyd25zenk3MmlwYzgifQ.YbJ_Ir794eD8VlrVvpX64g';
    var createMap = L.mapbox.map('createMap');
    var updateMap = L.mapbox.map('updateMap');
</script>

<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.tempat-vaksin.index') }}",
            columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nama_tempat', name: 'nama_tempat'},
            {data: 'alamat', name: 'alamat'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#createButton').click(function () {
            $('#updateMap').hide();
            $('#createMap').show();

            createMap.setView([-7.9666204, 112.6326321], 10)
            .addLayer(L.mapbox.styleLayer('mapbox://styles/mapbox/streets-v11'));

            var createMarker = L.marker();

            function onCreateMapClick(e) {  
                createMap.setView(e.latlng);
                createMap.invalidateSize();
                createMap.removeLayer(createMarker);
                createMarker = new L.marker(e.latlng).addTo(createMap);
                $('#latitude').val(e.latlng.lat);
                $('#longitude').val(e.latlng.lng);
            }
            createMap.on('click', onCreateMapClick);

            $('#CreateOrUpdateModal').on('shown.bs.modal', function() {
                createMap.invalidateSize();
            });

            $('#saveBtn').val("create");
            $('#tempat_id').val('');
            $('#vaksinForm').trigger("reset");
            $('#CreateOrUpdateHeader').html("Tambah Tempat Vaksin");
            $('#CreateOrUpdateModal').modal('show');
        });

        $('body').on('click', '.editData', function () {
            var tempat_id = $(this).data('id');
            $.get("{{ route('admin.tempat-vaksin.index') }}" +'/' + tempat_id, function (data) {                
                $('#createMap').hide();
                $('#updateMap').show();
                updateMap.setView([data[0].latitude, data[0].longitude], 10)
                .addLayer(L.mapbox.styleLayer('mapbox://styles/mapbox/streets-v11'));

                var oldMarker = L.marker();
                oldMarker = new L.marker([data[0].latitude, data[0].longitude]).addTo(updateMap);

                var updateMarker = L.marker();                

                function onUpdateMapClick(e) {  
                    updateMap.setView(e.latlng);
                    updateMap.invalidateSize();
                    updateMap.removeLayer(updateMarker);
                    updateMap.removeLayer(oldMarker);
                    updateMarker = new L.marker(e.latlng).addTo(updateMap);
                    $('#latitude').val(e.latlng.lat);
                    $('#longitude').val(e.latlng.lng);
                }
                updateMap.on('click', onUpdateMapClick);

                $('#CreateOrUpdateModal').on('shown.bs.modal', function() {
                    updateMap.invalidateSize();
                });

                $('#CreateOrUpdateHeader').html("Edit Tempat Vaksin");
                $('#saveBtn').val("edit");
                $('#CreateOrUpdateModal').modal('show');
                $('#tempat_id').val(data[0].id_tempat_vaksin);
                $('#nama').val(data[0].nama_tempat);
                $('#alamat').val(data[0].alamat);
            })
        });

        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Memproses..');

            $.ajax({
                data: $('#vaksinForm').serialize(),
                url: "{{ route('admin.tempat-vaksin.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#vaksinForm').trigger("reset");
                    $('#CreateOrUpdateModal').modal('hide');
                    $('#latitude').val();
                    $('#longitude').val();
                    $('#saveBtn').html('Simpan');
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Simpan');
                }
            });
        });

        $('body').on('click', '.deleteData', function () {
            var tempat_id = $(this).data('id');
            $.get("{{ route('admin.tempat-vaksin.index') }}" +'/' + tempat_id, function (data) {
                $('#DeleteHeader').html("Hapus Tempat Vaksin");
                $('#saveBtn').val("edit");
                $('#DeleteModal').modal('show');
                $('#tempat_id_delete').val(data[0].id_tempat_vaksin);
                $('#namas').html(data[0].nama_tempat);
            })
        });

        $('#delBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Memproses..');
            var tempat_id = $('#tempat_id_delete').val();
            var url = '{{ route("admin.tempat-vaksin.destroy", ":id") }}';
            url = url.replace(':id', tempat_id );
            $.ajax({
                type: "DELETE",
                url: url,
                success: function (data) {
                    table.draw();
                    $('#vaksinDeleteForm').trigger("reset");
                    $('#DeleteModal').modal('hide');
                    $('#delBtn').html('Hapus');
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

    });
</script>

@endsection
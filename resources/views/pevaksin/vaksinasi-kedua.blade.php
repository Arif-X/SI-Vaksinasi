@extends('layouts.pevaksin')

@section('content')

<div class="mt-4">
	<h1 style="margin-bottom: 20px;">Vaksinasi Kedua</h1>
	<!-- Button trigger modal -->
	<a class="btn btn-primary" href="javascript:void(0)" id="createButton">Tambah Data Vaksinasi Kedua</a>
	<div class="w-100 mt-3">
		<div class="">
			<table class="table table-bordered data-table table-responsive">
				<thead>
					<tr>
						<th width="5%">No</th>
						<th width="">NIK</th>
						<th width="">Nama</th>
						<th width="">Tanggal Vaksin</th>
						<th width="">Nama Vaksin</th>
						<th width="">Tempat Vaksin</th>
						<th width="">Nama Pevaksin</th>
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
						<form id="vaksinasiForm" name="vaksinasiForm" class="form-horizontal">
							<input type="hidden" name="id_vaksinasi" id="id_vaksinasi">
							<div class="col-sm-12">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Nama</label>
											<input type="text" name="get_user" id="get_user" class="form-control" placeholder="Masukkan Nama" autocomplete="off" required />
											<div class="dropdown-menu" id="dropdown-menu-user">
											</div>
										</div>
									</div>

									<div class="col-sm-6">
										<div class="form-group">
											<label>Jenis Vaksin</label>
											<select name="jenis_vaksin" class="form-control">
												<option value="">Pilih Jenis Vaksin</option>
												@foreach ($jenis_vaksin as $key => $value)
												<option value="{{ $key }}">{{ $value }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Tanggal Vaksin</label>
											<input type="date" name="tanggal" id="tanggal" class="form-control"  autocomplete="off" required />
										</div>
									</div>

									<div class="col-sm-6">
										<div class="form-group">
											<label>Tempat Vaksin</label>
											<input type="text" name="get_tempat" id="get_tempat" class="form-control" placeholder="Masukkan Tempat Vaksin" autocomplete="off" required />
											<div class="dropdown-menu" id="dropdown-menu-tempat">
											</div>
										</div>
									</div>
								</div>
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
							<form id="VaksinasiDeleteForm" name="VaksinasiDeleteForm" class="form-horizontal">
								<input type="hidden" name="vaksinasi_id_delete" id="vaksinasi_id_delete">
								<h5>Ingin menghapus data vaksinasi kedua <strong id="namas"></strong>?</h5>

								<button type="submit" class="btn btn-danger w-100" id="delBtn" value="delete">Hapus
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div>
			<div class="modal fade" id="AlertModal" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="AlertHeader"></h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body text-justify">
							<h5>
								Data Profil Vaksinasi Bisa Diupdate Di Halaman Vaksinasi Pertama<br><br>
								<strong>Pastikan</strong>
								<ul>
									<li>Email belum terpakai oleh user lain</li>
									<li>NIK tidak boleh sama</li>
									<li>Vaksinasi kedua secepat-cepatnya harus lebih dari 30 hari</li>
									<li>Jenis vaksin harus sama dengan jenis vaksin yang diberikan pada vaksinasi pertama</li>
								</ul>
								<strong>Jika tidak mencapai kriteria diatas, maka data tidak akan tersimpan</strong>
							</h5>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#AlertHeader').html("Alert");
		$('#AlertModal').modal('show');
	});
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
			ajax: "{{ route('pevaksin.vaksinasi-kedua.index') }}",
			columns: [
			{data: 'DT_RowIndex', name: 'DT_RowIndex'},
			{data: 'nik', name: 'nik'},
			{data: 'nama', name: 'nama'},
			{data: 'tanggal_vaksin', name: 'tanggal_vaksin'},
			{data: 'nama_vaksin', name: 'nama_vaksin'},
			{data: 'nama_tempat', name: 'nama_tempat'},
			{data: 'nama_pevaksin', name: 'nama_pevaksin'},
			{data: 'action', name: 'action', orderable: false, searchable: false},
			]
		});

		$('#createButton').click(function () {            
			$('#saveBtn').val("create");
			$('#vaksinasi_id').val('');
			$('#vaksinasiForm').trigger("reset");
			$('#CreateOrUpdateHeader').html("Tambah Vaksinasi");
			$('#CreateOrUpdateModal').modal('show');
		});

		$('#saveBtn').click(function (e) {
			e.preventDefault();
			$(this).html('Memproses..');

			$.ajax({
				data: $('#vaksinasiForm').serialize(),
				url: "{{ route('pevaksin.vaksinasi-kedua.store') }}",
				type: "POST",
				dataType: 'json',
				success: function (data) {
					$('#vaksinasiForm').trigger("reset");
					$('#CreateOrUpdateModal').modal('hide');
					$('#saveBtn').html('Simpan');
					table.draw();
				},
				error: function (data) {
					console.log('Error:', data);
					alert("Pastikan email belum terpakai oleh user lain, NIK tidak boleh sama, vaksinasi kedua secepat-cepatnya harus lebih dari 30 hari & jenis vaksin harus sama dengan jenis vaksin yang diberikan pada vaksinasi pertama");
					$('#saveBtn').html('Simpan');
				}
			});
		});

		$('body').on('click', '.editData', function () {
			var id_vaksinasi = $(this).data('id');
			$.get("{{ route('pevaksin.vaksinasi-kedua.index') }}" +'/' + id_vaksinasi, function (data) {
				$('#CreateOrUpdateHeader').html("Edit Vaksinasi");
				$('#saveBtn').val("edit");
				$('#CreateOrUpdateModal').modal('show');
				$('#id_vaksinasi').val(data[0].id_vaksinasi);
				$('#get_user').val(data[0].nama+' * '+data[0].email);
				$('#tanggal').val(data[0].tanggal_vaksin);
				$('#get_tempat').val(data[0].nama_tempat+' - '+data[0].alamat_vaksin);
				$('#get_pevaksin').val(data[0].nama_pevaksin+' * '+data[0].email_pevaksin);
			})
		});

		$('body').on('click', '.deleteData', function () {
			var vaksinasi_id = $(this).data('id');
			$.get("{{ route('pevaksin.vaksinasi-kedua.index') }}" +'/' + vaksinasi_id, function (data) {
				$('#DeleteHeader').html("Hapus Vaksinasi");
				$('#saveBtn').val("edit");
				$('#DeleteModal').modal('show');
				$('#vaksinasi_id_delete').val(data[0].id_vaksinasi);
				$('#namas').html(data[0].nama);
			})
		});

		$('#delBtn').click(function (e) {
			e.preventDefault();
			$(this).html('Memproses..');
			var vaksinasi_id = $('#vaksinasi_id_delete').val();
			var url = '{{ route("pevaksin.vaksinasi-kedua.destroy", ":id") }}';
			url = url.replace(':id', vaksinasi_id );
			$.ajax({
				type: "DELETE",
				url: url,
				success: function (data) {
					table.draw();
					$('#VaksinasiDeleteForm').trigger("reset");
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

<script type="text/javascript">
	$(document).ready(function(){
		$('#get_user').keyup(function(){ 
			var query = $(this).val();
			if(query != ''){
				var _token = $('input[name="_token"]').val();
				$.ajax({
					url:"{{ route('pevaksin.search.user') }}",
					method:"GET",
					data:{query:query, _token:_token},
					success:function(data){
						$('#dropdown-menu-user').fadeIn();  
						$('#dropdown-menu-user').html(data);
					}
				});
			}
		});
		$(document).on('click', '#li-user', function(){  
			$('#get_user').val($(this).text());  
			$('#dropdown-menu-user').fadeOut();  
		});  
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#get_tempat').keyup(function(){ 
			var query = $(this).val();
			if(query != ''){
				var _token = $('input[name="_token"]').val();
				$.ajax({
					url:"{{ route('pevaksin.search.tempat-vaksin') }}",
					method:"GET",
					data:{query:query, _token:_token},
					success:function(data){
						$('#dropdown-menu-tempat').fadeIn();  
						$('#dropdown-menu-tempat').html(data);
					}
				});
			}
		});
		$(document).on('click', '#li-tempat', function(){  
			$('#get_tempat').val($(this).text());  
			$('#dropdown-menu-tempat').fadeOut();  
		});  
	});
</script>

@endsection
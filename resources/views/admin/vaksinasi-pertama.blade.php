@extends('layouts.admin')

@section('content')

<div class="mt-4">
	<h1 style="margin-bottom: 20px;">Vaksinasi Pertama</h1>
	<!-- Button trigger modal -->
	<a class="btn btn-primary" href="javascript:void(0)" id="createButton">Tambah Data Vaksinasi Pertama</a>
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
						<input type="hidden" name="id_user" id="id_user" value="">
						<div class="col-sm-12">
							<div class="form-group">
								<label>NIK</label>
								<input type="number" name="nik" id="nik" class="form-control" placeholder="Masukkan NIK" autocomplete="off" required />
							</div>

							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>Email</label>
										<input type="email" name="email" id="email" class="form-control" placeholder="Masukkan Email" autocomplete="off" required />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-group">
										<label>Nama Lengkap</label>
										<input type="text" name="nama" id="nama_lengkap" class="form-control" placeholder="Masukkan Nama" autocomplete="off" required />
									</div>
								</div>	
							</div>

							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>Alamat</label>
										<input type="text" name="alamat" id="alamat" class="form-control" placeholder="Masukkan Alamat" autocomplete="off" required />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-group">
										<label>Tanggal Lahir</label>
										<input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" placeholder="Masukkan Tanggal Lahir" autocomplete="off" required />
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

							<div class="row">
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

								<div class="col-sm-6">
									<div class="form-group">
										<label>Pevaksin</label>
										<input type="text" name="get_pevaksin" id="get_pevaksin" class="form-control" placeholder="Masukkan Pevaksin" autocomplete="off" required />
										<div class="dropdown-menu" id="dropdown-menu-pevaksin">
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
					<form id="vansinasiDelete" name="vansinasiDelete" class="form-horizontal">
						<input type="hidden" name="id_user_delete" id="id_user_delete">
						<h5>Ingin Data Vaksinasi <strong id="namas"></strong>?</h5>

						<button type="submit" class="btn btn-danger w-100" id="delBtn" value="delete">Hapus
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="AlertModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="AlertHeader"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<h5>Data Profil Vaksinasi Bisa Diupdate Di Sini</h5>
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
			ajax: "{{ route('admin.vaksinasi-pertama.index') }}",
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

		$('body').on('click', '.editData', function () {
			var user_id = $(this).data('id');
			$.get("{{ route('admin.vaksinasi-pertama.index') }}" +'/' + user_id, function (data) {
				$('#CreateOrUpdateHeader').html("Edit Vaksinasi");
				$('#saveBtn').val("edit");
				$('#CreateOrUpdateModal').modal('show');
				$('#id_user').val(data[0].id_user);
				$('#nik').val(data[0].nik);
				$('#email').val(data[0].email);
				$('#nama_lengkap').val(data[0].nama);
				$('#alamat').val(data[0].alamat);
				$('#tanggal_lahir').val(data[0].tanggal_lahir);
				$('#tanggal').val(data[0].tanggal_vaksin);
				$('#get_tempat').val(data[0].nama_tempat+' - '+data[0].alamat_vaksin);
				$('#get_pevaksin').val(data[0].nama_pevaksin+' * '+data[0].email_pevaksin);
			})
		});

		$('#createButton').click(function () {            
			$('#saveBtn').val("create");
			$('#id_user').val('');
			$('#vaksinasiForm').trigger("reset");
			$('#CreateOrUpdateHeader').html("Tambah Vaksinasi");
			$('#CreateOrUpdateModal').modal('show');
		});		

		$('#saveBtn').click(function (e) {
			e.preventDefault();
			$(this).html('Memproses..');

			$.ajax({
				data: $('#vaksinasiForm').serialize(),
				url: "{{ route('admin.vaksinasi-pertama.store') }}",
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
					$('#saveBtn').html('Simpan');
				}
			});
		});

		$('body').on('click', '.deleteData', function () {
			var id_user = $(this).data('id');
			$.get("{{ route('admin.vaksinasi-pertama.index') }}" +'/' + id_user, function (data) {
				$('#DeleteHeader').html("Hapus Vaksinasi");
				$('#saveBtn').val("edit");
				$('#DeleteModal').modal('show');
				$('#id_user_delete').val(data[0].id_user);
				$('#namas').html(data[0].nama);
			})
		});

		$('#delBtn').click(function (e) {
			e.preventDefault();
			$(this).html('Memproses..');
			var id_user = $('#id_user_delete').val();
			var url = '{{ route("admin.vaksinasi-pertama.destroy", ":id") }}';
			url = url.replace(':id', id_user );
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

<script type="text/javascript">
	$(document).ready(function(){
		$('#get_tempat').keyup(function(){ 
			var query = $(this).val();
			if(query != ''){
				var _token = $('input[name="_token"]').val();
				$.ajax({
					url:"{{ route('admin.search.tempat-vaksin') }}",
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

<script type="text/javascript">
	$(document).ready(function(){
		$('#get_pevaksin').keyup(function(){ 
			var query = $(this).val();
			if(query != ''){
				var _token = $('input[name="_token"]').val();
				$.ajax({
					url:"{{ route('admin.search.pevaksin') }}",
					method:"GET",
					data:{query:query, _token:_token},
					success:function(data){
						$('#dropdown-menu-pevaksin').fadeIn();  
						$('#dropdown-menu-pevaksin').html(data);
					}
				});
			}
		});
		$(document).on('click', '#li-pevaksin', function(){  
			$('#get_pevaksin').val($(this).text());  
			$('#dropdown-menu-pevaksin').fadeOut();  
		});  
	});
</script>

@endsection
@extends('layouts.admin')

@section('content')

<div class="mt-4">
	<h1 style="margin-bottom: 20px;">Pevaksin</h1>
	<!-- Button trigger modal -->
	<a class="btn btn-primary" href="javascript:void(0)" id="createButton">Tambah Pevaksin</a>
	<div class="w-100 mt-3">
		<div class="">
			<table class="table table-bordered data-table table-responsive">
				<thead>
					<tr>
						<th width="5%">No</th>
						<th width="">Nama Pevaksin</th>
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
		<div class="modal fade" id="createModal" aria-hidden="true">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="createHeader"></h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form id="pevaksinForm" name="pevaksinForm" class="form-horizontal">
							<input type="hidden" name="pevaksin_id" id="pevaksin_id">
								<div class="col-sm-12">
									<div class="form-group">
										<label>Nama</label>
										<input type="text" name="get_user" id="get_user" class="form-control" placeholder="Masukkan Nama" autocomplete="off" required />
										<div class="dropdown-menu" id="dropdown-menu-user">
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
							<form id="vaksinDeleteForm" name="vaksinDeleteForm" class="form-horizontal">
								<input type="hidden" name="pevaksin_id_delete" id="pevaksin_id_delete">
								<h5>Ingin menghapus pevaksin di <strong id="namas"></strong>?</h5>

								<button type="submit" class="btn btn-danger w-100" id="delBtn" value="delete">Hapus
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

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
			ajax: "{{ route('admin.pevaksin.index') }}",
			columns: [
			{data: 'DT_RowIndex', name: 'DT_RowIndex'},
			{data: 'nama', name: 'nama'},
			{data: 'alamat', name: 'alamat'},
			{data: 'action', name: 'action', orderable: false, searchable: false},
			]
		});

		$('#createButton').click(function () {            
			$('#saveBtn').val("create");
			$('#pevaksin_id').val('');
			$('#pevaksinForm').trigger("reset");
			$('#createHeader').html("Tambah Pevaksin");
			$('#createModal').modal('show');
		});

		$('#saveBtn').click(function (e) {
			e.preventDefault();
			$(this).html('Memproses..');

			$.ajax({
				data: $('#pevaksinForm').serialize(),
				url: "{{ route('admin.pevaksin.store') }}",
				type: "POST",
				dataType: 'json',
				success: function (data) {
					$('#pevaksinForm').trigger("reset");
					$('#createModal').modal('hide');
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
			var pevaksin_id = $(this).data('id');
			$.get("{{ route('admin.pevaksin.index') }}" +'/' + pevaksin_id, function (data) {
				$('#DeleteHeader').html("Hapus Pevaksin");
				$('#saveBtn').val("edit");
				$('#DeleteModal').modal('show');
				$('#pevaksin_id_delete').val(data[0].id_pevaksin);
				$('#namas').html(data[0].nama);
			})
		});

		$('#delBtn').click(function (e) {
			e.preventDefault();
			$(this).html('Memproses..');
			var pevaksin_id = $('#pevaksin_id_delete').val();
			var url = '{{ route("admin.pevaksin.destroy", ":id") }}';
			url = url.replace(':id', pevaksin_id );
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
		$('#get_user').keyup(function(){ 
			var query = $(this).val();
			if(query != ''){
				var _token = $('input[name="_token"]').val();
				$.ajax({
					url:"{{ route('admin.search.user') }}",
					method:"GET",
					data:{query:query, _token:_token},
					success:function(data){
						$('#dropdown-menu-user').fadeIn();  
						$('#dropdown-menu-user').html(data);
					}
				});
			}
		});
		$(document).on('click', 'li', function(){  
			$('#get_user').val($(this).text());  
			$('#dropdown-menu-user').fadeOut();  
		});  
	});
</script>

@endsection
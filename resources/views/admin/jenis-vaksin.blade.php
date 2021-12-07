@extends('layouts.admin')

@section('content')

<div class="mt-4">
	<h1 style="margin-bottom: 20px;">Jenis Vaksin</h1>
	<!-- Button trigger modal -->
	<a class="btn btn-primary" href="javascript:void(0)" id="createButton">Tambah Jenis Vaksin</a>
	<div class="w-100 mt-3">
		<div class="table-responsive">
			<table class="table table-bordered data-table table-responsive">
				<thead>
					<tr>
						<th width="5%">No</th>
						<th width="">Nama Vaksin</th>
						<th width="">Opsi</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>	
		</div>
	</div>

	<div class="modal fade" id="CreateOrUpdateModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="CreateOrUpdateHeader"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="vaksinForm" name="vaksinForm" class="form-horizontal">
						<input type="hidden" name="vaksin_id" id="vaksin_id">
						<div class="form-group">
							<label for="nama" class="col-sm-12 control-label">Nama Vaksin</label>
							<div class="col-sm-12">
								<input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Vaksin" value="" maxlength="50" required="">
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
					<form id="vaksinDeleteForm" name="vaksinDeleteForm" class="form-horizontal">
						<input type="hidden" name="vaksin_id_delete" id="vaksin_id_delete">
						<h5>Ingin menghapus vaksin <strong id="namas"></strong>?</h5>

						<button type="submit" class="btn btn-danger w-100" id="delBtn" value="delete">Hapus
						</button>
					</form>
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
			ajax: "{{ route('admin.jenis-vaksin.index') }}",
			columns: [
			{data: 'DT_RowIndex', name: 'DT_RowIndex'},
			{data: 'nama_vaksin', name: 'nama_vaksin'},
			{data: 'action', name: 'action', orderable: false, searchable: false},
			]
		});

		$('#createButton').click(function () {
			$('#saveBtn').val("create");
			$('#vaksin_id').val('');
			$('#vaksinForm').trigger("reset");
			$('#CreateOrUpdateHeader').html("Tambah Jenis Vaksin");
			$('#CreateOrUpdateModal').modal('show');
		});

		$('body').on('click', '.editData', function () {
			var vaksin_id = $(this).data('id');
			$.get("{{ route('admin.jenis-vaksin.index') }}" +'/' + vaksin_id, function (data) {
				$('#CreateOrUpdateHeader').html("Edit Jenis Vaksin");
				$('#saveBtn').val("edit");
				$('#CreateOrUpdateModal').modal('show');
				$('#vaksin_id').val(data[0].id_jenis_vaksin);
				$('#nama').val(data[0].nama_vaksin);
			})
		});

		$('#saveBtn').click(function (e) {
			e.preventDefault();
			$(this).html('Memproses..');

			$.ajax({
				data: $('#vaksinForm').serialize(),
				url: "{{ route('admin.jenis-vaksin.store') }}",
				type: "POST",
				dataType: 'json',
				success: function (data) {
					$('#vaksinForm').trigger("reset");
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
			var vaksin_id = $(this).data('id');
			$.get("{{ route('admin.jenis-vaksin.index') }}" +'/' + vaksin_id, function (data) {
				$('#DeleteHeader').html("Hapus Jenis Vaksin");
				$('#saveBtn').val("edit");
				$('#DeleteModal').modal('show');
				$('#vaksin_id_delete').val(data[0].id_jenis_vaksin);
				$('#namas').html(data[0].nama_vaksin);
			})
		});

		$('#delBtn').click(function (e) {
			e.preventDefault();
			$(this).html('Memproses..');
			var vaksin_id = $('#vaksin_id_delete').val();
			var url = '{{ route("admin.jenis-vaksin.destroy", ":id") }}';
			url = url.replace(':id', vaksin_id );
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
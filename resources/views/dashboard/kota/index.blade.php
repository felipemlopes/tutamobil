
@extends('layouts.app-dash-lte')

@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('styles')
  <link rel="stylesheet" href="{!! asset('template/plugins/datatables/dataTables.bootstrap.css') !!}">
@endsection

@section('scripts')
<script src="{!! asset('template/plugins/datatables/jquery.dataTables.min.js') !!}"></script>
<script src="{!! asset('template/plugins/datatables/dataTables.bootstrap.min.js') !!}"></script>
{!! Html::script("/mytuta/js/kota.js") !!}


<script type="text/javascript">
$(document).ready(function() {

  $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
  });

$('#btn-refresh').click(function(){
  location.reload();
});

  $('#example').DataTable();

//menu active
$('#menu-master').addClass("active");
$('#menu-kota').addClass("active");

});
</script>
@endsection

@section('content-header', 'Kota')

@section('breadcump')
<li>Dashboard</li>
<li class="active">Kota</li>
@endsection

@section('content')

<div class="box">
	<div class="box-header">
		<h3 class="box-title">
<button class="btn btn-success" id="btn-add"><i class="fa fa-plus-circle"></i> Tambah Kota</button> <button class="btn btn-info" id="btn-refresh"><i class="fa fa-refresh"></i></button>
    </h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<table id="example" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Kota</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody id="kota-list" name="kota-list">
        @foreach($kota as $value)
            <tr id="kota{{ $value->id }}">
                <td>{{ $value->city }}</td>
                <td>
                    <button class="btn btn-xs btn-primary open-modal" value="{{$value->id}}"><i class="glyphicon glyphicon-edit"></i> Edit</button>
                    <button class="btn btn-xs btn-danger delete" value="{{$value->id}}"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                </td>
            </tr>
        @endforeach
			</tbody>
		</table>
</div>
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="myModalLabel">Kota Form</h4>
          </div>
          <div class="modal-body">
          {!! Form::open(array('id' => 'frm', 'name' => 'frm',  'onsubmit' => "return false;")) !!}
          <input id="token" type="hidden" value="{{ csrf_token() }}">
          @include('dashboard.kota._form')
          {!! Form::close() !!}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
    <!-- Modal -->



</div>
@endsection

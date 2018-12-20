@extends('layouts.backend')

@section('konten')
 

<div class="col-md-12">
	<h2>
		<i class="fa fa-th-list"></i> Jenis Produk 
	</h2>
	<hr>
@include($base_view.'komponen.tombol_create')
	
@include($base_view.'komponen.nav_atas')

	<hr>

	@include($base_view.'tambahstok.komponen.form_tambah')
</div>


 
@endsection

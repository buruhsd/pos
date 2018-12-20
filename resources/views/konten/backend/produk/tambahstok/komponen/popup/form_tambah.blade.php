<h1 id="loading_search" style="display:none;" class="pull-right">
	<i class='fa fa-refresh fa-spin' ></i>	
</h1>
<h3>
	<i class='fa fa-search'></i> Search Produk
</h3>
<hr>

<div class="row">
	<div id="pesan" class="col-md-12"></div>
	<div class="col-md-12">
		<div class="form-group">
			{!! Form::label('nama_produk', 'Pencarian Produk : ') !!}
			{!! Form::text('nama_produk', '', ['id' => 'nama_produk', 'placeholder' => 'search by nama produk...', 'class' => 'form-control' ]) !!}
		</div>
	</div>

	<div class="col-md-12">
		<hr>
		<button id='simpan' class='btn btn-info pull-right'><i class='fa fa-floppy-o'></i> SIMPAN</button>
	</div>
</div>
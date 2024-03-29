<div class="col-md-6">

	<div class="form-group">
		{!! Form::label('nama_aplikasi', 'Nama Aplikasi : ') !!}
		{!! Form::text('nama_aplikasi', setup_variable('nama_aplikasi'), ['id' => 'nama_aplikasi', 'class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('nama_toko', 'Nama Toko : ') !!}
		{!! Form::text('nama_toko', setup_variable('nama_toko'), ['id' => 'nama_toko', 'class' => 'form-control']) !!}
	</div>


	<div class="form-group">
		{!! Form::label('header_struk', 'Header Struk : ') !!}
		{!! Form::text('header_struk', setup_variable('header_struk'), ['id' => 'header_struk', 'class' => 'form-control']) !!}
	</div>	

	<div class="form-group">
		{!! Form::label('footer_struk', 'Footer : ') !!}
		{!! Form::text('footer_struk', setup_variable('footer_struk'), ['id' => 'footer_struk', 'class' => 'form-control']) !!}
	</div>

	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				{!! Form::label('backup_db', 'Backup DB : ') !!}
				{!! Form::select('backup_db', 
								 ['1' => 'aktif', '0' => 'tdk aktif'], 
								 setup_variable('backup_db'), 
								 ['id' => 'backup_db', 
								   'class' => 'form-control']) !!}
			</div>				
		</div>

		<div class="col-md-4">
			<div class="form-group">
				{!! Form::label('jam_backup', 'Jam Backup : ') !!}
				{!! Form::text('jam_backup', setup_variable('jam_backup'), ['id' => 'jam_backup', 'class' => 'form-control', 'placeholder' => 'jam backup...']) !!}
			</div>
		</div>


	</div>


</div>

  
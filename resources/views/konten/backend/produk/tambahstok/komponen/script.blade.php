

<script type="text/javascript">

$('#tombol_cari_produk').click(function(){
	$('#myModal').modal('show');
	$('.modal-body').load('{!! route("backend_home.search_produk") !!}');
	
});



$('#kode_barang').keypress(function(e) {
    if(e.which == 13) {

		$('#pesan').removeClass('alert alert-danger animated shake').html('');
		form_data ={
			kode_barang : $('#kode_barang').val(),
		 	_token : '{!! csrf_token() !!}'
		}
		$('#simpan').attr('disabled', 'disabled');
			$.ajax({
				url : '{{ route("backend_home.check_produk_transaksi") }}',
				data : form_data,
				type : 'post',
				error:function(xhr, status, error){
					$('#myModal').modal('show');
					$('.modal-body').html('<div id="pesan"></div>');
					$('#simpan').removeAttr('disabled');
				 	$('#pesan').addClass('alert alert-danger animated shake').html('<b>Error : </b><br>');
			        datajson = JSON.parse(xhr.responseText);
			        $.each(datajson, function( index, value ) {
			       		$('#pesan').append(index + ": " + value+"<br>")
			          });
				},
				success:function(ok){
					result = Object.keys(ok).length;
					if(result > 0){

						if(ok.stok_barang == 0){
							swal('error', 'stok barang sudah habis', 'error');
						}else{
							console.log(ok);
							$('#myModal').modal('show');
							$('.modal-body').load('{!! route("backend_produk.search_tambah_stock") !!}');
						}						
					}
				}
			});
      

    } //end if
});


$('#simpan').click(function(){

})



$('#pesan').click(function(){
	$('#pesan').fadeOut(function(){
		$('#pesan').html('').show().removeClass('alert alert-danger');
	});
})

</script>



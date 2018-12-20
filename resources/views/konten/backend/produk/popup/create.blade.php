<div class="row">
	<div class="col-md-12">
	<h2>
		<i class="fa fa-plus-square"></i> Menambahkan Produk 
	</h2>
	<hr>
	<div id="pesan"></div>
		<div class="row">
			<div class="col-md-4">		
				<div class="form-group">
					{!! Form::label('nama', 'Nama Produk : ') !!}
					{!! Form::text('nama', '', ['class' => 'form-control', 'id'	=> 'nama', 'placeholder' => 'nama produk...']) !!}
				</div>

				<div class="form-group">
					{!! Form::label('barcode', 'Barcode : ') !!}
					{!! Form::text('barcode', '', ['class' => 'form-control', 'id'	=> 'barcode', 'placeholder' => 'barcode...']) !!}
				</div>


				<div class="form-group">
					{!! Form::label('ref_produk_id', 'Jenis Produk : ') !!}
					{!! Form::select('ref_produk_id', 
									 $ref_produk, 
									 '', 
									 ['id'	=> 'ref_produk_id', 
									  'class' => 'form-control'
									  ]
								) !!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('harga_beli', 'Harga Beli : ') !!}
					{!! Form::text('harga_beli', '', ['class' => 'form-control', 'id'	=> 'harga_beli', 'placeholder' => 'Harga Beli...']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('harga_jual', 'Harga Jual : ') !!}
					{!! Form::text('harga_jual', '', ['class' => 'form-control', 'id'	=> 'harga_jual', 'placeholder' => 'Harga Jual...']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('harga_reseller', 'Harga Re-seller : ') !!}
					{!! Form::text('harga_reseller', '', ['class' => 'form-control', 'id'	=> 'harga_reseller', 'placeholder' => 'Harga Re-seller...']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('stok_barang', 'Stok Barang : ') !!}
					{!! Form::text('stok_barang', '', ['class' => 'form-control', 'id'	=> 'stok_barang', 'placeholder' => 'Stok Barang...']) !!}
				</div>			
			</div>
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('ref_satuan_produk_id', 'Satuan Barang : ') !!}
					{!! Form::select('ref_satuan_produk_id', 
									 $satuan_barang, 
									 '', 
									 ['id'	=> 'ref_satuan_produk_id', 
									  'class' => 'form-control'
									  ]
								) !!}
				</div>
				<div class="form-group">
					{!! Form::label('keterangan', 'keterangan Produk : ') !!}
					{!! Form::textarea('keterangan', '', ['class' => 'form-control', 'id'	=> 'keterangan', 'placeholder' => 'keterangan produk...', 'style' => 'height:70px']) !!}
				</div>	
				@if(Auth::user()->ref_user_level_id == 1)
				<div class="form-group">
					{!! Form::label('mst_cabang_id', 'Cabang : ') !!}
					{!! Form::select('mst_cabang_id', 
									 $mst_cabang, 
									 '', 
									 ['id'	=> 'mst_cabang_id', 
									  'class' => 'form-control'
									  ]
								) !!}
				</div>
				@else 
				{!! Form::hidden('mst_cabang_id', \Auth::user()->mst_cabang_id, ['id' => 'mst_cabang_id']) !!}
				@endif					
			</div>
			<!-- <div class="col-md-12">
				<div class="form-group">
					{!! Form::label('gambar', 'Gambar : ') !!}
					<div class="images">
						<div class="pic">
						  add
						</div>
					</div>
				</div>
			</div> -->
			<div class="col-md-12">
				<hr>
				<button id='simpan' class='btn btn-info pull-right'><i class='fa fa-floppy-o'></i> SIMPAN</button>
			</div>
			
		</div>
	</div>
</div>
<script type="text/javascript">
$('#simpan').click(function(){
	$('#pesan').removeClass('alert alert-danger animated shake').html('');


form_data ={
	mst_user_id : '{!! Auth::user()->id !!}',
	barcode : $('#barcode').val(),
	harga_beli : $('#harga_beli').val(),
	harga_jual : $('#harga_jual').val(),
	harga_reseller : $('#harga_reseller').val(),
	stok_barang : $('#stok_barang').val(),
	ref_satuan_produk_id : $('#ref_satuan_produk_id').val(),
	gambar : $('#gambar').val(),
	nama : $('#nama').val(),
	ref_produk_id : $('#ref_produk_id').val(),
	mst_cabang_id : $('#mst_cabang_id').val(),
	keterangan : $('#keterangan').val(),
 	_token : '{!! csrf_token() !!}'
}
$('#simpan').attr('disabled', 'disabled');
	$.ajax({
		url : '{{ route("backend_produk.store") }}',
		data : form_data,
		type : 'post',
		error:function(xhr, status, error){
			$('#simpan').removeAttr('disabled');
		 	$('#pesan').addClass('alert alert-danger animated shake').html('<b>Error : </b><br>');
	        datajson = JSON.parse(xhr.responseText);
	        $.each(datajson, function( index, value ) {
	       		$('#pesan').append(index + ": " + value+"<br>")
	          });

		      //    alert('error! terjadi kesalahan pada sisi server!')
		},
		success:function(ok){
			 //window.location.reload();
			 swal({
			 	title : 'success',
			 	text : 'data telah tersimpan',
			 	type : 'success'
			 }, function(){
			 	window.location.href = '{!! route("backend_produk.index") !!}';
			 })
		}
	})
})



$('#pesan').click(function(){
	$('#pesan').fadeOut(function(){
		$('#pesan').html('').show().removeClass('alert alert-danger');
	});
})

</script>
<script type="text/javascript">
	(function ($) {
  $(document).ready(function () {
    
    removeClass()
    uploadImage()
    submit()
    removeNotification()
    autoRemoveNotification()
    autoDequeue()
    
    var ID
    var way = 0
    var queue = []
    var fullStock = 10
    var speedCloseNoti = 1000

    function removeClass() {
      $('body').on('click', function () { 
        $('.select-option').removeClass('active')   
      })                  
    }
    
    function uploadImage() {
      var button = $('.images .pic')
      var uploader = $('<input type="file" accept="image/*" />')
      var images = $('.images')
      
      button.on('click', function () {
        uploader.click()
      })
      
      uploader.on('change', function () {
          var reader = new FileReader()
          reader.onload = function(event) {
            images.prepend('<div class="img" style="background-image: url(\'' + event.target.result + '\');" rel="'+ event.target.result  +'"><span>remove</span></div>')
          }
          reader.readAsDataURL(uploader[0].files[0])
  
       })
      
      images.on('click', '.img', function () {
        $(this).remove()
      })
    
    }
    
    function submit() {  
		var images = $('.images .img')
		var imageArr = []         
		for(var i = 0; i < images.length; i++) {
		imageArr.push({url: $(images[i]).attr('rel')})
		}       
		var newStock = {
		images: imageArr
		}        
		console.log(newStock);
		saveToQueue(newStock)
    }
    
    function removeNotification() {
      var close = $('.notification')
      close.on('click', 'span', function () {
        var parent = $(this).parent()
        parent.fadeOut(300)
        setTimeout(function() {
          parent.remove()
        }, 300)
      })
    }
    
    function autoRemoveNotification() {
      setInterval(function() {
        var notification = $('.notification')
        var notiPage = $(notification).children('.btn')
        var noti = $(notiPage[0])
        
        setTimeout(function () {
          setTimeout(function () {
           noti.remove()
          }, speedCloseNoti)
          noti.fadeOut(speedCloseNoti)
        }, speedCloseNoti)
      }, speedCloseNoti)
    }
    
    function autoDequeue() {
      var notification = $('.notification')
      var text
      
      setInterval(function () {

          if(queue.length > 0) {
            if(queue[0].type == 2) {
              text = ' Your discusstion is sent'
            } else {
              text = ' Your order is allowed.'
            }
            
            notification.append('<div class="success btn"><p><strong>Success:</strong>'+ text +'</p><span><i class=\"fa fa-times\" aria-hidden=\"true\"></i></span></div>')
            queue.splice(0, 1)
            
          }  
      }, 10000)
    }
    
    // helpers
    function saveToQueue(stock) {
      var notification = $('.notification')
      var check = 0
      
      if(queue.length <= fullStock) {
        if(stock.type == 2) {
            if(!stock.title || !stock.message) {
              check = 1
            }
        } else {
          if(!stock.title || !stock.category || stock.images == 0) {
            check = 1
          }
        }
        
        if(check) {
          notification.append('<div class="error btn"><p><strong>Error:</strong> Please fill in the form.</p><span><i class=\"fa fa-times\" aria-hidden=\"true\"></i></span></div>')
        } else {
          notification.append('<div class="success btn"><p><strong>Success:</strong> '+ ID +' is submitted.</p><span><i class=\"fa fa-times\" aria-hidden=\"true\"></i></span></div>')
          queue.push(stock)
          reset()
        }
      } else {
        notification.append('<div class="error btn"><p><strong>Error:</strong> Please waiting a queue.</p><span><i class=\"fa fa-times\" aria-hidden=\"true\"></i></span></div>')
      } 
    }
    
  })
})(jQuery)
</script>



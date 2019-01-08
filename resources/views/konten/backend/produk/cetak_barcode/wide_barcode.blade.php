<!DOCTYPE html>
<html><head>
	<title>Barcode - {!! $produk->nama !!} @if(empty($produk->barcode)) - SKU @endif </title>
<style type="text/css">
	@page { margin: 10px; }
	body {
			margin: 10px;
			font-size: 10px;
		}
	.barcode_produk{
		float:right;
		/*border : 1px solid #aaa; */
		width:150px;
		text-align:center;
		margin: 1em;
	}
</style>
</head><body>
	@for($i=1;$i<=$jml;$i++)
			@if(!empty($produk->barcode))
 					{!! '<img class="barcode_produk" src="data:image/png;base64,' . DNS1D::getBarcodePNG($produk->barcode, "C128") . '" alt="barcode"/>' !!}
 					<p>kjfgh</p>
 			@else
 					{!! '<img class="barcode_produk" src="data:image/png;base64,' . DNS1D::getBarcodePNG($produk->sku, "C128") . '" alt="barcode"/>' !!}
			@endif
	@endfor
</body></html>

<!-- <img src="data:image/png,' . DNS1D::getBarcodePNG("4", "C39+") . '" alt="barcode"   /> -->
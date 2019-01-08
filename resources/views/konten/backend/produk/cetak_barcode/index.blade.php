<!DOCTYPE html>
<html><head>
	<title>Barcode - {!! $produk->nama !!} @if(empty($produk->barcode)) - SKU @endif </title>
<style type="text/css">
	@page { margin-top: 18px; 
			margin-left: 10px}
	body {
			margin: 5px;
			font-size: 10px;
		}
	

	figure {
	  float: right;
	  width: 30%;
	  text-align: center;
	  font-style: italic;
	  font-size: smaller;
	  text-indent: 0;
	  border: thin silver solid;
	  margin: 1em;
	  padding: 1.5em;
	}
</style>
</head><body>
	@for($i=1;$i<=$jml;$i++)
			@if(!empty($produk->barcode))
			<figure style="margin: 10px">
 					{!! '<img class="barcode_produk" src="data:image/png;base64,' . DNS1D::getBarcodePNG($produk->barcode, "C128") . '" alt="barcode"/>' !!}
 					<figcaption>{{$produk->barcode}}</figcaption>
 			</figure>
 			@else
 					{!! '<img class="barcode_produk" src="data:image/png;base64,' . DNS1D::getBarcodePNG($produk->sku, "C128") . '" alt="barcode"/>' !!}
			@endif
	@endfor
</body></html>
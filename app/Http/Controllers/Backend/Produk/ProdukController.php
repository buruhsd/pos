<?php

namespace App\Http\Controllers\Backend\Produk;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\HistoryStok\createStokRequest;
use App\Http\Requests\Produk\createOrUpdateProdukRequest;
use App\Jobs\Produk\importProdukJob;
use App\Repositories\Contracts\Mst\CabangRepoInterface;
use App\Repositories\Contracts\Mst\HistoryStokRepoInterface;
use App\Repositories\Contracts\Mst\ProdukRepoInterface;
use App\Repositories\Contracts\Ref\ProdukRepoInterface as refProdukRepoInterface;
use App\Repositories\Contracts\Ref\SatuanProdukRepoInterface;
use Illuminate\Http\Request;
use App\Models\Ref\Gambar;
use Illuminate\Support\Facades\Storage;
use Excel;
use Milon\Barcode\DNS1D;

class ProdukController extends Controller
{
	private $base_view = 'konten.backend.produk.';
	protected $produk;
	protected $ref_produk;
    protected $mst_cabang;
    protected $stok;
    protected $satuan_barang;
    protected $gambar;

    public function __construct(ProdukRepoInterface $produk, 
    							refProdukRepoInterface $ref_produk,
                                CabangRepoInterface $mst_cabang,
                                HistoryStokRepoInterface $stok,
                                SatuanProdukRepoInterface $satuan_barang
					    	){
        $this->satuan_barang = $satuan_barang;
        $this->stok       = $stok;
        $this->mst_cabang = $mst_cabang;
    	$this->ref_produk = $ref_produk;
    	$this->produk = $produk;
    	view()->share('backend_produk', true);
    	view()->share('base_view', $this->base_view);
    }


    public function index(Request $request)
    {
        $search = $request->get('search');
        if($search){
            $filter  = [['nama', 'like', '%'.$search.'%']];
            $filter_barcode = [['barcode', 'like', '%'.$search.'%']];
        }else{
            $filter = [];
            $filter_barcode = [];
        }

        if(\Session::has('mst_cabang_id')){
            $filter = array_add($filter, 'mst_cabang_id', \Session::get('mst_cabang_id'));
            $filter_barcode = array_add($filter_barcode, 'mst_cabang_id', \Session::get('mst_cabang_id'));
        }
        // var_dump($filter); die();
        $produk = $this->produk->all(10, $filter);
        if (count($produk) <= 0) {
            $produk = $this->produk->all(10, $filter_barcode);
        }
        $backend_produk_home = true;
        $vars = compact('produk', 'backend_produk_home');
    	return view($this->base_view.'index', $vars);
    }

    public function create()
    {
        $satuan_barang = $this->satuan_barang->getAllDropdown('satuan barang');
    	$ref_produk = $this->ref_produk->getAllDropdown('jenis produk');
        $mst_cabang = $this->mst_cabang->getAllDropdown('cabang');
    	$vars = compact('ref_produk', 'mst_cabang', 'satuan_barang');
    	return view($this->base_view.'popup.create', $vars);
    }

    public function store(createOrUpdateProdukRequest $request)
    {
        // dd($request->gambar); die();
        $produk = $this->produk->create($request->except('_token', 'gambar'));
        foreach ($request->gambar as $photo) {
            $file_data = $photo;
            $file_name = 'image_' . time() . '.png'; //generating unique file name;

            if ($file_data != "") { // storing image in storage/app/public Folder
               Storage::disk('public')->put($file_name, base64_decode($file_data));
            }

            $image = new Gambar;
            $image->nama = $file_name;
            $image->ref_produk_id = $produk->id;
            $image->gambar = $file_name;
            $image->save();
            // $filename = $request->gambar->store('photos');
        }
        return $produk;
        
    }

    public function storeImage(Request $request){
        foreach ($request->gambar as $gambar) {
            $gambar = new Gambar();
            $gambar->nama = $gambar;
            $gambar->gambar = $gambar;
            $gambar->ref_produk_id = $data->id;
            $gambar->save();
        }
        return $data;
    }


    public function edit($id)
    {
        $satuan_barang = $this->satuan_barang->getAllDropdown('satuan barang');
        $ref_produk = $this->ref_produk->getAllDropdown('jenis produk');
        $mst_cabang = $this->mst_cabang->getAllDropdown('cabang');
        $produk = $this->produk->find($id);
        $vars = compact('produk', 'ref_produk', 'mst_cabang', 'satuan_barang');
        return view($this->base_view.'popup.edit', $vars);
    }

    public function update(createOrUpdateProdukRequest $request)
    {
        $produk = $this->produk->find($request->id);
        // check authorisasi saat update produk
        $this->authorize('updateProduk', $produk);


        return $this->produk->update($request->id, $request->except(['_token', 'id']));
    }

    public function delete(Request $request)
    {
        // check authorisasi saat destroy produk   
        return $this->produk->delete($request->id);
    }


    public function show($id)
    {
        $produk = $this->produk->find($id);
        $vars = compact('produk');
        return view($this->base_view.'popup.show', $vars);
    }


    public function stok_kosong()
    {
        $filter = ['stok_barang' => '0'];

        if(\Session::has('mst_cabang_id')){
            $filter = array_add($filter, 'mst_cabang_id', \Session::get('mst_cabang_id'));
        }
        
        $produk = $this->produk->all(10, $filter);
        $produk_stok_kosong = true;
        $vars = compact('produk', 'produk_stok_kosong');
        return view($this->base_view.'stok_kosong.index', $vars);
    }

    public function kelola_stok($id)
    {
        $keterangan = ['tambah stok' => 'tambah stok', 
                       'pengurangan stok' => 'pengurangan stok',
                       // 'stok awal'  => 'stok awal'
                       ];
        $produk = $this->produk->find($id);
        $vars = compact('produk', 'keterangan');
        return view($this->base_view.'popup.kelola_stok', $vars);
    }


    public function update_stok_barang(createStokRequest $request)
    {
        $mst_produk_id = $request->mst_produk_id;
        $jml_stok = $request->stok_barang;
        $mst_user_id = \Auth::user()->id;
        $keterangan = $request->keterangan;

        // var_dump($keterangan); die();
        return $this->stok->updateStok($mst_produk_id, $jml_stok, $mst_user_id, $keterangan);
    }


    public function cetak_barcode($mst_produk_id, Request $request)
    {
        $jml = 1;
        $produk = $this->produk->find($mst_produk_id);
        // $vars = compact('produk', 'jml');
        // if(!$jml){
        //    return view($this->base_view.'popup.cetak_barcode', $vars);
        // }   
        $data = ['produk' => $produk, 'jml' => $jml];
        // if ($request->get('size') == 'lebar') {
        //     $pdf = \PDF::loadView($this->base_view.'cetak_barcode.wide_barcode', $data);
        // }else{
        //     $pdf = \PDF::loadView($this->base_view.'cetak_barcode.index', $data);
        // }

        // $pdf->setPaper('a5', 'potrait');

        $filename = 'File Name';
        $image = base64_decode(DNS1D::getBarcodePNG($produk->barcode, "C128"));

        $safeName = str_random(10).'.'.'png';
        Storage::disk('public')->put($safeName, $image);

        return response()->download(storage_path('app/public/' . $safeName));

        // return Response::download($file, 'filename.pdf', $headers);
        // var_dump($safeName); die();
        // Excel::create($filename, function($excel) use ($data){

        //    $excel->sheet('sheet name', function($sheet) use ($data){
        //         $sheet->loadView($this->base_view.'cetak_barcode.wide_barcode', $data);
        //    });

        // })->export('xls');
        
        // return $pdf->stream('barcode.pdf');
        // return view($this->base_view.'cetak_barcode.index', $data);
    }


    public function import()
    {
        $satuan_barang = $this->satuan_barang->getAllDropdown('satuan barang');
        $ref_produk = $this->ref_produk->getAllDropdown('jenis produk');
        $mst_cabang = $this->mst_cabang->getAllDropdown('cabang');
        $vars = compact('ref_produk', 'mst_cabang', 'satuan_barang');        
        return view($this->base_view.'popup.import', $vars);
    }

    public function do_import(Request $request)
    {
        $nama_file_temp = 'tmp_produk_'.date('YmdHi').'.xls';
        $hidden_button = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';

        if(!file_exists($_FILES['userfile']['tmp_name']) || !is_uploaded_file($_FILES['userfile']['tmp_name'])) {
        \Session::flash('pesan', '<div class="alert alert-danger"> '.$hidden_button.' error! no file! </div>');
            return redirect()->back();
        }else{
            $file = $_FILES['userfile']['tmp_name'];
            $pindah_file = rename($file, storage_path('logs/'.$nama_file_temp));
            chmod(storage_path('logs/'.$nama_file_temp), 0777);

            $job = new importProdukJob(
                storage_path('logs/'.$nama_file_temp), $request->ref_produk_id,
                $request->ref_satuan_produk_id, $request->mst_cabang_id,
                \Auth::user()->id
             );


            $this->dispatch($job);

            \Session::flash('pesan', '<div class="alert alert-success"> '.$hidden_button.' berhasil import data </div>');
            return redirect()->back();
        }        
    }

    public function tambah_stok(){
        $backend_ref_tambah_stok_produk = true;
        $vars = compact('backend_ref_tambah_stok_produk');

        return view($this->base_view.'tambahstok.index', $vars); 
    }

    public function search_tambah_stock(){
        return view($this->base_view.'tambahstok.komponen.popup.form_tambah'); 
    }

}

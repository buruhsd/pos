<!-- <nav class="nav-sidebar">
    <ul class="nav">
    
        <li @if(isset($backend_home)) class="active" @endif>
        	<a href="{!! route('backend_home.index') !!}">
        		<i class='fa fa-home'></i> Home
        	</a>
        </li>

@if(\Auth::user()->ref_user_level_id == 2)

        <li @if(isset($backend_transaksi_saya)) class="active" @endif>
            <a href="{!! route('backend_transaksi_saya.index') !!}">
                <i class='fa fa-th-list'></i> Transaksi Saya
            </a>
        </li>
@endif


@if(\Auth::user()->ref_user_level_id == 1)

        <li @if(isset($backend_produk)) class="active" @endif>
        	<a href="{!! route('backend_produk.index') !!}">
        		<i class='fa fa-shopping-cart'></i> Produk
        	</a>
        </li>


        <li @if(isset($backend_transaksi_karyawan)) class="active" @endif>
            <a href="{!! route('backend_transaksi_karyawan.index') !!}">
                <i class='fa fa-th-list'></i> Transaksi
            </a>
        </li>


        <li @if(isset($backend_pengeluaran)) class="active" @endif>
            <a href="{!! route('backend_pengeluaran.index') !!}">
                <i class='fa fa-tags'></i> Pengeluaran
            </a>
        </li>
 

        <li @if(isset($backend_statistik)) class="active" @endif>
            <a href="{!! route('backend_statistik_transaksi.index') !!}">
                <i class='fa fa-bar-chart'></i> Statistik
            </a>
        </li>



        <li @if(isset($backend_cabang)) class="active" @endif>
            <a href="{!! route('backend_cabang.index') !!}">
                <i class='fa fa-sitemap'></i> Cabang
            </a>
        </li>

 
        <li @if(isset($backend_user)) class="active" @endif>
            <a href="{!! route('backend_user.index') !!}">
                <i class='fa fa-group'></i> Pengguna
            </a>
        </li>

         <li @if(isset($backend_konfigurasi)) class="active" @endif>
            <a href="{!! route('backend_konfigurasi.index') !!}">
                <i class='fa fa-cogs'></i> Konfigurasi
            </a>
        </li>


         <li @if(isset($backend_log)) class="active" @endif>
            <a href="{!! route('backend_log.index') !!}">
                <i class='fa fa-cubes'></i> Sys Log
            </a>
        </li>


@endif
 

 
         <li @if(isset($backend_profile)) class="active" @endif>
            <a href="{!! route('backend_profile.index') !!}">
                <i class='fa fa-wrench'></i> Profile
            </a>
        </li>


    </ul>
</nav> -->
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <li @if(isset($backend_home)) class="active" @endif>
        <a href="{!! route('backend_home.index') !!}">
            <i class='fa fa-home'></i><span> Home</span>
        </a>
    </li>
    @if(\Auth::user()->ref_user_level_id == 2)
    <li @if(isset($backend_transaksi_saya)) class="active" @endif>
        <a href="{!! route('backend_transaksi_saya.index') !!}">
            <i class='fa fa-th-list'></i><span> Transaksi Saya</span>
        </a>
    </li>
    @endif
    @if(\Auth::user()->ref_user_level_id == 1)
    <li @if(isset($backend_produk)) class="active" @endif>
        <a href="{!! route('backend_produk.index') !!}">
            <i class='fa fa-shopping-cart'></i><span> Produk</span>
        </a>
    </li>
    <li @if(isset($backend_transaksi_karyawan)) class="active" @endif>
        <a href="{!! route('backend_transaksi_karyawan.index') !!}">
            <i class='fa fa-th-list'></i><span> Transaksi</span>
        </a>
    </li>
    <li @if(isset($backend_pengeluaran)) class="active" @endif>
        <a href="{!! route('backend_pengeluaran.index') !!}">
            <i class='fa fa-tags'></i><span> Pengeluaran</span>
        </a>
    </li>
    <li @if(isset($backend_statistik)) class="active" @endif>
        <a href="{!! route('backend_statistik_transaksi.index') !!}">
            <i class='fa fa-bar-chart'></i><span> Statistik</span>
        </a>
    </li>
    <li @if(isset($backend_cabang)) class="active" @endif>
        <a href="{!! route('backend_cabang.index') !!}">
            <i class='fa fa-sitemap'></i><span> Cabang</span>
        </a>
    </li>
    <li @if(isset($backend_user)) class="active" @endif>
        <a href="{!! route('backend_user.index') !!}">
            <i class='fa fa-group'></i> <span>Pengguna</span>
        </a>
    </li>
     <li @if(isset($backend_konfigurasi)) class="active" @endif>
        <a href="{!! route('backend_konfigurasi.index') !!}">
            <i class='fa fa-cogs'></i><span> Konfigurasi</span>
        </a>
    </li>
     <li @if(isset($backend_log)) class="active" @endif>
        <a href="{!! route('backend_log.index') !!}">
            <i class='fa fa-cubes'></i><span> Sys Log</span>
        </a>
    </li>
    @endif
     <li @if(isset($backend_profile)) class="active" @endif>
        <a href="{!! route('backend_profile.index') !!}">
            <i class='fa fa-wrench'></i><span> Profile</span>
        </a>
    </li>
    
    <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
</ul>
@extends('template.services-master')
@section('content')
	<section id="pricing">
      <div class="container">
      	<div class="form-group">
      		<form action="{{ url('/shop') }}" method="get" class="search">
              	<input type="text" name="s" placeholder="Search . . " value="{{ $res->nama_produk }}">
              	<button>Search</button>
            </form>
      	</div>
      	<br><br><br>
      	<a href="{{ url('/#services') }}">Services</a> > 
      	<a href="{{ url('/shop') }}">Shop</a> >
      	{{ $res->nama_produk }}

	    <hr>

        <div class="row pricing-cols">
        	<div class="col-md-6 wow fadeInUp">
        		<div class="img2">
	              	@if($res->jenis_produk == 'Buah Segar')
	              	<img src="https://katakabar.com/assets/images/upload/news/medium_news_1594438184.jpeg" alt="" class="img-fluid img-shop">
	              	@else
	                <img src="https://sc01.alicdn.com/kf/UTB8HKCxsiDEXKJk43Oqq6Az3XXaQ/926475121/UTB8HKCxsiDEXKJk43Oqq6Az3XXaQ.jpg_.webp" alt="" class="img-fluid img-shop">
	                @endif
              	</div>

	       	</div>

	       	<div class="col-md-6 wow fadeInUp">
	       		<h1 class="title"><a href="#">{{ $res->nama_produk }}</a></h1>
              	<h2 class="price"><a href="#">Rp. {{ number_format((int)$res->harga,0,".",".") }}</a></h2>
              	<p class="price"><a href="#">Stock : {{ $res->jumlah }}</a></p>
              	<hr>
              	<p>{{ $res->deskripsi }}</p>
              	<hr>
              	<form method="post" action="{{ url('/shop/purchase') }}">
              		@csrf
              		<input type="hidden" name="price" value="{{ $res->harga }}">
              		<input type="hidden" name="id" value="{{ $res->product_id }}">
              		<label>Jumlah Beli :</label>
              		<input class="form-control jumlah-beli" type="number" name="jumlah" min="1" max="{{ $res->jumlah }}" value="1">
              		<label>Jenis Pembayaran :</label>
              		<input class="form-control jumlah-beli" type="text" name="jenis">
              		<label>Bank :</label>
              		<input class="form-control jumlah-beli" type="text" name="bank">
              		<br>
              		<button class="btn btn-success form-control">Proses Pembelian</button>
              	</form>
	       	</div>
        </div>

      </div>
    </section>
@endsection


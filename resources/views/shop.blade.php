@extends('template.services-master')
@section('content')
	<section id="pricing">
      <div class="container">
      	<div class="form-group">
      		<form action="" method="get" class="search">
      			<input type="hidden" name="c" value="{{ ucfirst($category) }}">
              	<input type="text" name="s" placeholder="Search . . " value="{{ ucfirst($search) }}">
              	<button>Search</button>
            </form>
      	</div>
      	<br><br><br>
      	<a href="{{ url('/#services') }}">Services</a> > <a href="{{ url('/shop') }}">Shop</a> 
      		@if(!is_null($category)){{ '> '.ucfirst($category) }} @endif
      		@if(!is_null($search)){{ '> '.ucfirst($search) }} @endif
	    <hr>

        <div class="row pricing-cols">

        	@foreach($result as $r)
	        	<div class="col-md-4 wow fadeInUp">
		            <div class="pricing-col">
		              <div class="img">
		              	@if($r->jenis_produk == 'Buah Segar')
		              	<img src="https://katakabar.com/assets/images/upload/news/medium_news_1594438184.jpeg" alt="" class="img-fluid img-shop">
		              	@else
		                <img src="https://sc01.alicdn.com/kf/UTB8HKCxsiDEXKJk43Oqq6Az3XXaQ/926475121/UTB8HKCxsiDEXKJk43Oqq6Az3XXaQ.jpg_.webp" alt="" class="img-fluid img-shop">
		                @endif
		              </div>
		              <h1 class="title"><a href="#">{{ $r->nama_produk }}</a></h1>
		              <h2 class="title"><a href="#">Rp. {{ number_format((int)$r->harga,0,".",".") }}</a></h2>
		              <hr>
		              <p>{{ $r->deskripsi }}</p>
		              <hr>
		              <a href='{{ url("/shop/payment/$r->product_id") }}'>
		              	<button class="btn btn-success">Buy</button>
		              </a>
		            </div>
		          </div>
        	@endforeach

        </div>

      </div>
    </section>
@endsection


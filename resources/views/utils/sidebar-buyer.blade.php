				<div class="side-bar col-md-3">
					<!-- <div class="search-hotel">
					<h3 class="sear-head">Name contains</h3>
					<form>
						<input type="text" value="Product name..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Product name...';}" required="">
						<input type="submit" value=" ">
					</form>
				</div> -->
				@if($id_p>0)
				<div class="range">
					<h3 class="sear-head">Price range</h3>
					<br>
					<br>
							<ul class="dropdown-menu6">
								<li>
									<div id="slider-range"></div>
										<input type="text" id="amount" style="border: 0; color: #ffffff; font-weight: normal;width: 100%" />
									</li>
							</ul>
				</div>
				<div class="brand-select">
					<h3 class="sear-head">Make</h3>
					  <select class="selectpicker" data-live-search="true">
					  <option data-tokens="All" value="All">All</option>
						@foreach(\App\Kategori::where('id_jenis',\App\JKategori::where('code','make')->first()['id'])->whereIn('id_induk',$id_p<3?array($id_p):array(1,2))->get() as $key)
					  <option data-tokens="{{$key->id}}" value="{{$key->id}}">{{$key->name}}</option>
						@endforeach
					</select>
				</div>
				@endif
				<div class="featured-ads">
					<h2 class="sear-head fer">Featured Ads</h2>
					@foreach(\App\Product::where('promo',2)->orderBy(\DB::raw('rand()'))->get() as $key)
					<div class="featured-ad">
						<a href="single.html">
							<div class="featured-ad-left">
								<img src="{{url('assets/images/f1.jpg')}}" title="ad image" alt="" />
							</div>
							<div class="featured-ad-right">
								<h4>{{$key->promotion_text}}</h4>
								<p>{{number_format($key->new_price)}}</p>
							</div>
							<div class="clearfix"></div>
						</a>
					</div>
					@endforeach
					<div class="clearfix"></div>
				</div>

				</div>

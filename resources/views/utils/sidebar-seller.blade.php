<div class="rectangle-list col-md-3">
	<h3>Navigation</h3>
	<ol>
		<li><a href="{{route('ads_create')}}"></i> Create New Ad</a></li>
		<li><a href="{{route('ads')}}">My Ads</a>
			<ol>
				<li><a href="{{route('ads_published')}}">Published Ads</a></li>
				<li><a href="{{route('ads_moderation')}}">In Moderation Ads</a></li>
				<li><a href="{{route('ads_declined')}}">Declined Ads</a></li>
			</ol>
		</li>
		<li><a href="{{route('promotion')}}">My Promotions</a>
			<ol>
				<li><a href="{{route('promotion_create')}}">Create New Promotion</a></li>
				<li><a href="{{route('promotion_published')}}">Published Promotion</a></li>
				<li><a href="{{route('promotion_requested')}}">Requested Promotion</a></li>
				<li><a href="{{route('promotion_declined')}}">Declined Promotion</a></li>
			</ol>
		</li>
		<li><a href="{{route('store')}}">My Stores</a>
			<ol>
				<li><a href="{{route('store_create')}}">Create New Store</a></li>
				<li><a href="{{route('store_published')}}">Published Store</a></li>
			</ol>
		</li>
	</ol>
</div>
	<!--页面顶部-->
    <div id="nav-bottom">
	<!--顶部-->
	<div class="nav-top">

		<div class="top">
			<div class="py-container">
				<div class="shortcut">
					<ul class="fl">
						<li class="f-item">品优购欢迎您！</li>
						<li class="f-item">请<a href="{{route('login_before')}}" target="_blank">登录</a>　<span><a href="{{route('register_before')}}" target="_blank">免费注册</a></span></li>
					</ul>
					<ul class="fr">
						<li class="f-item"><a href="{{route('home_index')}}">我的订单</a></li>		
					</ul>
				</div>
			</div>
		</div>

		<!--头部-->
		<div class="header">
			<div class="py-container">
				<div class="yui3-g Logo">
					<div class="yui3-u Left logoArea">
						<a class="logo-bd" title="品优购" href="/" ></a>
					</div>
					<div class="yui3-u Center searchArea">

						<div class="search">
							<!-- 搜索框 start -->
							<form action="{{route('search')}}" class="sui-form form-inline" method="post" >
								@csrf()
								<div class="input-append">
									<input name="keyword" value="{{isset($keyword)?$keyword:""}}" required type="text" id="autocomplete" type="text" class="input-error input-xxlarge" />
									<input type="submit" value="搜索" class="sui-btn btn-xlarge btn-danger" >
								</div>
							</form>
							<!-- 搜索框 end -->
						</div>
						
						<div class="hotwords">
							<ul>
								<!-- <li class="f-item">品优购首发</li> -->
							</ul>
						</div>
					</div>
					<div class="yui3-u Right shopArea">
						<div class="fr shopcar">
							<div class="show-shopcar" id="shopcar">
								<span class="car"></span>
								<a class="sui-btn btn-default btn-xlarge" href="{{route('good_cart')}}" target="_blank">
									<span>我的购物车</span>
									<i class="shopnum">{{session('good_cart_num')?session('good_cart_num'):0}}</i>
								</a>
								<div class="clearfix shopcarlist" id="shopcarlist" style="display:none">

									@if(session('good_cart_num') == 0 )
									<p>"啊哦，你的购物车还没有商品哦！"</p>
									@else
										<p>快去付款吧，少年！</p>
									@endif
								
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="yui3-g NavList">
					<div class="yui3-u Left all-sort">
						<h4>全部商品分类</h4>
					</div>
					<div class="yui3-u Center navArea">
						<ul class="nav">
							<li class="f-item"><a href="{{route('seckgood')}}">秒杀</a></li>
						</ul>
					</div>
					<div class="yui3-u Right"></div>
				</div>
			</div>
		</div>
	</div>
</div>
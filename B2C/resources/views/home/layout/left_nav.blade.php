<div class="person-info">
						<div class="person-photo"><img src="uploads/{{session('users_img')}}" alt="" style="width:50px;height:50px;border-radius:100px;"></div>
						
                        <div class="person-account">
                            <span class="name">{{session('user_name')}}</span>
							
							<span class="safe"><a href="{{route('logout')}}">退出登录 </a></span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
<div class="list-items">
                        <dl>
							<dt><i>·</i> 订单中心</dt>
							<dd ><a href="{{route('home_index')}}" @if(isset($url) && $url == "index") class="list-active" @endif >我的订单</a></dd>
							<dd><a href="{{route('home_unshipp')}}" @if(isset($url) && $url == "unshipp") class="list-active" @endif  >待发货</a></dd>
                            <dd><a href="{{route('home_shipp')}}" @if(isset($url) && $url == "shipp") class="list-active" @endif>待收货</a></dd>
                            <dd><a href="{{route('home_refuning')}}" @if(isset($url) && $url == "refuning") class="list-active" @endif>退款中</a></dd>
                            <dd><a href="{{route('home_refund')}}" @if(isset($url) && $url == "refund") class="list-active" @endif>已退款</a></dd>
							<dd><a href="{{route('home_complete')}}" @if(isset($url) && $url == "complete") class="list-active" @endif>待评价</a></dd>
						</dl>
						<dl>
							<dt><i>·</i> 我的中心</dt>
							<dd><a href="{{route('home_collect')}}" @if(isset($url) && $url == "collect") class="list-active" @endif>我的收藏</a></dd>
							<dd><a href="{{route('home_foot')}}" @if(isset($url) && $url == "foot") class="list-active" @endif>我的足迹</a></dd>
						</dl>
						<dl>
                            <dt><i>·</i> 物流消息</dt>
                            
						</dl>
						<dl>
							<dt><i>·</i> 设置</dt>
							<dd><a href="{{route('home_info')}}" @if(isset($url) && $url == "info") class="list-active" @endif>个人信息</a></dd>
							<dd><a href="{{route('home_address')}}" @if(isset($url) && $url == "address") class="list-active" @endif  >地址管理</a></dd>
							<dd><a href="{{route('home_safe')}}" @if(isset($url) && $url == "safe") class="list-active" @endif >安全管理</a></dd>
						</dl>
                    </div>
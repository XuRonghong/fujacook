
<!--上方menu bar-->
<div class="fuja-nav">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="https://www.fujacook.com/">
                <img src="{{asset('/web0617/img/logo.png')}}" alt="FUJACOOK即食鍋">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    @forelse(data_get($data, 'navbar', []) as $key => $var)
                        <li class="nav-item @if($key==1) active @endif">
                            <a class="nav-link {{data_get($var, 'style')}}" href="{{data_get($var, 'url')}}">{{data_get($var, 'summary')}}</a>
                        </li>
                    @empty
                        <li class="nav-item active">
                            <a class="nav-link" href="https://www.fujacook.com/">首頁</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">關於FUJACOOK</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">媒體報導</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">即食鍋</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">即時餐</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">最新消息</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">聯繫我們</a>
                        </li>
                    @endforelse
                </ul>

                <form action="{{ route('logout') }}" method="post" id="portal-layouts-nav-form">
                    {{ csrf_field() }}

                    <ul class="social-media">
                        <li><a href=""><i class="fa fa-twitter-square"></i><p>Twitter</p></a></li>
                        <li><a href=""><i class="fa fa-weixin"></i><p>Wechat</p></a></li>
                        <li><a href=""><i class="fa fa-facebook-square"></i><p>Facebook</p></a></li>
                        <li><a href=""><i class="line"></i><p>Line</p></a></li>
                        <li><a href=""><i class="fa fa-youtube"></i><p>Youtube</p></a></li>
                        @if (Route::has('login'))
                            @if(Auth::guard('web')->check())
                                <li>
                                    <a href="" onclick="document.getElementById('portal-layouts-nav-form').submit();">
                                        <i class="fa fa-bicycle"></i>
                                        <p>Logout</p>
                                    </a>
                                </li>
                            @endif
                        @endif
                    </ul>

                </form>

            </div>
        </nav>
    </div>
</div>

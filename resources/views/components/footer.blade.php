<footer class="site-footer" id="footer">
  <div class="bottom">
    <div class="container-fulid">
      <div class="row justify-content-center align-items-center no-gutters">
        <div class="col-auto col-xs-12 text-lg-left text-center">
          <p class="copyright-text">
            © APP移動應用創新賽
          </p>
          <div class="credits">
            <a href="http://www.fcu.edu.tw/">Design</a> by FCU
          </div>
        </div>
        <div class="col-auto col-xs-12 text-lg-left text-center">
          <div class="credits">
            聯繫信箱：<a href="mailto:stacse@straighta.com.tw">stacse@straighta.com.tw</a>
          </div>
          <div class="credits">
            聯繫電話：Straight A客服專線（02）6608-1000
          </div>
        </div>
        <div class="col-auto col-xs-12 text-lg-right text-center">
          <ul class="list-inline">
            @auth
            <li class="list-inline-item">
              <a href="{{route('user',[],false)}}">你好，{{auth()->user()->name}}！</a>
            </li>
            @endauth @if (URL::current()!=route('home',[],false) && URL::current()!=route('home',[],false))
            <li class="list-inline-item">
              <a href="{{route('home',[],false)}}">首頁</a>
            </li>
            @endif
            @auth
            <li class="list-inline-item">
              <a href="{{ route('logout',[],false) }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">登出</a>
              <form id="logout-form" action="{{ route('logout',[],false) }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
            </li>
            @else
            <li class="list-inline-item">
              <a href="{{ route('login',[],false) }}">登入</a>
            </li>
            @endauth
          </ul>
        </div>
      </div>
    </div>
  </div>
</footer>
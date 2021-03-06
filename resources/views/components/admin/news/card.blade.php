@php $randomStr = str_random(10); @endphp
<div class="card">
    <div class="card-header p-0">
        <div class="row">
            <div class="col cursor-pointer" id="{{$randomStr}}-close" data-toggle="collapse" data-target="#{{$randomStr}}-card" aria-expanded="true" aria-controls="{{$randomStr}}-card">
                <a class="text-primary h3 p-3 w-100 d-block m-0">
                    {{$title}}
                </a>
            </div>
            @auth @hasanyrole('developer|admin')
            <div class="col-auto py-3 pr-5">
                <a class="btn btn-primary text-white h3 bootstrap-original mb-0" style="z-index: 999;" href="{{$route}}">
                    編輯
                </a>
                @if (request()->is("admin/news*"))
                <a class="btn btn-danger text-white h3 bootstrap-original mb-0" href="{{ route('admin.news.delete',['id'=>$id]) }}" onclick="event.preventDefault();document.getElementById('{{$randomStr}}-delete_news').submit();">刪除</a>
                @endif
            </div>
            <form id="{{$randomStr}}-delete_news" action="{{ route('admin.news.delete',['id'=>$id]) }}" method="POST" style="display: none;">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="delete">
            </form>
            @endhasanyrole @endauth
        </div>
    </div>
    <div id="{{$randomStr}}-card" class="collapse {{$firstShow ? 'show':''}}" aria-labelledby="{{$randomStr}}-close" data-parent="#{{$parent}}">
        <div class="card-body">
            {!!$content!!}
        </div>
    </div>
</div>
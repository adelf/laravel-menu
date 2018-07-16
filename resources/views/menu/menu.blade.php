<!-- Example of menu template with Bootstrap and FontAwesome icons-->

<nav class="navbar navbar-default">
    <ul class="nav navbar-nav">
        @foreach($items as $item)
            @if(isset($item['items']))
                <li class="dropdown @if($item['activeParent']) active @endif">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{$item['name']}} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @foreach($item['items'] as $subItem)
                            <li @if($subItem['active']) class="active" @endif>
                                <a href="{{$subItem['link']}}"><i class="fa fa-{{$item['icon']}}"></i> {{$subItem['name']}}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @else
                <li @if($item['active']) class="active" @endif>
                    <a href="{{$item['link']}}" title="{{$item['name']}}">
                        <i class="fa fa-{{$item['icon']}}"></i> {{$item['name']}}
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</nav>

{{--
Simple template for one level menu
<nav class="navbar navbar-default">
    <ul class="nav navbar-nav">
        @foreach($items as $item)
            <li @if($item['active']) class="active" @endif>
                <a href="{{$item['link']}}" title="{{$item['name']}}">
                    <i class="fa fa-{{$item['icon']}}"></i> {{$item['name']}}
                </a>
            </li>
        @endforeach
    </ul>
</nav>--}}
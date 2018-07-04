<nav>
    <ul>
        @foreach($items as $item)
            @if(isset($item['items']))
                <li>
                    <a href="#" title="{{$item['name']}}"><i class="fa fa-lg fa-fw fa-{{$item['icon']}}"></i><span class="menu-item-parent">{{$item['name']}}</span></a>

                    <ul style="display: @if($item['activeParent']) block; @else none; @endif;">
                        @foreach($item['items'] as $subItem)
                            <li @if($subItem['active']) class="active" @endif>
                                <a href="{{$subItem['link']}}">{{$subItem['name']}}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @else
                <li @if($item['active']) class="active" @endif>
                    <a href="{{$item['link']}}" title="{{$item['name']}}"><i class="fa fa-{{$item['icon']}}"></i>{{$item['name']}}</a>
                </li>
            @endif
        @endforeach
    </ul>
</nav>

{{--
Simple template for one level menu
<nav>
    <ul>
        @foreach($items as $item)
            <li @if($item['active']) class="active" @endif>
                <a href="{{$item['link']}}" title="{{$item['name']}}"><i class="fa fa-{{$item['icon']}}"></i>{{$item['name']}}</a>
            </li>
        @endforeach
    </ul>
</nav>--}}
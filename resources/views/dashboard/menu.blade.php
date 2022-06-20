@foreach (\App\Helpers\MenuHelper::menu() as $menu)
    @php
    //dd( \App\Helpers\MenuHelper::menu() );
    @endphp
    @if( isset($menu['items']) )
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>{{ $menu['title'] }}</span>
            <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
            </a>
        </h6>
        @php
            $items = $menu['items'];
        @endphp
    @else
        @php
            $items = [
                $menu
            ];
        @endphp
    @endif

    @php
    //dd( $items );
    @endphp

   <ul class="nav flex-column mb-2">
        @foreach ($items as $item)
            <li class="nav-item">
                <a onclick="loadContent({{ json_encode($item) }})" class="nav-link" href="#">
                <span data-feather="file-text"></span>
                {{ $item['title'] }}
                </a>
            </li>
        @endforeach
    </ul>
@endforeach
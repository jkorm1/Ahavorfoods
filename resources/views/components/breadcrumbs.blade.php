<section class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-container">
            <ul class="breadcrumbs-list">
                <li class="breadcrumbs-item">
                    <a href="{{ route('home') }}" class="breadcrumbs-link">Home</a>
                </li>
                
                @foreach($breadcrumbs as $breadcrumb)
                    <li class="breadcrumbs-item">
                        @if($loop->last)
                            <span class="breadcrumbs-current">{{ $breadcrumb['title'] }}</span>
                        @else
                            <a href="{{ $breadcrumb['url'] }}" class="breadcrumbs-link">{{ $breadcrumb['title'] }}</a>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
<div class="card overflow-hidden">
    <h6 class="card-header d-flex align-items-center justify-content-between">
        @lang('Derniers colis')

        @if (count($latestParcels))
            <small class="float-right">
                <a href="{{ route('parcels.index') }}">@lang('View All')</a>
            </small>
        @endif
    </h6>

    <div class="card-body p-0">
        @if (count($latestParcels))
            <ul class="list-group list-group-flush">
                @foreach ($latestParcels as $parcel)
                    <li class="list-group-item list-group-item-action px-4 py-3">
                        <a href="{{ route('parcels.index') }}" class="d-flex text-dark no-decoration">
                            <div class="ml-2" style="line-height: 1.2;">
                                <span class="d-block p-0">{{ $parcel->client->present()->name() }}</span>
                                <small class="text-muted">{{ $parcel->created_at->diffForHumans() }}</small>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-muted">@lang('No records found.')</p>
        @endif
    </div>
</div>

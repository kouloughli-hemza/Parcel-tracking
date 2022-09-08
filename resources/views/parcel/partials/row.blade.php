<tr>
    <td class="align-middle" style="font-size: 11px">{{ $parcel->tracking_number }}</td>
    <td class="align-middle" style="font-size: 11px">{{ $parcel->shipping_type }}</td>
    <td class="align-middle" style="font-size: 11px">{{ $parcel->client->present()->name }}</td>
    <td class="align-middle" style="font-size: 11px">{{ $parcel->client->wilaya->name }}</td>
    <td class="align-middle" style="font-size: 11px">{{ $parcel->client->commune->name }}</td>
    <td class="align-middle" style="font-size: 11px">{{ $parcel->client->adresse }}</td>
    <td class="align-middle" style="font-size: 11px">{{ $parcel->client->tel }}</td>
    <td class="align-middle" style="font-size: 11px">{{ $parcel->shipping_cost }}</td>
    <td class="align-middle" style="font-size: 11px">{{ $parcel->expediteur->nom }} {{ $parcel->expediteur->prenom }}</td>
    <td class="align-middle" style="font-size: 11px">{{ $parcel->created_at->format(config('app.date_format')) }}</td>
    <td class="text-center align-middle">

        <a href="{{ route('parcels.pdf', $parcel) }}"
           class="btn btn-icon edit"
           target="__blank"
           title="@lang('Télécharger le colis')"
           data-toggle="tooltip" data-placement="top">
            <i class="fas fa-download"></i>
        </a>

    </td>
</tr>

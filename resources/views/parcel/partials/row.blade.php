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
        <div class="dropdown show d-inline-block">
            <a class="btn btn-icon"
               href="#" role="button" id="dropdownMenuLink"
               data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h"></i>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">

                <a href="{{ route('parcels.show', $parcel) }}" class="dropdown-item text-gray-500">
                    <i class="fas fa-eye mr-2"></i>
                    @lang('Vue sur le colis')
                </a>
            </div>
        </div>

        <a href="{{ route('parcels.edit', $parcel) }}"
           class="btn btn-icon edit"
           title="@lang('Modifier le colis')"
           data-toggle="tooltip" data-placement="top">
            <i class="fas fa-edit"></i>
        </a>

        <a href="{{ route('parcels.destroy', $parcel) }}"
           class="btn btn-icon"
           title="@lang('Supprimer le coliss')"
           data-toggle="tooltip"
           data-placement="top"
           data-method="DELETE"
           data-confirm-title="@lang('Veuillez confirmer')"
           data-confirm-text="@lang('Êtes-vous sûr de vouloir supprimer ce colis ??')"
           data-confirm-delete="@lang('Oui, supprimez-le !')">
            <i class="fas fa-trash"></i>
        </a>
    </td>
</tr>

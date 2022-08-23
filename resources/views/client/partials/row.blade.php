<tr>
    <td class="align-middle">
        <a href="{{ route('clients.show', $client) }}">
            {{ $client->nom ?: __('N/A') }}
        </a>
    </td>
    <td class="align-middle">{{ $client->nom . ' ' . $client->prenom }}</td>
    <td class="align-middle">{{ $client->tel }}</td>
    <td class="align-middle">{{ $client->wilaya->name }}</td>
    <td class="align-middle">{{ $client->commune->name }}</td>
    <td class="align-middle">{{ $client->adresse }}</td>
    <td class="align-middle">{{ $client->created_at->format(config('app.date_format')) }}</td>
    <td class="text-center align-middle">
        <div class="dropdown show d-inline-block">
            <a class="btn btn-icon"
               href="#" role="button" id="dropdownMenuLink"
               data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h"></i>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">

                <a href="{{ route('clients.show', $client) }}" class="dropdown-item text-gray-500">
                    <i class="fas fa-eye mr-2"></i>
                    @lang('View Client')
                </a>
            </div>
        </div>

        <a href="{{ route('clients.edit', $client) }}"
           class="btn btn-icon edit"
           title="@lang('Edit Client')"
           data-toggle="tooltip" data-placement="top">
            <i class="fas fa-edit"></i>
        </a>

        <a href="{{ route('clients.destroy', $client) }}"
           class="btn btn-icon"
           title="@lang('Delete Client')"
           data-toggle="tooltip"
           data-placement="top"
           data-method="DELETE"
           data-confirm-title="@lang('Please Confirm')"
           data-confirm-text="@lang('Are you sure that you want to delete this client?')"
           data-confirm-delete="@lang('Yes, delete him!')">
            <i class="fas fa-trash"></i>
        </a>
    </td>
</tr>

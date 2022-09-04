<tr>
    <td class="align-middle">
        <a href="{{ route('factures.show', $facture) }}">
            {{ $facture->reference ?: __('N/A') }}
        </a>
    </td>
    <td class="align-middle" style="font-size: 11px">{{ $facture->expedireur->nom . ' ' . $facture->expedireur->prenom }}</td>
    <td class="align-middle" style="font-size: 11px">{{ $facture->total_coli }}</td>
    <td class="align-middle " style="font-size: 11px">{{ $facture->total_ttc }}</td>
    <td class="align-middle" style="font-size: 11px">{{ $facture->total_shipping }}</td>
    <td class="align-middle" style="font-size: 11px">{{ $facture->sur_facture }}</td>
    <td class="align-middle" style="font-size: 11px">{{ $facture->net_amount }}</td>
    <td class="align-middle" style="font-size: 11px">{{ $facture->created_at->format(config('app.date_format')) }}</td>
    <td class="text-center align-middle">
        <div class="dropdown show d-inline-block">
            <a class="btn btn-icon"
               href="#" role="button" id="dropdownMenuLink"
               data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h"></i>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">

                <a href="{{ route('factures.show', $facture) }}" class="dropdown-item text-gray-500">
                    <i class="fas fa-eye mr-2"></i>
                    @lang('Afficher la Facture')
                </a>
            </div>
        </div>
    </td>
</tr>

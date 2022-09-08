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

        <a href="{{ route('factures.pdf', $facture) }}"
           class="btn btn-icon edit"
           target="__blank"
           title="@lang('Télécharger la facture')"
           data-toggle="tooltip" data-placement="top">
            <i class="fas fa-download"></i>
        </a>
        <a href="{{ route('factures.show', $facture) }}"
           class="btn btn-icon edit"
           target="__blank"
           title="@lang('Details de la facture')"
           data-toggle="tooltip" data-placement="top">
            <i class="fas fa-eye mr-2"></i>
        </a>
    </td>
</tr>

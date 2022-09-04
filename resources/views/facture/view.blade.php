@extends('layouts.app')

@section('page-title', $facture->reference)
@section('page-heading', $facture->reference)

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('factures.index') }}">@lang('Factures')</a>
    </li>
    <li class="breadcrumb-item active">
        {{ $facture->reference }}
    </li>
@stop

@section('content')


<div class="row g-5">
            <div class="col-md-12 col-lg-12 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Détails de la facture</span>
                    <span class="badge bg-primary rounded-pill text-white">{{$facture->colis->count() . ' Colis'}}</span>
                </h4>

                <ul class="list-group mb-3">

                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">Expediteur</h6>
                        </div>
                        <span class="text-dark font-weight-bold ">
                            {{ $facture->expedireur->nom . ' ' . $facture->expedireur->prenom }}
                        </span>
                    </li>


                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">Total TTC</h6>
                            <small class="text-muted">Le Prix Toutes Taxes Comprises</small>
                        </div>
                        <span class="text-dark font-weight-bold ">{{ $facture->total_ttc }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">Tarif livraison</h6>
                            <small class="text-muted">Total des prix d'expédition</small>
                        </div>
                        <span class="text-muted">{{ $facture->total_shipping }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">Sur facture</h6>
                            <small class="text-muted">Tarif sur facture</small>
                        </div>
                        <span class="text-muted">{{ $facture->sur_facture }}</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <span>@lang('Montant Net')</span>
                        <strong>{{ $facture->net_amount }}</strong>
                    </li>
                </ul>
            </div>
    </div>


<div class="card">
    <h6 class="card-header d-flex align-items-center justify-content-between">
        @lang('Colis')
        <small>
            <a href="{{ route('factures.append', $facture) }}"
               class="edit"
               data-toggle="tooltip"
               data-placement="top"
               title="@lang('Ajouter un colis à la facture')">
                @lang('Ajouter un colis à la facture')
            </a>
        </small>
    </h6>
    <div class="card-body">
        <div class="table-responsive" id="parcels-table-wrapper">
            <table class="table table-borderless table-striped">
                <thead>
                <tr>
                    <th class="min-width-150"  style="font-size: 11px">@lang('N° de suivi')</th>
                    <th class="min-width-80" style="font-size: 11px">@lang('Type')</th>
                    <th class="min-width-80" style="font-size: 11px">@lang('Déstinataire')</th>
                    <th class="min-width-100" style="font-size: 11px">@lang('Wilaya')</th>
                    <th class="min-width-100" style="font-size: 11px">@lang('Commune')</th>
                    <th class="min-width-100" style="font-size: 11px">@lang('Adresse')</th>
                    <th class="min-width-100" style="font-size: 11px">@lang('Télephone')</th>
                    <th class="min-width-100" style="font-size: 11px">@lang('Tarif d\'envoi')</th>
                    <th class="min-width-100" style="font-size: 11px">@lang('Expediteur')</th>
                    <th class="min-width-100" style="font-size: 11px">@lang('Date')</th>
                    <th class="text-center min-width-150" style="font-size: 11px">@lang('Action')</th>
                </tr>
                </thead>
                <tbody>
                @if (count($parcels))
                    @foreach ($parcels as $parcel)
                        @include('parcel.partials.row')
                    @endforeach
                @else
                    <tr>
                        <td colspan="7"><em>@lang('No records found.')</em></td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@stop

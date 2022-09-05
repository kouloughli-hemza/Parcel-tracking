@extends('layouts.export')
@section('styles')
    <style>
        body{
            margin-top:0px;
            color: #484b51;
        }
        .text-secondary-d1 {
            color: #728299!important;
        }


        .brc-default-l1 {
            border-color: #dce9f0!important;
        }


        hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px solid rgba(0,0,0,.1);
        }



        .font-bolder, .text-600 {
            font-weight: 600!important;
        }

        .bgc-default-tp1 {
            background-color: rgba(121,169,197,.92)!important;
        }
        .text-150 {
            font-size: 150%!important;
        }
        th, td{
            font-size: 11px!important;
        }

    </style>
@stop

@section('content')
    <div class="">
        <div>
            <div class="row ">
                <div class="col-12 col-lg-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center text-150">
                                <img src="{{ url('assets/img/logo.svg') }}" class="logo-sm" height="65" alt="{{ setting('app_name') }}">
                            </div>
                            <div class="text-center font-weight-bold mb-0">
                                <p>Décharge de paiement Partenaire</p>
                                <p class="mb-0" >Liste des envois livrés</p>
                                <hr class="mb-0" />
                                <p class="mb-0">Crée par Admin {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- .row -->

                    <div class="row row-cols-2" >
                        <div style="width: 70%;float: left" class="col-3  table-responsive">
                            <table class="table table-bordered ">
                                <thead>
                                <tr class="text-white">
                                    <th>Date</th>
                                    <th>Nombre de colis</th>
                                    <th>Total</th>
                                    <th>Expéditeur</th>
                                </tr>
                                </thead>

                                <tbody class="text-95 text-secondary-d3">
                                <tr></tr>
                                <tr>
                                    <td>{{ \Carbon\Carbon::now()->format('d-m-Y') }}</td>
                                    <td>{{$facture->colis()->count()}}</td>
                                    <td class="text-95">{{$facture->colis()->sum('prix_unitaire') . ' DZD'}}</td>
                                    <td class="text-secondary-d2">{{$facture->expedireur->nom . ' ' . $facture->expedireur->prenom}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->

                        <div class="col-2  justify-content-center align-items-center" style="width: 30%;float: left">
                            <p class="text-600 font-bolder ">REFERENCE</p>
                            <p class="text-600 font-bolder ">{{$facture->reference}}</p>
                        </div>
                    </div>
                    <div style="clear: both"></div>

                    <div class="mt-4">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="bg-none bgc-default-tp1">
                                    <tr class="text-white">
                                        <th>Tracking</th>
                                        <th>Déstinataire</th>
                                        <th>Tel</th>
                                        <th>Wilaya</th>
                                        <th>Commune</th>
                                        <th>Montant</th>
                                        <th>Tarif livraison</th>
                                        <th>Sur-facturation</th>
                                        <th>Net</th>
                                    </tr>
                                </thead>


                                <tbody class="">

                                @if (count($facture->colis))
                                    @foreach ($facture->colis as $colis)
                                        <tr>

                                            <td style="padding: 0.35rem">{{$colis->tracking_number}}</td>
                                            <td style="padding: 0.35rem">{{$colis->client->present()->name()}}</td>
                                            <td style="padding: 0.35rem">{{$colis->client->tel}}</td>
                                            <td style="padding: 0.35rem">{{ $colis->client->wilaya->name }}</td>
                                            <td style="padding: 0.35rem">{{ $colis->client->commune->name }}</td>
                                            <td style="padding: 0.35rem">{{$colis->prix_unitaire + $colis->shipping_cost}}</td>
                                            <td style="padding: 0.35rem">{{$colis->shipping_cost}}</td>
                                            <td style="padding: 0.35rem">{{ 0 }}</td>
                                            <td style="padding: 0.35rem" class="text-secondary-d2">{{ $colis->prix_unitaire }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7"><em>@lang('No records found.')</em></td>
                                    </tr>
                                @endif

                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-3">
                            <div style="">
                            </div>

                            <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                                <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                    <div class="col-7 text-right">
                                        Net
                                    </div>
                                    <div class="col-7 text-right">
                                        <span class="text-150 text-success-d3 opacity-2">{{$facture->colis()->sum('prix_unitaire') . ' DZD'}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="text-center">
                            <span class="text-secondary-d1 text-105 text-center">
                                Tous droits réservés
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@extends('layouts.export')
@section('styles')

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
                                <p>Projet fin d'étude</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr />
            <div class="row">
                <div style="float: left;width: 40%">
                    <p>
                        <span>Déstinataire : <span class="font-weight-bold">{{$coli->client->present()->name()}}</span></span>
                    </p>
                    <p>
                        <span>Téléphone : <span class="font-weight-bold">{{$coli->client->tel}}</span></span>
                    </p>
                    <p>
                        <span>Montant : <span class="font-weight-bold">{{$coli->prix_unitaire}}</span></span>
                    </p>
                    <p>
                        <span>Adresse : <span class="font-weight-bold">{{$coli->client->adresse}}</span></span>
                    </p>
                    <p>
                        <span>Commune : <span class="font-weight-bold">{{$coli->client->commune->name}}</span></span>
                    </p>
                    <p>
                        <span>Wilaya : <span class="font-weight-bold">{{$coli->client->wilaya->name}}</span></span>
                    </p>
                    <p>
                        <span>Remarque : <span class="font-weight-bold">{{$coli->note}}</span></span>
                    </p>
                    <p>
                        <span>Produit : <span class="font-weight-bold">{{$coli->description_produit}}</span></span>
                    </p>
                    <p>
                        <span>Colis crée le : <span class="font-weight-bold">{{$coli->created_at}}</span></span>
                    </p>
                    <div>
                        <p>
                            <span style="font-size: 22px;font-weight: bold">{{ str_pad($coli->id,4,0,STR_PAD_LEFT) }}</span>
                            <span>
                                {!! $dns1d->getBarcodeHTML(str_pad($coli->id,4,0,STR_PAD_LEFT), 'C39',0.8,50,'black') !!}
                            </span>
                        </p>
                    </div>
                </div>
                <div style="float: right;width: 40%">
                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate('https://www.google.com/maps/search/'. $coli->client->adresse . ',' . $coli->client->commune->name . ',' . $coli->client->wilaya->name . ',Algérie')) !!} ">

                    <div class="mt-2">
                        <p style="border: 1px solid #333;width:220px;padding: 15px;text-align: center"><span class="font-weight-bold">Poids :</span> {{ $coli->poids }}</p>
                        <p style="border: 1px solid #333;width:220px;padding: 15px;text-align: center"><span class="font-weight-bold">Livraison :</span> {{ $coli->shipping_type }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

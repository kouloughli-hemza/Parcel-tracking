@extends('layouts.app')

@section('page-title', __('Add Colis'))
@section('page-heading', __('Create New Colis'))

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('parcels.index') }}">@lang('Colis')</a>
    </li>
    <li class="breadcrumb-item active">
        @lang('Create')
    </li>
@stop

@section('content')

@include('partials.messages')

{!! Form::open(['route' => ['factures.append-parcel','facture' => $facture], 'files' => true, 'id' => 'parcel-form']) !!}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="card-title">
                        @lang('Informations déstinatiare')
                    </h5>
                    <p class="text-muted font-weight-light">
                        @lang('Informations générale sur le profil du déstinatiare.')
                    </p>
                </div>
                <div class="col-md-9">
                    @include('parcel.partials.receiver-details', ['edit' => false, 'profile' => false])
                </div>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="card-title">
                        @lang('Informations sur l\'adresse')
                    </h5>
                    <p class="text-muted font-weight-light">
                        @lang("Information sur l'adresse.")
                    </p>
                </div>
                <div class="col-md-9">
                    @include('parcel.partials.address', ['edit' => false, 'profile' => false])
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="card-title">
                        @lang('Détails du colis')
                    </h5>
                    <p class="text-muted font-weight-light">
                        @lang('Information sur le colis.')
                    </p>
                </div>
                <div class="col-md-9">
                    @include('parcel.partials.details', ['edit' => false, 'profile' => false])
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">
                @lang('Ajouter le colis au facture')
            </button>
        </div>
    </div>
{!! Form::close() !!}

<br>
@stop

@section('scripts')
    {!! HTML::script('assets/js/as/profile.js') !!}
    {!! JsValidator::formRequest('Dsone\Http\Requests\Colis\CreateColisRequest', '#parcel-form') !!}
@stop

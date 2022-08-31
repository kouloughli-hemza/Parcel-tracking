@extends('layouts.app')

@section('page-title', __('Colis'))
@section('page-heading', __('Colis'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Colis')
    </li>
@stop

@section('content')

@include('partials.messages')

<div class="card">
    <div class="card-body">

        <form action="" method="GET" id="parcels-form" class="pb-2 mb-3 border-bottom-light">
            <div class="row my-3 flex-md-row flex-column-reverse">
                <div class="col-md-6 mt-md-0 mt-2">
                    <div class="input-group custom-search-form">
                        <input type="text"
                               class="form-control input-solid"
                               name="search"
                               value="{{ Request::get('search') }}"
                               placeholder="@lang('Recherche de colis...')">

                            <span class="input-group-append">
                                @if (Request::has('search') && Request::get('search') != '')
                                    <a href="{{ route('parcels.index') }}"
                                           class="btn btn-light d-flex align-items-center text-muted"
                                           role="button">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                                <button class="btn btn-light" type="submit" id="search-parcels-btn">
                                    <i class="fas fa-search text-muted"></i>
                                </button>
                            </span>
                    </div>
                </div>


                <div class="col-md-6">
                    <a href="{{ route('parcels.create') }}" class="btn btn-primary btn-rounded float-right">
                        <i class="fas fa-plus mr-2"></i>
                        @lang('Ajouter un colis')
                    </a>
                </div>
            </div>
        </form>

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

{!! $parcels->render() !!}

@stop


@extends('layouts.app')

@section('page-title', __('Factures'))
@section('page-heading', __('Factures'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Factures')
    </li>
@stop

@section('content')

@include('partials.messages')

<div class="card">
    <div class="card-body">

        <form action="" method="GET" id="factures-form" class="pb-2 mb-3 border-bottom-light">
            <div class="row my-3 flex-md-row flex-column-reverse">
                <div class="col-md-6 mt-md-0 mt-2">
                    <div class="input-group custom-search-form">
                        <input type="text"
                               class="form-control input-solid"
                               name="search"
                               value="{{ Request::get('search') }}"
                               placeholder="@lang('Recherche par référence...')">

                            <span class="input-group-append">
                                @if (Request::has('search') && Request::get('search') != '')
                                    <a href="{{ route('factures.index') }}"
                                           class="btn btn-light d-flex align-items-center text-muted"
                                           role="button">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                                <button class="btn btn-light" type="submit" id="search-factures-btn">
                                    <i class="fas fa-search text-muted"></i>
                                </button>
                            </span>
                    </div>
                </div>
            </div>
        </form>

        <div class="table-responsive" id="factures-table-wrapper">
            <table class="table table-borderless table-striped">
                <thead>
                <tr>
                    <th class="min-width-80" style="font-size: 11px">@lang('Référence')</th>
                    <th class="min-width-80" style="font-size: 11px">@lang('Expediteur')</th>
                    <th class="min-width-80" style="font-size: 11px">@lang('N° de colis')</th>
                    <th class="min-width-150" style="font-size: 11px">@lang('Total TTC')</th>
                    <th class="min-width-150" style="font-size: 11px">@lang('Sur facture')</th>
                    <th class="min-width-150" style="font-size: 11px">@lang('Tarif livraison')</th>
                    <th class="min-width-100" style="font-size: 11px">@lang('Montant Net')</th>
                    <th class="min-width-100" style="font-size: 11px">@lang('Creé le')</th>
                    <th class="text-center min-width-150" style="font-size: 11px">@lang('Action')</th>
                </tr>
                </thead>
                <tbody>
                    @if (count($factures))
                        @foreach ($factures as $facture)
                            @include('facture.partials.row')
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

{!! $factures->render() !!}

@stop

@section('scripts')
    <script>
        $("#status").change(function () {
            $("#factures-form").submit();
        });
    </script>
@stop

@extends('layouts.app')

@section('page-title', $coli->tracking_number)
@section('page-heading', $coli->shipping_type)

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('parcels.index') }}">@lang('Colis')</a>
    </li>
    <li class="breadcrumb-item active">
        {{ $coli->tracking_number }}
    </li>
@stop

@section('content')

<div class="row">
    <div class="col-lg-5 col-xl-4 ">
        <div class="card">
            <h6 class="card-header d-flex align-items-center justify-content-between">
                @lang('Details')

                <small>

                    <a href="{{ route('parcels.edit', $coli) }}"
                       class="edit"
                       data-toggle="tooltip"
                       data-placement="top"
                       title="@lang('Edit Colis')">
                        @lang('Edit')
                    </a>
                </small>
            </h6>
            <div class="card-body">
               <div class="d-flex align-items-center flex-column pt-3">

                    <a class="text-muted font-weight-light mb-2">
                        {{ $coli->prix_unitaire }}
                    </a>
                </div>

                <ul class="list-group list-group-flush mt-3">

                    <li class="list-group-item">
                        <strong>@lang('Remarque'):</strong>
                        {{ $coli->note }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@stop

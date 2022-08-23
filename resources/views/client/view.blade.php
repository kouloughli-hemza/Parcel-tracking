@extends('layouts.app')

@section('page-title', $client->nom)
@section('page-heading', $client->prenom)

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('clients.index') }}">@lang('Clients')</a>
    </li>
    <li class="breadcrumb-item active">
        {{ $client->nom }}
    </li>
@stop

@section('content')

<div class="row">
    <div class="col-lg-5 col-xl-4 ">
        <div class="card">
            <h6 class="card-header d-flex align-items-center justify-content-between">
                @lang('Details')

                <small>

                    <a href="{{ route('clients.edit', $client) }}"
                       class="edit"
                       data-toggle="tooltip"
                       data-placement="top"
                       title="@lang('Edit Client')">
                        @lang('Edit')
                    </a>
                </small>
            </h6>
            <div class="card-body">
               <div class="d-flex align-items-center flex-column pt-3">

                    @if ($name = $client->nom)
                        <h5>{{ $client->prenom }}</h5>
                    @endif

                    <a class="text-muted font-weight-light mb-2">
                        {{ $client->tel }}
                    </a>
                </div>

                <ul class="list-group list-group-flush mt-3">

                    <li class="list-group-item">
                        <strong>@lang('Address'):</strong>
                        {{ $client->adresse }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@stop

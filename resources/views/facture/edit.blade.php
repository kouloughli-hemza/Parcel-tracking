@extends('layouts.app')

@section('page-title', __('Edit Client'))
@section('page-heading', $client->nom)

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('clients.index') }}">@lang('Clients')</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('clients.show', $client->id) }}">
            {{ $client->nom }}
        </a>
    </li>
    <li class="breadcrumb-item active">
        @lang('Edit')
    </li>
@stop

@section('content')

@include('partials.messages')

<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" id="nav-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active"
                           id="details-tab"
                           data-toggle="tab"
                           href="#details"
                           role="tab"
                           aria-controls="home"
                           aria-selected="true">
                            @lang('Client Details')
                        </a>
                    </li>
                </ul>

                <div class="tab-content mt-4" id="nav-tabContent">
                    <div class="tab-pane fade show active px-2"
                         id="details"
                         role="tabpanel"
                         aria-labelledby="nav-home-tab">
                        <form action="{{ route('clients.update', $client) }}" method="POST" id="details-form">
                            @csrf
                            @method('PUT')
                            @include('client.partials.details', ['profile' => false])
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

@stop

@section('scripts')
    {!! HTML::script('assets/js/as/btn.js') !!}
    {!! HTML::script('assets/js/as/profile.js') !!}
    {!! JsValidator::formRequest('Dsone\Http\Requests\Client\UpdateClientRequest', '#details-form') !!}

@stop

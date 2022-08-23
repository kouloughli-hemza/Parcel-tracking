@extends('layouts.app')

@section('page-title', __('Add Client'))
@section('page-heading', __('Create New Client'))

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('clients.index') }}">@lang('Clients')</a>
    </li>
    <li class="breadcrumb-item active">
        @lang('Create')
    </li>
@stop

@section('content')

@include('partials.messages')

{!! Form::open(['route' => 'clients.store', 'files' => true, 'id' => 'client-form']) !!}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="card-title">
                        @lang('Client Details')
                    </h5>
                    <p class="text-muted font-weight-light">
                        @lang('A general client profile information.')
                    </p>
                </div>
                <div class="col-md-9">
                    @include('client.partials.details', ['edit' => false, 'profile' => false])
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">
                @lang('Create Client')
            </button>
        </div>
    </div>
{!! Form::close() !!}

<br>
@stop

@section('scripts')
    {!! HTML::script('assets/js/as/profile.js') !!}
    {!! JsValidator::formRequest('Dsone\Http\Requests\Client\CreateClientRequest', '#client-form') !!}
@stop

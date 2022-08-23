@extends('layouts.app')

@section('page-title', __('Clients'))
@section('page-heading', __('Clients'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Clients')
    </li>
@stop

@section('content')

@include('partials.messages')

<div class="card">
    <div class="card-body">

        <form action="" method="GET" id="clients-form" class="pb-2 mb-3 border-bottom-light">
            <div class="row my-3 flex-md-row flex-column-reverse">
                <div class="col-md-6 mt-md-0 mt-2">
                    <div class="input-group custom-search-form">
                        <input type="text"
                               class="form-control input-solid"
                               name="search"
                               value="{{ Request::get('search') }}"
                               placeholder="@lang('Search for clients...')">

                            <span class="input-group-append">
                                @if (Request::has('search') && Request::get('search') != '')
                                    <a href="{{ route('clients.index') }}"
                                           class="btn btn-light d-flex align-items-center text-muted"
                                           role="button">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                                <button class="btn btn-light" type="submit" id="search-clients-btn">
                                    <i class="fas fa-search text-muted"></i>
                                </button>
                            </span>
                    </div>
                </div>


                <div class="col-md-6">
                    <a href="{{ route('clients.create') }}" class="btn btn-primary btn-rounded float-right">
                        <i class="fas fa-plus mr-2"></i>
                        @lang('Add Client')
                    </a>
                </div>
            </div>
        </form>

        <div class="table-responsive" id="clients-table-wrapper">
            <table class="table table-borderless table-striped">
                <thead>
                <tr>
                    <th></th>
                    <th class="min-width-80">@lang('Nom')</th>
                    <th class="min-width-80">@lang('Téléphone')</th>
                    <th class="min-width-150">@lang('Wilaya')</th>
                    <th class="min-width-150">@lang('Commune')</th>
                    <th class="min-width-100">@lang('adresse')</th>
                    <th class="min-width-100">@lang('Creé le')</th>
                    <th class="text-center min-width-150">@lang('Action')</th>
                </tr>
                </thead>
                <tbody>
                    @if (count($clients))
                        @foreach ($clients as $client)
                            @include('client.partials.row')
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

{!! $clients->render() !!}

@stop

@section('scripts')
    <script>
        $("#status").change(function () {
            $("#clients-form").submit();
        });
    </script>
@stop

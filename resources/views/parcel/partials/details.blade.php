<div class="row">

    <div class="col-md-12">
        <div class="form-group">
            <label for="first_name">@lang('Description du produit')</label>
            <textarea type="text" class="form-control input-solid" id="first_name"
                   name="description_produit" placeholder="@lang('Description du produit')" >{{ $edit ? $client->description_produit : old('description_produit') }}</textarea>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="poids">@lang('Poids (KG)')</label>
                    <input type="number" class="form-control input-solid" id="poids"
                           name="poids" placeholder="@lang('Poids')" value="{{ $edit ? $client->poids : old('poids') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="prix_unitaire">@lang('Prix unitaire')</label>
                    <input type="number" class="form-control input-solid" id="prix_unitaire"
                           name="prix_unitaire" placeholder="@lang('Prix unitaire')" value="{{ $edit ? $client->prix_unitaire : old('prix_unitaire') }}">
                </div>
            </div>


            <div class="col-md-12">
                <div class="form-group">
                    <label for="shipping_cost">@lang("Tarif d'envoi")</label>
                    <input type="number" class="form-control input-solid" id="prix_unitaire"
                           name="shipping_cost" placeholder="@lang('Tarif d\'envoi')" value="{{ $edit ? $client->shipping_cost : old('shipping_cost') }}">
                </div>
            </div>
        </div>


        <div class="form-group">
            <label for="shipping_type">@lang('Type d\'envoi')</label>
            {!! Form::select('shipping_type', $statuses, $edit ? $direction->shipping_type : '',
                ['class' => 'custom-select', 'id' => 'shipping_type']) !!}
        </div>

        <div class="form-group">
            <label for="note">@lang('Remarque')</label>
            <textarea type="text" class="form-control input-solid" id="note"
                      name="note" placeholder="@lang('Remarque')" >{{ $edit ? $client->note : old('note') }}</textarea>
        </div>

    </div>


    @if ($edit)
        <div class="col-md-12 mt-2">
            <button type="submit" class="btn btn-primary" id="update-details-btn">
                <i class="fa fa-refresh"></i>
                @lang('Mettre à jour les détails')
            </button>
        </div>
    @endif
</div>

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#country-dd').on('change', function () {
                var idWilaya = this.value;
                var url = "{{url('/api/wilayas/:id/communes')}}"
                url = url.replace(':id', idWilaya);

                $("#state-dd").html('');
                $.ajax({
                    url: url,
                    type: "GET",
                    data: {
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#state-dd').html('<option value="">Select Commune</option>');
                        $.each(result, function (key, value) {
                            $("#state-dd").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });

        });
    </script>

@endsection

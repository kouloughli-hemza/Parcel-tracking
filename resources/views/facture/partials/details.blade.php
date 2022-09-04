<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="first_name">@lang('First Name')</label>
            <input type="text" class="form-control input-solid" id="first_name"
                   name="nom" placeholder="@lang('First Name')" value="{{ $edit ? $client->nom : '' }}">
        </div>
        <div class="form-group">
            <label for="last_name">@lang('Last Name')</label>
            <input type="text" class="form-control input-solid" id="last_name"
                   name="prenom" placeholder="@lang('Last Name')" value="{{ $edit ? $client->prenom : '' }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="phone">@lang('Wilaya')</label>
            <select name="wilaya_id"  id="country-dd" class="form-control">
                <option value="">Select Wilaya</option>
                @foreach (wilayas() as $id => $wilaya)
                    <option value="{{ $id }}">{{ $wilaya }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="address">@lang('Address')</label>
            <input type="text" class="form-control input-solid" id="address"
                   name="adresse" placeholder="@lang('Address')" value="{{ $edit ? $client->adresse : '' }}">
        </div>
    </div>

    <div class="col-md-6">

        <div class="form-group mb-3">
            <label for="phone">@lang('Commune')</label>
            <select name="commune_id" id="state-dd" class="form-control">
            </select>
        </div>



        <div class="form-group">
            <label for="phone">@lang('Phone')</label>
            <input type="text" class="form-control input-solid" id="phone"
                   name="tel" placeholder="@lang('Phone')" value="{{ $edit ? $client->tel : '' }}">
        </div>
    </div>

    @if ($edit)
        <div class="col-md-12 mt-2">
            <button type="submit" class="btn btn-primary" id="update-details-btn">
                <i class="fa fa-refresh"></i>
                @lang('Update Details')
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

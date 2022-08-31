<div class="row">

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

    </div>

    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="phone">@lang('Commune')</label>
            <select name="commune_id" id="state-dd" class="form-control">
            </select>
        </div>
    </div>

    <div class="col-md-12">

        <div class="form-group">
            <label for="address">@lang('Adresse')</label>
            <input type="text" class="form-control input-solid" id="address"
                   name="adresse" placeholder="@lang('Adresse')" value="{{ $edit ? $client->adresse : old('adresse') }}">
        </div>
    </div>
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

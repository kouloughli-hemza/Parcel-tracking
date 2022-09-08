<script>
    var factures = @json(array_values($facturesPerMonth));
    var months = @json(array_keys($facturesPerMonth));
    var trans = {
        chartLabel: "{{ __('Factures')  }}",
        new: "{{ __('new') }}",
        facture: "{{ __('facture') }}",
        factures: "{{ __('factures') }}"
    };
</script>
{!! HTML::script('assets/js/chart.min.js') !!}
{!! HTML::script('assets/js/as/dashboard-admin.js') !!}

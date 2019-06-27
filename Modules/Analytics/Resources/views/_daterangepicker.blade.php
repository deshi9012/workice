@push('pagestyle')
<link rel="stylesheet" type="text/css" href="{{ getAsset('plugins/datepicker/daterangepicker.css') }}" /> 
@endpush 
@push('pagescript')
<script type="text/javascript" src="{{ getAsset('plugins/datepicker/daterangepicker.min.js') }}"></script>
<script type="text/javascript">
	$('#reportrange').daterangepicker({
        locale: {
            format: 'MMMM D, YYYY'
        },
        startDate: '{{ $start_date }}',
        endDate: '{{ $end_date }}',
        "opens": "right",
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    });

</script>

@endpush 
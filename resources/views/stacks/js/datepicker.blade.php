<script src="{{ getAsset('plugins/datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ getAsset('plugins/datepicker/locales/bootstrap-datepicker.'.datePickerLocale().'.min.js') }}" charset="UTF-8"></script>
<script src="{{ getAsset('plugins/datepicker/bootstrap-datetimepicker.js') }}"></script>
<script type="text/javascript">
$('.datepicker-input').datepicker({
    todayHighlight: true,
    todayBtn: "linked",
    language: '{{ datePickerLocale() }}',
    autoclose: true
});
</script>
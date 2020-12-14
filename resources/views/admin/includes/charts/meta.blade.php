<!-- Chart's container -->
<div id="chart" style="height: 500px;"></div>
<!-- Your application script -->
@push('chartsJs')
<script>
    const chart = new Chartisan({
        el: '#chart',
        url: "@chart('meta_chart')",
        hooks:new ChartisanHooks().datasets(['line']).colors()
    });
</script>
@endpush

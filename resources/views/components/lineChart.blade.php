<div class='chart'>
    <canvas id='{{ $id }}'></canvas>
    <script>
        var days = [];
        var values = [];
        @foreach($dates as $data)
            days.push('{{ $data }}');
        @endforeach
        @foreach($values as $data)
            values.push('{{ $data }}');
        @endforeach
        var ctx = document.getElementById('{{ $id }}').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',
            // The data for our dataset
            data: {
                labels: days,
                datasets: [{
                    label: '{{ $label }}',
                    backgroundColor: '{{ $bgColor }}',
                    borderColor: '{{ $borderColor }}',
                    data: values
                }]
            },

            // Configuration options go here
            options: {}
        });
    </script>
</div>
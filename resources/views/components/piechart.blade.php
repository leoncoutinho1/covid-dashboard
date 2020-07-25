<div class='chart'>
    <canvas id='{{ $id }}'></canvas>
    <script>
        var labels = [];
        var values = [];
        @foreach($labels as $data)
            labels.push('{{ $data }}');
        @endforeach
        @foreach($values as $data)
            values.push('{{ $data }}');
        @endforeach
        var ctx = document.getElementById('{{ $id }}').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: values
                }]
            },
            options: {}
        });
    </script>
    <p>Taxa de mortalidade de: {{ round(($values[0] / $values[1]) * 100, 2) }}%</p>
</div>
<div class='chart'>
    <canvas id='{{ $chart["id"] }}'></canvas>
    <script>
        var days = [];
        var datasets = [];
        var values = [];
        @foreach($chart['labels'] as $data)
            days.push('{{ $data }}');
        @endforeach
        @foreach($chart['dataset'] as $dataset)
            @foreach($dataset['values'] as $data)
                values.push('{{ $data }}');
            @endforeach
            datasets.push({
                label: '{{ $dataset["label"] }}',
                backgroundColor: '{{ $dataset["bgColor"] }}',
                borderColor: '{{ $dataset["color"] }}',
                data: values
            })
        @endforeach
               
        var ctx = document.getElementById('{{ $chart["id"] }}').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',
            // The data for our dataset
            data: {
                labels: days,
                datasets: datasets
            },

            // Configuration options go here
            options: {}
        });
    </script>
</div>

<div class='chart'>
    <div class='chart__header'>
        <h3>{{ $chart['title'] }}</h3>
    </div>
    <div class='chart__content'>
        <canvas id='{{ $chart["id"] }}'></canvas>
        <script>
            var meses = [];
            var valores = [];
            @foreach($chart['labels'] as $label)
                meses.push('{{ $label }}');
            @endforeach
            @foreach($chart['datasets']['data'] as $valor)
                valores.push('{{ $valor }}');
            @endforeach
            var ctx = document.getElementById('{{ $chart["id"] }}').getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: '{{ $chart["type"] }}',

                // The data for our dataset
                data: {
                    labels: meses,
                    datasets: [{
                        label: '{{ $chart["datasets"]["label"] }}',
                        backgroundColor: 'rgba(150, 150, 132, .5)',
                        borderColor: 'rgba(150, 150, 132, .6)',
                        data: valores
                    }]
                },

                // Configuration options go here
                options: {}
            });
        </script>
    </div>
    
</div>
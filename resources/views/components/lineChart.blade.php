<div class='chart'>
    <canvas id='dayEvolutionChart'></canvas>
    <script>
        var days = [];
        var confirmed = [];
        @foreach($countryDataset['weekDates'] as $data)
            days.push('{{ $data }}');
        @endforeach
        @foreach($countryDataset['weekConfirmedDaily'] as $data)
            confirmed.push('{{ $data }}');
        @endforeach
        var ctx = document.getElementById('dayEvolutionChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',
            // The data for our dataset
            data: {
                labels: days,
                datasets: [{
                    label: 'Casos confirmados',
                    backgroundColor: 'rgba(150, 150, 132, .5)',
                    borderColor: 'rgba(150, 150, 132, .6)',
                    data: confirmed
                }]
            },

            // Configuration options go here
            options: {}
        });
    </script>
</div>
<div class='chart'>
    <canvas id='{{$id}}'></canvas>
    <script>
        var data = [];
        var dates = [];
        var values = [];
        var backgroundColor = [];
        var borderColor = [];
        
        @foreach($dates as $date)
            dates.push('{{ $date }}');
        @endforeach
        @foreach($values as $value)
            values.push({{ $value }});
        @endforeach

        for(var i = 0; i < dates.length; i++) {
            data.push({
                x: dates[i],
                y: values[i]
            });
            backgroundColor.push('rgb(0, 92, 184)');
            borderColor.push('rgb(0, 92, 184)');
        }
        
        var data = {
            labels: dates,
            datasets: [
            {
                label: '{{ $label }}',
                data: values,
                borderWidth: 1
            },
            ]
        };

  
        var options = {
            responsive: true,
            title: {
            display: true,
            position: "top",
            text: '{{ $text }}',
            fontSize: 18,
            fontColor: "#111"
            },
            legend: {
            display: true,
            position: "bottom",
            labels: {
                fontColor: "#333",
                fontSize: 16
            }
            },
            scales: {
            yAxes: [{
                ticks: {
                min: 0
                }
            }]
            }
        };

        var ctx = document.getElementById('{{$id}}').getContext('2d');
        var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: options
            });
    </script>

</div>

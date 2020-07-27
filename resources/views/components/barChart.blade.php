<div class='chart'>
    <canvas id='{{$id}}'></canvas>
    <script>
        var data = [];
        var dates = [];
        var values = [];
        var labels = [];
        var backgroundColor = [];
        var borderColor = [];
        var beginDate = '{{$beginDate}}';
        var endDate = '{{$endDate}}';
        
        @foreach($dates as $date)
            dates.push('{{ $date }}');
        @endforeach
        @foreach($values as $value)
            values.push({{ $value }});
        @endforeach
        
        if (!beginDate) {
            beginDate = dates[0];
        }

        if (!endDate) {
            endDate = dates[dates.length - 1]
        }

        if(beginDate > endDate) {
            var aux = beginDate;
            beginDate = endDate;
            endDate = aux;
        }
        
        
        for(var i = 0; i < dates.length; i++) {
            if (beginDate <= dates[i] && dates[i] <= endDate) {
                data.push({
                    x: dates[i],
                    y: values[i]
                });
                backgroundColor.push('rgb(0, 92, 184)');
                borderColor.push('rgb(0, 92, 184)');
                labels.push(dates[i])
            }
        }
                        
        var data = {
            labels: labels,
            datasets: [
            {
                label: '{{ $label }}',
                data: data,
                borderWidth: 1
            },
            ]
        };

  
        var options = {
            responsive: true,
            title: {
            display: true,
            position: "top",
            //text: '{{ $text }}',
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

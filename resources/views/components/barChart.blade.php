<div class='chart'>
    <canvas id='{{$id}}'></canvas>
    <script>
        var data = [];
        var dates = [];
        var values = [];
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

        if (beginDate == '') {
            beginDate = dates[0];
        }

        if (endDate == '') {
            endDate = dates[date.length - 1]
        }
        
        for(var i = 0; i < dates.length; i++) {
        
            if (beginDate <= dates[i] && dates[i] <= endDate) {
                backgroundColor.push('rgb(0, 92, 184)');
                borderColor.push('rgb(0, 92, 184)');
            } else {
                console.log(beginDate, dates[i], endDate, values[i]);
                dates.splice(i, 1);
                values.splice(i, 1);
            }
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

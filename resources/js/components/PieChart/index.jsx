import React, {useEffect} from 'react'

export default props => {
    useEffect(() => {
        var ctx = document.getElementById(props.id).getContext('2d');
        var chart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: props.labels,
                datasets: [{
                    data: props.values,
                    backgroundColor: ['#fa4b4b9a', '#8bd466a6'],
                    borderColor: ['#fa4b4b', '#4eb92a']
                }]
            },
            options: {}
        })
    })
        
    return (
        <div className='chart'>
            <canvas id={props.id}></canvas>
            <p>Taxa de mortalidade de: { ((props.values[0] / props.values[1]) * 100).toFixed(2) }%</p>
        </div>
    )
}
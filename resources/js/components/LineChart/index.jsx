import React, { useEffect } from 'react'

export default props => {
    useEffect(() => {
        var ctx = document.getElementById(props.id).getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: props.labels,
                datasets: props.datasets
            },
            options: {}
        })
    })

    return (
        <div className='chart'>
            <canvas id={props.id}></canvas>
        </div>
    )
}




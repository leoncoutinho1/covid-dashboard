import React, {useEffect} from 'react'

export default props => {
    let beginDate = ''
    let endDate = ''
    const labels = []
    const values = []
        
    beginDate = (!props.beginDate || props.beginDate === null) ? props.labels[0] : props.beginDate
    endDate = (!props.endDate || props.endDate === null) ? props.labels[props.labels.length - 1] : props.endDate
    
    props.labels.map((date, index, arr) => {
        if ((date >= beginDate && date <= endDate) || (date >= endDate && date <= beginDate)) {
            labels.push(date)
            values.push(props.values[index])
        }
    })

    useEffect(() => {
        var ctx = document.getElementById(props.id).getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                {
                    label: props.text,
                    data: values,
                    borderWidth: 1,
                    backgroundColor: props.backgroundColor,
                    borderColor: props.borderColor,
                },
                ]
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

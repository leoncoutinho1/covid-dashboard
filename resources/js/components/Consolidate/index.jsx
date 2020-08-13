import React from 'react'
import Card from '../Card'
import LineChart from '../LineChart'

export default props => {
    const bgConfirmed =  '#8bd466a6';
    const confirmed =  '#8bd466';
    const bgDeaths =  '#fa4b4b9a';
    const deaths =  '#fa4b4b'
    const bgActive =  '#fdfd2d8c';
    const active =  '#fdfd2d';
    const bgRecovered =  '#409efc8e';
    const recovered =  '#409efc';
    const transparent =  'transparent';

    return (
        <div id='consolidate'>
            <Card title='Dados diários'>
                <LineChart 
                    id='consolidateDaily'
                    labels={props.country.datasets.dates.slice(-7)}
                    datasets={[
                        {
                            data: props.country.datasets.confirmedDaily.slice(-7),
                            backgroundColor: transparent,
                            borderColor: confirmed,
                            label: 'Casos confirmados'
                        },
                        {
                            data: props.country.datasets.deathsDaily.slice(-7),
                            backgroundColor: transparent,
                            borderColor: deaths,
                            label: 'Mortes'
                        },
                        {
                            data: props.country.datasets.recoveredDaily.slice(-7),
                            backgroundColor: transparent,
                            borderColor: recovered,
                            label: 'Recuperados'
                        },
                    ]}
                />
            </Card>
            <Card title='Dados totais'>
                <LineChart 
                    id='consolidateTotal'
                    labels={props.country.datasets.dates.slice(-7)}
                    datasets={[
                        {
                            data: props.country.datasets.confirmedTotal.slice(-7),
                            backgroundColor: transparent,
                            borderColor: confirmed,
                            label: 'Casos confirmados'
                        },
                        {
                            data: props.country.datasets.deathsTotal.slice(-7),
                            backgroundColor: transparent,
                            borderColor: deaths,
                            label: 'Mortes'
                        },
                        {
                            data: props.country.datasets.activeTotal.slice(-7),
                            backgroundColor: transparent,
                            borderColor: active,
                            label: 'Ativos'
                        },
                        {
                            data: props.country.datasets.recoveredTotal.slice(-7),
                            backgroundColor: transparent,
                            borderColor: recovered,
                            label: 'Recuperados'
                        },
                    ]}
                />
            </Card>
        </div>
    )
}
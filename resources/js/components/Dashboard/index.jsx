import React from 'react'
import Card from '../Card'
import LineChart from '../LineChart'
import BarChart from '../BarChart'

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

    const beginDate = document.location.pathname.split('/')[3];
    const endDate = document.location.pathname.split('/')[4];

    if (props.page === 'country') {
        return (
            <div className="dashboard">
                <Card title='Novos casos confirmados'>
                    <LineChart 
                        id='confirmedDaily'
                        labels={props.country.datasets.dates.slice(-7)}
                        datasets={[{
                            data: props.country.datasets.confirmedDaily.slice(-7),
                            backgroundColor: bgConfirmed,
                            borderColor: confirmed,
                            label: 'Casos confirmados'
                        }]}
                    />
                </Card>
                <Card title='Números de mortes'>
                    <LineChart 
                        id='deathsDaily'
                        labels={props.country.datasets.dates.slice(-7)}
                        datasets={[{
                            data: props.country.datasets.deathsDaily.slice(-7),
                            backgroundColor: bgDeaths,
                            borderColor: deaths,
                            label: 'Mortes'
                        }]}
                    />
                </Card>
                <Card title='Total de casos confirmados / semana'>
                    <LineChart 
                        id='confirmedTotal'
                        labels={props.country.datasets.dates.slice(-7)}
                        datasets={[{
                            data: props.country.datasets.confirmedTotal.slice(-7),
                            backgroundColor: bgConfirmed,
                            borderColor: confirmed,
                            label: 'Casos confirmados'
                        }]}
                    />
                </Card>
                <Card title='Total de mortes / semana'>
                    <LineChart 
                        id='deathsTotal'
                        labels={props.country.datasets.dates.slice(-7)}
                        datasets={[{
                            data: props.country.datasets.deathsTotal.slice(-7),
                            backgroundColor: bgDeaths,
                            borderColor: deaths,
                            label: 'Mortes'
                        }]}
                    />
                </Card>
                <Card title='Total de casos confirmados / mês'>
                    <LineChart 
                        id='confirmedTotalMonth'
                        labels={props.country.datasets.dates.slice(-30)}
                        datasets={[{
                            data: props.country.datasets.confirmedTotal.slice(-30),
                            backgroundColor: bgConfirmed,
                            borderColor: confirmed,
                            label: 'Casos confirmados'
                        }]}
                    />
                </Card>
                <Card title='Total de mortes / mês'>
                    <LineChart 
                        id='deathsTotalMonth'
                        labels={props.country.datasets.dates.slice(-30)}
                        datasets={[{
                            data: props.country.datasets.deathsTotal.slice(-30),
                            backgroundColor: bgDeaths,
                            borderColor: deaths,
                            label: 'Mortes'
                        }]}
                    />
                </Card>
            </div> )
    } else if (props.page === 'report') {
        return (
            <div className="relatorio__dashboard">
                <Card title='Novos casos confirmados'>
                    <BarChart
                        id='confirmedDaily'
                        labels={props.country.datasets.dates}
                        values={props.country.datasets.confirmedDaily}
                        text='Novos casos confirmados'
                        label='Casos confirmados'
                        beginDate={beginDate}
                        endDate={endDate}
                        backgroundColor={bgConfirmed}
                        borderColor={confirmed}
                    />
                </Card>
                <Card title='Mortes diárias'>
                    <BarChart
                        id='deathsDaily'
                        labels={props.country.datasets.dates}
                        values={props.country.datasets.deathsDaily}
                        text='Mortes'
                        label='Mortes diárias'
                        beginDate={beginDate}
                        endDate={endDate}
                        backgroundColor={bgDeaths}
                        borderColor={deaths}
                    />
                </Card>
            </div>
        )
    }
}



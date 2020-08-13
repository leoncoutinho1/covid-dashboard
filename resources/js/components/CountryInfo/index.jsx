import React from 'react'

export default props => {
    return (
        <div className='info'>
            <div>
                <p>População: {props.country.population.toLocaleString('pt-BR')}</p>
                <p>Capital: { props.country.capital }</p>
                <p>Região: { props.country.region }</p>
                <p>Day One em: { props.country.dayOne }</p>
                <p>Total de casos confirmados: { props.country.currentConfirmed.toLocaleString('pt-BR') }</p>
                <p>Total de mortes: { props.country.currentDeaths.toLocaleString('pt-BR') }</p>
            </div>
            <img src={props.country.flag} alt="flag"/>
        </div>
    )
}

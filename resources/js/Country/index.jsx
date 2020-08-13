import React from 'react'
import { connect } from 'react-redux'


import Header from '../components/Header'
import Footer from '../components/Footer'
import Select from '../components/Select'
import Card from '../components/Card'
import CountryInfo from '../components/CountryInfo'
import PieChart from '../components/PieChart'
import If from '../components/If'
import Dashboard from '../components/Dashboard'
import Consolidate from '../components/Consolidate'
import convertDate from '../helpers/convertDate'
import DateForm from '../components/DateForm'

import './Country.css'
import { pageChange } from '../store/actions/page'

const Country = props => {
    
    console.log(props.page)

    const country = {
        code: props.country,
        name: props.countryInfo.name,
        iso2: props.countryInfo.alpha2Code,
        iso3: props.countryInfo.alpha3Code,
        capital: props.countryInfo.capital,
        region: props.countryInfo.region,
        subregion: props.countryInfo.subregion,
        nativeName: props.countryInfo.nativeName,
        flag: props.countryInfo.flag,
        population: props.countryInfo.population,
        area: props.countryInfo.area,
        currentConfirmed: '',
        currentDeaths: '',
        dayOne: '',
        datasets: {
            dates: [],
            confirmedTotal: [],
            confirmedDaily: [],
            deathsTotal: [],
            deathsDaily: [],
            recoveredTotal: [],
            recoveredDaily: [],
            activeTotal: [],
            activeDaily: []
        }
    }

    var cd = props.countryDataset;
    var total = cd.length - 1;
    
    var beginDate = cd[0].Date;
    var endDate = cd[total].Date;

    for(var i = 1; i <= total; i++) {
        country.datasets.dates.push(convertDate(cd[i].Date));
        country.datasets.confirmedTotal.push(cd[i].Confirmed);
        country.datasets.confirmedDaily.push(cd[i].Confirmed - cd[i - 1].Confirmed);
        country.datasets.deathsTotal.push(cd[i].Deaths);
        country.datasets.deathsDaily.push(cd[i].Deaths - cd[i - 1].Deaths);
        country.datasets.recoveredTotal.push(cd[i].Recovered);
        country.datasets.recoveredDaily.push(cd[i].Recovered - cd[i - 1].Recovered);
        country.datasets.activeTotal.push(cd[i].Active);
        country.datasets.activeDaily.push(cd[i].Active - cd[i - 1].Active);

        if( (cd[i].Confirmed !== 0) && (cd[i - 1].Confirmed === 0)) {
            country.dayOne = convertDate(cd[i].Date);
        }

        if (i === total) {
            country.currentConfirmed = cd[i].Confirmed;
            country.currentDeaths = cd[i].Deaths;
        }
    }

     
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
        <>
            <Header csrf={props.csrf} user={props.user} country={country.code} />
            <div id='content'>
                <div className="aside">
                    <Select countries={props.countries} page='country'/>
                    <Card title={`${country.iso2} - ${country.iso3} - ${country.name}`} >
                        <CountryInfo
                            country={country} />
                    </Card>
                    <Card title='Informações adicionais'>
                        <div>
                            <p>Casos por milhões de habitantes: { (country.currentConfirmed / (country.population / 1000000)).toFixed(2).toLocaleString('pt-BR') }</p>
                            <p>Mortes por milhões de habitantes: { (country.currentDeaths / (country.population / 1000000)).toFixed(2).toLocaleString('pt-BR') }</p>
                        </div>
                    </Card>
                    <Card title='Mortes vs Casos'>
                        <PieChart 
                            id='deathsByConfirmed'
                            labels={['Mortes', 'Casos']}
                            values={[country.currentDeaths, country.currentConfirmed]}
                        />
                    </Card>
                    <If test={(props.page === 'report')}>
                        <Card title='Selecionar datas' >
                            <DateForm 
                                beginDate={beginDate}
                                endDate={endDate}
                                country={country}
                            />
                        </Card>
                    </If>
                </div>
                <Dashboard country={country} page={props.page}/>
            </div>
            <If test={(props.page === 'country')}>
                <Consolidate country={country} />
            </If>
            <Footer />
        </>
    )
}

function mapStateToProps(state) {
    return {
        page: state.page.current
    }
}

function mapDispatchToProps(dispatch) {
    return {
        turnPage(page) {
            const action = pageChange(page)
            dispatch(action)
        }
    }
}


export default connect(mapStateToProps, mapDispatchToProps)(Country)
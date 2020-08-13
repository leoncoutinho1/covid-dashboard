import React from 'react'
import './Select.css'
import Option from '../Option'
import setCountry from '../../helpers/setCountry'

export default props => {
    props.countries.sort((a, b) => {
        return (a.Country > b.Country) ? 1 : ((b.Country > a.Country) ? -1: 0);
    })
        
    return (
        <div className='selectCountry'>
            <select id='countries' onChange={ () => setCountry() }>
                <option key="country" value="">--Selecione um país--</option>
                {
                    props.countries.map((c, index) => {
                        return <Option index={`country${index+1}`} page={props.page} slug={c.Slug} country={c.Country} iso2={c.ISO2} />
                    })
                }
            </select>
        </div>
    )
}


    
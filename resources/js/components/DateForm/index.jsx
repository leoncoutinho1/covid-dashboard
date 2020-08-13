import React, { useState } from 'react'
import { connect } from 'react-redux'
import { setIntervalChanged } from '../../store/actions/interval'

const DateForm = (props) => {

    console.log(props)
    let min = props.country.datasets.dates[0]
    let max = props.country.datasets.dates[props.country.datasets.dates.length - 1]
    
    const [begin, setBegin] = useState(min)
    const [end, setEnd] = useState(max)
    
    return (
        <>
            <input type="date" name="beginDate" id="beginDate" value={begin} min={min} max={max} onChange={(e) => setBegin(e.target.value)}/>
            <input type="date" name="endDate" id="endDate" value={end} min={min} max={max} onChange={(e) => setEnd(e.target.value)} />
            <input type='hidden' id='inputCountry' value={props.country.code} />
            <div id="btnSearch" onClick={props.setPeriod()}>Pesquisar</div>
        </>
    )
}

function mapStateToProps(state) {
    return {
        begin: state.interval.begin,
        end: state.interval.end
    }
}

function mapDispatchToProps(dispatch) {
    return {
        setPeriod() {
            const action = setIntervalChanged()
            dispatch(action)
        }
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(DateForm);
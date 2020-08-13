import React from 'react'
import './Header.css'
import { connect } from 'react-redux'
import { pageChange } from '../../store/actions/page'

const Header = props => {
    return (
        <header id='header'>
            <div id='header__title'>
                <img id='header__logo' src="/img/icon.png" alt="logo" />
                <h1>Dashboard Dados Covid19</h1>
            </div>
            <div id='header__menu'>
                <div id='header__links'>
                    <a className={((props.page === 'country') ? 'current' : '')} onClick={(e) => props.turnPage('country')}>Quadro geral</a>
                    <a className={((props.page === 'report') ? 'current' : '')}  onClick={(e) => props.turnPage('report')}>Relatório</a>
                    <a href={ `/pdf/${props.country}` }>Dados</a>
                </div>
                <p>Olá, { props.user }</p>      
                <form action="/logout" method="POST">
                    <input type="hidden" name="csrf-token" id="csrsf-token" value={ props.csrf } />
                    <button type='submit' className='button__logout'>Logout</button>
                </form>
            </div>
        </header>        
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
            console.log(`tentou mudar pra ${page}`)
            const action = pageChange(page)
            dispatch(action)
        }
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(Header)
import React from 'react'
import './Card.css'

export default props => {
    return (
        <div className='card'>
            <div className='card__header'>
                <h3>{ props.title }</h3>
            </div>
            <div className='card__content'>
                { props.children }
            </div>
        </div>
    )
}



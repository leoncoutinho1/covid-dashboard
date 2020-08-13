import React from 'react'

export default props => {
    const { page, slug, country, iso2, index } = props

    return (
        <option key={index} value={`${slug}`} >
            {`${iso2} - ${country}`}
        </option>
    )
}
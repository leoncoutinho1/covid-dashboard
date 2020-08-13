import React from 'react'
import './Footer.css'

export default props => {
    return (
        <>
            <footer id='footer'>
                <div id='footer__title'>
                    <h3>Leonardo Coutinho</h3>
                    <p>leon.coutinho1@gmail.com</p>
                    <p>(22) 99288-4103</p>
                </div>
                <div id='footer__links'>
                    <a href="https://github.com/leoncoutinho1"><img src="/img/icons8-github-50.png" alt="github"/></a>
                    <a href="https://www.linkedin.com/in/leoncoutinho1/"><img src="/img/icons8-linkedin-50.png" alt="linkedin"/></a>
                    <a href="https://stackoverflow.com/users/13592207/coutinho"><img src="/img/icons8-stack-overflow-50.png" alt="stack-overflow"/></a>
                    <a href="https://www.facebook.com/leonardo.coutinhogomes.5/"><img src="/img/icons8-facebook-50.png" alt="facebook"/></a>
                    <a href="https://www.instagram.com/leoncoutinho1"><img src="/img/icons8-instagram-50.png" alt="instagram"/></a>
                </div>
            </footer>
        </>
    )
    
}
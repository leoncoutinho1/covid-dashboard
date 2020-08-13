import { InertiaApp } from '@inertiajs/inertia-react'
import React from 'react'
import { render } from 'react-dom'
import { Provider } from 'react-redux'
import configStore from './store/storeConfig'
const store = configStore()

const app = document.getElementById('app')

render(
    <Provider store={store}>
        <InertiaApp
            initialPage={JSON.parse(app.dataset.page)}
            resolveComponent={name => import(`./${name}`).then(module => module.default)}
        />
    </Provider>,
    app
)
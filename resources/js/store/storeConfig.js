import { createStore, combineReducers } from 'redux'
import pageReducer from '../store/reducers/page'
import intervalReducer from '../store/reducers/interval'

const reducers = combineReducers({
    page: pageReducer,
    interval: intervalReducer
})

function storeConfig() {
    return createStore(reducers)
}

export default storeConfig
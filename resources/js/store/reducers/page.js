const initialState = {
    current: 'country'
}

export default function(state = initialState, action) {
    switch(action.type){
        case 'PAGE_CHANGED':
            return {
                current: action.payload
            }
        default:
            return state
    }
    
}
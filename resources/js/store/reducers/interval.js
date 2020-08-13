const initialState = {
    begin: '',
    end: ''
}

export default function(state = initialState, action) {
    switch(action.type){
        case 'INTERVAL_CHANGED':
            return {
                ...action.payload
            }
        default:
            return state
    }
    
}
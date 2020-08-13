export function setIntervalChanged(begin, end) {
    return {
        type: 'INTERVAL_CHANGED',
        payload: {
            begin: begin,
            end: end
        }
    }
}
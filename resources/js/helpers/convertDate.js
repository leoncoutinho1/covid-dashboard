//conversor de data
//2020-01-01T00:00:00Z  -->  2020-01-01
export default (date) => {
    return date.substring(0, 10);;
    /* return date.substring(8, 10) + '-' + date.substring(5, 7) + '/' + date.substring(2, 4); */
}
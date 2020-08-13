export default () => {
    const beginDate = document.getElementById('beginDate').value
    const endDate = document.getElementById('endDate').value
    const country = document.getElementById('inputCountry').value

       
    location.redirect(location.hostname + `/report/${country}/${beginDate}/${endDate}`)
}
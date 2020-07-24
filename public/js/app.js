function setCountry() {
    var url = 'http://127.0.0.1:8000/' + document.getElementById('countries').value
    console.log(url);
    window.location.href = url
}
function setCountry() {
    var url = 'http://127.0.0.1:8000/' + document.getElementById('countries').value
    console.log(url);
    window.location.href = url
}

function search(e) {
    var beginDate = document.getElementById('beginDate').value;
    var endDate = document.getElementById('endDate').value;
    var country = document.getElementById('country').value;
    var url = 'localhost:8000/report/'+country+'/'+beginDate+'/'+endDate;
    console.log(url);
    window.location.replace(url);   
}
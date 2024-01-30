function sendmail(){
    var params = {
        from_name: document.getElementById("name").value,
        email_id: document.getElementById("mail").value,
        message: document.getElementById("msg").value,
    }

emailjs.send("service_vcunpjl","template_3vgel9f",params).then(function (res) {
    alert("success"+ res.status);
})
}
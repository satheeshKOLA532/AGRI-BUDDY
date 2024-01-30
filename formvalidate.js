

const form=document.querySelector('form');
const username=document.getElementById("username");
const email=document.getElementById("email");
const password=document.getElementById("password");
const cpassword=document.getElementById("cpassword");
const mobile=document.getElementById("num");
const image=document.getElementById("file");
let country = document.querySelector('#countries');
let state = document.querySelector('#states');

const pincode=document.getElementById("pin");


form.addEventListener("submit", function(event) {
    event.preventDefault(); // This prevents the default form submission
    // ... rest of your validation and handling code ...

    //function validate()
//{
 // Validate Name (Non-empty)
const pattern2=/^[a-zA-Z\s]+$/;
let p1=pattern2.test(username.value);
if (p1!=true) {
    alert("Please enter your name.");
    return;
}

// Validate Email (Format)
const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
let p2 = emailRegex.test(email.value);
if (p2==""){
    alert("Please enter a valid email address.");
    return;
}


// Validate Password (Minimum length)
const p3 =password.value;
if (p3.length < 8) {
    alert("Password must be at least 8 characters long.");
    return;
}

// Validate Password Confirmation
const p4 =cpassword.value;
if (p3 !== p4) {
    alert("Passwords do not match.");
    return;
}
// Validate Mobile Number (Numeric and length)
const mobileRegex = /^\d{10}$/;
let p5 =mobileRegex.test(num.value);
if (p5!=true) {
    alert("Please enter a valid 10-digit mobile number.");
    return;
}
 // Validate Image File
 let p6 =file.files[0];
if (!p6) {
    alert("Please select an image.");
    return;
}
// Check image file size (less than 1MB)
let maxSize = 1 * 1024 * 1024; // 1MB in bytes
if (p6.size > maxSize) {
    alert("Image file size should be less than 1MB.");
    return;
}
// Validate Country (Non-empty)
let p7 =country.value;
if (country === "-1") {
    alert("Please select your country.");
    return;
}

// Validate District (Non-empty)
let p8 = state.value;
if (state === "-1") {
    alert("Please enter your state.");
    return;
}

// Validate Pincode (Numeric and length)
const pincodeRegex = /^\d{6}$/;
let p9= pincodeRegex.test(pincode.value);
if (p9!=true) {
    alert("Please enter a valid 6-digit pincode.");
    return;
}


//}
form.submit();
});



//orm.addEventListener('submit',event=>{event.preventDefault(); validate();});


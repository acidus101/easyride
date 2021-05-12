function formValidation() {
    let username    = document.registration.username;
    let email       = document.registration.email;
    let phone       = document.registration.phone;
    let password    = document.registration.password;
    let re_password = document.registration.re_passsword;
    if(username_validation(username)){
        if(phone_validation(phone)) {
            if(email_validation(email)) {
                if(password_validation(password,6,12)) {
                    if(match_password(password, re_password)) {
                        return true;
                    } 
                }
            }
        }
    }
    return false;
}

function username_validation(username)
{ 
    let letters = /^[0-9a-zA-Z]+$/;
    if(username.value.match(letters)){
        return true;
    } else {
        alert('Username must have alphabet and numberscharacters only');
        username.focus();
        return false;
    }
}

function phone_validation(phone) {
    var phone_len = phone.value.length;
    if (phone_len == 0 || phone_len > 10 || phone_len < 10) {
        alert("enter a valid 10-digit mobile number");
        phone.focus();
        return false;
    }
    return true;
}

function email_validation(email)
{
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(uemail.value.match(mailformat)) {
        return true;
    } else {
        alert("You have entered an invalid email address!");
        email.focus();
        return false;
    }
}

function password_validation(password, mx, my) {
    let lowerCaseLetters = /[a-z]/g;
    let upperCaseLetters = /[A-Z]/g;
    let numbers = /[0-9]/g;
    let password_len = password.value.length;
    let containsmall = password.value.match(lowerCaseLetters);
    let containcapital = password.value.match(upperCaseLetters);
    let containnumber = password.value.match(numbers);
    if (password_len == 0 ||password_len >= my || password_len < mx)
    {
        alert("Password should not be empty / length be between "+mx+" to "+my);
        password.focus();
        return false;
    }else {
        if(containcapital && containsmall && containnumber){
            return true;
        } else {
            alert("password must contain one small letter , one capital letter, one number");
            password.focus();
            return false;
        }
    }
}

function match_password(password, re_passsword) {
    let a = password.value;
    let b = re_passsword.value;
    if(a === b) {
        return true;
    }else {
        alert("Passwords do not match");
        re_passsword.focus();
        return false;
    }
}


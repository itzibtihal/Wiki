const signUp = document.querySelector("#signUp");
const signIn = document.querySelector("#signIn");
const passwordIcon = document.querySelectorAll('.password__icon')
const authPassword = document.querySelectorAll('.auth__password')

// when click sign up button
signUp.addEventListener('click', () => {
    document.querySelector('.login__form').classList.remove('active')
    document.querySelector('.register__form').classList.add('active')
    document.querySelector('.ball').classList.add('register')
    document.querySelector('.ball').classList.remove('login')
});

// when click sign in button
signIn.addEventListener('click', () => {
    document.querySelector('.login__form').classList.add('active')
    document.querySelector('.register__form').classList.remove('active')
    document.querySelector('.ball').classList.add('login')
    document.querySelector('.ball').classList.remove('register')
});


            document.getElementById('signupForm').addEventListener('submit', function(event) {
                let hasError = false;

                document.getElementById('firstNameError').textContent = '';
                document.getElementById('lastNameError').textContent = '';
                document.getElementById('emailError').textContent = '';
                document.getElementById('passwordError').textContent = '';
                document.getElementById('confirm-passwordError').textContent = '';
                
                let firstName = document.getElementById('first-name').value;
                let lastName = document.getElementById('last-name').value;
                let email = document.getElementById('email').value;
                let password = document.getElementById('password').value;
                let confirmPassword = document.getElementById('confirm-password').value;

                if (!firstName) {
                    document.getElementById('firstNameError').textContent = 'Please enter your first name.';
                    hasError = true;
                }
                if (!lastName) {
                    document.getElementById('lastNameError').textContent = 'Please enter your last name.';
                    hasError = true;
                }
                if (!email || !email.includes('@')) {
                    document.getElementById('emailError').textContent = 'Please enter a valid email address.';
                    hasError = true;
                }
                if (password.length < 8) {
                    document.getElementById('passwordError').textContent = 'Password must be at least 8 characters.';
                    hasError = true;
                }
                if (password !== confirmPassword) {
                    document.getElementById('confirm-passwordError').textContent = 'Passwords do not match.';
                    hasError = true;
                }

                if (hasError) {
                    event.preventDefault();
                }
            });
        

// validation form




function validateName() {
    var name = document.getElementsByName('name')[0].value.trim();
    var nameError = document.getElementById('nameError');

    if (!name) {
        nameError.innerHTML = 'Please enter your name.';
        return false;
    } else {
        nameError.innerHTML = '';
        return true;
    }
}

function validateEmail() {
    var email = document.getElementsByName('email')[0].value.trim();
    var emailError = document.getElementById('emailError');
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!email || !email.match(emailRegex)) {
        emailError.innerHTML = 'Please enter a valid email address.';
        return false;
    } else {
        emailError.innerHTML = '';
        return true;
    }
}


function validatePassword() {
    var password = document.getElementsByName('password')[0].value;
    var passwordError = document.getElementById('passwordError');

    if (!password || password.length < 6) {
        passwordError.innerHTML = 'Password must be at least 6 characters long.';
        return false;
    } else {
        passwordError.innerHTML = '';
        return true;
    }
}

function validateConfirmPassword() {
    var password = document.getElementsByName('password')[0].value;
    var confirmPassword = document.getElementsByName('Confirmpassword')[0].value;
    var confirmPasswordError = document.getElementById('confirmPasswordError');

    if (password !== confirmPassword) {
        confirmPasswordError.innerHTML = 'Passwords do not match.';
        return false;
    } else {
        confirmPasswordError.innerHTML = '';
        return true;
    }
}


function validateLoginForm() {
    var isEmailValid = validateEmail();
    var isPasswordValid = validatePassword();

    if ( isEmailValid && isPasswordValid ) {
        return true;
    } else {
        return false;
    }
}


function validateRegisterForm() {
    var isNameValid = validateName();
    var isEmailValid = validateEmail();
    var isPasswordValid = validatePassword();
    var isConfirmPasswordValid = validateConfirmPassword();

    
    if (isNameValid && isEmailValid && isPasswordValid && isConfirmPasswordValid) {
        return true;
    } else {
        return false;
    }
}



// change hidden password to visible password
for (var i = 0; i < passwordIcon.length; ++i) {
    passwordIcon[i].addEventListener('click', (i) => {
        const lastArray = i.target.classList.length - 1
        if (i.target.classList[lastArray] == 'bi-eye-slash') {
            i.target.classList.remove('bi-eye-slash')
            i.target.classList.add('bi-eye')
            i.currentTarget.parentNode.querySelector('input').type = 'text'
        } else {
            i.target.classList.add('bi-eye-slash')
            i.target.classList.remove('bi-eye')
            i.currentTarget.parentNode.querySelector('input').type = 'password'
        }
    });
}
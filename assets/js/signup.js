let fullnameErrorMessage = document.querySelector('#fullnameErrorMessage');
let emailErrorMessage = document.querySelector('#emailErrorMessage');
let passwordErrorMessage = document.querySelector('#passwordErrorMessage');
let signupForm = document.querySelector('#signupForm')

const fullnameErrorHandler = () => {
  fullnameErrorMessage.textContent = ''
};

const emailErrorHandler = () => {
  emailErrorMessage.textContent = ''
};

const passwordErrorHandler = () => {
  passwordErrorMessage.textContent = ''
}

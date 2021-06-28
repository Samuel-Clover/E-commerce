import replaceErrorContainerContent from './functions/replaceErrorContainerContent.js';
import Validator from './utils/Validator.js';

(function () {
  const registrationForm = document.forms['registration-form'];
  const errorContainer = document.querySelector('.errors-container');

  /**
   * @param {Event} event
   */
  function handleFormSubmit(event) {
    const name = event.target.name.value;
    const email = event.target.email.value;
    const password1 = event.target.password1.value;
    const password2 = event.target.password2.value;
    const phoneNumber = event.target.phone.value;
    const address = event.target.address.value;

    const emptyFields = !name || !email || !password1 || !password2 || !phoneNumber || !address;
    if (emptyFields) {
      event.preventDefault();
      replaceErrorContainerContent(errorContainer, 'Preencha todos os campos.');
      return;
    }

    const invalidEmail = !Validator.isAValidEmail(email);
    if (invalidEmail) {
      event.preventDefault();
      replaceErrorContainerContent(errorContainer, 'E-mail inválido.');
      return;
    }

    const invalidPasswordLength = !Validator.hasAValidPasswordLength(password1);
    if (invalidPasswordLength) {
      event.preventDefault();
      replaceErrorContainerContent(
        errorContainer,
        'A senha deve ter entre 8 e 50 carácteres.',
      );
      return;
    }

    const differentPasswords = !Validator.areThePasswordsTheSame(
      password1,
      password2,
    );
    if (differentPasswords) {
      event.preventDefault();
      replaceErrorContainerContent(errorContainer, 'As senhas não coincidem.');
      return;
    }

    const invalidPhoneNumber = !Validator.isAValidPhoneNumber(phoneNumber);
    if (invalidPhoneNumber) {
      event.preventDefault();
      replaceErrorContainerContent(
        errorContainer,
        'Número de telefone inválido.',
      );
    }
  }

  registrationForm.addEventListener('submit', handleFormSubmit);
}());

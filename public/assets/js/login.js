import replaceErrorContainerContent from './functions/replaceErrorContainerContent.js';

(function () {
  const loginForm = document.forms['login-form'];
  const errorContainer = document.querySelector('.errors-container');

  /**
   * @param {Event} event
   */
  function handleFormSubmit(event) {
    const email = event.target.email.value;
    const password = event.target.password.value;

    const emptyFields = !email || !password;
    if (emptyFields) {
      event.preventDefault();
      replaceErrorContainerContent(errorContainer, 'Preencha todos os campos.');
    }
  }

  loginForm.addEventListener('submit', handleFormSubmit);
}());

class Validator {
  /**
   * @param {string} email
   */
  static isAValidEmail(email) {
    const emailRegex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return emailRegex.test(email);
  }

  /**
   * @param {string} phoneNumber
   */
  static isAValidPhoneNumber(phoneNumber) {
    const phoneNumberRegex = /^\(?\d{1,2}\)? ?9? ?\d{4}-?\d{4}$/;
    return phoneNumberRegex.test(phoneNumber);
  }

  /**
   * @param {string} password
   */
  static hasAValidPasswordLength(password) {
    const minPasswordLength = 8;
    const maxPasswordLength = 50;
    return (
      password.length > minPasswordLength
      || password.length < maxPasswordLength
    );
  }

  /**
   * @param {string} password1
   * @param {string} password2
   */
  static areThePasswordsTheSame(password1, password2) {
    return password1 === password2;
  }
}

export default Validator;

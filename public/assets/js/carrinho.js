import formatNumberToBRLCurrency from './functions/formatNumberToBRLCurrency.js';
import getPriceNumbers from './functions/getPriceNumbers.js';
import updateProductsInfoInSessionStorage from './functions/updateProductsInfoInSessionStorage.js';
import deleteProductFromCart from './functions/deleteProductFromCart.js';
import deleteProductFromCartElement from './functions/deleteProductFromCartElement.js';
import getBaseURL from './functions/getBaseURL.js';

(function () {
  const BASE_URL = getBaseURL();
  const plusButtons = document.querySelectorAll('input[type=button].plus');
  const minusButtons = document.querySelectorAll('input[type=button].minus');
  const couponButton = document.querySelector(
    'div.coupon input[type=submit].button',
  );

  /**
   * @param {Event} event
   */
  async function handleCoupon(event) {
    event.preventDefault();

    const couponCode = document.querySelector('#coupon_code').value;

    if (!couponCode) {
      alert('Você não inseriu o código do cupom.');
      return;
    }

    const couponVerificationURL = `${BASE_URL}/coupons`;
    const response = await fetch(couponVerificationURL, {
      method: 'POST',
      headers: {
        'Content-Type': 'multipart/form-data',
      },
      body: couponCode,
    });
    const data = await response.json();

    if (data.error) {
      alert(data.message);
      return;
    }

    updateProductsInfoInSessionStorage(data.product);

    alert(
      `Cupom de ${data.product.couponValue} reais aplicado ao produto "${data.product.name}"`,
    );
    location.reload();
  }

  /**
   * @param {Event} event
   */
  function incrementProductQuantity(event) {
    const productQuantityCell = event.target.parentElement.parentElement;
    const totalPriceElement = productQuantityCell.nextElementSibling;
    const productPriceElement = productQuantityCell.previousElementSibling;
    const inputTextQuantity = event.target.previousElementSibling;

    const inputNumberValue = parseInt(inputTextQuantity.value, 10);
    const productPrice = getPriceNumbers(productPriceElement.textContent);
    const incrementedValue = inputNumberValue + 1;

    const totalPrice = formatNumberToBRLCurrency(
      productPrice * incrementedValue,
    );
    totalPriceElement.textContent = totalPrice;

    inputTextQuantity.value = incrementedValue;
  }

  /**
   * @param {Event} event
   */
  function decrementProductQuantity(event) {
    const productQuantityCell = event.target.parentElement.parentElement;
    const totalPriceElement = productQuantityCell.nextElementSibling;
    const productPriceElement = productQuantityCell.previousElementSibling;
    const inputTextQuantity = event.target.nextElementSibling;

    const inputNumberValue = parseInt(inputTextQuantity.value, 10);
    const productPrice = getPriceNumbers(productPriceElement.textContent);
    const decrementedValue = inputNumberValue - 1;

    const totalPrice = formatNumberToBRLCurrency(
      productPrice * decrementedValue,
    );

    const minQuantity = 1;
    if (decrementedValue >= minQuantity) {
      inputTextQuantity.value = decrementedValue;
      totalPriceElement.textContent = totalPrice;
    }
  }

  plusButtons.forEach((plusButton) => {
    plusButton.addEventListener('click', incrementProductQuantity);
  });
  minusButtons.forEach((minusButton) => {
    minusButton.addEventListener('click', decrementProductQuantity);
  });

  couponButton.addEventListener('click', handleCoupon);

  window.deleteProduct = deleteProductFromCart;
  window.deleteProductFromCart = deleteProductFromCartElement;
}());

import getBaseURL from './functions/getBaseURL.js';
import addProductToTheCart from './functions/addProductToTheCart.js';
import handleDisabledButtons from './functions/handleDisabledButtons.js';
import getProductsInfoInTheSessionStorage from './functions/getProductsInfoInTheSessionStorage.js';

(function () {
  const cartButton = document.querySelector('.shopping-item a');
  const BASE_URL = getBaseURL();

  function handleCartInformations() {
    const {
      totalPrice,
      productsCount,
    } = getProductsInfoInTheSessionStorage();
    const alreadyHasTheCartValues = totalPrice && productsCount;
    if (alreadyHasTheCartValues) {
      const [totalPriceElement, productsCountElement] = document.querySelectorAll(
        '.shopping-item span',
      );

      totalPriceElement.textContent = totalPrice;
      productsCountElement.textContent = productsCount;
    }
  }

  function removeHighlight(element) {
    element.classList.remove('active');
  }

  function addHighlightAndRemoveFromPreviousElement(element) {
    const classToAddHightlight = '.active';
    const highlightedPreviousElement = document.querySelector(
      classToAddHightlight,
    );
    removeHighlight(highlightedPreviousElement);
    element.classList.add('active');
  }

  function addHighlightToNavBarElements() {
    const navBarElements = document.querySelector('ul.nav.navbar-nav').children;
    const [, productsNavBar, cartNavBar] = navBarElements;

    if (location.href.includes('produtos')) {
      addHighlightAndRemoveFromPreviousElement(productsNavBar);
    } else if (location.href.includes('carrinho')) {
      addHighlightAndRemoveFromPreviousElement(cartNavBar);
    }
  }

  /**
   * @param {Event} event
   */
  async function handleCartButton(event) {
    event.preventDefault();

    const {
      products,
      productsIds,
    } = getProductsInfoInTheSessionStorage();

    if (products.length > 0) {
      const productsURL = `${BASE_URL}/produtos`;
      const cartURL = `${BASE_URL}/carrinho`;
      await fetch(productsURL, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
        },
        body: JSON.stringify(productsIds),
      });

      location.href = cartURL;
    }
  }

  cartButton.addEventListener('click', handleCartButton);
  window.addEventListener('load', handleCartInformations);
  window.addEventListener('load', addHighlightToNavBarElements);
  window.addEventListener('load', handleDisabledButtons);

  window.addProductToTheCart = addProductToTheCart;
}());

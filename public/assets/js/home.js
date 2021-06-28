import removeEventListenerAndPreventElementDefaultAction from './functions/removeEventListenerAndPreventElementDefaultAction.js';
import formatNumberToBRLCurrency from './functions/formatNumberToBRLCurrency.js';
import getPriceNumbers from './functions/getPriceNumbers.js';
import disableButton from './functions/disableButton.js';

(function () {
  let products = JSON.parse(sessionStorage.getItem('products')) || [];
  let productsIds = [];

  const productsIdsInTheSessionStorage = sessionStorage.getItem('productsIds');
  if (productsIdsInTheSessionStorage) {
    productsIds = productsIdsInTheSessionStorage.split(',');
  }

  window.addEventListener('load', handleDisabledButtons);

  function handleDisabledButtons(_event) {
    const productsWithId = document.querySelectorAll('[data-product_id]');
    productsWithId.forEach((product) => {
      const productId = product.getAttribute('data-product_id');
      const isTheProductAlreadyAddedInTheCart = productsIds.includes(productId);
      if (isTheProductAlreadyAddedInTheCart) {
        disableButton(product);
        removeEventListenerAndPreventElementDefaultAction(
          product,
          'click',
          addProductToTheCart
        );
      }
    });
  }

  function addProductToTheCart(id, name, price) {
    const numericPrice = getPriceNumbers(price);

    const product = {
      id,
      name,
      price: numericPrice,
    };

    products.push(product);

    const productNotAdded = !productsIds.includes(product.id);
    if (productNotAdded) {
      productsIds.push(product.id);
      sessionStorage.setItem('productsIds', productsIds);
      sessionStorage.setItem('products', JSON.stringify(products));
    }

    let [totalPriceElement, productsCountElement] = document.querySelectorAll(
      '.shopping-item span'
    );

    const numberPrice = getPriceNumbers(totalPriceElement.textContent);
    let totalPrice = numberPrice + product.price;
    totalPrice = formatNumberToBRLCurrency(totalPrice);

    const productsCount = parseInt(productsCountElement.textContent) + 1;

    sessionStorage.setItem('totalPrice', totalPrice);
    sessionStorage.setItem('productsCount', productsCount);

    totalPriceElement.textContent = totalPrice;
    productsCountElement.textContent = productsCount;

    disableButton(event.target);
    removeEventListenerAndPreventElementDefaultAction(
      event.target,
      'click',
      addProductToTheCart
    );
  }

  window.addProductToTheCart = addProductToTheCart;
})();

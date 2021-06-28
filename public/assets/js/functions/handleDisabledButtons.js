import disableButton from './disableButton.js';
import removeEventListenerAndPreventElementDefaultAction from './removeEventListenerAndPreventElementDefaultAction.js';
import addProductToTheCart from './addProductToTheCart.js';
import getProductsInfoInTheSessionStorage from './getProductsInfoInTheSessionStorage.js';

function handleDisabledButtons() {
  const { productsIds } = getProductsInfoInTheSessionStorage();

  const productsWithId = document.querySelectorAll('[data-product_id]');
  productsWithId.forEach((product) => {
    const productId = product.getAttribute('data-product_id');
    const isTheProductAlreadyAddedInTheCart = productsIds.includes(productId);
    if (isTheProductAlreadyAddedInTheCart) {
      disableButton(product);
      removeEventListenerAndPreventElementDefaultAction(
        product,
        'click',
        addProductToTheCart,
      );
    }
  });
}

export default handleDisabledButtons;

import getPriceNumbers from './getPriceNumbers.js';
import disableButton from './disableButton.js';
import removeEventListenerAndPreventElementDefaultAction from './removeEventListenerAndPreventElementDefaultAction.js';
import getProductsInfoInTheSessionStorage from './getProductsInfoInTheSessionStorage.js';
import incrementProductsCount from './incrementProductsCount.js';
import addProductPriceToTotalPrice from './addProductPriceToTotalPrice.js';

/**
 * @param {{id: number, name: string, price: string}} product
 */
function addProductToTheCart(product) {
  const { products, productsIds } = getProductsInfoInTheSessionStorage();

  const numericPrice = getPriceNumbers(product.price);
  product.price = numericPrice;

  products.push(product);

  const productNotAdded = !productsIds.includes(product.id);
  if (productNotAdded) {
    productsIds.push(product.id);
    sessionStorage.setItem('productsIds', productsIds);
    sessionStorage.setItem('products', JSON.stringify(products));
  }

  console.log(product.price);
  addProductPriceToTotalPrice(product.price);
  incrementProductsCount();

  disableButton(event.target);
  removeEventListenerAndPreventElementDefaultAction(
    event.target,
    'click',
    addProductToTheCart,
  );
}

export default addProductToTheCart;

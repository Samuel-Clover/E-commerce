import formatNumberToBRLCurrency from './formatNumberToBRLCurrency.js';

/**
 * @param {{id, price}} product
 */
function updateProductsInfoInSessionStorage(product) {
  const sessionProducts = JSON.parse(sessionStorage.getItem('products'));

  const foundProduct = sessionProducts.find(
    (sessionProduct) => Number(sessionProduct.id) === Number(product.id),
  );
  foundProduct.price = product.price;

  let updatedTotalPrice = sessionProducts.reduce(
    (total, sessionProduct) => total + sessionProduct.price,
    0,
  );
  updatedTotalPrice = formatNumberToBRLCurrency(updatedTotalPrice);

  sessionStorage.setItem('products', JSON.stringify(sessionProducts));
  sessionStorage.setItem('totalPrice', updatedTotalPrice);
}

export default updateProductsInfoInSessionStorage;

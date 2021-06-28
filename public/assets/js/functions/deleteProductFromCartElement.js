import getPriceNumbers from './getPriceNumbers.js';
import formatNumberToBRLCurrency from './formatNumberToBRLCurrency.js';
import getProductsInfoInTheSessionStorage from './getProductsInfoInTheSessionStorage.js';

function deleteProductFromCartElement(productPrice) {
  const numericProductPrice = getPriceNumbers(productPrice);
  const { productsCount, totalPrice } = getProductsInfoInTheSessionStorage();

  const [
    totalPriceElement,
    productsCountElement,
  ] = document.querySelectorAll('.shopping-item a span');

  const decrementedProductsCount = parseInt(productsCount, 10) - 1;

  const numericTotalPrice = getPriceNumbers(totalPrice);
  const updatedTotalPrice = numericTotalPrice - numericProductPrice;
  const formattedTotalPrice = formatNumberToBRLCurrency(updatedTotalPrice);

  totalPriceElement.textContent = formattedTotalPrice;
  productsCountElement.textContent = decrementedProductsCount;
}

export default deleteProductFromCartElement;

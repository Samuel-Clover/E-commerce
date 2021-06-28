import getPriceNumbers from './getPriceNumbers.js';
import formatNumberToBRLCurrency from './formatNumberToBRLCurrency.js';
import getProductsInfoInTheSessionStorage from './getProductsInfoInTheSessionStorage.js';

/**
 * @param {number} productPrice
 */
function addProductPriceToTotalPrice(productPrice) {
  const { totalPrice } = getProductsInfoInTheSessionStorage();
  console.log(totalPrice);

  const totalPriceElement = document.querySelector('.shopping-item span');

  const numericTotalPrice = getPriceNumbers(totalPrice);
  const updatedTotalPrice = numericTotalPrice + productPrice;
  const formattedTotalPrice = formatNumberToBRLCurrency(updatedTotalPrice);

  sessionStorage.setItem('totalPrice', formattedTotalPrice);
  totalPriceElement.textContent = formattedTotalPrice;
}

export default addProductPriceToTotalPrice;

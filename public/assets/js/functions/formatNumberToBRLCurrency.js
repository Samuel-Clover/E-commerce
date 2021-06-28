/**
 * @param {number|string} price
 */
function formatNumberToBRLCurrency(price) {
  const formattedPrice = Intl.NumberFormat('pt-br', {
    style: 'currency',
    currency: 'BRL',
  }).format(price);

  return formattedPrice;
}

export default formatNumberToBRLCurrency;

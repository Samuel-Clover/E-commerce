/**
 * @param {string} price
 */
function getPriceNumbers(price) {
  const arraySplittedNums = price
    .replace('R$', '')
    .replace(/,/g, '.')
    .trim()
    .split('.');

  const fractionalPart = arraySplittedNums.pop();
  const integerPart = arraySplittedNums.reduce(
    (previous, current) => previous + current,
    '',
  );
  const numberPrice = parseFloat(`${integerPart}.${fractionalPart}`);

  return numberPrice;
}

export default getPriceNumbers;

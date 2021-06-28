import getPriceNumbers from './getPriceNumbers.js';
import formatNumberToBRLCurrency from './formatNumberToBRLCurrency.js';
import getProductsInfoInTheSessionStorage from './getProductsInfoInTheSessionStorage.js';

function deleteProductFromSessionStorage(productId) {
  const {
    products,
    productsCount,
    productsIds,
    totalPrice,
  } = getProductsInfoInTheSessionStorage();

  const updatedProductsCount = productsCount - 1;

  const productIndexInProductsIds = productsIds.indexOf(productId);
  productsIds.splice(productIndexInProductsIds, 1);

  const [foundProduct] = products.filter(
    (product) => Number(product.id) === Number(productId),
  );

  let numericTotalPrice = getPriceNumbers(totalPrice);
  numericTotalPrice -= foundProduct.price;
  const formattedTotalPrice = formatNumberToBRLCurrency(numericTotalPrice);

  let updatedProducts = products.filter(
    (product) => Number(product.id) !== Number(productId),
  );
  updatedProducts = JSON.stringify(updatedProducts);

  sessionStorage.setItem('productsCount', updatedProductsCount);
  sessionStorage.setItem('productsIds', productsIds);
  sessionStorage.setItem('products', updatedProducts);
  sessionStorage.setItem('totalPrice', formattedTotalPrice);
}

export default deleteProductFromSessionStorage;

import getProductsInfoInTheSessionStorage from './getProductsInfoInTheSessionStorage.js';

function incrementProductsCount() {
  const { productsCount } = getProductsInfoInTheSessionStorage();

  const [, productsCountElement] = document.querySelectorAll(
    '.shopping-item span',
  );

  const incrementedProductsCount = parseInt(productsCount, 10) + 1;

  sessionStorage.setItem('productsCount', incrementedProductsCount);
  productsCountElement.textContent = incrementedProductsCount;
}

export default incrementProductsCount;

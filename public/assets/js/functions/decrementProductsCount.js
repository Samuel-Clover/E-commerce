import getProductsInfoInTheSessionStorage from './getProductsInfoInTheSessionStorage.js';

function decrementProductsCount() {
  const { productsCount } = getProductsInfoInTheSessionStorage();

  const [, productsCountElement] = document.querySelectorAll(
    '.shopping-item span',
  );

  const decrementedProductsCount = parseInt(productsCount, 10) - 1;

  sessionStorage.setItem('productsCount', decrementedProductsCount);
  productsCountElement.textContent = decrementedProductsCount;
}

export default decrementProductsCount;

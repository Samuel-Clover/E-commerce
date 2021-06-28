function getProductsInfoInTheSessionStorage() {
  const products = JSON.parse(sessionStorage.getItem('products')) || [];
  const productsCount = sessionStorage.getItem('productsCount') || 0;
  const totalPrice = sessionStorage.getItem('totalPrice') || 'R$ 0,00';
  let productsIds = [];

  const productsIdsInTheSessionStorage = sessionStorage.getItem('productsIds');
  if (productsIdsInTheSessionStorage) {
    productsIds = productsIdsInTheSessionStorage.split(',');
  }

  return {
    products,
    productsCount,
    totalPrice,
    productsIds,
  };
}

export default getProductsInfoInTheSessionStorage;

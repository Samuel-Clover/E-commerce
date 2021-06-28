/**
 * @param {string|number} productId
 */
function deleteProductElement(productId) {
  const productElements = document.querySelectorAll('[data-id]');

  const [productElementThatWillBeRemoved] = Array.prototype.filter.call(
    productElements,
    (productElement) => {
      const productElementId = productElement.getAttribute('data-id');
      return Number(productElementId) === Number(productId);
    },
  );

  productElementThatWillBeRemoved.remove();
}

export default deleteProductElement;

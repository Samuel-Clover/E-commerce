(function () {
  let products = JSON.parse(sessionStorage.getItem('products')) || [];
  let productsIds = [];

  const productsIdsInTheSessionStorage = sessionStorage.getItem(
    'productsIds'
  );
  if (productsIdsInTheSessionStorage) {
    productsIds = productsIdsInTheSessionStorage.split(',');
  }

  window.addEventListener('load', handleDisabledButtons);

  function handleDisabledButtons(_event) {
    const productsWithId = document.querySelectorAll('[data-product_id]');
    productsWithId.forEach((product) => {
      const productId = product.getAttribute('data-product_id');
      const isTheProductAlreadyAddedInTheCart = productsIds.includes(productId);
      if (isTheProductAlreadyAddedInTheCart) {
        disableButton(product);
      }
    });
  }

  function addProductToTheCart(id, name, price) {
    const numericPrice = getPriceNumbers(price)

    const product = {
      id,
      name,
      price: numericPrice,
    };

    products.push(product);

    const productNotAdded = !productsIds.includes(product.id);
    if (productNotAdded) {
      productsIds.push(product.id);
      sessionStorage.setItem('productsIds', productsIds);
      sessionStorage.setItem('products', JSON.stringify(products));
    }

    let [totalPriceElement, productsCountElement] = document.querySelectorAll(
      '.shopping-item span'
    );

    const numberPrice = getPriceNumbers(
      totalPriceElement.textContent
    );
    let totalPrice = numberPrice + product.price;
    totalPrice = formatNumberToBRLCurrency(totalPrice);

    const productsCount = parseInt(productsCountElement.textContent) + 1;

    sessionStorage.setItem('totalPrice', totalPrice);
    sessionStorage.setItem('productsCount', productsCount);

    totalPriceElement.textContent = totalPrice;
    productsCountElement.textContent = productsCount;

    disableButton(event.target);
  }

  /**
   * @param {Element} element
   */
  function disableButton(element) {
    element.className = 'disabled-button';
    element.textContent = 'Adicionado';
    element.removeEventListener('click', addProductToTheCart);
    element.addEventListener('click', (event) => event.preventDefault());
  }

  /**
   * @param {string} stringPrice
   */
  function getPriceNumbers(stringPrice) {
    const arraySplittedNums = stringPrice
      .replace('R$', '')
      .replace(/,/g, '.')
      .trim()
      .split('.');

    const fractionalPart = arraySplittedNums.pop();
    const integerPart = arraySplittedNums.reduce(
      (previous, current) => previous + current,
      ''
    );
    const numberPrice = parseFloat(`${integerPart}.${fractionalPart}`);
    return numberPrice;
  }

  function formatNumberToBRLCurrency(price) {
    return Intl.NumberFormat('pt-br', {
      style: 'currency',
      currency: 'BRL',
    }).format(price);
  }

  window.addProductToTheCart = addProductToTheCart;
})();

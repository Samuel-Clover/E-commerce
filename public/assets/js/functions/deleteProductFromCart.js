import deleteProductElement from './deleteProductElement.js';
import deleteProductFromSessionStorage from './deleteProductFromSessionStorage.js';
import getBaseURL from './getBaseURL.js';

async function deleteProductFromCart(productId) {
  try {
    const BASE_URL = getBaseURL();
    const cartURL = `${BASE_URL}/carrinho`;
    await fetch(cartURL, {
      method: 'POST',
      body: productId,
    });

    deleteProductElement(productId);
    deleteProductFromSessionStorage(productId);
  } catch (err) {
    alert(
      `Não foi possível excluir este produto do carrinho.\n
      Tente recarregar a página ou reabrir seu navegador.`,
    );
  }
}

export default deleteProductFromCart;

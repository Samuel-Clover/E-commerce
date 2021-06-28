/**
 * @param {Element} button
 */
export default function disableButton(button) {
  button.className = 'disabled-button';
  button.textContent = 'Adicionado';
}

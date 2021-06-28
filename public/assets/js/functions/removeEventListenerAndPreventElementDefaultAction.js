/**
 * @param {Element} element
 * @param {string} eventName
 * @param {function} eventFunction
 */
export default function removeEventListenerAndPreventElementDefaultAction(
  element,
  eventName,
  eventFunction,
) {
  const preventDefaultAction = (event) => event.preventDefault;

  element.removeEventListener(eventName, eventFunction);
  element.addEventListener(eventName, preventDefaultAction);
}

const msg = document.querySelector("[data-removable]");

if (msg) {
  setTimeout((_) => {
    msg.remove();
  }, parseInt(msg.dataset.removeAfter) * 1000);
}

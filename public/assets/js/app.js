const logo = document.querySelector(".logo");

logo.addEventListener("mouseenter", () => {
  if (!logo.classList.contains("is-animating")) {
    logo.classList.add("is-animating");
  }
});

logo.addEventListener("animationend", () => {
  logo.classList.remove("is-animating");
});
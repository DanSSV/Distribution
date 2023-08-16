const buttons = document.querySelectorAll(".custom-btn");

buttons.forEach((button) => {
  button.addEventListener("mouseover", () => {
    const icon = button.querySelector("i");
    if (icon) {
      icon.style.color = "white";
    }
  });

  button.addEventListener("mouseout", () => {
    const icon = button.querySelector("i");
    if (icon) {
      icon.style.color = "#000000"; 
    }
  });
});

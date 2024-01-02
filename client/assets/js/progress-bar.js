window.onload = function () {
  let myVar = setInterval(move, 20);

  function move() {
    let elem = document.getElementById("myBar");
    let width = 0.1;
    let id = setInterval(frame, 10);

    function frame() {
      if (width >= 100)
      {
        clearInterval(id);
        clearInterval(myVar);
      } else
      {
        width++;
        elem.style.width = width + "%";
      }
    }
  }
};

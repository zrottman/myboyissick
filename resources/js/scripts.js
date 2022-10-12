  function toggle (buttonID, boxClass) {
      const button = document.querySelector(buttonID);
      const boxes = document.querySelectorAll(boxClass);

      button.style.opacity = button.style.opacity ==  .5 ? 1 : .5;

      boxes.forEach(box => {
        box.style.display = box.style.display == 'none' ? 'block' : 'none';
      });
  }

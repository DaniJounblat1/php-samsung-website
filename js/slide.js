let slideIndex = 0;
let slides = document.getElementsByClassName("mySlides");
let slideshowInterval;

function showSlides() {
  for (let i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }

  slideIndex++;
  if (slideIndex > slides.length) {
    slideIndex = 1;
  }

  slides[slideIndex - 1].style.display = "block";
}

function plusSlides(n) {
  slideIndex += n;
  if (slideIndex > slides.length) {
    slideIndex = 1;
  } else if (slideIndex < 1) {
    slideIndex = slides.length;
  }
  showSlides();
  restartSlideshow();
}

function restartSlideshow() {
  clearInterval(slideshowInterval);
  slideshowInterval = setInterval(function() {
    plusSlides(1);
  }, 5000);
}

showSlides(); // Show the initial slide
slideshowInterval = setInterval(function() {
  plusSlides(1);
}, 5000); // Automatically switch slides every 5 seconds

document.querySelector(".prev").addEventListener("click", function () {
  plusSlides(-1);
  restartSlideshow();
});

document.querySelector(".next").addEventListener("click", function () {
  plusSlides(1);
  restartSlideshow();
});

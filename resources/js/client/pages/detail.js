import Splide from "@splidejs/splide";
import Viewer from "viewerjs";

const bigImage = document.getElementById("big-image");

new Viewer(bigImage, {
  inline: false,
  navbar: false,
  toolbar: {
      zoomIn: true,
      zoomOut: true,
      play: {
          show: true,
      },
      rotateLeft: true,
      rotateRight: true,
      flipHorizontal: true,
      flipVertical: true,
  },
});

const splide = new Splide("#images-carousel", {
  arrows: false,
  pagination: false,
  gap: "24px",
  autoWidth: true,
}).mount();

splide.on("click", (image) => {
  let imageUrl,
      isMain = false;
  document.querySelectorAll("li.image").forEach((image) => {
      image.classList.remove("active");
  });
  image.slide.classList.add("active");
  if (image.index != 0) {
      imageUrl = image.slide
          .querySelector("div")
          .style.backgroundImage.replace(/^url\(["']?/, "")
          .replace(/["']?\)$/, "");
  } else {
      imageUrl = image.slide.querySelector("div img").src;
      isMain = true;
  }
  showImage(imageUrl, isMain);
});

new Splide("#popular", {
  arrows: false,
  pagination: false,
  gap: "32px",
  autoWidth: true,
}).mount();

const showImage = (imageUrl, isMain) => {
    const image = bigImage.querySelector("img");
    image.src = imageUrl;

    if (isMain) {
        image.style.width = "80%";
        image.style.height = "auto";
        image.style.borderRadius = "0";
    } else {
        image.style.width = "100%";
        image.style.height = "100%";
        image.style.objectFit = "cover";
        image.style.objectPosition = "center";
        image.style.borderRadius = "10px";
    }
};

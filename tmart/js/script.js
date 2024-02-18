document
  .getElementById("section-change")
  .addEventListener("mouseover", mouseOver);
document
  .getElementById("section-change")
  .addEventListener("mouseout", mouseOut);
function mouseOver() {
  document.getElementById("section-change-main").style.border =
    "5px solid #fff";
}
function mouseOut() {
  document.getElementById("section-change-main").style.border = "0px";
}
$(".next-sub a").on("click", function(event) {
  const hash = this.hash;
  if (this.hash !== "") {
    event.preventDefault();

    $("html, body").animate(
      {
        scrollTop: $(hash).offset().top - 100
      },
      1000
    );
  }
});
function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
// window.addEventListener('scroll', function() {
//   if (window.scrollY > 50) {
//     document.querySelector('.navbar').style.cssText += 'border-bottom: 2px solid #333;';
//   } else {
//     document.querySelector('.navbar').style.cssText += 'border-bottom: 0px';
//   }
// });
$(document).scroll(function() {
  var y = $(document).scrollTop(), //get page y value
    header = $("#myarea"); // your div id
  if (y >= 900) {
    header.css({ position: "fixed", top: "99px", left: "0", display: "flex" });
  } else {
    header.css({ position: "static", display: "none" });
  }
});

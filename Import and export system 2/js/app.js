const navToggle = document.querySelector('.toggle-menu');
const links = document.querySelector('.links');

navToggle.addEventListener('click',function(){
     if(links.classList.contains('show-links')){
        links.classList.remove('show-links')
    }
    else{
         links.classList.add('show-links')

     }
});
// change nav link color 
  const navlinks = document.querySelectorAll('.links li a');

  navlinks.forEach(link => {
    link.addEventListener('click', function () {
        navlinks.forEach(link => link.classList.remove('active'));

      
      this.classList.add('active');
    });
  });

  
// features section 
const about = document.querySelector(".features-content");
const btns = document.querySelectorAll(".btn");
const articles = document.querySelectorAll(".content");
about.addEventListener("click", function (e) {
  const id = e.target.dataset.id;
  if (id) {
    // remove selected from other buttons
    btns.forEach(function (btn) {
      btn.classList.remove("active");
    });
    e.target.classList.add("active");
    // hide other articles
    articles.forEach(function (article) {
      article.classList.remove("active");
    });
    const element = document.getElementById(id);
    element.classList.add("active");
  }
});
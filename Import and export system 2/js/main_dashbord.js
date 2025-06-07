const toggleBtn =document.querySelector('.sideBar-toggle');
const closeBtn =document.querySelector('.colse-btn');
const sidebar =document.querySelector('.sidebar');


toggleBtn.addEventListener('click',function(){

     sidebar.classList.toggle('show-sidebar');   //another shorter way than if/else
});
closeBtn.addEventListener('click',function(){
        sidebar.classList.remove('show-sidebar');
     
});
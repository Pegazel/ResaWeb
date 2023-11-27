// style sur la barre de navigation pour qu'elle disparaisse quand on scroll vers le bas et qu'elle réapparaisse quand on scroll vers le haut

var navbar = document.querySelector(".nav");
var prevScrollpos = window.pageYOffset;

window.addEventListener("scroll", function() {
  var currentScrollPos = window.pageYOffset;

  if (prevScrollpos > currentScrollPos) {
    navbar.style.top = "0";
  } else {
    navbar.style.top = "-100px";
  }

  prevScrollpos = currentScrollPos;
});

document.addEventListener("keydown", function(event) {
  if (event.key === "Tab") {
    navbar.style.top = "0";
  }
});

document.addEventListener("keyup", function(event) {
  if (event.key === "Tab") {
    var currentScrollPos = window.pageYOffset;

    if (currentScrollPos > 0) {
      navbar.style.top = "-100px";
    } else {
      navbar.style.top = "0";
    }
  }
});

document.addEventListener("click", function(event) {
  var currentScrollPos = window.pageYOffset;

  if (currentScrollPos > 0) {
    navbar.style.top = "-100px";
  } else {
    navbar.style.top = "0";
  }
});





// slider


document.addEventListener("DOMContentLoaded", function() {
  var photosWrapper = document.querySelector('.js-photos');

  var sliderGlobalContainer =  document.querySelector('.js-slider');
  var photoWidth = sliderGlobalContainer.offsetWidth;

  var allReelPhotosArray = document.querySelectorAll('.js-photo.reel-slide'); 

  var mouvement = 1; 
  var minMouvement = 0;
  var maxMouvement = allReelPhotosArray.length + 1; 
  
  function decaleGauche () {
    mouvement = mouvement + 1;

  
    if (mouvement == maxMouvement) {
      retourDebut();
    } else { 
      photosWrapper.style.left = mouvement * -photoWidth  + "px";
    }
  }
  

  function retourDebut () {
    
    
    mouvement = minMouvement; 
    photosWrapper.style.transition = '0s'; 
    photosWrapper.style.left = "0px"; 
    

    setTimeout( function () {
      mouvement = minMouvement + 1; 
      photosWrapper.style.transition = 'left 0.6s ease-out'; 
      photosWrapper.style.left = mouvement * -photoWidth  + "px";  
    }, 20)

  }


  function decaleDroite () {
    mouvement = mouvement - 1;

    if (mouvement == minMouvement) { 
      retourFin();
    } else { 
      photosWrapper.style.left = mouvement * -photoWidth  + "px";
    }
  }
  
  function retourFin () {
    mouvement = maxMouvement;
    photosWrapper.style.transition = '0s';
    photosWrapper.style.left = mouvement * -photoWidth  + "px";

    setTimeout( function () {
      mouvement = maxMouvement - 1;
      photosWrapper.style.transition = 'left 0.6s ease-out';
      photosWrapper.style.left = mouvement * -photoWidth  + "px";
    }, 20)
  }



  var btnDecaleGauche = document.querySelector('.js-btn-decale-gauche');
  var btnDecaleDroite = document.querySelector('.js-btn-decale-droite');

  btnDecaleGauche.addEventListener('click', function() {
    decaleGauche();
  });

  btnDecaleDroite.addEventListener('click', function() {
    decaleDroite();
  });
})





// pour charger les autres avis si il y en a plus de 4

function chargerAvis() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
          document.getElementById("avisComplet").innerHTML = xhr.responseText;
          document.getElementById("avisComplet").style.display = "block";
          document.getElementById("afficherAvis").style.display = "none";
      }
  };
  xhr.open("GET", "charger_avis.php", true);
  xhr.send();
}


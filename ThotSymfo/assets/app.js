import './bootstrap.js';

import './styles/app.css';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

// assets/app.js

// import tinymce from 'tinymce/tinymce';
// import 'tinymce/themes/silver/theme';   // Ajoute le thème par défaut
// import 'tinymce/icons/default';         // Ajoute les icônes par défaut

// Initialisation de TinyMCE
import "tinymce/plugins/print";



// document.addEventListener('turbo:render',function(){
//   tinymce.init({
//     selector: "textarea",
//     plugins: "print",
//     // plugins: "advlist autolink lists link charmap print preview anchor",
//     toolbar:
//       "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
//     menubar: false,
//     branding: false,
//   });
// });


document.addEventListener("turbo:load",()=>{
  attachEventListeneurs();
}
)

// function rechercheTitre() {
//   let inputTitre = document.getElementById("inputTitre").value;
  
//   console.log(inputTitre);

// }


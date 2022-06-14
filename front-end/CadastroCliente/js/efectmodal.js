'use strict'


const abrirmodal = () =>{

   document.getElementById('containerModel_entrada').classList.add('active');
     
}


const fecharmodal = () =>{

    document.getElementById('containerModel_entrada').classList.remove('active');
 
 
 }

 fecharmodal(); 
 

export{
   abrirmodal
};

document.getElementById('imgmodel').addEventListener('click', fecharmodal);
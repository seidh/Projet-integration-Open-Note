/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/////////////////////////////////////
//Profil page
//author: nicolas
/////////////////////////////////////


edit = function() 
{
    $('#change, #save').click(function() {
        $('#save').toggle("slow");
        $('#change').toggle("slow");
            
        $('#name').toggle("slow");
        $('#saveName').toggle("slow");
            
        $('#firstname').toggle("slow");
        $('#saveFirstname').toggle("slow");
            
        $('#email').toggle("slow");
        $('#saveEmail').toggle("slow");
            
        $('#avatar').toggle("slow");
    });
}
/////////////////////////////////////
//End of profil page
/////////////////////////////////////
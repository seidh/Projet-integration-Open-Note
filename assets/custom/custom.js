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
    $('#change').click(function() {
        $('#save').toggle("slow");
        $('#change').toggle("slow");
            
        $('#name').toggle("slow");
        $('#saveName').toggle("slow");
            
        $('#firstname').toggle("slow");
        $('#saveFirstname').toggle("slow");
        
        $('#oldpwd').toggle("slow");
        $('#newpwd1').toggle("slow");
        $('#newpwd2').toggle("slow");
        
            
    });
};

avatar = function()
{
    $('#submitAvatar, #choiceAvatar').click(function(){
        $('#avatar').toggle("slow");
        $('#submitAvatar').toggle("slow");
        $('#choiceAvatar').toggle("slow");
    });
};
/////////////////////////////////////
//End of profil page
/////////////////////////////////////
/////////////////////////////////////
//Note page
//author: nicolas
/////////////////////////////////////

comment = function ()
{
        $("#comment_list button").click(function(){
           var idComment = this.id;      
           $("#textComment"+idComment).toggle("slow");
        });
        
        

        
};
commentParent = function()
{
    $("#commentMother").click(function(){      
           $("#textCommentMother").toggle("slow");
        });
};

modification_note = function()
{
    $("#modification, #cancel_modification").click(function(){      
           $("#see_note").toggle("slow");
           $("#modif_note").toggle("slow");
           $("#modification").toggle("slow");
           $("#cancel_modification").toggle("slow");
           
        });
};

/////////////////////////////////////
//End of Note page
/////////////////////////////////////
/////////////////////////////////////
// SideBar Navigation
/////////////////////////////////////
activeNavbar = function()
{
        $(document).ready(function () {
            $('ul.nav a').removeClass("active");
            var url = window.location;
            $('ul.nav a[href="'+ url +'"]').addClass('active');
            $('ul.nav a').filter(function() {
                 return this.href == url;
            }).addClass('active');
        });
};

collapseMenu = function()
{
        $(document).ready(function (){
            var url = window.location;
            $('ul.nav a[href="'+url+'"').parent().parent().addClass('in');
        });
};

editUserTable = function ()
{
        $("#users_table tr").click(function(){
           var idUser = this.id;
           $("span[id^='disp']").css("display","inline");
           $("[id^='edit']").css("display","none");
           $("[id^='saveModif']").css("display","none");
         
           
           $("#dispname"+idUser).css("display","none");
           $("#editName"+idUser).css("display","inline");
           $("#dispfirstname"+idUser).css("display","none");
           $("#editFirstname"+idUser).css("display","inline");
           $("#disppseudo"+idUser).css("display","none");
           $("#editPseudo"+idUser).css("display","inline");
           $("#dispgroup"+idUser).css("display","none");
           $("#editGroup"+idUser).css("display","inline");
           $("#dispemail"+idUser).css("display","none");
           $("#editEmail"+idUser).css("display","inline");        
           $("#saveModif"+idUser).css("display","inline");
        });

        

        
};

addUserForm = function(){            
    
        $("#addUserBtn").click(function(){
            $("#trAddUser").css("display","table-row");
            $("#newName").css("display","table-cell");
            $("#newFirstname").css("display","table-cell");
            $("#newPseudo").css("display","table-cell");
            $("#newGroup").css("display","table-cell");
            $("#newEmail").css("display","table-cell");
            $("#saveNew").css("display","table-cell");
        });
        
        $("body").mouseup(function (e){                    
            var container = $("#trAddUser");

            if (!container.is(e.target) // if the target of the click isn't the container...
                && container.has(e.target).length === 0) // ... nor a descendant of the container
            {
                container.css("display","none");
            }
        });
        
};

        

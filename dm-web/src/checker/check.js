/* PARTIE JQUERY DE L'AJAX  APPELLANT LE FICHIER CHECKER QUI RENVOIE SUCCESS OU ERROR PUIS AFFICHE L'ERREUR */
$(document).ready(function(){
    $("#submit").click(function(e){
        e.preventDefault();
        $.ajax({
            type:"POST",
            url:"src/checker/Checker.php",
            dataType: "json",
            data: $("#form").serialize(),
            success: function(response){
                window.location.href = "/langages.php?action=sauverNouveau"
            },
            error: function(response){
                $('#error').html(response.responseText);
                // console.log("erreur de : ", response.responseText);
            }
        })
    });
});
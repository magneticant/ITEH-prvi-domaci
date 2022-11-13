$('#dodajForm').submit(function(){
    event.preventDefault();
    console.log("Radi dodaj.");

    const $form = $(this);
    const $inputs = $form.find('input, select, button, textarea');
    const serijalizacija = $form.serialize();
    console.log('\n Ovo su podaci za prijavu:\n')
    console.log(serijalizacija);

    request = $.ajax({
        url: 'handler/insert.php',
        type: 'post',
        data:serijalizacija
    });

    request.done(function(response, textStatus, jqXHR){
        if(response==="Success"){
            window.alert("Prijava je zabelezena.");
            location.reload(true);
        }else{
            console.log("Prijava nije zabelezena."+response);
            console.log(response);
            
        }
    });

    request.fail(function(jqXHR, textStatus, errorThrown){
        console.error("Desila se greska" + textStatus,errorThrown);
    });


});
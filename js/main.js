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
        // if(response=="Success"){
        //     window.alert("Prijava je zabelezena.");
        //     location.reload(true);
        // }else{
        //     console.log("Prijava nije zabelezena."+response);
        //     console.log(response);
            window.alert("Prijava je zabelezena.");
            location.reload(true);
            
        //}
    });

    request.fail(function(jqXHR, textStatus, errorThrown){
        console.error("Desila se greska" + textStatus,errorThrown);
    });


});

$('#dugmeObrisi').click(function(){
    console.log("Brisanje");

    const checked = $('input[name=checked-donut]:checked');

    req = $.ajax({
        url: 'handler/deleteSpecific.php',
        type:'post',
        data: {'id':checked.val()}
    });

    req.done(function(res, textStatus, jqXHR){
        if(res=="Success"){
           checked.closest('tr').remove();
           alert('Obrisana prijava');
           console.log('Obrisan');
        }else {
        console.log("Prijava nije obrisana "+res);
        alert("Prijava nije obrisana ");

        }
        console.log(res);
    });

});

 $('#deleteAllCheck').change(function(){
     request = $.ajax({
         url: 'handler/deleteAll.php',
         type: 'post',
         data: ''
    });
    if(response=="Success"){
            window.alert("Sve je obrisano.");
            location.reload(true);
        }else{
            console.log("Nista nije obrisano."+response);
            console.log(response);
        }
 });
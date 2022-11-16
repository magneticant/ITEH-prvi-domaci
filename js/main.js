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
            // window.alert("Prijava je zabelezena.");
            // location.reload(true);
            
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

 $('#brisanje_dugme').click(function(){

    // const $form = $(this);
    // const $inputs = $form.find();
    // const serijalizacija = $form.serialize();
    
    const checked = $('input[name=checked-donut]:checked');
    const unchecked = $('input[name=checked-donut]:not(:checked)');

    console.log("Brisanje svega.");
     request = $.ajax({
         url: 'handler/deleteAll.php',
         type:'post',
         data: {'id':checked.val(), 'id':unchecked.val()}
     });    
   
     request.done(function(res, textStatus, jqXHR) {
        
        if(res=="Success"){
           checked.closest('tr').remove();
           unchecked.closest('tr').remove();
           alert('Obrisane prijave');
           console.log('Obrisane');
        }else {
        console.log("Prijave nisu obrisane "+res);
        alert("Prijave nisu obrisane ");

        }
        console.log(res);
    });

 });
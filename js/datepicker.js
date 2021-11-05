// JQUERY plugin za biranje datuma, setovan je format koji je kod nas najcesci, moze direktno da se bira mesec i godina

$(function(){
    $('#datepicker').datepicker({
        dateFormat: "dd.mm.yy",
        changeMonth: true,
        changeYear: true
})
  });
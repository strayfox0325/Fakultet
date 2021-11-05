//JQUERY validacija formi 

$(function() {
    $("form[name='student-form']").validate({
      rules: {
        ime: "required",
        prezime: "required",
        jmbg:{
            required:true,
            minlength:13,
            maxlength:13
        },
        email: {
          required: true,
          email: true
        },
      },
      messages: {
        ime: "Unesite ime",
        prezime: "Unesite prezime",
        jmbg:"JMBG mora imati 13 cifara",
        email: "Unesite validnu email adresu"
      },
     submitHandler: function(form) {
        form.submit();
      }
    });
  });

  $(function() {
    $("form[name='ispiti-form']").validate({
      rules: {
        naziv: "required"
      },
      messages: {
        naziv: "Naziv ne sme biti prazan"
      },
      submitHandler: function(form) {
        form.submit();
      }
    });
  });

  $(function() {
    $("form[name='polozeni-form']").validate({
      rules: {
        stud_id: "required",
        prof_id: "required",
        ispit_id: "required",
        datum:"required",
        ocena:{ 
          required: true,
          min: 6,
          max: 10
        },
      },
      messages: {
        stud_id: "Unesite studenta",
        prof_id: "Unesite profesora",
        ispit_id:"Unesite ispit",
        datum: "Unesite datum",
        ocena:"Unesite ocenu 6-10"
      },
      submitHandler: function(form) {
        form.submit();
      }
    });
  });

  $(function() {
    $("form[name='smer-form']").validate({
      rules: {
        naziv: "required",
      },
      messages: {
        naziv: "Unesite naziv"
      },
      submitHandler: function(form) {
        form.submit();
      }
    });
  });

  $(function() {
    $("form[name='prof-form']").validate({
      rules: {
        ime: "required",
        prezime: "required"
      },
      messages: {
        ime: "Unesite ime",
        prezime:"Unesite prezime"
      },
      submitHandler: function(form) {
        form.submit();
      }
    });
  });
(function($) {
    "use strict";

    /*-------------------------------------
	Background image
	-------------------------------------*/
    $("[data-bg-image]").each(function() {
        var img = $(this).data("bg-image");
        $(this).css({
            backgroundImage: "url(" + img + ")"
        });
    });

    /*-------------------------------------
    After Load All Content Add a Class
    -------------------------------------*/
    window.onload = addNewClass();

    function addNewClass() {
        $('.fxt-template-animation').imagesLoaded().done(function(instance) {
            $('.fxt-template-animation').addClass('loaded');
        });
    }
    

// Document is ready
$(document).ready(function () {
    
    //====================================================================================User Registration================================================================================//
    // Validate fname
    $('.notfname').hide();   
    let fnameError = true;
    $('#fname').keyup(function () {
        validatefname();
    });
     
    function validatefname() {
      let fnameValue = $('#fname').val();
      if (fnameValue.length == '') {
      $('.notfname').show();
          fnameError = false;
          return false;
      }
      else if(fnameValue.length < 3) {
          $('.notfname').show();
          $('.notfname').html("length of First name should be atleast 3 characters");
          fnameError = false;
          return false;
      }
      else {
          $('.notfname').hide();
      }
    }

    // Validate lname
    $('.notlname').hide();   
    let lnameError = true;
    $('#lname').keyup(function () {
        validatelname();
    });
     
    function validatelname() {
      let lnameValue = $('#lname').val();
      if (lnameValue.length == '') {
      $('.notlname').show();
          lnameError = false;
          return false;
      }
      else if(lnameValue.length < 3) {
          $('.notlname').show();
          $('.notlname').html("length of Last name should be atleast 3 characters");
          lnameError = false;
          return false;
      }
      else {
          $('.notlname').hide();
      }
    }


// Validate Username
    $('.notuname').hide();   
    let usernameError = true;
    $('#username').keyup(function () {
        validateUsername();
    });
     
    function validateUsername() {
      let usernameValue = $('#username').val();
      if (usernameValue.length == '') {
      $('.notuname').show();
          usernameError = false;
          return false;
      }
      else if((usernameValue.length < 3)||
              (usernameValue.length > 10)) {
          $('.notuname').show();
          $('.notuname').html("**length of username must be between 5 and 8");
          usernameError = false;
          return false;
      }
      else {
          $('.notuname').hide();
      }
    }

    // Validate phone
    $("#phone").on("keyup", function(){
        $('.notphone').hide();   
        var mobNum = $('#phone').val();
        var filter = /^\d*(?:\.\d{1,2})?$/;

          if (filter.test(mobNum)) {
            if(mobNum.length==10){
              $('.notphone').hide();
              $("#phone").removeClass("hidden");
              $("#phone").addClass("hidden");
             } else {
              $('.notphone').show();
               $('.notphone').text('Please put 10  digit mobile number');
               $("#phone").removeClass("hidden");
               $("#phone").addClass("hidden");
              }
            }
            else {
              $('.notphone').show();
              $('.notphone').text('Not a valid number');
              $("#phone").removeClass("hidden");
              $("#phone").addClass("hidden");
           }
    
  });

    
 
   // Validate Email
   $('.notemail').hide();  
   let emailError = true; 
    const email =document.getElementById('email');
    email.addEventListener('keyup', ()=>{
       let regex =
/^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
       let s = email.value;
       if(regex.test(s)){
          email.classList.remove(
                'is-invalid');
          emailError = true;
          $('.notemail').hide();
        }
        else{
            email.classList.add(
                  'is-invalid');
            emailError = false;
            $('.notemail').show();  
            $('.notemail').text("Email Should be like example@xx.xx");    
        }
    })
     
   // Validate Password
    $('.notpassword').hide();
    let passwordError = true;
    $('#password').keyup(function () {
        validatePassword();
    });
    function validatePassword() {
        let passwrdValue = $('#password').val();
        if (passwrdValue.length == '') {
            $('.notpassword').show();
            passwordError = false;
            return false;
        }
        if ((passwrdValue.length < 5)||
            (passwrdValue.length > 10)) {
            $('.notpassword').show();
            $('.notpassword').html("length of your password must be between 5 and 10");
            passwordError = false;
            return false;
        } else {
            $('.notpassword').hide();
        }
    }
});
$(document).ready(function () {

    //====================================================================================Stylist Registration================================================================================//
    // Validate firstname
    $('.notfirstname').hide();   
    let firstnameError = true;
    $('#firstname').keyup(function () {
        validatefirstname();
    });
     
    function validatefirstname() {
      let firstnameValue = $('#firstname').val();
      if (firstnameValue.length == '') {
      $('.notfirstname').show();
          firstnameError = false;
          return false;
      }
      else if(firstnameValue.length < 3) {
          $('.notfirstname').show();
          $('.notfirstname').html("length of First name should be atleast 3 characters");
          firstnameError = false;
          return false;
      }
      else {
          $('.notfirstname').hide();
      }
    }

    // Validate lastname
    $('.notlastname').hide();   
    let lastnameError = true;
    $('#lastname').keyup(function () {
        validatelastname();
    });
     
    function validatelastname() {
      let lastnameValue = $('#lastname').val();
      if (lastnameValue.length == '') {
      $('.notlastname').show();
          lastnameError = false;
          return false;
      }
      else if(lastnameValue.length < 3) {
          $('.notlastname').show();
          $('.notlastname').html("length of Last name should be atleast 3 characters");
          lastnameError = false;
          return false;
      }
      else {
          $('.notlastname').hide();
      }
    }


// Validate Username
    $('.notusername').hide();   
    let styusernameError = true;
    $('#username').keyup(function () {
        validatestyUsername();
    });
     
    function validatestyUsername() {
      let styusernameValue = $('#username').val();
      if (styusernameValue.length == '') {
      $('.notusername').show();
          styusernameError = false;
          return false;
      }
      else if((styusernameValue.length < 3)||
              (styusernameValue.length > 10)) {
          $('.notusername').show();
          $('.notusername').html("**length of username must be between 5 and 8");
          styusernameError = false;
          return false;
      }
      else {
          $('.notusername').hide();
      }
    }

    // Validate phone
    $("#phoneno").on("keyup", function(){
        $('.notphoneno').hide();   
        var mob = $('#phoneno').val();
        var filtermob = /^\d*(?:\.\d{1,2})?$/;

          if (filtermob.test(mob)) {
            if(mob.length==10){
              $('.notphoneno').hide();
              $("#phoneno").removeClass("hidden");
              $("#phoneno").addClass("hidden");
             } else {
              $('.notphoneno').show();
               $('.notphoneno').text('Please put 10  digit mobile number');
               $("#phoneno").removeClass("hidden");
               $("#phoneno").addClass("hidden");
              }
            }
            else {
              $('.notphoneno').show();
              $('.notphoneno').text('Not a valid number');
              $("#phoneno").removeClass("hidden");
              $("#phoneno").addClass("hidden");
           }
    
  });

    
 
   // Validate Email
   $('.notemailID').hide();  
   let emailIDError = true; 
    const emailID =document.getElementById('emailID');
    emailID.addEventListener('keyup', ()=>{
       let regex =
/^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
       let s = emailID.value;
       if(regex.test(s)){
          emailID.classList.remove(
                'is-invalid');
          emailIDError = true;
          $('.notemailID').hide();
        }
        else{
            emailID.classList.add(
                  'is-invalid');
            emailIDError = false;
            $('.notemailID').show();  
            $('.notemailID').text("Email Should be like example@xx.xx");    
        }
    })
     
   // Validate Password
    $('.notstypassword').hide();
    let stypasswordError = true;
    $('#stypassword').keyup(function () {
        validatestyPassword();
    });
    function validatestyPassword() {
        let stypasswrdValue = $('#stypassword').val();
        if (stypasswrdValue.length == '') {
            $('.notstypassword').show();
            stypasswordError = false;
            return false;
        }
        if ((stypasswrdValue.length < 5)||
            (stypasswrdValue.length > 10)) {
            $('.notstypassword').show();
            $('.notstypassword').html("length of your password must be between 5 and 10");
            stypasswordError = false;
            return false;
        } else {
            $('.notstypassword').hide();
        }
    }
         

  
});
    /*-------------------------------------
    Toggle Class
    -------------------------------------*/
    $(".toggle-password").on('click', function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

    /*-------------------------------------
    Youtube Video
    -------------------------------------*/
    if ($.fn.YTPlayer !== undefined && $("#fxtVideo").length) {
        $("#fxtVideo").YTPlayer({ useOnMobile: true });
    }

    /*-------------------------------------
    Vegas Slider
    -------------------------------------*/
    if ($.fn.vegas !== undefined && $("#vegas-slide").length) {
        var target_slider = $("#vegas-slide"),
            vegas_options = target_slider.data('vegas-options');
        if (typeof vegas_options === "object") {
            target_slider.vegas(vegas_options);
        }
    }

    /*-------------------------------------
    OTP Form (Focusing on next input)
    -------------------------------------*/
    $("#otp-form .otp-input").keyup(function() {
        if (this.value.length == this.maxLength) {
            $(this).next('.otp-input').focus();
        }
    });

    /*-------------------------------------
	Social Animation
	-------------------------------------*/
    $('#fxt-login-option >ul >li').hover(function() {
        $('#fxt-login-option >ul >li').removeClass('active');
        $(this).addClass('active');
    });

    /*-------------------------------------
    Preloader
    -------------------------------------*/
    $('#preloader').fadeOut('slow', function() {
        $(this).remove();
    });

    /*-----------------------------------------step register form js--------------------------------------*/
//DOM elements
const DOMstrings = {
  stepsBtnClass: 'multisteps-form__progress-btn',
  stepsBtns: document.querySelectorAll(`.multisteps-form__progress-btn`),
  stepsBar: document.querySelector('.multisteps-form__progress'),
  stepsForm: document.querySelector('.multisteps-form__form'),
  stepsFormTextareas: document.querySelectorAll('.multisteps-form__textarea'),
  stepFormPanelClass: 'multisteps-form__panel',
  stepFormPanels: document.querySelectorAll('.multisteps-form__panel'),
  stepPrevBtnClass: 'js-btn-prev',
  stepNextBtnClass: 'js-btn-next' };


//remove class from a set of items
const removeClasses = (elemSet, className) => {

  elemSet.forEach(elem => {

    elem.classList.remove(className);

  });

};

//return exect parent node of the element
const findParent = (elem, parentClass) => {

  let currentNode = elem;

  while (!currentNode.classList.contains(parentClass)) {
    currentNode = currentNode.parentNode;
  }

  return currentNode;

};

//get active button step number
const getActiveStep = elem => {
  return Array.from(DOMstrings.stepsBtns).indexOf(elem);
};

//set all steps before clicked (and clicked too) to active
const setActiveStep = activeStepNum => {

  //remove active state from all the state
  removeClasses(DOMstrings.stepsBtns, 'js-active');

  //set picked items to active
  DOMstrings.stepsBtns.forEach((elem, index) => {

    if (index <= activeStepNum) {
      elem.classList.add('js-active');
    }

  });
};

//get active panel
const getActivePanel = () => {

  let activePanel;

  DOMstrings.stepFormPanels.forEach(elem => {

    if (elem.classList.contains('js-active')) {

      activePanel = elem;

    }

  });

  return activePanel;

};

//open active panel (and close unactive panels)
const setActivePanel = activePanelNum => {

  //remove active class from all the panels
  removeClasses(DOMstrings.stepFormPanels, 'js-active');

  //show active panel
  DOMstrings.stepFormPanels.forEach((elem, index) => {
    if (index === activePanelNum) {

      elem.classList.add('js-active');

      setFormHeight(elem);

    }
  });

};

//set form height equal to current panel height
const formHeight = activePanel => {

  const activePanelHeight = activePanel.offsetHeight;

  DOMstrings.stepsForm.style.height = `${activePanelHeight}px`;

};

const setFormHeight = () => {
  const activePanel = getActivePanel();

  formHeight(activePanel);
};

//STEPS BAR CLICK FUNCTION
DOMstrings.stepsBar.addEventListener('click', e => {

  //check if click target is a step button
  const eventTarget = e.target;

  if (!eventTarget.classList.contains(`${DOMstrings.stepsBtnClass}`)) {
    return;
  }

  //get active button step number
  const activeStep = getActiveStep(eventTarget);

  //set all steps before clicked (and clicked too) to active
  setActiveStep(activeStep);

  //open active panel
  setActivePanel(activeStep);
});

//PREV/NEXT BTNS CLICK
DOMstrings.stepsForm.addEventListener('click', e => {

  const eventTarget = e.target;

  //check if we clicked on `PREV` or NEXT` buttons
  if (!(eventTarget.classList.contains(`${DOMstrings.stepPrevBtnClass}`) || eventTarget.classList.contains(`${DOMstrings.stepNextBtnClass}`)))
  {
    return;
  }

  //find active panel
  const activePanel = findParent(eventTarget, `${DOMstrings.stepFormPanelClass}`);

  let activePanelNum = Array.from(DOMstrings.stepFormPanels).indexOf(activePanel);

  //set active step and active panel onclick
  if (eventTarget.classList.contains(`${DOMstrings.stepPrevBtnClass}`)) {
    activePanelNum--;

  } else {

    activePanelNum++;

  }

  setActiveStep(activePanelNum);
  setActivePanel(activePanelNum);

});

//SETTING PROPER FORM HEIGHT ONLOAD
window.addEventListener('load', setFormHeight, false);

//SETTING PROPER FORM HEIGHT ONRESIZE
window.addEventListener('resize', setFormHeight, false);

/*  ==========================================
    SHOW UPLOADED IMAGE
* ========================================== */


function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#imageResult').html('<img class="img-fluid rounded shadow-sm mx-auto d-block" src="'+e.target.result+'" />');
    }
    reader.readAsDataURL(input.files[0]);
  } else {
    alert('select a file to see preview');
    $('#imageResult').html('');
  }
}

$(function () {
    $('#upload').on('change', function () {
        readURL(input);
    });
});

/*  ==========================================
    SHOW UPLOADED IMAGE NAME
* ========================================== */
var input = document.getElementById( 'upload' );
var infoArea = document.getElementById( 'upload-label' );

input.addEventListener( 'change', showFileName );
function showFileName( event ) {
  var input = event.srcElement;
  var fileName = input.files[0].name;
  infoArea.textContent = 'File name: ' + fileName;
}


/////service js 

/////////////////////////////service 1

/*  ==========================================
    SHOW UPLOADED IMAGE NAME
* ========================================== */
var input1 = document.getElementById( 'serviceimg1' );
var infoArea1 = document.getElementById( 'upload-label1' );

input1.addEventListener( 'change', showFileName1 );
function showFileName1( event ) {
  var input1 = event.srcElement;
  var fileName1 = input1.files[0].name;
  infoArea1.textContent = 'File name: ' + fileName1;
  if (input1.files && input1.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#service1').html('<img class="img-fluid rounded shadow-sm mx-auto d-block" src="'+e.target.result+'" />');
    }
    reader.readAsDataURL(input1.files[0]);
  } else {
    alert('select a file to see preview');
    $('#service1').html('');
  }
}

/////////////////////////////service 2


/*  ==========================================
    SHOW UPLOADED IMAGE NAME
* ========================================== */
var input2 = document.getElementById( 'serviceimg2' );
var infoArea2 = document.getElementById( 'upload-label2' );

input2.addEventListener( 'change', showFileName2 );
function showFileName2( event ) {
  var input2 = event.srcElement;
  var fileName2 = input2.files[0].name;
  infoArea2.textContent = 'File name: ' + fileName2;
  if (input2.files && input2.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#service2').html('<img class="img-fluid rounded shadow-sm mx-auto d-block" src="'+e.target.result+'" />');
    }
    reader.readAsDataURL(input2.files[0]);
  } else {
    alert('select a file to see preview');
    $('#service2').html('');
  }
}

/////////////////////////////service 3


/*  ==========================================
    SHOW UPLOADED IMAGE NAME
* ========================================== */
var input3 = document.getElementById( 'serviceimg3' );
var infoArea3 = document.getElementById( 'upload-label3' );

input3.addEventListener( 'change', showFileName3 );
function showFileName3( event ) {
  var input3 = event.srcElement;
  var fileName3 = input3.files[0].name;
  infoArea3.textContent = 'File name: ' + fileName3;
  if (input3.files && input3.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#service3').html('<img class="img-fluid rounded shadow-sm mx-auto d-block" src="'+e.target.result+'" />');
    }
    reader.readAsDataURL(input3.files[0]);
  } else {
    alert('select a file to see preview');
    $('#service3').html('');
  }
}


//////////////////////////////////////////////certificate

/*  ==========================================
    SHOW UPLOADED IMAGE NAME
* ========================================== */
var inputcerti = document.getElementById( 'upload-certi' );
var infoAreacerti = document.getElementById( 'upload-certificate' );

inputcerti.addEventListener( 'change', showFileNamecerti );
function showFileNamecerti( event ) {
  var inputcerti = event.srcElement;
  var fileNamecerti = inputcerti.files[0].name;
  infoAreacerti.textContent = 'File name: ' + fileNamecerti;
}

/*------------------------------------------------------end step register form js----------------------------------------*/

$(document).ready(function () {
var $panelsInput = $('.panels input');
$('.next-q').prop('disabled', true);
$panelsInput.on('keyup blur change',function () {
  if ($(this).closest('.panels').find('input:required').length >= 1) {
    $(this).closest('.panels').find('.next-q').prop('disabled', false);
  }
  else {
    $(this).closest('.panels').find('.next-q').prop('disabled', true);
  }
});

});
})(jQuery);
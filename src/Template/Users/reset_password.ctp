<?php  
$lang = 'en';
if ($Configure::check('language')) {
  $lang = $Configure::read('language.culture');
}
?>

<section class="section-gap first-top">
  <div class="container ">
    <div class="row flex-column-reverse flex-md-row">
      <div class="col-md-5 loginarea f-left form-style">        
        <?=$this->Form->create($user, ['id' => 'reset-password-frm','autocomplete'=>'off']);?>
        <div class="col-md-12 f-left lognhead">
          <?= $this->Flash->render(); ?>
          <h4><?= __('Reset Password'); ?></h4>
          <div class="title-line-6 align-left f-left"></div>
        </div>
        <div class="col-md-12">
          <?php echo $this->Form->control('password', ['required' => true, 'placeholder' => __('Password')]); ?>
        </div>
        <div class="col-md-12">
          <?php echo $this->Form->control('confirm_password',['type'=>'password','required'=>true,'placeholder'=>__('Confirm Password')]); ?>
        </div>

        <div class="row captcha-row nomargin">
          <div class="col-md-6">
            <?php $captcha = $this->Captcha->create('securitycode', [
            'type'         => 'image', //or 'math'
            'theme'        => 'login',
            'controller'   => 'Users',
            'action'       => 'captcha',
            'width'        => 100,
            'height'       => 40,
            'length'       => 5,
            'clabel'       => __("Captcha"),
            'cplaceholder' => __("Captcha"),
            'reload_txt'   => '<i class="fa fa-refresh"></i>',
          ]);
            /* $captcha['input']; */
            ?>
            <span class="input input--hoshi ">
              <input type="text" name="securitycode" required="required" autocomplete="off" class="input__field input__field--hoshi" id="securitycode" aria-required="true">
              <label class="input__label input__label--hoshi input__label--hoshi-color-1">
                <span class="input__label-content input__label-content--hoshi">Captcha</span> 
              </label>
            </span>
          </div>
          <div class="col-md-6 captchaimg">
            <span >
              <?= $captcha['captcha'];?>
              <?= $captcha['reload'];?>
            </span>
          </div>
        </div>
        <div class="col-md-12 col-lg-12 btnsec ">
          <?= $this->Form->button(__('Reset Password'),['class'=>'commonBtn']); ?>
        </div>

        <div class="row btnsec nomargin">
          <div class="col-md-6 col-lg-6 forgettext"><?= $this->Html->link(__('Forget Password?'),['action'=>'forgotPassword']);?></div>
          <div class="col-md-6 col-lg-6 forgettext text-right"><?= $this->Html->link(__('Login'),['action' => 'login']); ?></div>
        </div>

        <div class="col-md-12 col-12 newuser textyellow">
          New User? <?= $this->Html->link(__('Create an Account'),['action' => 'registration']); ?>
        </div>
        <?= $this->Form->end();?>
      </div>
      <div class="col-md-7 col-12 loginright" data-aos="fade-left">
        <?= $this->Html->image("../assets/img/loginimg.jpg",["alt" => "logo","class"=>"img-fluid"])?>
      </div>
    </div>
  </div>
</section>

<?php $this->append('bottom-script');?>
<script type="text/javascript">
$(document).ready(function() {
    $("#reset-password-frm").validate({
        rules:{
            "password": {required:true, rangelength: [8, 20], pwcheck: true,},
            "confirm_password": {required: true, equalTo: "#password"},
            'securitycode':"required"
        },
        messages:{
            "password" : {
                required:"Enter Password",
                rangelength:"Password should be minimum {8} and maximum {20} character",
                pwcheck: "Password should be at least one uppercase letter, one lowercase letter, one number and one special character",
            },
            "confirm_password": {required:"Enter Confirm Password",equalTo: "Password not match"},
            "securitycode": "Enter captcha"
        }
    });
});

    $.validator.addMethod("pwcheck", function(value) {
        return /[\@\#\$\%\^\&\*\(\)\_\+\!\?]/.test(value) // At least one special character
            && /[a-z]/.test(value) // At least one lower case English letter
            && /[0-9]/.test(value) // At least one digit
            && /[A-Z]/.test(value) // At least one upper case English letter
    });


  $(function() {
    $('.creload').on('click', function() {
      var mySrc = $(this).prev().attr('src');
      var glue = '?';
      if(mySrc.indexOf('?')!=-1)  {
        glue = '&';
      }
      $(this).prev().attr('src', mySrc + glue + new Date().getTime());
      return false;
    });
  });
</script>

  <script>
    (function() { 
      if (!String.prototype.trim) {
        (function() {
            // Make sure we trim BOM and NBSP
            var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
            String.prototype.trim = function() {
              return this.replace(rtrim, '');
            };
          })();
        }

        [].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
          // in case the input is already filled..
          if( inputEl.value.trim() !== '' ) {
            classie.add( inputEl.parentNode, 'input--filled' );
          }

          // events:
          inputEl.addEventListener( 'focus', onInputFocus );
          inputEl.addEventListener( 'blur', onInputBlur );
        } );

        function onInputFocus( ev ) {
          classie.add( ev.target.parentNode, 'input--filled' );
        }

        function onInputBlur( ev ) {
          if( ev.target.value.trim() === '' ) {
            classie.remove( ev.target.parentNode, 'input--filled' );
          }
        }
      })();
    </script>

    <script>

      ( function( window ) {

        'use strict';

// class helper functions from bonzo https://github.com/ded/bonzo

function classReg( className ) {
  return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
}

// classList support for class management
// altho to be fair, the api sucks because it won't accept multiple classes at once
var hasClass, addClass, removeClass;

if ( 'classList' in document.documentElement ) {
  hasClass = function( elem, c ) {
    return elem.classList.contains( c );
  };
  addClass = function( elem, c ) {
    elem.classList.add( c );
  };
  removeClass = function( elem, c ) {
    elem.classList.remove( c );
  };
}
else {
  hasClass = function( elem, c ) {
    return classReg( c ).test( elem.className );
  };
  addClass = function( elem, c ) {
    if ( !hasClass( elem, c ) ) {
      elem.className = elem.className + ' ' + c;
    }
  };
  removeClass = function( elem, c ) {
    elem.className = elem.className.replace( classReg( c ), ' ' );
  };
}

function toggleClass( elem, c ) {
  var fn = hasClass( elem, c ) ? removeClass : addClass;
  fn( elem, c );
}

var classie = {
  // full names
  hasClass: hasClass,
  addClass: addClass,
  removeClass: removeClass,
  toggleClass: toggleClass,
  // short names
  has: hasClass,
  add: addClass,
  remove: removeClass,
  toggle: toggleClass
};

// transport
if ( typeof define === 'function' && define.amd ) {
  // AMD
  define( classie );
} else {
  // browser global
  window.classie = classie;
}

})( window );
</script>

<?php $this->end();?>
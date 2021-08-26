<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \December 5, 2018, 4:57 pm
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Swavlamban $news
 */
$this->assign('title','Feedback');
$this->assign('subtitle','Feedback');
$this->Breadcrumbs->add(__('Feedback'));
?>

  <section class="online-enquiry-sec">
    <div class="container">
      
	     <div class="row">
      <div class=" contact-form">
       
        <?= $this->Form->create($complaint,['id'=>'onlineenquiry','type'=>'file']);?>
            <?= $this->Flash->render(); ?>
            <div class="row">
              <div class="col-md-6">
                <?= $this->Form->control('full_name',['required'=>true,'placeholder'=>'Enter full name *','label'=>false]);?>
              </div>
              <div class="col-md-6">
                <?= $this->Form->control('company_name',['required'=>true,'placeholder'=>'Enter company name *','label'=>false]);?>
              </div>
              <div class="col-md-6">
                <?= $this->Form->control('email_id',['type'=>'email','required'=>true,'placeholder'=>'Enter email Id *','label'=>false]);?>
              </div> 
              <div class="col-md-6">
                <?= $this->Form->control('address',['type'=>'textarea','rows'=>2,'required'=>true,'placeholder'=>'Enter address *','label'=>false]);?>
              </div>           
              <div class="col-md-6">
                <?= $this->Form->control('city',['type'=>'text','required'=>true,'placeholder'=>'Enter city *','label'=>false]);?>              
              </div>            
              <div class="col-md-6">
                <?= $this->Form->control('state',['required'=>true,'placeholder'=>'Enter state *','label'=>false]);?>
              </div> 
              <div class="col-md-6">
                <?= $this->Form->control('country',['type'=>'text','required'=>true,'placeholder'=>'Enter country *','label'=>false]);?>              
              </div>            
              <div class="col-md-6">
                <?= $this->Form->control('pincode',['required'=>true,'placeholder'=>'Enter pincode *','label'=>false]);?>
              </div>
              <div class="col-md-6">
                <?= $this->Form->control('fixed_line_number',['type'=>'number','placeholder'=>'Enter fixed line number *','label'=>false,'required'=>false]);?>              
              </div>            
              <div class="col-md-6">
                <?= $this->Form->control('mobile_number',['required'=>true,'placeholder'=>'Enter mobile number *','label'=>false]);?>
              </div>
              <div class="col-md-12">
                <?= $this->Form->control('subject',['required'=>true,'placeholder'=>'Enter subject *','label'=>false]);?>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <?= $this->Form->control('comments',['type'=>'textarea','rows'=>3,'required'=>true,'placeholder'=>'Enter narration/particulars','label'=>false]);?>
                  </div>
              </div>
              <div class="col-sm-5">
                <input type="text" name="captcha" id="captcha" autocomplete="off" class="form-control" placeholder="Enter captcha code" title="Enter captcha code" required="required" maxlength="5">
              </div>
              <div class="col-sm-2 captch-div">
                <img src="<?php echo $this->Url->build('/admin/users/captcha');?>" class="capimg"/>
              </div>
              <div class="col-sm-2">
                <a href="#" class="recaptcha"><i class="fa fa-refresh"></i></a>
              </div>
              <div class="clearfix"></div>
			  
			  <div class="button-group-d">
              <div class="col-md-6">
                <div class="form-group">
                  <?= $this->Form->button(__('Submit'),['class' => 'btnContact submit login-btn']);?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <?= $this->Form->button(__('Reset'),['type'=>'reset','class' => 'btnContact reset-btn'])?>
                </div>
              </div> </div>
            </div>
        <?= $this->Form->end();?>
      </div>
	   </div>
    </div>
  </section><!-- ./section -->

<?php $this->append('bottom-script');?>
<script>

(function($){
  $(document).ready(function(){
    $("label[for='securitycode']").css('display','none');
    $.validator.addMethod("alphaNum", function(value, element) {
      return this.optional(element) || /^[a-z0-9\ \s]+$/i.test(value);
    }, "Name must contain only letters, number &  space");

    if(typeof $.validator !== "undefined"){
      $("#onlineenquiry").validate({
        rules:{
          'full_name':{
            required:true,
            alphaNum: true,
            rangelength:[5,25]
          },
          'email_id':{
            required:true,
            email: true,
          },
          'mobile_number' : {
            required: true,
            alphaNum: true,
            rangelength:[10,10]
          },
          'address' : {
            required: true,
            alphaNum: true,
          },
          'subject' : {
            required: true,
            alphaNum: true,
            maxlength : 200
          },
          'city' : {
            required: true,
            alphaNum: true,
            maxlength : 100
          },
          'state' : {
            required: true,
            alphaNum: true,
            maxlength : 100
          },
          'country' : {
            required: true,
            alphaNum: true,
            maxlength : 100
          },
          'pincode' : {
            required: true,
            alphaNum: true,
            maxlength : 6
          },
          'company_name' : {
            required: true,
            alphaNum: true,
          },
          'comments' : {
            required: true,
            alphaNum: true,
          },
          'securitycode' : {
            required: true,
            alphaNum: true,
          }
        },
        messages:{
          'full_name':{
            required:"Name field is required",
            alphaNum: "Enter a valid  name.",
          },
          'email_id':{
            required:"Email field is required",
            email: 'Enter a valid email address.'
          },
          'mobile_number' : {
            required: "Mobile number field is required",
            alphaNum: "Enter a valid mobile number.",
            rangelength : "Enter a valid mobile number.",
          },
          'subject' : {
            required: "Subject field is required",
            alphaNum: "Enter a valid subject.",
          },          
          'city' : {
            required: "City field is required",
            alphaNum: "Enter a valid city.",
          },
          'state' : {
            required: "State field is required",
            alphaNum: "Enter a valid state.",
          },
          'country' : {
            required: "Country field is required",
            alphaNum: "Enter a valid country.",
          },
          'pincode' : {
            required: "Pincode field is required",
            alphaNum: "Enter a valid pincode.",
          },
          'company_name' : {
            required: "Company name field is required",
            alphaNum: "Enter a valid company name.",
          },
          'address' : {
            required: "Address field is required",
            alphaNum: "Enter a valid address.",
          },
          'comments' : {
            required: "Comments field is required",
            alphaNum: "Enter a valid comments.",
          },
          'securitycode' : {
            required: "Captch field is required",
            alphaNum: "Enter a valid captcha.",
          }
        }
      });
    }
  });
})($);

  $('.creload').on('click', function() {
    var mySrc = $(this).prev().attr('src');
    var glue = '?';
    if(mySrc.indexOf('?')!=-1)  {
        glue = '&';
    }
    $(this).prev().attr('src', mySrc + glue + new Date().getTime());
    return false;
  });
</script>
<?php $this->end(); ?>
<?php
$lang = 'en';
if ($Configure::check('language')) {
  $lang = $Configure::read('language.culture');
}
?>
<?php
/**
 * @author \Nilesh Kushvaha
 * @version \1.1
 * @since \December 5, 2018, 4:57 pm
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\News $news
 */
$this->assign('title',__('Registration For Startup'));
$this->assign('subtitle',__('Registration For Startup'));
$this->Breadcrumbs->add(__('Registration'));

$this->Html->meta('keywords', 'Registration For Startup', ['block' => true]);
$this->Html->meta('description', "Registration For Startup", ['block' => true]);

?>
<style>

span.multiselect-native-select select {
  border: 0!important;
  clip: rect(0 0 0 0)!important;
  height: 1px!important;
  margin: -1px -1px -1px -3px!important;
  overflow: hidden!important;
  padding: 0!important;
  position: absolute!important;
  width: 1px!important;
  left: 50%;
  top: 30px
}
.multiselect-container {
  position: absolute;
  list-style-type: none;
  margin: 0;
  padding: 0;
  top: 68%;
  left: 3%;
}
.multiselect-container .input-group {
  margin: 5px
}
.multiselect-container>li {
  padding: 0
}
.multiselect-container>li>a.multiselect-all label {
  font-weight: 700
}
.multiselect-container>li.multiselect-group label {
  margin: 0;
  padding: 3px 20px 3px 20px;
  height: 100%;
  font-weight: 700
}
.multiselect-container>li.multiselect-group-clickable label {
  cursor: pointer
}
.multiselect-container>li>a {
  padding: 0
}
.multiselect-container>li>a>label {
  margin: 0;
  height: 100%;
  cursor: pointer;
  font-weight: 400;
  padding: 3px 0 3px 30px
}
.multiselect-container>li>a>label.radio, .multiselect-container>li>a>label.checkbox {
  margin: 0
}
.multiselect-container>li>a>label>input[type=checkbox] {
  margin-bottom: 5px
}
.btn-group>.btn-group:nth-child(2)>.multiselect.btn {
  border-top-left-radius: 4px;
  border-bottom-left-radius: 4px
}
.form-inline .multiselect-container label.checkbox, .form-inline .multiselect-container label.radio {
  padding: 3px 20px 3px 40px
}
.form-inline .multiselect-container li a label.checkbox input[type=checkbox], .form-inline .multiselect-container li a label.radio input[type=radio] {
  margin-left: -20px;
  margin-right: 0
}
</style>
  <div class="inner-main-sec">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <?php echo $this->Form->create($application,['id'=>'registration_form','type'=>'file'])?>
          <div class="enttity-detail">
            <h2>Startup Details</h2>
            <div class="inner-body-form">
              <div class="row">
                <div class="col-md-5 left-sec-form">
                  <div class="form-group">
                    <label>Nature of Startup<sup>*</sup></label>
                    <?= $this->Form->select('nature_of_startup_id',$nature_of_startup,['empty'=>'Select','label'=>false,'required'=>true])?>
                  </div>
                  <div class="form-group">
                    <label>Industry<sup>*</sup></label>
                    <?= $this->Form->select('industry_id',$industries,['empty'=>'Select','label'=>false,'required'=>true,'id'=>'industry-id'])?>
                  </div>
                  
                  <div class="form-group">
                    <label>Sector<sup>*</sup></label>
                    <?= $this->Form->select('sector_id',@$sectors,['empty'=>'Select','label'=>false,'required'=>true,'id'=>'sector-id'])?>
                  </div>
                  <div class="form-group">
                    <label>Name of Startup <sup>*</sup></label>
                    <?= $this->Form->input('name_of_startup',['type'=>'text','label'=>false,'placeholder'=>'Name of Startup','required'=>true])?>
                  </div>
                  
                </div>
                <div class="col-md-5 right-sec-form">
                  <div class="form-group">
                    <label>Registration/ Incorporation No.<sup>*</sup></label>
                    <?= $this->Form->input('incorporation_no',['type'=>'text','label'=>false,'placeholder'=>'Registration/ Incorporation No','required'=>true])?>
                  </div>
                  <div class="form-group">
                    <label>Registration/ Incorporation Date<sup>*</sup></label>
                    <div class="calender-div-s"> <i class="fa fa-calendar" aria-hidden="true"></i>
                    <?= $this->Form->input('registration_date',['type'=>'text','label'=>false,'id'=>'datepicker4','required'=>true])?>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label>Categories<sup>*</sup></label>
                    <?= $this->Form->select('category_id',$startup_categories,['label'=>false,'required'=>true,'multiple'=>true,'id'=>'dates-field2','class'=>'multiselect-ui'])?>
                  </div>
                  
                  <div class="form-group">
                    <label>PAN</label>
                    <?= $this->Form->input('pan_no',['type'=>'text','label'=>false,'placeholder'=>'XXXXX7805X'])?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="enttity-detail contact-detail">
            <h2>Full Address (Startup- Office)</h2>
            <div class="inner-body-form">
              <div class="row">
                <div class="col-md-5 left-sec-form">
                  <div class="form-group">
                    <label>Address Line 1 <sup>*</sup></label>
                    <?= $this->Form->input('address_line_1',['type'=>'text','label'=>false,'required'=>true])?>
                  </div>
                  <div class="form-group">
                    <label>Address Line 3 </label>
                    <?= $this->Form->input('address_line_3',['type'=>'text','label'=>false])?>
                  </div>
                  <div class="form-group">
                    <label>State <sup>*</sup></label>
                    <?= $this->Form->select('state_id',$states,['empty'=>'Select','label'=>false,'required'=>true,'id'=>'state-id'])?>
                  </div>
                  <div class="form-group">
                    <label>Pin Code <sup>*</sup></label>
                    <?= $this->Form->input('pincode',['type'=>'text','label'=>false,'maxlength'=>6,'minlength'=>6,'required'=>true])?>
                  </div>
                </div>
                <div class="col-md-5 right-sec-form">
                  <div class="form-group">
                    <label>Address Line 2 <sup>*</sup></label>
                    <?= $this->Form->input('address_line_2',['type'=>'text','label'=>false,'required'=>true])?>
                  </div>
                  <div class="form-group">
                    <label>City/ Village <sup>*</sup></label>
                    <?= $this->Form->input('city',['type'=>'text','label'=>false,'required'=>true])?>
                  </div>
                  <div class="form-group">
                    <label>District <sup>*</sup></label>
                    <?= $this->Form->select('district_id',@$district,['empty'=>'Select','label'=>false,'required'=>true,'id'=>'district-id'])?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="enttity-detail other-information">
            <h2>Startup Representative Information</h2>
            <div class="inner-body-form">
              <div class="row">
                <div class="col-md-5 left-sec-form">
                  <div class="form-group">
                    <label>Authorized Representative<sup>*</sup></label>
                    <?= $this->Form->input('authorized_representative',['type'=>'text','label'=>false,'value'=>$name,'readonly','required'=>true])?>
                  </div>
                  
                  <div class="form-group">
                    <label>Email Address<sup>*</sup></label>
                    <?= $this->Form->input('representative_email',['type'=>'text','label'=>false,'value'=>$email,'readonly','required'=>true])?>
                  </div>
                </div>
                <div class="col-md-5 right-sec-form">
                  <div class="form-group">
                    <label>Designation  <sup>*</sup></label>
                    <?= $this->Form->input('representative_designation',['type'=>'text','label'=>false,'required'=>true,'value'=>$users->registration->designation->name])?>
                  </div>
                  <div class="form-group">
                    <label>Mobile No. <sup>*</sup></label>
                    <?= $this->Form->input('representative_mobile',['type'=>'text','label'=>false,'required'=>true,'value'=>$users->registration->mobile_number])?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="enttity-detail document-required">
            <h2>Director's Information</h2>
            <div class="inner-body-form">
              <div class="row">
                <div class="col-md-5 left-sec-form">
                  <div class="form-group">
                    <label>No. of Directors <sup>*</sup></label>
                    <?php $no_of_director = range(1,10);
                    $no_of_director = array_combine($no_of_director, $no_of_director);
                    ?>
                    <?= $this->Form->select('no_of_directors',@$no_of_director,['empty'=>'Select','label'=>false,'required'=>true])?>
                  </div>
                  <div class="form-group">
                    <label>Gender <sup>*</sup></label>
                    <?php $gender = array('1'=>'Male','2'=>'Female')?>
                    <?= $this->Form->select('gender',$gender,['empty'=>'Select','label'=>false,'required'=>true])?>
                  </div>
                  <div class="form-group">
                    <label>Mobile No. <sup>*</sup></label>
                    <?= $this->Form->input('mobile',['type'=>'text','label'=>false,'required'=>true,'maxlength'=>10])?>
                  </div>
                </div>
                <div class="col-md-5 right-sec-form">
                  <div class="form-group">
                    <label>Name of Director <sup>*</sup></label>
                    <?= $this->Form->input('name_of_director',['type'=>'text','label'=>false,'required'=>true])?>
                  </div>
                  <div class="form-group">
                    <label>Email Address <sup>*</sup></label>
                    <?= $this->Form->input('email',['type'=>'email','label'=>false,'required'=>true])?>
                  </div>
                  <div class="form-group">
                    <label>Address <sup>*</sup></label>
                    <?= $this->Form->textarea('address',['type'=>'text','label'=>false,'required'=>true])?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="enttity-detail document-required">
            <h2>Information Required</h2>
            <div class="inner-body-form">
              <div class="row">
                <div class="col-md-5 left-sec-form">
                  <div class="form-group">
                    <label>Current number of employees <sup>*</sup></label>
                    <?= $this->Form->input('number_of_employees',['type'=>'number','label'=>false,'required'=>true])?>
                  </div>
                  <div class="form-group">
                    <label>Has your startup applied for any IPR<sup>*</sup></label>
                    <div class="radion-div">
                      <!-- <label class="container1">Yes
                        <input type="radio" checked="checked" name="applied_for_IPR">
                        <span class="checkmark"></span> </label>
                      <label class="container1">No
                        <input type="radio" name="applied_for_IPR">
                        <span class="checkmark"></span> </label> -->
                      <?= $this->Form->radio('applied_for_IPR',['y'=>'Yes','n'=>'No'],['required'=>true])?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Is the startup creating a scalable business model with high potential of employment generation or wealth creation<sup>*</sup></label>
                    <div class="radion-div">
                      <!-- <label class="container1">Yes
                        <input type="radio" checked="checked" name="is_scalable_business_model">
                        <span class="checkmark"></span> </label>
                      <label class="container1">No
                        <input type="radio" name="is_scalable_business_model">
                        <span class="checkmark"></span> </label> -->
                      <?= $this->Form->radio('is_scalable_business_model',['y'=>'Yes','n'=>'No'],['required'=>true])?>
                    </div>
                  </div>
                </div>
                <div class="col-md-5 right-sec-form">
                  <div class="form-group">
                    <label>Startup Stage <sup>*</sup></label>
                    <div class="radion-div">
                      <!-- <label class="container1">Yes
                        <input type="radio" checked="checked" name="startup_stage">
                        <span class="checkmark"></span> </label>
                      <label class="container1">No
                        <input type="radio" name="startup_stage">
                        <span class="checkmark"></span> </label> -->
                      <?= $this->Form->radio('startup_stage',$startup_stages,['required'=>true])?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Is the startup creating an innovative product / service / process or improving an existing product / service / process <sup>*</sup></label>
                    <div class="radion-div">
                      <!-- <label class="container1">Yes
                        <input type="radio" checked="checked" name="is_innovative_improving">
                        <span class="checkmark"></span> </label>
                      <label class="container1">No
                        <input type="radio" name="is_innovative_improving">
                        <span class="checkmark"></span> </label> -->

                      <?= $this->Form->radio('is_innovative_improving',['y'=>'Yes','n'=>'No'],['required'=>true])?>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>

          <div class="enttity-detail document-required">
            <h2>Startup Activities</h2>
            <div class="inner-body-form">
              <div class="row">
                <div class="col-md-5 left-sec-form">
                  <div class="form-group">
                    <label>Please mention any awards/recognition received</label>
                    <?= $this->Form->textarea('awards_recognition',['label'=>false,'required'=>false])?>
                  </div>
                  <div class="form-group">
                    <label>How does your startup propose to solve this problem? <sup>*</sup></label>
                    <?= $this->Form->textarea('how_problem_solving',['label'=>false,'required'=>true])?>
                  </div>
                  <div class="form-group">
                    <label>How does your startup generate revenue? <sup>*</sup></label>
                    <?= $this->Form->textarea('how_generate_revenue',['label'=>false,'required'=>true])?>
                  </div>
                </div>
                <div class="col-md-5 right-sec-form">
                  <div class="form-group">
                    <label>What is the problem the startup is solving?<sup>*</sup></label>
                    <?= $this->Form->textarea('problem_startup_solving',['label'=>false,'required'=>true])?>
                  </div>
                  <div class="form-group">
                    <label>What is the uniqueness of your solution?<sup>*</sup></label>
                    <?= $this->Form->textarea('uniqueness_of_solution',['label'=>false,'required'=>true])?>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>

          <div class="enttity-detail document-required">
            <h2>Self-Certification</h2>
            <div class="inner-body-form">
              <div class="row">
                <div class="col-md-5 left-sec-form">
                  <div class="form-group">
                    <div class="form-group">
                      <label>Incorporation/ Registration Certificate <sup>*</sup></label>
                      <input type="file" name="registration_certificate" class="file" required="true">
                      <div class="input-group col-xs-12 upload-file"> <span class="input-group-btn">
                        <button class="browse btn btn-primary input-lg" type="button"> Browse</button>
                        </span>
                        <input type="text" class="form-control input-lg"  placeholder="No File Selected">
                      </div>
                      <span class="file-size">File Size should not be more than 1MB</span> </div>
                  </div>
                  <div class="form-group">
                    <label>
                    <?= $this->Form->checkbox('is_Declaration_checked',['type'=>'checkbox','label'=>false,'required'=>true])?> Declaration<sup>*</sup></label>
                  </div>
                </div>
                <div class="col-md-12 right-sec-form addition-comm">
                  <div class="form-group">
                    <label>Please provide links or upload additional document to support your application. (E.g. Website link, Videos, Pitch Deck, Patents, etc.)</label>
                    <?= $this->Form->input('additional_documents',['label'=>false,'required'=>false])?>
                  </div>                  
                </div>
              </div>
            </div>
          </div>

          <div class="enttity-detail verification">
            
            <div class="inner-body-form">
              <div class="row logged-sec">
               
                <div class="submit-button-div">
                  <input type="submit" placeholder="Submit" value="Submit">
                </div>
              </div>
            </div>
          </div>
          <?= $this->Form->end(); ?>
        </div>
      </div>
    </div>
  </div>
<?php $this->append('bottom-script');?>
<?php $this->Html->script(['multiselect'], ['block' => 'bottom-script']); ?>
<script>
$( function() {
  $( "#datepicker4" ).datepicker();

} );

$("#registration_form").validate();

$(function() {
    $('.multiselect-ui').multiselect({
        includeSelectAllOption: true
    });
});

var baseUrl = "<?php echo $this->Url->build('/'.$lang.'/registration', true);?>";

  $('#state-id').on('change',function(){
    var stateId = $('#state-id').val();
    //alert(stateId); //return false;
    $.ajax({
        type:'POST',
        async: true,
        cache: false,
        url: baseUrl + '/getDistrictList',
        data: {
            state_id : stateId,
        },
        beforeSend: function (xhr) {
          xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
        },
        success: function(data) {
            if(stateId == 0){
              var optiond = "<option value=''>Select</option>";
              $('#district-id').html(optiond);
            }else{
              $('#district-id').html(data);
            }
            /*var option = "<option value=''>--Select--</option>";
            $('#city-id').html(option);*/
        },
        error:function (){
            alert('I am in Error');
        },
    });
})

$('#industry-id').on('change',function(){
    var industry_id = $('#industry-id').val();
    //alert(stateId); //return false;
    $.ajax({
        type:'POST',
        async: true,
        cache: false,
        url: baseUrl + '/getSectorList',
        data: {
            industry_id : industry_id,
        },
        beforeSend: function (xhr) {
          xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
        },
        success: function(data) {
            if(industry_id == 0){
              var optiond = "<option value=''>Select</option>";
              $('#sector-id').html(optiond);
            }else{
              $('#sector-id').html(data);
            }
            /*var option = "<option value=''>--Select--</option>";
            $('#city-id').html(option);*/
        },
        error:function (){
            alert('I am in Error');
        },
    });
})


$(document).on('click', '.browse', function(){
  var file = $(this).parent().parent().parent().find('.file');
  file.trigger('click');
});
$(document).on('change', '.file', function(){
  $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
});
</script> 
<?php $this->end();?>
<style type="text/css">
  .checkbox input[type=checkbox], .checkbox-inline input[type=checkbox], .radio input[type=radio], .radio-inline input[type=radio] {
    position: relative;
    margin: 0;
}
.addition-comm {
    width: 100%;
    float: right;
    text-align: left !important;
    
}
.enttity-detail {
    background: #fff;
    border-radius: 0px 0px 4px 4px;
    box-shadow: none !important;
}
.inner-body-form {
    padding: 0;
    box-shadow: none;
}
.submit-button-div {
    text-align: center;
}
.error {
    color: red !important;
}
.addition-comm #additional-documents{height:100px !important;}
.inner-body-form .form-control {
    height: 40px !important;
}
.calender-div-s i.fa.fa-calendar {
    top: 15px !important;
}
.open > .dropdown-menu {
    width: 94.4% !important;
}
.inner-main-sec {
    padding-top: 25px;}
.upload-file .browse, .upload-file .form-control {
    height: 40px !important;
}
.enttity-detail h2 {
    background: #dfdfdf;
    padding: 14px !important;}
.form-check {
    float: left;
    margin-right: 20px;
}
.checkbox label, .radio label {
    min-height: 20px;
    padding-left: 6px !important;}
</style>
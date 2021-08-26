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
$this->assign('title',__('Edit Profile'));
$this->assign('subtitle',__('Edit Profile'));
$this->Breadcrumbs->add(__('Edit Profile'));

$this->Html->meta('keywords', 'Edit Profile', ['block' => true]);
$this->Html->meta('description', "Edit Profile", ['block' => true]);

?>
<section class="section-gap first-top">
  <div class="inner-main-sec">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="enttity-detail edit-bg">
            <h2>Edit Profile</h2>
            <div class="inner-body-form">
              <?php echo $this->Form->create($user,['id'=>'profile','type'=>'file'])?>
              <div class="row">
                <div class="col-md-3">
                  <div class="text-left">
                    <?php if(!empty($user->registration->profile_photo)){?>
                      <?= $this->Html->image("../files/profile_pic/".$user->registration->profile_photo,["alt" => "Profile-img",'class'=>'profile-pic']);?>
                      <?= $this->Form->hidden('registration.profile_photo_old',['type'=>'file','label'=>false,'class'=>'file','value'=>$user->registration->profile_photo])?>
                    <?php }else{ ?>
                      <?= $this->Html->image("user2-160x16.jpg",["alt" => "Profile-img",'class'=>'profile-pic']);?> 
                    <?php } ?>
                    <h6>Upload a different photo...</h6>
                    <div class="form-group">
                      <?= $this->Form->input('registration.profile_photo',['type'=>'file','label'=>false,'class'=>'file','accept'=>'image/x-png,image/gif,image/jpeg'])?>
                      <div class="input-group col-xs-12 upload-file"> <span class="input-group-btn">
                        <button class="browse btn btn-primary input-lg pro-b" type="button"> Browse</button>
                        </span>
                        <input type="text" class="form-control input-lg" placeholder="No File Selected">
                      </div>
                      <p>File Size should not be more than 1MB</p> </div>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                      <label>First Name<sup>*</sup></label>
                      <?= $this->Form->input('registration.first_name',['type'=>'text','label'=>false,'required'=>true, 'placeholder'=>'First Name'])?>
                    </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                      <label>Last Name </label>
                      <?= $this->Form->input('registration.last_name',['type'=>'text','label'=>false, 'placeholder'=>'Last Name'])?>
                    </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                      <label>Mobile No.<sup>*</sup></label>
                      <?= $this->Form->input('registration.mobile_number',['type'=>'number','label'=>false,'required'=>true, 'placeholder'=>'Mobile No'])?>
                    </div>
                    </div>
                  </div>
                  <div class="row margin30">
                    <div class="col-md-4">
                      <div class="form-group">
                      <label>Date of Birth</label>
                      <?= $this->Form->input('registration.date_of_birth',['type'=>'text','label'=>false, 'placeholder'=>'Date of Birth','class'=>'datepicker','readonly'])?>
                    </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                      <label>Gender</label>
                      <?php $gender = array('1'=>'Male','2'=>'Female'); ?>
                      <?= $this->Form->select('registration.gender',$gender,['empty'=>'Select','label'=>false])?>
                    </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                      <label>Address <sup>*</sup></label>
                      <?= $this->Form->input('registration.address',['type'=>'text','label'=>false,'required'=>true, 'placeholder'=>'Address'])?>
                    </div>
                    </div>
                  </div>
                  <div class="row margin30">
                    <div class="col-md-4">
                      <div class="form-group">
                      <label>State<sup>*</sup></label>
                      <?= $this->Form->select('registration.state_id',@$state,['empty'=>'Select','label'=>false,'required'=>true,'id'=>'state-id'])?>
                    </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                      <label>District<sup>*</sup></label>
                      <?= $this->Form->select('registration.district_id',@$district,['empty'=>'Select','label'=>false,'required'=>true,'id'=>'district-id'])?>
                    </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                      <label>City</label>
                      <?= $this->Form->input('registration.city',['type'=>'text','label'=>false,'placeholder'=>'City'])?>
                    </div>
                    </div>
                  </div>
                  <div class="row margin30">
                    <div class="col-md-4">
                      <div class="form-group">
                      <label>Pin Code<sup>*</sup></label>
                      <?= $this->Form->input('registration.pincode',['type'=>'number','label'=>false,'placeholder'=>'Pin Code','required'=>true,'minlength'=>6,'maxlength'=>6])?>
                    </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                      <label>Company Name </label>
                      <?= $this->Form->input('registration.organization',['type'=>'text','label'=>false,'placeholder'=>'Company Name'])?>
                    </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                      <label>Designation </label>
                      <?= $this->Form->select('registration.designation_id',@$designation,['empty'=>'Select','label'=>false])?>
                    </div>
                    </div>
                  </div>
                  <div class="row margin30">
                    <div class="col-md-4">
                      <div class="form-group">
                      <label>Website</label>
                      <?= $this->Form->input('registration.website',['type'=>'url','label'=>false,'placeholder'=>'Website'])?>
                    </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                      <div class="submit-button-div profile-btn">
                        <input type="submit" placeholder="Submit" value="Submit">
                        <a href="<?= $this->Url->build(['controller'=>'Dashboard'])?>">Cancel</a>
                      </div>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
              <?= $this->Form->end(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
  <hr>
<?php $this->Html->css(['AdminLTE./plugins/datepicker/datepicker3'], ['block' => 'head-style']); ?>
<?php $this->append('bottom-script');?>
<?php $this->Html->script(['AdminLTE./plugins/datepicker/bootstrap-datepicker'], ['block' => 'bottom-script']); ?>
<script type="text/javascript">
  $('.datepicker').datepicker();

$(document).ready(function() {    
    $("#profile").validate();
  })

$(document).on('click', '.browse', function(){
  var file = $(this).parent().parent().parent().find('.file');
  file.trigger('click');
});
$(document).on('change', '.file', function(){
  $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
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

</script>
<?php $this->end();?>
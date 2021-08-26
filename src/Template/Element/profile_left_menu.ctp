<?php
/*
*
*/
$userData  = $this->request->getSession()->read('Auth.User');
$roleId = $userData['role_id'];
?>
<div class="adProfile-quickLinks-group">
  <h4 class="adProfile-quickLink-title">Profile Information</h4>
  <ul class="adProfile-quickLink-list">
    <li class="has-children">
      <a href="javascript:void(0)">Personal Information</a>
      <ul class="quickLink-subMenu">
        <li><?= $this->Html->link(__('<i class="fa fa-angle-right" aria-hidden="true"></i> Personal Information'),['controller'=>'MyProfile','action'=>'index'],['escape'=>false]);?></li>
        <li><?= $this->Html->link(__('<i class="fa fa-angle-right" aria-hidden="true"></i> Profile Picture & Video'),['controller'=>'MyProfile','action'=>'profilePicture'],['escape'=>false]);?></li>
      </ul>
    </li>
    <?php if ($roleId==6):  ?>
    <li class="has-children">
      <a href="javascript:void(0)">Professional Information</a>
      <ul class="quickLink-subMenu">
        <!-- <li><?= $this->Html->link(__('<i class="fa fa-angle-right" aria-hidden="true"></i> Experience In Driving'),['controller'=>'MyProfile','action'=>'drivingExperience'],['escape'=>false]);?></li> -->
        <li><?= $this->Html->link(__('<i class="fa fa-angle-right" aria-hidden="true"></i> Upload Documents'),['controller'=>'MyProfile','action'=>'uploadDocuments'],['escape'=>false]);?></li>
      </ul>
    </li>
    <?php endif;?>
  </ul>
</div>
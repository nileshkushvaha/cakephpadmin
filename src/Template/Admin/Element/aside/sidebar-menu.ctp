<?php
/**
 * Element : Sidebar menu
 * Sidebar menu controll all list of menu.
 * @author : Nilesh Kushvaha
 * @version : 1.1
 * @since : 24 October 2018
 */
?>
<?php
$action = !empty($this->request->getParam('action')) ? $this->request->getParam('action') : null;
$controller = !empty($this->request->getParam('controller')) ? $this->request->getParam('controller') : null;
?>
<ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    <li>
        <?=$this->Html->link('<i class="fa fa-dashboard"></i> <span>Dashboard</span>',['controller'=>'dashboard','action'=>'index'], ['class'=> 'silvermenu', 'title' => __('Dashboard'), 'escape' => false]);?>
    </li>
    <?php 
    $i = 0;
    foreach($roledata as $navaction) { ?>
        <li class="treeview">
            <a href="#id<?= $i; ?>"><i class="fa <?=$navaction['ParentModule']['icon']?>"></i> <span><?=$navaction['ParentModule']['name']?></span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>

        <?php if(count($navaction['ChildModule'])){ ?>
        <ul class="treeview-menu" id="id<?= $i; ?>">
            <?php foreach($navaction['ChildModule'] as $Subnavaction) { 
            $cusac = lcfirst(str_replace('-', '',ucwords($Subnavaction['action'], "-")));
            $cuscont = str_replace('-', '',ucwords($Subnavaction['controller'], "-"));
            $str = '';
            if(($controller == $Subnavaction['controller'] || $controller == $cuscont) && ($action == $cusac)){
                $str="active";
            }else{
                $str="";
            } ?>
            <li>
                <?=$this->Html->link('<i class="fa fa-circle-o"></i>'.$Subnavaction['name'],['controller'=>ucfirst($Subnavaction['controller']),'action'=>strtolower($Subnavaction['action'])], ['class'=> 'silvermenu', 'title' => __($Subnavaction['name']), 'escape' => false]);?>
            </li>
            <?php } ?>
        </ul>
        <?php } ?>
    </li>
    <?php $i++; } ?>
</ul>

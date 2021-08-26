<?php 
$this->Breadcrumbs->templates([
	'wrapper' => '<nav aria-label="breadcrumb"><ol{{attrs}}>{{content}}</ol></nav>',
	'item' => '<li class="breadcrumb-item" {{attrs}}><a href="{{url}}"{{innerAttrs}}>{{title}}</a></li>{{separator}}',
	'itemWithoutLink' => '<li class="breadcrumb-item active" {{attrs}}>{{title}}</li>{{separator}}',
]);
$this->Breadcrumbs->prepend('<i class="fa fa-home"></i> Home', ['controller' => 'Home', 'action' => 'index']);?>
<?=	$this->Breadcrumbs->render( 
	['class' => 'breadcrumb rounded-0']
	//['separator' => '<i class="fas fa-angle-right"></i>']
);
?>
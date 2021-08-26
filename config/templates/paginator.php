<?php
return [
    'nextActive' => '<li class="page-item next"><a rel="next" class="page-link" href="{{url}}">{{text}}</a></li>',
    'nextDisabled' => '<li class="page-item next disabled"><a class="page-link" href="" onclick="return false;">{{text}}</a></li>',
    'prevActive' => '<li class="page-item prev"><a rel="prev" class="page-link" href="{{url}}">{{text}}</a></li>',
    'prevDisabled' => '<li class="page-item prev disabled"><a class="page-link" href="" onclick="return false;">{{text}}</a></li>',
    'counterRange' => '{{start}} - {{end}} of {{count}}',
    'counterPages' => '{{page}} of {{pages}}',
    'first' => '<li class="page-item first"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'last' => '<li class="page-item last"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'current' => '<li class="page-item active"><a class="page-link" href="">{{text}}</a></li>',
    'ellipsis' => '<li class="page-item ellipsis">&hellip;</li>',
    'sort' => '<a href="{{url}}">{{text}} <i class="fa fa-sort float-right mt-1"></i></a>',
    'sortAsc' => '<a class="asc" href="{{url}}">{{text}} <i class="fa fa-sort-up float-right mt-1"></i></a>',
    'sortDesc' => '<a class="desc" href="{{url}}">{{text}} <i class="fa fa-sort-down float-right mt-1"></i></a>',
    'sortAscLocked' => '<a class="asc locked" href="{{url}}">{{text}}</a>',
    'sortDescLocked' => '<a class="desc locked" href="{{url}}">{{text}}</a>',
];
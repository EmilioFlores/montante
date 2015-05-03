<?php 
function load_view() {
	$header = "<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>";
	$header .=  "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css'>";
	$header .=  "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css'>";
	$header .=  "<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js'></script>";
	$header .=  "<script src='../public/javascript/general.js'></script>";
	$header .=  "<link rel='stylesheet' href='../public/css/style.css'>";
	$view = "	<div class='col-lg-12 text-error' id='error'></div>";
	$view .=   "<div id='input-wrapper'>";
	$view .=		"<div class='col-lg-12 form-group'>";
	$view .=			"<label for='ecuaciones'>Number of equations</label><input  class='form-control' type='text' id='ecuaciones' value='3' placeholder='3'>";
	$view .=		"</div>";
	$view .=		"<div class='col-lg-12 form-group'>";
	$view .=			"<label for='incognitas'>Number of unknown variables</label><input class='form-control' type='text' id='incognitas' value='3' placeholder='3' >";
	$view .=		"</div>";
	$view .=	"</div>";
	$view .=	"<div class='col-lg-12 '>";
	$view .=		"<input type='button' class='btn-primary btn-block' value='Continue' id='insert-ecuations'>";
	$view .=	"</div>";
	$view .=	"<div class='col-lg-12'>";
	$view .=		"<div id='ecs-div' class='table-responsive'></div> ";
	$view .=	"</div>";
	$view .=	"<div class='col-lg-6'>";
	$view .=		"<input type='button' class='btn-primary btn-block 'value='Go Back' id='go-back' style='display: none;'>";
	$view .=	"</div>";
	$view .=	"<div class='col-lg-6'>";
	$view .=		"<input type='button' class='btn-primary btn-block 'value='Continue' id='start-method' style='display: none;'>";
	$view .=	"</div>";
	$view .=	"<div class='col-lg-12' id='result'></div>";
	return $header . $view;
}
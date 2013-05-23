$(document).ready(inicio);

function inicio(){
	$('#messages article').on('mouseover',mostraropc);
	$('#messages article').on('mouseout',ocultaropc);
}

function mostraropc(e){
	$('#tools' + e.currentTarget.id).css('display','inline-block');
}

function ocultaropc(e){
	$('#tools' + e.currentTarget.id).css('display','none');
}
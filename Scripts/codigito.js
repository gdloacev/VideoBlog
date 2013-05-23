$(document).ready(inicio);

function inicio(){
	$("time.timeago").timeago();
	$('#messages article').on('mouseover',mostraropc);
	$('#messages article').on('mouseout',ocultaropc);
	mostrardialogo();
}

function mostraropc(e){
	$('#tools' + e.currentTarget.id).css('display','inline-block');
}

function ocultaropc(e){
	$('#tools' + e.currentTarget.id).css('display','none');
}

function mostrardialogo() {
    $( "#dialog-message" ).dialog({
      height: 'auto',
      modal: true
    });
  }
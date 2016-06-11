$(document).ready(function() {
    $('#letter-e a').click(function(event) {
    event.preventDefault();
    var requestData = {term: $(this).text()};
    $.get('e.php', requestData, function(data) {
      $('#dictionary').html(data);
    }).fail(function(jqXHR) {
      $('#dictionary')
      .html('Sorry, but an error occurred: ' + jqXHR.status)
      .append(jqXHR.responseText);
    });
  });
  
$("select#dropdown1").change(function(){
var topcat = $("select#dropdown1 option:selected").attr('value');
$.post( "category.php", { tid: topcat })
.done(function( data ) {
$("#second").html(data);
});
});
 
$("select#dropdown2").change(function(){
var seccat = $("select#dropdown2 option:selected").attr('value');
$.post( "category.php", { sid: seccat })
.done(function( data ) {
$("#thrid").html(data);
});
});

});

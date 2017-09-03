jQuery(document).ready(function($){
   var index = $('.table_pedidos_actuales-column-status').prop('selectedIndex'); 
    var select = $('.table_pedidos_actuales-column-status');
   select.change(function(e){
     var conf = confirm('Realmente desea cambiar el estado?');
     if(!conf){
             $(this).prop('selectedIndex',index);
         // reset the select back to previous
         return false;
     }
       else{
        $('.table_pedidos_actuales-column-status').prop('selectedIndex');}

     // do stuff

  });
});


setTimeout(function(){
   window.location.reload(1);
}, 30000);


function update(){
  console.log("asd");
}

var estadoCambiado;



(function () {
    var previous;

    $(".table_pedidos_actuales-column-status").on('focus', function () {
        // Store the current value on focus and on change
        previous = this.value;
        
        
    }).change(function() {
        // Do something with the previous value after the change
        var conf = confirm('Realmente desea cambiar el estado?');
        if(!conf){
           $(this).val(previous);
         // reset the select back to previous
         return false;
         // Make sure the previous value is updated
         previous = this.value;
        }else{
            var updated = $('.table_pedidos_actuales-column-status').prop('selectedIndex');
            estadoCambiado=updated+1;
            var idpedidoAJAX= ($(this).closest('td').prevAll()[3].innerHTML);
            $.ajax({
                url: "../../Model/estadopedidoUpdated.php",

                data: {"idpedidoAJAX":idpedidoAJAX,"idestado":estadoCambiado},
                type: "POST",
                
                success : function(data,status){
                    if(status == 'success'){
                        alert("Estado cambiado con exito!");

                        // window.location.reload(true);
                    }
                },
                error: function(){
                    alert("ERROR: Estado no pudo ser cambiado :(");
                }

            });
        }

    });

})();

setTimeout(function(){
   window.location.reload(1);
}, 30000);


function update(){
  console.log("asd");
}


$(document).ready(function(){
  

  // alert(serial);

  $('#form').click(function(e){
    e.preventDefault();
    // alert('sdf');
    var serialize = $('#form').serialize();
    // alert(serialize);
   $.ajax({
        url:'send.php',
        type:'POST',
        data: serialize,
        success:function(data){
          alert('SUCESSO');
          alert(data);
            // $('.exibeColPasta').html(data);
        location.reload();
        }
   
    });
 });







});
// function chamarPhpAjax()
//     {
//        var msg = '<?php echo a(); ?>';
//         alert(msg);
//     }
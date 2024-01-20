function products(key){
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = 'users/productdetail.php';
    
    var input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'product_id';
    input.value = key;
    
    form.appendChild(input);
    
    document.body.appendChild(form);
    
    form.submit();
    }
    
    function generatehtml(data){
    }
  
const products = document.getElementById("products");

if(products){
  products.addEventListener("click", e => {
    console.log('lol');
    if(e.target.className === 'btn btn-danger'){
      if(confirm("Are you sure?")){
        const id = e.target.getAttribute('data-id');
        fetch(`products/delete/${id}`, {
          method:'DELETE'
        }).then(res => window.location.reload());
      }
    }
  });
}
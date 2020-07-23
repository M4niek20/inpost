const products = document.getElementById("products");

if(products){
  products.addEventListener("click", e => {
    if(e.target.className === 'btn btn-danger'){
      if(confirm("Are you sure?")){
        const id = e.target.getAttribute('data-id');
        fetch(`delete/${id}`, {
          method:'DELETE'
        }).then(res => window.location.reload());
      }
    }
  });
}
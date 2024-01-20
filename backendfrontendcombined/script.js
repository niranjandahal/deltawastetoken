function sendPostRequest() {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./users/displayproduct.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        generateProductHTML(xhr.responseText);
        console.log(xhr.responseText);
      }
    };
    xhr.send("action=displayallproducts");
  }
  
  function generateProductHTML(response) {
    var productContainer = document.getElementById("productContainer");
  
    var productList = JSON.parse(response);
    productList.forEach((product) => {
      var productHTML = `
            <div class="lg:w-1/4 md:w-1/2 p-4 w-full">
                <a onclick="products(${product.id})") class="block relative h-48 rounded overflow-hidden">
                    <button "alt="ecommerce" class="object-cover object-center w-full h-full block" >
                        <img src="./uploads/${product.product_image}" alt="${product.product_name}">
                    </button>
                </a>
                <div class="mt-4">
                    <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1">
                        ${product.product_category}
                    </h3>
                    <h2 class="text-black title-font text-lg font-medium">
                        ${product.product_name}
                    </h2>
                    <p class="mt-1">${product.product_price} DT</p>
                </div>
            </div>
        `;
      productContainer.innerHTML += productHTML;
    });
  }
  
  sendPostRequest();
  
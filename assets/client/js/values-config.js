var valueProduct = document.getElementById('value-product');

function maxValue() {
    valueProduct.value = parseInt(valueProduct.value) + 1;
}

// Función para disminuir la cantidad (no puede ser menor que 1)
function minValue() {
    valueProduct.value = Math.max(parseInt(valueProduct.value) - 1, 1);
}

console.log(valueProduct);
var datos

fetch('https://www.dolarsi.com/api/api.php?type=valoresprincipales', {
  method: 'POST', // or 'PUT'
  headers: {
    'Content-Type': 'application/json',
  },
  body: JSON.stringify(datos),
})
.then(response => response.json())
.then(data => {
	datos = data;
	var dollarValue = document.getElementById('testDolar');
	var dolarOficial = parseFloat(datos[0].casa.venta.replace(",","."));
	//console.log(dolarOficial);
	var dolarBlue = parseFloat(datos[1].casa.venta.replace(",","."));
	dollarValue.innerHTML =  ("$"+dolarOficial+" || $"+dolarBlue);

  console.log('Success:', datos,parseFloat(datos[0].casa.venta));
})
.catch((error) => {
  console.error('Error:', error);
});



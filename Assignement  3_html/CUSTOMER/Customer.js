let totalItems = 0;
let totalCost = 0;

function addToCart(price, qty)
{
  let amountNeeded = parseInt(document.getElementById(qty).value);

  totalItems += amountNeeded;

  totalCost += amountNeeded * price;

  document.getElementById("items").innerHTML = totalItems;
  document.getElementById("cost").innerHTML = totalCost + " RWF";
  document.getElementById("totalAmount").value = totalCost;
}

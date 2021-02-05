function price() {
  var total = 0;
  var time = document.getElementById("slider1").value;
  var net = document.getElementById("slct").value;
  total = time * net;

  document.getElementById("totalPrice").innerHTML = "Price: " + total;
}


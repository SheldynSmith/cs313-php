function addItem(item) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          //alert("responded");
          //alert(this.responseText);
          document.getElementById("response").innerHTML = this.responseText;
      }
    };

    var queryString = item + "=1";
    //alert(item);
    xhttp.open("GET", "cart.php?" + queryString, true);
    xhttp.send();
  }

function remove(item) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          //alert("responded");
          //alert(this.responseText);
          document.getElementById("response").innerHTML = this.responseText;
      }
    };
    //alert("remove was called");
    var queryString = item + "=-1";
    xhttp.open("GET", "cart.php?" + queryString, true);
    xhttp.send();
    location.reload();
  }
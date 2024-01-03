var myProductsId;
var ordMyProductsId, ordMyProductsTotal;

function searchProductsIfNotEmpty(val) {
  if (val.length > 0) {
    searchProducts(val);
  }
}

function adminSearchPrdctsIfNotEmpty(val) {
  if (val.length > 0) adminFilterProduct(val);
}

function searchUsersIfNotEmpty(val) {
  if (val.length > 0) adminFilterUsers(val);
}

function searchOrderIfNotEmpty(val) {
  if (val.length > 0) adminFilterOrders(val);
}

function searchCommentIfNotEmpty(val) {
  if (val.length > 0) adminFilterComments(val);
}

function searchProducts(value) {
  if (value.length > 0) {
    searchDivToApp.classList.remove("navDivSearchDivToAppTrans");
    searchDivToApp.classList.add("navDivSearchDivToAppShow");
  } else {
    searchDivToApp.classList.add("navDivSearchDivToAppTrans");
    searchDivToApp.classList.remove("navDivSearchDivToAppShow");
  }

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("navDivSearchDivToAppTablId").innerHTML =
        this.responseText;
    }
  };
  xmlhttp.open("GET", "liveSearchAllProducts.php?name=" + value, true);
  xmlhttp.send();
}

function registerUser() {
  var userName = document.getElementById("registerPageUserNameId").value;
  var userEmail = document.getElementById("registerPageEmailId").value;
  var userPasswrd = document.getElementById("registerPagePasswordId").value;
  var userPhoneNumb = document.getElementById("registerPagePhoneNumbId").value;
  var userAddressLine = document.getElementById("regAddAddressLineId").value;
  var userCity = document.getElementById("regAddAddressCityId").value;
  var userNearTo = document.getElementById("regAddAddressNearToId").value;
  var userCountry = document.getElementById("regAddAddressCountryId").value;

  var emailPattern = /^[\w\.]+(@gmail.com){1}$/i;
  var userNamePattern = /(^((?!\@).)*$)/i;
  var passwordPattern = /(^[\d]+[A-z]+[\w]*$)|(^[A-z]+[\d]+[\w]*$)/i;
  var phoneNumbPattern = /(^[0][3][0-9]{6}$)|(^[7][01689][0-9]{6}$)/i;

  var resultEmail = new RegExp(emailPattern).test(userEmail);
  var resultUserName = new RegExp(userNamePattern).test(userName);
  var resultPassword = new RegExp(passwordPattern).test(userPasswrd);
  var resultPhoneNumb = new RegExp(phoneNumbPattern).test(userPhoneNumb);
  var stopExecution = false;

  if (
    userName.length == 0 ||
    userEmail.length == 0 ||
    userPasswrd.length == 0 ||
    userPhoneNumb.length == 0 ||
    userAddressLine.length == 0 ||
    userCity.length == 0 ||
    userNearTo.length == 0 ||
    userCountry.length == 0
  ) {
    window.alert("Field Empty !");
  } else {
    if (!resultPassword) {
      alert("Password must contains digit and letters");
      stopExecution = true;
    }

    if (!stopExecution) {
      if (!resultEmail || !resultUserName) {
        alert("error with your username/email");
        stopExecution = true;
      } else {
        if (!resultPhoneNumb) {
          alert("error with phone number");
          stopExecution = true;
        } else {
          stopExecution = false;
        }
      }
    }

    if (!stopExecution) {
      var prm =
        "userName=" +
        userName +
        "&userEmail=" +
        userEmail +
        "&password=" +
        userPasswrd +
        "&phoneNumber=" +
        userPhoneNumb +
        "&addressLine=" +
        userAddressLine +
        "&userCity=" +
        userCity +
        "&userNearTo=" +
        userNearTo +
        "&userCountry=" +
        userCountry;
      var xml = new XMLHttpRequest();
      xml.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          var rslt = this.responseText.trim();
          if (rslt != "error1" && rslt != "error2" && rslt != "error3") {
            window.alert("Operation Done !");
            window.location.reload();
          } else {
            switch (rslt) {
              case "error1":
                window.alert("This userName/Email already exists !");
                break;
              case "error2":
                window.alert("Error when adding informations !");
                break;
              case "error3":
                window.alert("Error when adding address !");
                break;
              default:
                window.alert("Operation Done !");
                window.location.reload();
            }
          }
        }
      };
      xml.open("POST", "addNewUser.php", true);
      xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xml.send(prm);
    }
  }
}

function edtProfileSave() {
  var userName = document.getElementById("edtProfileUserNameTextAreaId").value;
  var email = document.getElementById("edtProfileEmailTextAreaId").value;
  var passwrd = document.getElementById("edtProfileUserPasswordAreaId").value;
  var phoneNumb = document.getElementById(
    "edtProfilePhoneNumbTextAreaId"
  ).value;
  var addressLine = document.getElementById(
    "edtProfTableRightTxtAreaLineId"
  ).value;
  var addressCity = document.getElementById(
    "edtProfTableRightTxtAreaCityId"
  ).value;
  var addressNearTo = document.getElementById(
    "edtProfTableRightTxtAreaNearToId"
  ).value;

  var emailPattern = /^[\w\.]+(@gmail.com){1}$/i;
  var userNamePattern = /(^((?!\@).)*$)/i;
  var passwordPattern = /(^[\d]+[A-z]+[\w]*$)|(^[A-z]+[\d]+[\w]*$)/i;
  var phoneNumbPattern = /(^[0][3][0-9]{6}$)|(^[7][01689][0-9]{6}$)/i;

  if (
    userName.length == 0 ||
    email.length == 0 ||
    passwrd.length == 0 ||
    phoneNumb.length == 0 ||
    addressLine.length == 0 ||
    addressCity.length == 0 ||
    addressNearTo.length == 0
  ) {
    window.alert("Field Empty !");
  } else {
    var resultEmail = new RegExp(emailPattern).test(email);
    var resultUserName = new RegExp(userNamePattern).test(userName);
    var resultPassword = new RegExp(passwordPattern).test(passwrd);
    var resultPhoneNumb = new RegExp(phoneNumbPattern).test(phoneNumb);

    if (!resultPassword) {
      alert("Password must contains digit and letters");
      return;
    }

    if (!resultEmail) {
      alert("Error with email");
      return;
    }

    if (!resultPassword) {
      alert("password must contains digit and letter");
      return;
    }

    if (!resultPhoneNumb) {
      alert("error with phone number");
      return;
    }

    var parm =
      "userName=" +
      userName +
      "&email=" +
      email +
      "&password=" +
      passwrd +
      "&phoneNumb=" +
      phoneNumb +
      "&addressLine=" +
      addressLine +
      "&addressCity=" +
      addressCity +
      "&addressNearTo=" +
      addressNearTo;
    var xmlh = new XMLHttpRequest();
    xmlh.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        var rslt = this.response.trim();
        if (rslt == "Done") {
          window.alert("Operation Done !");
          window.location.reload();
        } else {
          switch (rslt) {
            case "error0":
              window.alert("This user already has same details");
              break;
            case "error3":
              window.alert("Can't update address");
              break;
            case "error4":
              window.alert("Can't update user");
              break;
            case "errorName":
              window.alert("This User Name already exists");
              break;
            case "errorEmail":
              window.alert("This Email already exists");
              break;
            case "errorPhoneNumb":
              window.alert("This PhoneNumber already exists");
              break;
            default:
              window.alert("Nothing has changed");
              window.location.reload();
              break;
          }
        }
      }
    };
    xmlh.open("POST", "edtProfileUserFunction.php", true);
    xmlh.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlh.send(parm);
  }
}

function loginUser(buttonId) {
  var userNameEmail;
  var userPassword;
  if (buttonId == "signUpLogInPageDivButtonId") {
    userNameEmail = document.getElementById("userNameEmailId").value;
    userPassword = document.getElementById("userPasswordId").value;
  } else {
    userNameEmail = document.getElementById(
      "LogInDivToAppUserNameEmailId"
    ).value;
    userPassword = document.getElementById("LogInDivToAppPassId").value;
  }

  if (userNameEmail.length == 0 || userPassword.length == 0) {
    window.alert("Field Empty");
  } else {
    var param = "nameEmail=" + userNameEmail + "&userPassword=" + userPassword;
    var xmlh = new XMLHttpRequest();
    xmlh.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        var resp = this.responseText.trim();
        if (resp == "true") {
          window.location.href = "homePage.php";
        } else {
          window.alert(
            this.responseText +
              "\nIf you are an admin you should go to login as admin \n (Click on login Button -> i am admin)"
          );
        }
      }
    };
    xmlh.open("POST", "logInFunction.php", true);
    xmlh.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlh.send(param);
  }
}

function forgetPassword() {
  var userNameEmail = document.getElementById("userNameEmailId").value;
  if (userNameEmail.length == 0) {
    window.alert("You have to add your UserName or Email");
  } else {
    var xm = new XMLHttpRequest();
    xm.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        var res = this.response.trim();
        if (res != "error") {
          userNameEmail = this.responseText;
          sendCodeToEmail(userNameEmail);
        } else {
          window.alert("You don't have an account !");
        }
      }
    };
    var parms = "userNameEmail=" + userNameEmail;
    xm.open("POST", "frgtPassGetEmailFunction.php", true);
    xm.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xm.send(parms);
  }
}

function sendCodeToEmail(userNameEmail) {
  // if(canContinue){
  if (
    confirm(
      "By Accepting this, you will receive a new password that will help you to log in!"
    )
  ) {
    var xmlh = new XMLHttpRequest();
    xmlh.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        // window.alert(this.response);
        // var resp = this.response.trim();
        // if(resp == "error"){
        // window.alert("Something went wrong ");
        // }else{
        window.alert(this.response);
        // }
      }
    };
    var params = "email=" + userNameEmail;
    xmlh.open("POST", "sendCodeToEmailFunction.php", true);
    xmlh.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlh.send(params);
  } else {
    return;
  }
  // }
}

function logInAdmin() {
  var adminNameEmail = document.getElementById("adminNameEmailId").value;
  var adminPassword = document.getElementById("adminPasswordId").value;

  if (adminNameEmail.length == 0 || adminPassword.length == 0) {
    window.alert("Field Empty");
  } else {
    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        var resp = this.responseText.trim();
        if (resp == "true") {
          window.alert("Welcome Mme Rosa");
          window.location.href = "adminHomePage.php";
        } else {
          window.alert("Error with Username/Password");
        }
      }
    };

    var parms = "nameEmail=" + adminNameEmail + "&password=" + adminPassword;
    xml.open("POST", "adminLogInFunction.php", true);
    xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xml.send(parms);
  }
}

function openPageCategorie(categorie) {
  window.location.href = "filterProducts.php?cat=" + categorie;
}

function selectThisProduct(productId) {
  window.location.href = "SelectedProduct.php?prodId=" + productId;
}

function plusQuantityProd(productId) {
  var quantity = document.getElementById(
    "selectedProductDivRightQttInputId"
  ).value;

  var xml = new XMLHttpRequest();
  xml.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // window.alert(this.responseText);
      var resp = this.responseText.trim();
      if (resp == "true") {
        quantity++;
      } else {
        alert("cant add this quantity");
      }
      document.getElementById("selectedProductDivRightQttInputId").value =
        quantity;
    }
  };

  var parm = "quantity=" + quantity + "&productId=" + productId;
  xml.open("POST", "plusQuantityFunction.php", true);
  xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xml.send(parm);
}

function minusQuantityProd() {
  var quantity = document.getElementById(
    "selectedProductDivRightQttInputId"
  ).value;
  if (quantity <= 1) {
    return;
  } else {
    quantity--;
    document.getElementById("selectedProductDivRightQttInputId").value =
      quantity;
  }
}

function checkThisProduct(productId) {
  if (confirm("do you want to remove this product ?")) {
    var xmlh = new XMLHttpRequest();
    xmlh.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        window.alert(this.responseText);
        window.location.reload();
      }
    };

    var parm = "productId=" + productId;
    xmlh.open("POST", "removeProductFromOrder.php", true);
    xmlh.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlh.send(parm);
  } else {
    return;
  }
}

function goToProfilePage() {
  window.location.href = "profilePage.php";
}

function setPage(page) {
  var firstTd = document.getElementById("profilePageFrstDivLeftTableTdId1");
  var secondTd = document.getElementById("profilePageFrstDivLeftTableTdId2");
  var thirdTd = document.getElementById("profilePageFrstDivLeftTableTdId3");

  if (page == "order") {
    window.location.href = "allMyOrdersPage.php";
  }

  if (page == "comments") {
    window.location.href = "commentPage.php";
  }

  if (page == "profile") {
    window.location.href = "profilePage.php";
  }
}

function addComment() {
  var comment = document.getElementById("profileCommentDescTxtAreaId").value;

  if (comment.length == 0) {
    alert("error");
  } else {
    var xmlh = new XMLHttpRequest();
    xmlh.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        // window.alert("");
        var resp = this.responseText.trim();
        if (resp == "true") {
          window.alert("Comment has been added !");
          window.location.reload();
        }
      }
    };
    var parms = "comment=" + comment;
    xmlh.open("POST", "addCommentFunction.php", true);
    xmlh.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlh.send(parms);
  }
}

function adminFilterProduct(prodName) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("adminProductPageTableId").innerHTML =
        this.responseText;
    }
  };
  var parms = "productName=" + prodName;
  xmlhttp.open("POST", "adminFilterProductsFunction.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send(parms);
}

function adminFilterUsers(userName) {
  var xm = new XMLHttpRequest();
  xm.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("adminUsersPageTableId").innerHTML =
        this.responseText;
    }
  };
  var parms = "userName=" + userName;
  xm.open("POST", "adminFilterUsersFunction.php", true);
  xm.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xm.send(parms);
}

function adminFilterOrders(userName) {
  var xm = new XMLHttpRequest();
  xm.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("adminOrdersPageTableId").innerHTML =
        this.responseText;
    }
  };
  var parms = "userName=" + userName;
  xm.open("POST", "adminFilterOrdersFunction.php", true);
  xm.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xm.send(parms);
}

function adminFilterComments(userName) {
  var xm = new XMLHttpRequest();
  xm.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("adminComemntsPageTableId").innerHTML =
        this.responseText;
    }
  };
  var parms = "userName=" + userName;
  xm.open("POST", "adminFilterCommentsFunction.php", true);
  xm.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xm.send(parms);
}

function adminGetThisProduct(prodId) {
  var xml = new XMLHttpRequest();
  xml.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var resp = this.responseText.trim();
      if (resp == "1") {
        window.location.href = "adminProductSelected.php";
      } else {
        window.alert("error");
      }
    }
  };
  var pms = "productId=" + prodId;
  xml.open("POST", "adminSessionPrdctIdFunction.php", true);
  xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xml.send(pms);
}

function adminGetThisOrder(orderId) {
  var xml = new XMLHttpRequest();
  xml.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // window.alert(this.responseText);
      var resp = this.responseText.trim();
      if (resp == "1") {
        window.location.href = "adminOrderSelected.php";
      } else {
        window.alert("error");
      }
    }
  };
  var pms = "orderId=" + orderId;
  xml.open("POST", "adminSessionOrderIdFunction.php", true);
  xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xml.send(pms);
}

function adminSavePrdct(prodId) {
  var name = document.getElementById("adminPrdctSlctdNameId").value;
  var desc = document.getElementById("adminPrdctSlctdDescId").value;
  var pric = document.getElementById("adminPrdctSlctdPricId").value;
  var qtt = document.getElementById("adminPrdctSlctdQttId").value;
  var arch = document.getElementById("adminPrdctSlctArchId");
  if (
    name.length == 0 ||
    desc.length == 0 ||
    pric.length == 0 ||
    qtt.length == 0
  ) {
    window.alert("Field Empty");
  } else {
    var xmlh = new XMLHttpRequest();
    xmlh.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        var resp = this.responseText.trim();
        if (resp == "true") {
          window.alert("Product Updated !");
          window.location.href = "adminAllProducts.php";
        } else {
          window.alert(this.responseText);
        }
      }
    };
    var parms =
      "prodId=" +
      prodId +
      "&name=" +
      name +
      "&desc=" +
      desc +
      "&pric=" +
      pric +
      "&qtt=" +
      qtt +
      "&arch=" +
      arch.checked;
    xmlh.open("POST", "adminSavePrdctFunction.php", true);
    xmlh.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlh.send(parms);
  }
}

function adminRemoveProd(prodId) {
  if (confirm("Do you want to remove this product?")) {
    var xmlh = new XMLHttpRequest();
    xmlh.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        // window.alert(this.responseText);
        var resp = this.responseText.trim();
        if (resp == "true") {
          window.alert("Product Deleted !");
          window.location.href = "adminAllProducts.php";
        } else {
          window.alert("error");
        }
      }
    };
    var parms = "prodId=" + prodId;
    xmlh.open("POST", "adminDeletePrdctFunction.php", true);
    xmlh.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlh.send(parms);
  } else {
    return;
  }
}

function adminGetThisUser(userId) {
  var xmlh = new XMLHttpRequest();
  xmlh.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // window.alert(this.response);
      var resp = this.responseText.trim();
      if (resp == "1") {
        window.location.href = "adminUserSelected.php";
      } else {
        window.alert("error");
      }
    }
  };
  var par = "userId=" + userId;
  xmlh.open("POST", "adminGetThisUserFunction.php", true);
  xmlh.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlh.send(par);
}

function adminChangeCheckBoxPrdct() {
  window.alert(
    "By Changing this box, User will (be/not be) able to see this product !"
  );
}

function ModifQuantite(a, b, action) {
  //Supprimer la quantité du produit
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    const panier = JSON.parse(this.responseText);
    console.log(panier);
    document.getElementById("divMontantPanier").innerHTML =
      panier.montantPanier + "€";

    let idTdQteCom = "tdQteCom" + a;

    let tdQteCom = document.getElementById(idTdQteCom);

    let nouvelleQteCom = 0;
    let oldQte = parseInt(tdQteCom.innerHTML, 10);
    if (action == "moins") {
      tdQteCom.innerHTML = oldQte - 1;
      nouvelleQteCom = oldQte - 1;
    }
    if (action == "plus") {
      tdQteCom.innerHTML = oldQte + 1;
      nouvelleQteCom = oldQte + 1;
    }

    let nouveauMontantProd = nouvelleQteCom * b;
    let idTdTotalProd = "totalProduit" + a;
    let tdTotalProd = document.getElementById(idTdTotalProd);
    console.log(tdTotalProd);
    tdTotalProd.innerHTML = nouveauMontantProd;

    let idBtnMoins = "tdBtnMoins" + a;
    if (nouvelleQteCom == 1) {
      document.getElementById(idBtnMoins).innerHTML =
        '<div class="border border-grey fw-bolder" >-</div>';
    } else {
      let onClickmodifQuantite = "ModifQuantite(" + a + "," + b + ", 'moins')";
      document.getElementById(idBtnMoins).innerHTML =
        '<div class="border border-primary fw-bolder btn btn-outline-primary" onclick="' + onClickmodifQuantite + '">-</div>';
    }
  };
  if (action == "moins") {
    xhttp.open( "GET", "../controller/traitement_ajouter_produit.php?action=modifqtecom&qtecom=moinsqtecom&idprod=" + a + "&prix=" + b, true );
    xhttp.send();
  }
  if (action == "plus") {
    xhttp.open( "GET", "../controller/traitement_ajouter_produit.php?action=modifqtecom&qtecom=plusqtecom&idprod=" + a + "&prix=" + b, true );
    xhttp.send();
  }
}
/*function listeVille(idDept){
        $.ajax({
            url: "../controller/ville.php?dept=";
            type: "POST";
            data:{source:'listeVille',id_dept:idDept},
            success: function(response){
                let villes = JSON.parse(response)
                $("#ville").html('');
                for (i=0;i<villes.length;i++){
                    let option = new Option
                }
                $
            }
        });
    }*/
function departementale(idDept) {
  let xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    const villes = JSON.parse(this.responseText);
    let tout =
      '<select id="floatingInput9" class="form-control" name="id_ville" required><option value="">Sélectionner une ville</option>';
    for (let i = 0; i < villes.length; i++) {
      const ville = villes[i];
      let tabCps = ville.cp.split("-");
      for (let j = 0; j < tabCps.length; j++) {
        tout += '<option value="' + ville.id_ville + "-" + tabCps[j] + '">' + ville.nom_ville + " (" + tabCps[j] + ")" + "</option>";
      }
    }
    tout += "</select>";
    document.getElementById("ville").innerHTML = tout;
  };
  xhttp.open("GET", "../controller/ville.php?dept=" + idDept, true);
  xhttp.send();
}




function mdpverif() {
  let mdp1 = document.getElementById("motdepasse1").value;
  let mdp2 = document.getElementById("motdepasse2").value;
  let pasok =
    '<div class="alert alert-warning" role="alert">Vérifiez que votre mot de passe correspond!</div>';
  let ok =
    '<div class="alert alert-success" role="alert">Votre mot de passe correspond bien.</div>';
  let bouton =
    '<input type="submit" class="btn btn-warning" value="Mettre à jour les informations personnelles">';
  if (mdp1 == mdp2) {
    document.getElementById("mdpverif").innerHTML = ok;
    document.getElementById("boutonSiLeMDPestValide").innerHTML = bouton;
  } else {
    document.getElementById("mdpverif").innerHTML = pasok;
    document.getElementById("boutonSiLeMDPestValide").innerHTML = "";
  }
  if (mdp2 == "") {
    document.getElementById("mdpverif").innerHTML = "";
  }
  if (mdp1) {
    document.getElementById("motdepasse2").removeAttribute("disabled");
  } else {
    document.getElementById("motdepasse2").value = "";
    document.getElementById("motdepasse2").setAttribute("disabled", true);
    document.getElementById("boutonSiLeMDPestValide").innerHTML = "";
    document.getElementById("mdpverif").innerHTML = "";
  }
}
function mdpsaisi() {
  let mdp1 = document.getElementById("motdepasse1").value;

  if (mdp1) {
    document.getElementById("motdepasse2").removeAttribute("disabled");
  } else {
    document.getElementById("motdepasse2").value = "";
    document.getElementById("motdepasse2").setAttribute("disabled", true);
    document.getElementById("boutonSiLeMDPestValide").innerHTML = "";
    document.getElementById("mdpverif").innerHTML = "";
  }
}

function afficherItem(idItem) {
  InfoPerso;
  document.getElementById(idItem).classList.add("show");
  if (idItem == "InfoPerso") {
    document.getElementById("facture").classList.remove("show");
  } else {
    document.getElementById("InfoPerso").classList.remove("show");
  }
}

function recherche(motcle){
  let tout;
  let xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
      if(motcle){
          const produits = JSON.parse(this.responseText);
          console.log(produits);
          tout = '<div class="card mb-3 z-3 bg-white border border-black position-absolute" style="width:400px">';
          for( i=0 ; i<produits.length ; i++ ) {
          const produit = produits[i];
          tout +=
          '<a href="'+produit.link+'#'+produit.id_prod+'" class="text-decoration-none text-black hoverrecherche "><div class="row"><div class="col-4"><img src="assets/images/'+ produit.fichier+'" class="img-fluid rounded-start"></div><div class="col-8"><div class="card-body hovertext"><h5 class="card-title">'+ produit.designation +'</h5></div></div></div></a>';
          }
          tout += '</div>';
      }else{
          tout ='';
      }
      document.getElementById("prod").innerHTML = tout;
  };
  xhttp.open("GET", "../controller/recherche.php?motcle=" + motcle, true);
  xhttp.send();
}


/*function MoinsDeQuantite(a,b){ //Supprimer la quantité du produit
    const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            setTimeout("location.reload(true);");
        }
    xhttp.open("GET","../controller/traitement_ajouter_produit.php?action=modifqtecom&qtecom=moinsqtecom&idprod="+a+"&prix="+b, true);
    xhttp.send();
}

function PlusDeQuantite(a,b){ //Augmenter la quantité du produit
    const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            setTimeout("location.reload(true);");
        }
    xhttp.open("GET","../controller/traitement_ajouter_produit.php?action=modifqtecom&qtecom=plusqtecom&idprod="+a+"&prix="+b, true);
    xhttp.send();
}*/

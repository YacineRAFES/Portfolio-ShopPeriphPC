function categs(idcateg){
    let xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        const categs = JSON.parse(this.responseText);
        console.log(categs);
        let tout =
        '<select name="souscateg" class="form-select" required><option value="">Sélectionner une sous-catégorie</option>';
        for (let i = 0; i < categs.length; i++) {
            const categ = categs[i];
            tout += '<option value="' + categ.id_souscateg + '">' + categ.nom_souscateg + '</option>';
            
        }
        tout += "</select>";
        document.getElementById("sous-categ").innerHTML = tout;
    };
    xhttp.open("GET","../controller/categorie.php?idcateg=" + idcateg, true);
    xhttp.send();
}

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
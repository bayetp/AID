var nbrLike = 0;
var nbrVue = 0;
var nbrMess = 0;

var backColor = "white";
var txtColor = "hsla(0, 0%, 15%, 0.849)";
var secColor = "rgb(0, 136, 199)";
var borderColor = "rgba(111, 209, 255, 0.719)";

function affPubliProfil(id){

  if(document.getElementById("block_publi") != null){

    $.ajax({
      url:'../ajax/affPubliProfil.php?id=' + id,
      success: function(data)
      {
          document.getElementById('block_publi').innerHTML = data;
      }
    });
    
  }

}

function imgSuiv(img, id) {
  
  idImg = img.substring(0, img.length - 1);
  nbrImg = img.substring(img.length - 1, img.length);

  nbrImg = parseInt(nbrImg) + 1;

  newImg = '../img/publi/' + idImg + nbrImg + '.png';

  $.ajax({
    url:'../ajax/fileExist.php?file=' + newImg,
    dataType:'json',
    success: function(data)
    {
        if(data == 1){

          document.getElementById('img_publi' + id).src = newImg;
          document.getElementById('arrowSuiv' + id).setAttribute('onclick', "imgSuiv('" + idImg + nbrImg + "', " + id + ")");
          document.getElementById('arrowPrec' + id).setAttribute('onclick', "imgPrec('" + idImg + nbrImg + "', " + id + ")");

        }
    }
  });

}

function imgPrec(img, id) {
  
  idImg = img.substring(0, img.length - 1);
  nbrImg = img.substring(img.length - 1, img.length);

  nbrImg = parseInt(nbrImg) - 1;

  newImg = '../img/publi/' + idImg + nbrImg + '.png';

  $.ajax({
    url:'../ajax/fileExist.php?file=' + newImg,
    dataType:'json',
    success: function(data)
    {
        if(data == 1){

          document.getElementById('img_publi' + id).src = newImg;
          document.getElementById('arrowSuiv' + id).setAttribute('onclick', "imgSuiv('" + idImg + nbrImg + "', " + id + ")");
          document.getElementById('arrowPrec' + id).setAttribute('onclick', "imgPrec('" + idImg + nbrImg + "', " + id + ")");

        }
    }
  });

}

function addPubli(titre, descript, id){

    $.ajax({

      type: "GET",
      url: "../ajax/addPubli.php?titre=" + titre + "&descript=" + descript,
      dataType: "json",
      success: function(data) {

          if(data == 1){

            document.getElementById('add_publi').style.display = "none";
            document.getElementById('add_publi_img').style.display = "none";

            affPubliProfil(id);

          }else{

            alert('Veuillez remplir tout les champs.');

          }

      }

    });

}

function preview_img(img,id) {

    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById(id);
      output.src = reader.result;
    };
    reader.readAsDataURL(img.files[0]);
    
}

function actuMess(idMe, idOther){

    $.ajax({

        type: "GET",
        url: "../ajax/actuMess.php?me=" + idMe + "&recieved=" + idOther,
        success: function(data) {

            document.getElementById('mess_zone').innerHTML = data;

        }

    });

}

function actuChatBox(){

  $.ajax({

      type: "GET",
      url: "../ajax/actuChatBox.php",
      success: function(data) {

          document.getElementById('block_chatbox').innerHTML = data;

      }

  });

}

function actuMessBox(){

  $.ajax({

      type: "GET",
      url: "../ajax/actuMessBox.php",
      success: function(data) {

          document.getElementById('messBox').innerHTML = data;

      }

  });

}

function setVu(idMe, idOther) {
  
  $.ajax({

    type: "GET",
    url: "../ajax/setVu.php?me=" + idMe + "&recieved=" + idOther,
    success: function(data) {

        

    }

});

}

function sendMess(idMe, idOther, mess, publi){

  alert(publi);

  if((mess != null && mess != "") || publi != ""){
    
    $.ajax({
      
        type: "GET",
        url: "../ajax/sendMess.php?me=" + idMe + "&recieved=" + idOther + "&mess=" + mess + "&publi=" + publi,
        async: false,
        success: function(data) {

            

        }

    }); 

    document.getElementById('txt_mess').value = "";

  }

}

function addNote(idMe, idOther, note) {
  
  document.getElementById('point1').style.backgroundColor = backColor;
  document.getElementById('point2').style.backgroundColor = backColor;
  document.getElementById('point3').style.backgroundColor = backColor;
  document.getElementById('point4').style.backgroundColor = backColor;
  document.getElementById('point5').style.backgroundColor = backColor;

  $.ajax({
      
    type: "GET",
    url: "../ajax/addnote.php?me=" + idMe + "&recieved=" + idOther + "&note=" + note,
    async: false,
    success: function(data) {

        

    }

  });

  for(i=1;i<=note;i++){

    document.getElementById('point' + i).style.backgroundColor = borderColor;

  }

  calcNote(idOther);

}

function calcNote(id) {

  $.ajax({
      
    type: "GET",
    dataType: "json",
    url: "../ajax/calcNote.php?id=" + id,
    async: false,
    success: function(data) {

      console.log(data);
      note = data['value'];
      nbr = data['nbr'];

    }

  }); 

  document.getElementById('pointNote1').style.backgroundColor = backColor;
  document.getElementById('pointNote2').style.backgroundColor = backColor;
  document.getElementById('pointNote3').style.backgroundColor = backColor;
  document.getElementById('pointNote4').style.backgroundColor = backColor;
  document.getElementById('pointNote5').style.backgroundColor = backColor;

  document.getElementById('pointNote1').style.backgroundImage = "none";
  document.getElementById('pointNote2').style.backgroundImage = "none";
  document.getElementById('pointNote3').style.backgroundImage = "none";
  document.getElementById('pointNote4').style.backgroundImage = "none";
  document.getElementById('pointNote5').style.backgroundImage = "none";

  if(note > 0){

    note = note.substring(0, 3);
    notes = note.split(".");

    if(notes[1] > 0){

      document.getElementById('voteValue').innerHTML = note + '/5 <span>(' + nbr + ' avis)</span>';

    }else{

      document.getElementById('voteValue').innerHTML = notes[0] + '/5 <span>(' + nbr + ' avis)</span>';

    }

    for(i=1;i<=notes[0];i++){

      document.getElementById('pointNote' + i).style.backgroundColor = borderColor;

    }

    if(notes[0] < 5){

      demiNote = notes[0];
      demiNote++;

      if(notes[1] > 0){

        document.getElementById('pointNote' + demiNote).style.backgroundImage = "-webkit-linear-gradient(left, " + borderColor + " " + notes[1] + "0%, " + backColor + " " + notes[1] + "0%)";
      
      }

    }

  }else{

    document.getElementById('voteValue').innerHTML = '0/5 <span>(' + nbr + ' avis)</span>';

  }
  
}

function closeOptionMess(maxMess) {

  for(i=1;i<=maxMess;i++){

    var myEle = document.getElementById('optionMess' + i);
    if(myEle){

      document.getElementById('optionMess' + i).style.display = 'none'; 
      document.getElementById('spanOptions' + i).style.display = 'none';

    }

  }
  
}

function supprMess(id) {

  $.ajax({
      
    type: "GET",
    dataType: "json",
    url: "../ajax/supprMess.php?id=" + id,
    async: false,
    success: function(data) {

      

    }

  });
  
}
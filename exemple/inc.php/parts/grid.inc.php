<?php
echo'<section>
      <div id="parent">
<!-- component container -->
<div id="layout" style="height: 100%;"></div>
<div id="chart"></div>
</div>
<script>

  var datasetmenu = [
    {
        "id": "file",
        "value": "File",
        "items": [
            { "id": "fileOpen", "value": "Open", "icon": "dxi dxi-folder-open" },
            { "id": "fileDownload", "value": "Download", "icon": "dxi dxi-download",

            "items": [
              {
                  id: "impXlsx",
                  type: "button",
                  circle: true,
                  value: "Télécharger en xlsx",
                  size: "small",
                  icon: "dxi dxi-download",
                  full: true
              },


              {
                  id: "impcsv",
                  type: "button",
                  circle: true,
                  value: "Télécharger en csv",
                  size: "small",
                  icon: "dxi dxi-download",
                  full: true
              }
            ]
          }
        ]
    },';
    $balise1= "<img class='menu-item' src='https://snippet.dhtmlx.com/codebase/data/menu/03/img/chart-pie.svg'/><span class='dhx_nav-menu-button__text'>Graphiques</span>";
    $balise2= "<img class='menu-item context-menu-item' src='https://snippet.dhtmlx.com/codebase/data/menu/03/img/chart-bar.svg'/><span class='dhx_menu-button__text'> Barre</span>";
    $balise2_a= "<div class='dhx_menu-button__text btnchart' onclick='Hsimple()'><span class='dhx_menu-button__text' > Simple</span></div>";
    $balise2_b= "<div class='dhx_menu-button__text btnchart' onclick='Hempile()'><span class='dhx_menu-button__text' > Empilée</span></div>";
    $balise2_c= "<div class='dhx_menu-button__text btnchart' onclick='Hhorizontal()'><span class='dhx_menu-button__text' > Horizontale</span></div>";
	$balise3= "<img class='menu-item context-menu-item' src='https://snippet.dhtmlx.com/codebase/data/menu/03/img/chart-donut.svg'/><span class='dhx_menu-button__text'> Circulaire</span>";
    $balise3_a= "<div class='dhx_menu-button__text btnchart' onclick='Ganneau()'><span class='dhx_menu-button__text' > Anneau</span></div>";
    $balise3_b= "<div class='dhx_menu-button__text btnchart' onclick='Gradar()'><span class='dhx_menu-button__text' > Radar</span></div>";
    $balise3_c= "<div class='dhx_menu-button__text btnchart' onclick='Gsecteur()'><span class='dhx_menu-button__text' > Secteur</span></div>";
    $balise4= "<img class='menu-item context-menu-item' src='https://snippet.dhtmlx.com/codebase/data/menu/03/img/chart-spline.svg'/><span class='dhx_menu-button__text'> Courbe</span>";
	$balise4_a= "<div class='dhx_menu-button__text btnchart' onclick='Gaire()'><span class='dhx_menu-button__text' > Aires</span></div>";
    $balise4_b= "<div class='dhx_menu-button__text btnchart' onclick='Gcourbe()'><span class='dhx_menu-button__text' > Courbe</span></div>";
    $balise4_c= "<div class='dhx_menu-button__text btnchart' onclick='Gnuage()'><span class='dhx_menu-button__text' > Nuage de points</span></div>";
	echo'{
        "id": "charts",
        "html": "'.$balise1.'",
        "items": [
            {
                "id": "barre",
                "html": "'.$balise2.'",
				"items": [
                    {
                        "id": "Hsimple",
                        "html": "'.$balise2_a.'"
                    },
                    {
                        "id": "Hempilé",
                        "html": "'.$balise2_b.'"
                    },
                    {
                        "id": "Hhorizontal",
                        "html": "'.$balise2_c.'"
                    }

                ]
            },
            {
                "id": "circulaire",
                "html": "'.$balise3.'",
                "items": [
                    {
                        "id": "Ganneau",
                        "html": "'.$balise3_a.'"
                    },
                    {
                        "id": "Gradar",
                        "html": "'.$balise3_b.'"
                    },
                    {
                        "id": "Gsecteur",
                          "html": "'.$balise3_c.'"
                    }

                ]
            },
            {
                "id": "courbe",
                "html": "'.$balise4.'",
				"items": [
                    {
                        "id": "Gaire",
                        "html": "'.$balise4_a.'"
                    },
                    {
                        "id": "Gcourbe",
                        "html": "'.$balise4_b.'"
                    },
                    {
                        "id": "Gnuage",
                          "html": "'.$balise4_c.'"
                    }

                ]
            }
        ]
    },
    {
        id: "add",
        type: "button",
        circle: true,
        value: "Add a new row",
        size: "small",
        icon: "mdi mdi-plus",
        full: true
    }
]
const menu = new dhx.Menu("menu", {
css: "dhx_widget--bg_white dhx_widget--bordered"
});
menu.data.parse(datasetmenu);

// Layout initialization
const layout = new dhx.Layout("layout", {
cols: [
  {
      rows: [
          {
              id: "menu",
              height: "content"
          },
          {
              type: "space",
              rows: [
                  {
                      id: "grid"
                  }
              ]
          }
      ]
  }
]
});

menu.events.on("click", function (id) {
if (id === "add") {
  const newId = grid.data.add({ //data a renseigner
      A: "",
      B: "",
      average_rating: "",
      publication_date: ""
  });
}

//export xlsx
if (id === "impXlsx") {
    grid.export.xlsx({
      url: "https://export.dhtmlx.com/excel"
  });
}
//export csv
if (id === "impcsv") {
grid.export.csv();
}
/*import file*/
if (id === "fileOpen") {
let input = document.createElement("input");
  input.type = "file";
  input.onchange = _ => {
            let files =   Array.from(input.files);
            console.log(files);
			var data = new FormData();
		
		data.append("table", input.files[0]);
		console.log(data);
		var request = new XMLHttpRequest();
		request.onreadystatechange = function () {
			if (request.readyState === 4) {
				fileresults = request.responseText;
				console.log(request.responseText);
				window.location.reload();
			}
		}
		request.open("POST", "inc.php/parts/table_upload.inc.php", true);
		request.setRequestHeader("X-Requested-With", "xmlhttprequest");
		request.send(data);
        };
  input.click();
}
});

layout.getCell("menu").attach(menu);
';
if($_SESSION["currentpage"] != "saisie" || isset($_SESSION["csv"])) {
echo'
// initializing Grid for data vizualization
const grid = new dhx.Grid(null, {
css: "dhx_demo-grid",
columns: [
  {
      id: "action", gravity: 1.5, header: [{ text: "Actions", align: "center" }],
      htmlEnable: true, align: "center",
      editable: false,
      autoWidth: false,
      template: function () {';
			$span = "<span class='action-buttons'><a class='remove-button noselect' title='Supprimer'>&#10060;</a></span>";
          echo'return "'.$span.'";
      }
	  },';
		for($i=0;$i<count($header)-1;$i++){
				echo '{ id: "'.$header[$i].'", header: [{ text: "'.$header[$i].'"}, {content: "selectFilter"}], editable: true }, ';
		}
			echo '{ id: "'.$header[$i].'", header: [{ text: "'.$header[$i].'"}, {content: "selectFilter"}], editable: true } ';
    echo'
],
autoWidth: true,
editable: true,
eventHandlers: {
  onclick: {
      "remove-button": function (e, data) {
          grid.data.remove(data.row.id);
      }
  }
}
});

//import test

function importXlsx() {
    grid.load("", "xlsx"); // loads data from a .xlsx file
}
// loading data into Grid
// loading data into Grid
database = ';
include("inc.php/parts/data.inc.php");
echo'
grid.data.parse(database);

// attaching widgets to Layout cells
layout.getCell("grid").attach(grid);

//--------------------------------------------Scripts pour charger les charts---------------------------------------------
document.addEventListener("DOMContentLoaded", (event) => {
    console.log("DOM fully loaded and parsed");
});
//Histogramme simple
function Hsimple(){
//rechargement du graphe
  var parent=document.getElementById("chart");
  console.log(parent);
  var enfant=document.getElementById("chart").childNodes[0];
  console.log(enfant);
  if(typeof(enfant)!= "undefined"){
  parent.removeChild(enfant);
  }
  const reloadUsingLocationHash = () => {
      window.location.hash = "chart";
    }
  window.onload = reloadUsingLocationHash();
      //rechargement du graphe
  const data = database;

		  
		  
		  
          const config = {
    type: "bar",
    css: "dhx_widget--bg_white dhx_widget--bordered",
    scales: {
        "bottom": {
                      text: "'.$header[0].'"
                  },
                  "left": {
                      maxTicks: 10,
                      max: ';
          				$maxval = 1;
          				for($i=0;$i<count($header);$i++){
          					for($j=0;$j<$row;$j++){
          						if(intval($array[$nbcol[$i]][$j]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$i]][$j]) && $i > 0){
          							if($array[$nbcol[$i]][$j] > $maxval*1.2){
          								$maxval = $array[$nbcol[$i]][$j];
          							}
          						}
          					}
          				}
          				echo $maxval*1.2;
          			echo',
                      min: 0
                  }
              },

              series: [';
          		for($j=0;$j<count($header)-1;$j++){
          			if(intval($array[$nbcol[$j]][0]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$j]][0]) && $j > 0){
          				echo '{ id: "'.$header[$j].'", value: "'.$header[$j].'", color: "#81C4E8", fill: "#81C4E8" },';
          			}
          		}
          			if(intval($array[$nbcol[$j]][0]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$j]][0]) && $j > 0){
          				echo '{ id: "'.$header[$j].'", value: "'.$header[$j].'", color: "#8E4C18", fill: "#8E4C18" }';
          			}
              echo'
          	],
          	legend: {
                  series: [';
          		for($j=0;$j<count($header)-1;$j++){
          			if(intval($array[$nbcol[$j]][0]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$j]][0]) && $j > 0){
          				echo '"'.$header[$j].'", ';
          			}
          		}
          		if(intval($array[$nbcol[$j]][0]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$j]][0]) && $j > 0){
          			echo '"'.$header[$j].'"';
          		}
          		echo'],
                  halign: "right",
                  valign: "top"
              }
          };

          const chart = new dhx.Chart("chart", config);
		  chart.data.parse(data);
		  document.getElementById("layout").style.width = "50vw";
		  document.getElementById("chart").style.width = "50vw";
		  document.getElementById("parent").style.display = "flex";
}

//Histogramme empile
function Hempile(){
  //rechargement du graphe
  var parent=document.getElementById("chart");
  console.log(parent);
  var enfant=document.getElementById("chart").childNodes[0];
  console.log(enfant);
  if(typeof(enfant)!= "undefined"){
  parent.removeChild(enfant);
  }
  const reloadUsingLocationHash = () => {
      window.location.hash = "chart";
    }
    window.onload = reloadUsingLocationHash();
    //rechargement du graphe
    const data = [
  				 { month: "02", "company A": 20, "company B": 52, "company C": 72},
  				 { month: "03", "company A": 5, "company B": 33, "company C": 90 },
  				 { month: "04", "company A": 55, "company B": 30, "company C": 81 },
  				 { month: "05", "company A": 30, "company B": 11, "company C": 62 },
  				 { month: "06", "company A": 27, "company B": 14, "company C": 68 },
  				 { month: "07", "company A": 32, "company B": 31, "company C": 64 },
  		 ];

  		 function getConfig(stacked) {
  	    return {
  	        type: "bar",
  	        css: "dhx_widget--bg_white dhx_widget--bordered",
  	        scales: {
  	            "bottom": {
                      text: "'.$header[0].'"
                  },
                  "left": {
                      maxTicks: 10,
                      max: ';
          				$maxval = 1;
          				for($i=0;$i<count($header);$i++){
          					for($j=0;$j<$row;$j++){
          						if(intval($array[$nbcol[$i]][$j]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$i]][$j]) && $i > 0){
          							if($array[$nbcol[$i]][$j] > $maxval*1.2){
          								$maxval = $array[$nbcol[$i]][$j];
          							}
          						}
          					}
          				}
          				echo $maxval*1.2;
          			echo',
                      min: 0
                  }
              },

              series: [';
          		for($j=0;$j<count($header)-1;$j++){
          			if(intval($array[$nbcol[$j]][0]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$j]][0]) && $j > 0){
          				echo '{ id: "'.$header[$j].'", value: "'.$header[$j].'", color: "#81C4E8", fill: "#81C4E8" },';
          			}
          		}
          			if(intval($array[$nbcol[$j]][0]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$j]][0]) && $j > 0){
          				echo '{ id: "'.$header[$j].'", value: "'.$header[$j].'", color: "#8E4C18", fill: "#8E4C18" }';
          			}
              echo'
          	],
          	legend: {
                  series: [';
          		for($j=0;$j<count($header)-1;$j++){
          			if(intval($array[$nbcol[$j]][0]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$j]][0]) && $j > 0){
          				echo '"'.$header[$j].'", ';
          			}
          		}
          		if(intval($array[$nbcol[$j]][0]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$j]][0]) && $j > 0){
          			echo '"'.$header[$j].'"';
          		}
          		echo'],
                  halign: "right",
                  valign: "top"
              }
  	    }
  	}

  	let stacked = true;
    const chart = new dhx.Chart("chart", getConfig(stacked));
  chart.data.parse(data);
  document.getElementById("layout").style.width = "50vw";
  document.getElementById("chart").style.width = "50vw";
  document.getElementById("parent").style.display = "flex";
}

//Histogramme Horizontal
function Hhorizontal(){
  //rechargement du graphe
  var parent=document.getElementById("chart");
  console.log(parent);
  var enfant=document.getElementById("chart").childNodes[0];
  console.log(enfant);
  if(typeof(enfant)!= "undefined"){
  parent.removeChild(enfant);
  }
  const reloadUsingLocationHash = () => {
      window.location.hash = "chart";
    }
  window.onload = reloadUsingLocationHash();
      //rechargement du graphe
  const data = database;

		  
		  
		  
          const config = {
    type: "xbar",
    css: "dhx_widget--bg_white dhx_widget--bordered",
    scales: {
        "bottom": {
                      text: "'.$header[0].'"
                  },
                  "left": {
                      maxTicks: 10,
                      max: ';
          				$maxval = 1;
          				for($i=0;$i<count($header);$i++){
          					for($j=0;$j<$row;$j++){
          						if(intval($array[$nbcol[$i]][$j]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$i]][$j]) && $i > 0){
          							if($array[$nbcol[$i]][$j] > $maxval*1.2){
          								$maxval = $array[$nbcol[$i]][$j];
          							}
          						}
          					}
          				}
          				echo $maxval*1.2;
          			echo',
                      min: 0
                  }
              },

              series: [';
          		for($j=0;$j<count($header)-1;$j++){
          			if(intval($array[$nbcol[$j]][0]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$j]][0]) && $j > 0){
          				echo '{ id: "'.$header[$j].'", value: "'.$header[$j].'", color: "#81C4E8", fill: "#81C4E8" },';
          			}
          		}
          			if(intval($array[$nbcol[$j]][0]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$j]][0]) && $j > 0){
          				echo '{ id: "'.$header[$j].'", value: "'.$header[$j].'", color: "#8E4C18", fill: "#8E4C18" }';
          			}
              echo'
          	],
          	legend: {
                  series: [';
          		for($j=0;$j<count($header)-1;$j++){
          			if(intval($array[$nbcol[$j]][0]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$j]][0]) && $j > 0){
          				echo '"'.$header[$j].'", ';
          			}
          		}
          		if(intval($array[$nbcol[$j]][0]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$j]][0]) && $j > 0){
          			echo '"'.$header[$j].'"';
          		}
          		echo'],
                  halign: "right",
                  valign: "top"
              }
          };

          const chart = new dhx.Chart("chart", config);
  		chart.data.parse(data);
      document.getElementById("layout").style.width = "50vw";
      document.getElementById("chart").style.width = "50vw";
      document.getElementById("parent").style.display = "flex";
}

//Graphique Anneau
function Ganneau(){
//rechargement du graphe
  var parent=document.getElementById("chart");
  console.log(parent);
  var enfant=document.getElementById("chart").childNodes[0];
  console.log(enfant);
  if(typeof(enfant)!= "undefined"){
  parent.removeChild(enfant);
  }
  const reloadUsingLocationHash = () => {
      window.location.hash = "chart";
    }
  window.onload = reloadUsingLocationHash();
      //rechargement du graphe
  const data = database;

		  
		  
		  
          const config = {
    type: "donut",
    css: "dhx_widget--bg_white dhx_widget--bordered",
    

              series: [';
          		for($j=0;$j<count($header)-1;$j++){
          			if(intval($array[$nbcol[$j]][0]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$j]][0]) && $j > 0){
          				echo '{ id: "'.$header[$j].'", value: "'.$header[$j].'", color: "#81C4E8", fill: "#81C4E8" },';
          			}
          		}
          			if(intval($array[$nbcol[$j]][0]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$j]][0]) && $j > 0){
          				echo '{ id: "'.$header[$j].'", value: "'.$header[$j].'", color: "#8E4C18", fill: "#8E4C18" }';
          			}
              echo'
          	],
          	legend: {
                  series: [';
          		for($j=0;$j<count($header)-1;$j++){
          			if(intval($array[$nbcol[$j]][0]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$j]][0]) && $j > 0){
          				echo '"'.$header[$j].'", ';
          			}
          		}
          		if(intval($array[$nbcol[$j]][0]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$j]][0]) && $j > 0){
          			echo '"'.$header[$j].'"';
          		}
          		echo'],
                  halign: "right",
                  valign: "top"
              }
          };

          const chart = new dhx.Chart("chart", config);
		  chart.data.parse(data);
		  document.getElementById("layout").style.width = "50vw";
		  document.getElementById("chart").style.width = "50vw";
		  document.getElementById("parent").style.display = "flex";
}

//Graphique Radar
function Gradar(){
//rechargement du graphe
  var parent=document.getElementById("chart");
  console.log(parent);
  var enfant=document.getElementById("chart").childNodes[0];
  console.log(enfant);
  if(typeof(enfant)!= "undefined"){
  parent.removeChild(enfant);
  }
  const reloadUsingLocationHash = () => {
      window.location.hash = "chart";
    }
  window.onload = reloadUsingLocationHash();
      //rechargement du graphe
  const data = database;

		  
		  
		  
          const config = {
    type: "radar",
    css: "dhx_widget--bg_white dhx_widget--bordered",
    scales: {
        "bottom": {
                      text: "'.$header[0].'"
                  },
                  "left": {
                      maxTicks: 10,
                      max: ';
          				$maxval = 1;
          				for($i=0;$i<count($header);$i++){
          					for($j=0;$j<$row;$j++){
          						if(intval($array[$nbcol[$i]][$j]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$i]][$j]) && $i > 0){
          							if($array[$nbcol[$i]][$j] > $maxval*1.2){
          								$maxval = $array[$nbcol[$i]][$j];
          							}
          						}
          					}
          				}
          				echo $maxval*1.2;
          			echo',
                      min: 0
                  }
              },

              series: [';
          		for($j=0;$j<count($header)-1;$j++){
          			if(intval($array[$nbcol[$j]][0]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$j]][0]) && $j > 0){
          				echo '{ id: "'.$header[$j].'", value: "'.$header[$j].'", color: "#81C4E8", fill: "#81C4E8" },';
          			}
          		}
          			if(intval($array[$nbcol[$j]][0]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$j]][0]) && $j > 0){
          				echo '{ id: "'.$header[$j].'", value: "'.$header[$j].'", color: "#8E4C18", fill: "#8E4C18" }';
          			}
              echo'
          	],
          	legend: {
                  series: [';
          		for($j=0;$j<count($header)-1;$j++){
          			if(intval($array[$nbcol[$j]][0]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$j]][0]) && $j > 0){
          				echo '"'.$header[$j].'", ';
          			}
          		}
          		if(intval($array[$nbcol[$j]][0]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$j]][0]) && $j > 0){
          			echo '"'.$header[$j].'"';
          		}
          		echo'],
                  halign: "right",
                  valign: "top"
              }
          };

          const chart = new dhx.Chart("chart", config);
		  chart.data.parse(data);
		  document.getElementById("layout").style.width = "50vw";
		  document.getElementById("chart").style.width = "50vw";
		  document.getElementById("parent").style.display = "flex";
}

//Graphique Secteur
function Gsecteur(){
//rechargement du graphe
  var parent=document.getElementById("chart");
  console.log(parent);
  var enfant=document.getElementById("chart").childNodes[0];
  console.log(enfant);
  if(typeof(enfant)!= "undefined"){
  parent.removeChild(enfant);
  }
  const reloadUsingLocationHash = () => {
      window.location.hash = "chart";
    }
  window.onload = reloadUsingLocationHash();
      //rechargement du graphe
  const data = database;

		  
		  
		  
          const config = {
    type: "pie",
    css: "dhx_widget--bg_white dhx_widget--bordered",
    

              series: [';
          		for($j=0;$j<count($header)-1;$j++){
          			if(intval($array[$nbcol[$j]][0]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$j]][0]) && $j > 0){
          				echo '{ id: "'.$header[$j].'", value: "'.$header[$j].'", color: "#81C4E8", fill: "#81C4E8" },';
          			}
          		}
          			if(intval($array[$nbcol[$j]][0]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$j]][0]) && $j > 0){
          				echo '{ id: "'.$header[$j].'", value: "'.$header[$j].'", color: "#8E4C18", fill: "#8E4C18" }';
          			}
              echo'
          	],
          	legend: {
                  series: [';
          		for($j=0;$j<count($header)-1;$j++){
          			if(intval($array[$nbcol[$j]][0]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$j]][0]) && $j > 0){
          				echo '"'.$header[$j].'", ';
          			}
          		}
          		if(intval($array[$nbcol[$j]][0]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$j]][0]) && $j > 0){
          			echo '"'.$header[$j].'"';
          		}
          		echo'],
                  halign: "right",
                  valign: "top"
              }
          };

          const chart = new dhx.Chart("chart", config);
		  chart.data.parse(data);
		  document.getElementById("layout").style.width = "50vw";
		  document.getElementById("chart").style.width = "50vw";
		  document.getElementById("parent").style.display = "flex";
}

//Graphique en Aire
function Gaire(){
//rechargement du graphe
  var parent=document.getElementById("chart");
  console.log(parent);
  var enfant=document.getElementById("chart").childNodes[0];
  console.log(enfant);
  if(typeof(enfant)!= "undefined"){
  parent.removeChild(enfant);
  }
  const reloadUsingLocationHash = () => {
      window.location.hash = "chart";
    }
  window.onload = reloadUsingLocationHash();
      //rechargement du graphe
  const data = database;
  
		  
		  
		  
          const config = {
    type: "area",
    css: "dhx_widget--bg_white dhx_widget--bordered",
    scales: {
        "bottom": {
                      text: "'.$header[0].'"
                  },
                  "left": {
                      maxTicks: 10,
                      max: ';
          				$maxval = 1;
          				for($i=0;$i<count($header);$i++){
          					for($j=0;$j<$row;$j++){
          						if(intval($array[$nbcol[$i]][$j]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$i]][$j]) && $i > 0){
          							if($array[$nbcol[$i]][$j] > $maxval*1.2){
          								$maxval = $array[$nbcol[$i]][$j];
          							}
          						}
          					}
          				}
          				echo $maxval*1.2;
          			echo',
                      min: 0
                  }
              },

              series: [';
          		for($j=0;$j<count($header)-1;$j++){
          			if(intval($array[$nbcol[$j]][0]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$j]][0]) && $j > 0){
          				echo '{ id: "'.$header[$j].'", value: "'.$header[$j].'", color: "#81C4E8", fill: "#81C4E8" },';
          			}
          		}
          			if(intval($array[$nbcol[$j]][0]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$j]][0]) && $j > 0){
          				echo '{ id: "'.$header[$j].'", value: "'.$header[$j].'", color: "#8E4C18", fill: "#8E4C18" }';
          			}
              echo'
          	],
          	legend: {
                  series: [';
          		for($j=0;$j<count($header)-1;$j++){
          			if(intval($array[$nbcol[$j]][0]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$j]][0]) && $j > 0){
          				echo '"'.$header[$j].'", ';
          			}
          		}
          		if(intval($array[$nbcol[$j]][0]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$j]][0]) && $j > 0){
          			echo '"'.$header[$j].'"';
          		}
          		echo'],
                  halign: "right",
                  valign: "top"
              }
          };

          const chart = new dhx.Chart("chart", config);
		  chart.data.parse(data);
		  document.getElementById("layout").style.width = "50vw";
		  document.getElementById("chart").style.width = "50vw";
		  document.getElementById("parent").style.display = "flex";
}
//Graphique Courbe
function Gcourbe(){
//rechargement du graphe
  var parent=document.getElementById("chart");
  console.log(parent);
  var enfant=document.getElementById("chart").childNodes[0];
  console.log(enfant);
  if(typeof(enfant)!= "undefined"){
  parent.removeChild(enfant);
  }
  const reloadUsingLocationHash = () => {
      window.location.hash = "chart";
    }
  window.onload = reloadUsingLocationHash();
      //rechargement du graphe
  const data = database;  
		  
          const config = {
    type: "line",
    css: "dhx_widget--bg_white dhx_widget--bordered",
    scales: {
        "bottom": {
                      text: "'.$header[0].'"
                  },
                  "left": {
                      maxTicks: 10,
                      max: ';
          				$maxval = 1;
          				for($i=0;$i<count($header);$i++){
          					for($j=0;$j<$row;$j++){
          						if(intval($array[$nbcol[$i]][$j]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$i]][$j]) && $i > 0){
          							if($array[$nbcol[$i]][$j] > $maxval*1.2){
          								$maxval = $array[$nbcol[$i]][$j];
          							}
          						}
          					}
          				}
          				echo $maxval*1.2;
          			echo',
                      min: 0
                  }
              },

              series: [';
          		for($j=0;$j<count($header)-1;$j++){
          			if(intval($array[$nbcol[$j]][0]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$j]][0]) && $j > 0){
          				echo '{ id: "'.$header[$j].'", value: "'.$header[$j].'", color: "#81C4E8", fill: "#81C4E8" },';
          			}
          		}
          			if(intval($array[$nbcol[$j]][0]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$j]][0]) && $j > 0){
          				echo '{ id: "'.$header[$j].'", value: "'.$header[$j].'", color: "#8E4C18", fill: "#8E4C18" }';
          			}
              echo'
          	],
          	legend: {
                  series: [';
          		for($j=0;$j<count($header)-1;$j++){
          			if(intval($array[$nbcol[$j]][0]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$j]][0]) && $j > 0){
          				echo '"'.$header[$j].'", ';
          			}
          		}
          		if(intval($array[$nbcol[$j]][0]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$j]][0]) && $j > 0){
          			echo '"'.$header[$j].'"';
          		}
          		echo'],
                  halign: "right",
                  valign: "top"
              }
          };

          const chart = new dhx.Chart("chart", config);
		  chart.data.parse(data);
		  document.getElementById("layout").style.width = "50vw";
		  document.getElementById("chart").style.width = "50vw";
		  document.getElementById("parent").style.display = "flex";
}

//Graphique Nuage
function Gnuage(){
//rechargement du graphe
  var parent=document.getElementById("chart");
  console.log(parent);
  var enfant=document.getElementById("chart").childNodes[0];
  console.log(enfant);
  if(typeof(enfant)!= "undefined"){
  parent.removeChild(enfant);
  }
  const reloadUsingLocationHash = () => {
      window.location.hash = "chart";
    }
  window.onload = reloadUsingLocationHash();
      //rechargement du graphe
  const data = database;
		  
		  
          const config = {
    type: "area",
    css: "dhx_widget--bg_white dhx_widget--bordered",
    scales: {
        "bottom": {
                      text: "'.$header[0].'"
                  },
                  "left": {
                      maxTicks: 10,
                      max: ';
          				$maxval = 1;
          				for($i=0;$i<count($header);$i++){
          					for($j=0;$j<$row;$j++){
          						if(intval($array[$nbcol[$i]][$j]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$i]][$j]) && $i > 0){
          							if($array[$nbcol[$i]][$j] > $maxval*1.2){
          								$maxval = $array[$nbcol[$i]][$j];
          							}
          						}
          					}
          				}
          				echo $maxval*1.2;
          			echo',
                      min: 0
                  }
              },

              series: [';
          		for($j=0;$j<count($header)-1;$j++){
          			if(intval($array[$nbcol[$j]][0]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$j]][0]) && $j > 0){
          				echo '{ id: "'.$header[$j].'", type: "scatter", value: "'.$header[$j].'", color: "#81C4E8", fill: "#81C4E8" },';
          			}
          		}
          			if(intval($array[$nbcol[$j]][0]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$j]][0]) && $j > 0){
          				echo '{ id: "'.$header[$j].'", type: "scatter", value: "'.$header[$j].'", color: "#8E4C18", fill: "#8E4C18" }';
          			}
              echo'
          	],
          	legend: {
                  series: [';
          		for($j=0;$j<count($header)-1;$j++){
          			if(intval($array[$nbcol[$j]][0]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$j]][0]) && $j > 0){
          				echo '"'.$header[$j].'", ';
          			}
          		}
          		if(intval($array[$nbcol[$j]][0]) && !preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$array[$nbcol[$j]][0]) && $j > 0){
          			echo '"'.$header[$j].'"';
          		}
          		echo'],
                  halign: "right",
                  valign: "top"
              }
          };

          const chart = new dhx.Chart("chart", config);
		  chart.data.parse(data);
		  document.getElementById("layout").style.width = "50vw";
		  document.getElementById("chart").style.width = "50vw";
		  document.getElementById("parent").style.display = "flex";
}
';
}
echo'

</script>
<!--tableur-->';
			echo'<script type="text/javascript" src="js/edit.js"></script>';
?>
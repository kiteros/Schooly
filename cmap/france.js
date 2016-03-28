/*
Plugin Name: France regions map
Plugin URI: http://blog.comersis.com/articles/SVG-Raphael-map/
Description: France departements map.
Version: fr-reg-1.0215
Author: S.Marmion ©2015
Author URI: http://www.cmap.comersis.com
License: non-comercial
*/
		var mapfill = "#DBA901";		// Couleur de remplissage des régions
		var maphover_fill = "#FF8000";	// Couleur de survol au passage de la souris
		var mapstroke = "#FFFFFF";		// Couleur des lignes de séparation des régions
		var mapstroke_width = 1.2;		// Epaisseur des lignes de séparation des régions (en points)
		var mapWidth=600;				// Largeur de la carte en pixels
		var mapHeight=600;				// Hauteur de la carte en pixels (facultatif)
		

/*
Modifiez ci-dessous les 2 variables pour chaque région :
	
	title:	" Texte associé à la région ";
	
	url:	" Lien vers la page ou le site souhaité ";

*/		
var paths = {
Z1: {
title: "Alsace-Champagne-Ardenne-Lorraine",
url: "?region=a"
},
Z2: {
title: "Aquitaine-Limousin-Poitou-Charentes",
url: "?region=b"
},
Z3: {
title: "Auvergne-Rhône-Alpes",
url: "?region=c"
},
Z4: {
title: "Bourgogne-Franche-Comté",
url: "?region=d"
},
Z5: {
title: "Bretagne",
url: "?region=e"
},
Z6: {
title: "Centre",
url: "?region=f"
},
Z7: {
title: "Corse",
url: "?region=g"
},
Z8: {
title: "Languedoc-Roussillon-Midi-Pyrénées",
url: "?region=h"
},
Z9: {
title: "Ile-de-France",
url: "?region=i"
},
Z10: {
title: "Nord-Pas-de-Calais-Picardie",
url: "?region=j"
},
Z11: {
title: "Normandie",
url: "?region=k"
},
Z12: {
title: "Pays-de-la-Loire",
url: "?region=l"
},
Z13: {
title: "Provence-Alpes-Côte-d-Azur",
url: "?region=m"
}
}
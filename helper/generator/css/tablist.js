// gestion des listes "collapsibles" en Javascript
// $Id: tablist.js,v 1.4 2005/03/16 11:02:11 touraine37 Exp $

var imgOpened = new Image();
imgOpened.src = './images/minus.gif';
var imgClosed = new Image();
imgClosed.src = './images/plus.gif';
var expandedDb = '';

// on regarde si le client est DOM-compliant

var isDOM = (typeof(document.getElementsByTagName) != 'undefined') ? 1 : 0;

//Opera et konqueror (support DOM partiel) : on rejette
if(isDOM && typeof(navigator.userAgent) != 'undefined') {
    var browserName = ' ' + navigator.userAgent.toLowerCase();
    if(browserName.indexOf('opera') > 0 || browserName.indexOf('konqueror') > 0) {
        isDOM = 0;
    }
}

function changeCoverImage(elt) {
	imgs=elt.getElementsByTagName('img');
	for (i=0; i < imgs.length; i++) {
		img=imgs[i];		
		isbn=img.getAttribute('isbn');
		url_image=img.getAttribute('url_image');
		if (isbn) {
			if (img.src.substring(img.src.length-8,img.src.length)=='vide.png') {
				img.src=url_image.replace(/%21%21isbn%21%21/,isbn);
				}
		}
	}
}

function expandAll() {
  var tempColl    = document.getElementsByTagName('DIV');
  var tempCollCnt = tempColl.length;
  for (var i = 0; i < tempCollCnt; i++) {
     if(tempColl[i].className == 'notice-child')
     tempColl[i].style.display = 'block';
     changeCoverImage(tempColl[i]);
  }
  tempColl    = document.getElementsByTagName('IMG');
  tempCollCnt = tempColl.length;
  for (var i = 0; i < tempCollCnt; i++) {
     if(tempColl[i].name == 'imEx') {
       tempColl[i].src = imgOpened.src;
     }
  }
}

function collapseAll() {
  var tempColl    = document.getElementsByTagName('DIV');
  var tempCollCnt = tempColl.length;
  for (var i = 0; i < tempCollCnt; i++) {
     if(tempColl[i].className == 'notice-child')
     tempColl[i].style.display = 'none';
  }
  tempColl    = document.getElementsByTagName('IMG');
  tempCollCnt = tempColl.length;
  for (var i = 0; i < tempCollCnt; i++) {
     if(tempColl[i].name == 'imEx') {
       tempColl[i].src = imgClosed.src;
     }
  }
}

function initIt()
{
  if (!isDOM) {
//    alert("ce navigateur n'est pas compatible avec le DOM.");
    return;
  }
  var tempColl    = document.getElementsByTagName('DIV');
  var tempCollCnt = tempColl.length;
  for (var i = 0; i < tempCollCnt; i++) {
     if (tempColl[i].className == 'notice-child')
       tempColl[i].style.display = 'none';
  }
} // end of the 'initIt()' function

function expandBase(el, unexpand)
{
  if (!isDOM)
    return;

  var whichEl = document.getElementById(el + 'Child');
  var whichIm = document.getElementById(el + 'Img');
  if (whichEl.style.display == 'none' && whichIm) {
    whichEl.style.display  = 'block';
    whichIm.src            = imgOpened.src;
    changeCoverImage(whichEl);
  }
  else if (unexpand) {
    whichEl.style.display  = 'none';
    whichIm.src            = imgClosed.src;
  }
} // end of the 'expandBase()' function

onload = initIt;
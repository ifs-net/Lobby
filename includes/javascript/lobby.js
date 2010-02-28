function lobby_addQuote(uname,text,done)
{
  	var quote;
  	var selText;
  	if (uname != '') {
	    unameinsert = '=' + uname;
	}
	selText = getSelText();
	if (selText != '') {
		quote = selText;
	} else {
		alert(text);
		return;
	}
  	txt = $('text').getValue() + "\n" + '[quote' + unameinsert + ']' + quote + "[/quote]\n";
  	$('text').setValue(txt);
  	alert(done + "\n" + quote);
}

function getSelText()
{
	var txt = '';
	if (window.getSelection) {
		txt = window.getSelection();
	} else if (document.getSelection) {
		txt = document.getSelection();
	} else if (document.selection) {
		txt = document.selection.createRange().text;
	}
    else {
		return;
	}
	return txt;
}

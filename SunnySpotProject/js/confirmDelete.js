// JavaScript Document
//this function will open a confirm window
function fnConfirm(delURL)
{
if(confirm("Are you sure you want to delete this record?"))
{
	window.location = delURL;
}

}

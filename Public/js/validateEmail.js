function ValidateEmail(inputText)
{
    var mailformat = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(inputText.value.match(mailformat))
    {
        document.getElementById("form1").submit();
        return true;
    }
    else
    {
        alert("You have entered an invalid email address!");
        return false;
    }
}
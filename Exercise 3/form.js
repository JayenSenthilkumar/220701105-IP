
function validate() {
    let x = document.forms["form"]["name"].value == "" ||
            document.forms["form"]["email"].value == "" ||
            document.forms["form"]["password"].value == "" ||
            document.forms["form"]["re-password"].value == "" ||
            document.forms["form"]["roll"].value == "" ||
            document.forms["form"]["gender"].value == "" ||
            document.forms["form"]["age"].value == "" ||
            document.forms["form"]["dept"].value == "" ||
            document.forms["form"]["sec"].value == "" ||
            document.forms["form"]["yr"].value == "" ||
            document.forms["form"]["phnumber"].value == "" ||
            document.forms["form"]["add"].value == "" ||
            document.forms["form"]["state"].value == "";
    if (x) {
        alert("All fields must be filled out.");
        return false;
    }
    return true;
}

function phno(){
    let p=document.form.phnumber.value;
    if(p.length<10)
        alert("Enter a valid mobile number");
}

function new_pass(){
    let a=document.forms["form"]["password"].value;
    var s="";
    let t=0;
    if(a.length<8||a.length>15){
        s=s+"Password should contain atleast 8 characters and atmost 15 characters";
    }
    if(a.search(/[A-Z]/g)==-1){
        s=s+"You have to add atleast one Capital letter"
    }
    if(a.search(/[a-z]/g)==-1){
        s=s+"You have to add atleast one Small letter"
    }
    if(a.search(/[0-9]/g)==-1){
        s=s+"You have to add atleast one number"
    }
    spe=/[!@#$%^&*]/g
    if(spe.test(a)==false){
        s=s+"You have to add atlease one special character"
        t=1;
    }if (s != "") {
        alert(s);
        return false;
    }
    return true;
}

function confirm() {
    let a = document.forms["form"]["password"].value;
    let b = document.forms["form"]["re-password"].value;
    if (a != b && b != "") {
        alert("Passwords don't match");
        return false;
    }
    return true;
}
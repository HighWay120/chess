var button = document.getElementById('button');
button.addEventListener('click', showSol);

function showSol(){
        let valuea = document.getElementById("sol").value;
        document.getElementById("answer").value = valuea;
}
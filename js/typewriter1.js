let words1 = [
        'Lessons'
    ];
    let output1 = document.querySelector("#outwel1");
    let charTurn1 = 0;
    let wordTurn1 = 0;
    
    function printWord1(){
        if(words1[wordTurn1].length >= charTurn1){
            // if(words[wordTurn].length == 8)
            // substring - позволяет выводить символы больше одной сразу
            let str = words1[wordTurn1].substring(0, charTurn1);
            output1.innerHTML = `${str} <span class="typeWriter-line"> | </span>`;
            charTurn1++;
            console.log(charTurn1);
            // пишем фукнция без скобок
            setTimeout(printWord1, 200);
        }else{
        }
    }
    
printWord1();
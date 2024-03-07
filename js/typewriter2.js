let words = [
        'Puzzles'
    ];
    let output = document.querySelector("#outwel");
    let charTurn = 0;
    let wordTurn = 0;
    
    function printWord(){
        if(words[wordTurn].length >= charTurn){
            // if(words[wordTurn].length == 8)
            // substring - позволяет выводить символы больше одной сразу
            let str = words[wordTurn].substring(0, charTurn);
            output.innerHTML = `${str} <span class="typeWriter-line"> | </span>`;
            charTurn++;
            console.log(charTurn);
            // пишем фукнция без скобок
            setTimeout(printWord, 200);
        }else{
        //     setTimeout(deleteWord, 200);
        }
    }
    
    printWord();
function create(){
        let numbers = document.querySelectorAll(".counter");
        console.log(numbers);
        numbers.forEach(number =>{
            number.innerHTML = '0';
            function changeNumber(){
                let finalValue = +(number.getAttribute('data-num'));
                let value = +(number.innerHTML);
                let increment = 1;
                if(value < finalValue){
                    number.innerHTML = Math.round(value + increment);
                    setTimeout(changeNumber, 200);
                }else{
                    number.innerHTML = finalValue;
                }
            }
            changeNumber();
        })
    }
 create();
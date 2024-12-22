document.addEventListener("DOMContentLoaded", function () {
    document.getElementById('Num').addEventListener('change', function () {
        let val = this.value;
        let candidatesDiv = document.getElementById('candidates');

        candidatesDiv.innerHTML = '';
        if (val > 5){
            alert("candidates cannot be more than 5")

        }else if (val < 0){
            alert("candidates cannot be less than 0")
        }
        else{
            for (let i = 0; i < val; i++) {
                let inputField = document.createElement('input');
                inputField.type = 'text';
                inputField.name = 'candidate' + (i);
                inputField.id = 'candidate-name' + (i + 1); 
                inputField.placeholder = 'Enter candidate name';
                candidatesDiv.appendChild(inputField);
                candidatesDiv.appendChild(document.createElement('br')); 
            }
        }
        
    });
});
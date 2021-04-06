window.onload = () =>{
    let btn=document.querySelector('#book');
    let tabBook=document.querySelector('#tabBook');
    let tab=document.querySelector('#tabListBook');
    function getLivre(){
        let myHeaders = new Headers();
        let url = `./public/js/traitement.php?id=${btn.getAttribute('data-id')}`;
        let options ={
            method: 'GET',
            headers: myHeaders,
            mode: 'cors',
            cache: 'default'
        };

        fetch(url, options)
        .then((res)=>{
            if(res.ok){ 
                return res.json();
            }
        })
        
        .then((response)=>{
            console.log(response);
            tab.innerHTML='';
            for(let livre of response){
                tab.innerHTML += `
                <tr>
                    <td>${livre.titre_l}</td>
                    <td>${livre.annee_l}</td>
                    <td>${livre.resume_l}</td>
                </tr>
                `;
            }
            console.log('guillaume le boss');
        })

        .then(()=>{
            tabBook.classList.remove('hide');
            console.log('edwin est un shmirlap'); 
        })

        .catch((error)=>{
            console.log('Error: '+ error);
        })
        // $.ajax({
        //     url: './public/js/traitement.php',
        //     type: 'get',
        //     data: {
        //         id: btn.getAttribute('data-id')
        //     },
        //     dataType: 'JSON',
        //     success: function(response) {
        //         for(let livre of response){
        //             tab.innerHTML += `
        //             <tr>
        //                 <td>${livre.titre_l}</td>
        //                 <td>${livre.annee_l}</td>
        //                 <td>${livre.resume_l}</td>
        //             </tr>
        //             `;
        //         }
        //     },
        //     error: function(err) {
        //         console.log('Error : ' + err);
        //     }
        // })
    }
    btn.addEventListener('click', getLivre);
}


function vote(articleUuid, score, link){

    const data = new FormData();
    data.set('articleUuid', articleUuid);
    data.set('score', score);

    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", link, true);

    xhttp.onload = () => {
        if(xhttp.status === 200){
            response = JSON.parse(xhttp.response);
            const element = document.querySelector(`#article${articleUuid} .score`);
            element.innerHTML = response.articleScore;
        }
        else{
        }
    }

    xhttp.send(data);
}
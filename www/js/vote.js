function addFlashMessage(message, type){
    const element = document.querySelector("#flashMessages");
    const node = document.createElement('div');
    node.className = `flash ${type}`;
    node.innerHTML = message;
    element.appendChild(node);
}
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
            addFlashMessage('Děkujeme za Váš hlas', 'info');
        }
        else{
            addFlashMessage('Už jste zahlasovali.', 'error');
        }
    }

    xhttp.send(data);
}
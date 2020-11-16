
function getMessages(){
  const requeteAjax = new XMLHttpRequest();
  requeteAjax.open("GET", "message.php");

  requeteAjax.onload = function(){
    // recuprer le resultat encoder et le parser
    const resultat = JSON.parse(requeteAjax.responseText);
    // creer le template pour chaque message recupere
    const html = resultat.reverse().map(function(messages){
      return `
        <div class="message">
          <span class="date">${messages.created_at.substring(0, 16)}</span>
          <span class="username">${messages.username}</span> : 
          <br>
          <span class="message_text">${messages.message}</span>
          <hr>
        </div>
      `
    }).join('');
    // selectionner la div ou on veux inserer les templates de message
    const messages = document.querySelector('.messages');
    // inserer le template dans la div selectionnée  
    messages.innerHTML = html;
    // remetre la scrollbar en bas 
    messages.scrollTop = messages.scrollHeight;
  }
  // envoyer la requete ajax
  requeteAjax.send();
}


function postMessage(){
  
  const message = document.querySelector('#message');

  const data = new FormData();
  data.append('message', message.value);

  const requeteAjax = new XMLHttpRequest();
  requeteAjax.open('POST', 'message.php?param=write');
  
  requeteAjax.onload = function(){
    // effacer la zone textarea
    message.value = '';
    // remetre le curseur dans la textarea
    message.focus();
    // recharger les message pour visualiser le message envoyer
    getMessages();
  }

  requeteAjax.send(data);
}

// actualise les messages chaque 10 seconds
const interval = window.setInterval(getMessages, 10000);
// s'execute la premier fois a la connexion ou la creation du compte
// recupere les messages 
getMessages();